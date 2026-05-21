<?php
/**
 * OIDC client for Authentik.
 *
 * Wraps the discovery doc, the authorize URL builder, the code/token exchange,
 * and id_token verification (delegated to firebase/php-jwt under vendor/).
 */

class OssnAuthentikLogin {

    /** Discovery doc cached on disk so a transient MITM can't poison the whole user session. */
    const DISCOVERY_TTL_SECONDS = 86400;

    /** JWKS cached on disk so each login doesn't trigger an outbound fetch. */
    const JWKS_TTL_SECONDS = 3600;

    /** Asymmetric algorithms only — prevents alg-confusion if JWKS ever publishes a symmetric key. */
    private static $allowed_algs = array('RS256', 'RS384', 'RS512', 'ES256', 'ES384', 'EdDSA');

    private function issuer() {
        return rtrim(ossn_authentik_login_settings('issuer'), '/');
    }

    private function discoveryCachePath() {
        return ossn_get_userdata('component/OssnAuthentikLogin/discovery.json');
    }

    private function jwksCachePath() {
        return ossn_get_userdata('component/OssnAuthentikLogin/jwks.json');
    }

    /**
     * Fetch + cache the OIDC discovery document on disk with a fixed TTL.
     * Issuer in the doc is pinned against the configured issuer — a poisoned
     * discovery response with a different `iss` is rejected.
     */
    public function discovery() {
        $path = $this->discoveryCachePath();
        if (is_file($path) && (time() - filemtime($path)) < self::DISCOVERY_TTL_SECONDS) {
            $cached = json_decode(file_get_contents($path));
            if ($cached && isset($cached->authorization_endpoint)) {
                return $cached;
            }
        }

        $url = $this->issuer() . '/.well-known/openid-configuration';
        $raw = $this->httpGet($url);
        if (!$raw) {
            throw new RuntimeException('Authentik: failed to fetch discovery doc');
        }
        $doc = json_decode($raw);
        if (!$doc || !isset($doc->authorization_endpoint, $doc->token_endpoint, $doc->jwks_uri, $doc->issuer)) {
            throw new RuntimeException('Authentik: malformed discovery doc');
        }

        // Pin issuer — if the doc's `iss` doesn't match what we configured, treat as poisoned.
        $configured = $this->issuer();
        $doc_iss    = rtrim($doc->issuer, '/');
        if ($doc_iss !== $configured) {
            throw new RuntimeException('Authentik: discovery issuer mismatch');
        }

        $dir = dirname($path);
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
        @file_put_contents($path, $raw);
        return $doc;
    }

    /**
     * Build the authorize-endpoint URL.
     *
     * $codeChallenge is the base64url-encoded SHA-256 of the PKCE verifier.
     * Pass the empty string to skip PKCE (not recommended).
     */
    public function buildAuthorizeUrl($state, $nonce, $codeChallenge = '') {
        $params = array(
            'response_type' => 'code',
            'client_id'     => ossn_authentik_login_settings('client_id'),
            'redirect_uri'  => ossn_authentik_login_redirect_uri(),
            'scope'         => 'openid profile email',
            'state'         => $state,
            'nonce'         => $nonce,
        );
        if ($codeChallenge !== '') {
            $params['code_challenge']        = $codeChallenge;
            $params['code_challenge_method'] = 'S256';
        }
        return $this->discovery()->authorization_endpoint . '?' . http_build_query($params);
    }

    /**
     * Redeem an authorization code for tokens.
     *
     * $codeVerifier is the PKCE verifier (empty if PKCE was not used).
     */
    public function exchangeCode($code, $codeVerifier = '') {
        $params = array(
            'grant_type'    => 'authorization_code',
            'code'          => $code,
            'redirect_uri'  => ossn_authentik_login_redirect_uri(),
            'client_id'     => ossn_authentik_login_settings('client_id'),
            'client_secret' => ossn_authentik_login_settings('client_secret'),
        );
        if ($codeVerifier !== '' && $codeVerifier !== null) {
            $params['code_verifier'] = $codeVerifier;
        }
        $body = http_build_query($params);
        $raw  = $this->httpPost($this->discovery()->token_endpoint, $body);
        if (!$raw) {
            throw new RuntimeException('Authentik: token endpoint returned nothing');
        }
        $tokens = json_decode($raw);
        if (!$tokens || !isset($tokens->id_token)) {
            throw new RuntimeException('Authentik: token response missing id_token');
        }
        return $tokens;
    }

    /**
     * Verify the id_token signature against Authentik's JWKS, validate
     * iss / aud / azp / exp / nonce, and return the decoded claims.
     *
     * Throws on any failure — caller treats as auth failure.
     */
    public function verifyIdToken($idToken, $expectedNonce) {
        $this->loadJwtLibrary();

        // 30s skew tolerance — covers normal NTP drift between Authentik host and OSSN host.
        \Firebase\JWT\JWT::$leeway = 30;

        $jwks = $this->fetchJwks();
        if (!$jwks || empty($jwks['keys'])) {
            throw new RuntimeException('Authentik: failed to fetch JWKS');
        }

        $keys = \Firebase\JWT\JWK::parseKeySet($jwks);
        foreach ($keys as $kid => $key) {
            if (!in_array($key->getAlgorithm(), self::$allowed_algs, true)) {
                throw new RuntimeException('Authentik: disallowed signing algorithm in JWKS');
            }
        }

        $decoded = \Firebase\JWT\JWT::decode($idToken, $keys);

        $expected_iss = $this->issuer();
        $token_iss    = isset($decoded->iss) ? rtrim($decoded->iss, '/') : '';
        if ($token_iss !== $expected_iss) {
            throw new RuntimeException('Authentik: issuer mismatch');
        }

        // OIDC permits aud as string or array. Accept either, require client_id present.
        $client_id = ossn_authentik_login_settings('client_id');
        $aud_list  = is_array($decoded->aud) ? $decoded->aud : array($decoded->aud);
        if (!in_array($client_id, $aud_list, true)) {
            throw new RuntimeException('Authentik: audience mismatch');
        }
        // OIDC §3.1.3.7: when aud has multiple values, azp MUST equal client_id.
        if (count($aud_list) > 1) {
            if (!isset($decoded->azp) || $decoded->azp !== $client_id) {
                throw new RuntimeException('Authentik: azp mismatch');
            }
        }

        if (!isset($decoded->nonce) || !hash_equals($expectedNonce, (string) $decoded->nonce)) {
            throw new RuntimeException('Authentik: nonce mismatch');
        }
        return $decoded;
    }

    /**
     * Fetch JWKS with an on-disk cache (JWKS_TTL_SECONDS).
     * Returns the decoded keys array, or false on failure.
     *
     * The cache is invalidated by deleting the file; OSSN admins can do this
     * if Authentik rotates keys before the TTL elapses.
     */
    private function fetchJwks() {
        $path = $this->jwksCachePath();
        if (is_file($path) && (time() - filemtime($path)) < self::JWKS_TTL_SECONDS) {
            $cached = json_decode(file_get_contents($path), true);
            if ($cached && !empty($cached['keys'])) {
                return $cached;
            }
        }

        $raw    = $this->httpGet($this->discovery()->jwks_uri);
        $parsed = $raw ? json_decode($raw, true) : null;
        if (!$parsed || empty($parsed['keys'])) {
            return false;
        }

        $dir = dirname($path);
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
        @file_put_contents($path, $raw);
        return $parsed;
    }

    private function loadJwtLibrary() {
        $base = OssnAuthentikLogin . 'vendor/firebase/php-jwt/src/';
        if (!is_file($base . 'JWT.php')) {
            throw new RuntimeException(
                'firebase/php-jwt not installed — run components/OssnAuthentikLogin/vendor/install-jwt.sh'
            );
        }
        require_once $base . 'JWTExceptionWithPayloadInterface.php';
        require_once $base . 'BeforeValidException.php';
        require_once $base . 'ExpiredException.php';
        require_once $base . 'SignatureInvalidException.php';
        require_once $base . 'Key.php';
        require_once $base . 'JWT.php';
        require_once $base . 'JWK.php';
    }

    /**
     * Common curl hardening: TLS peer + hostname verification, HTTPS-only
     * protocols (also restricts redirect targets), explicit timeouts.
     *
     * Pinned explicitly rather than relying on PHP/curl defaults so that a
     * system-level curl.cainfo or php.ini override can't silently disable
     * verification on the auth path.
     */
    private function curlHardenedOptions($url) {
        // Allow plain HTTP only when the target host is a dev-local address
        // (loopback, *.local, RFC1918). Public hosts stay https-only — and
        // because the allowance is decided per-URL, a redirect from a local
        // host to a public host still cannot downgrade to http.
        $host  = parse_url($url, PHP_URL_HOST);
        $local = ossn_authentik_login_is_local_host($host);
        $protos = $local
            ? (CURLPROTO_HTTPS | CURLPROTO_HTTP)
            : CURLPROTO_HTTPS;

        return array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 10,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_PROTOCOLS      => $protos,
            CURLOPT_REDIR_PROTOCOLS => $protos,
        );
    }

    private function httpGet($url) {
        $ch = curl_init($url);
        curl_setopt_array($ch, $this->curlHardenedOptions($url) + array(
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS      => 3,
        ));
        $body = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err  = curl_error($ch);
        curl_close($ch);
        if ($code < 200 || $code >= 300) {
            // Surface IdP failures to the OSSN error log so operators can
            // diagnose discovery / JWKS issues without IdP-side access.
            // Body capped at 500 chars; never reflected to the client.
            error_log(
                "OssnAuthentikLogin: GET {$url} HTTP {$code}"
                . ($err ? " curl_error={$err}" : '')
                . (is_string($body) && $body !== '' ? ' body=' . substr($body, 0, 500) : '')
            );
            return false;
        }
        return $body;
    }

    private function httpPost($url, $body) {
        $ch = curl_init($url);
        curl_setopt_array($ch, $this->curlHardenedOptions($url) + array(
            CURLOPT_POST       => true,
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => array('Content-Type: application/x-www-form-urlencoded'),
            // Token endpoint must not follow redirects — bearer tokens to a
            // different host would be an exfiltration channel.
            CURLOPT_FOLLOWLOCATION => false,
        ));
        $resp = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err  = curl_error($ch);
        curl_close($ch);
        if ($code < 200 || $code >= 300) {
            // Authentik returns OAuth-format JSON {"error":"...","error_description":"..."}
            // on token-endpoint failure. Surface server-side only — the response body may
            // contain authorization codes or short-lived tokens we must not echo to the client.
            error_log(
                "OssnAuthentikLogin: POST {$url} HTTP {$code}"
                . ($err ? " curl_error={$err}" : '')
                . (is_string($resp) && $resp !== '' ? ' body=' . substr($resp, 0, 500) : '')
            );
            return false;
        }
        return $resp;
    }

    /**
     * Find an SSO-provisioned user by their stable Authentik subject identifier.
     * Returns the OssnUser stdClass on hit, false on miss.
     *
     * The OSSN core OssnEntities::searchEntities() interpolates `value` into
     * raw SQL (no placeholder), so the sub is regex-restricted to characters
     * that cannot break out of the SQL string literal — even though the JWT
     * signature has already been verified.
     *
     * Authentik subs are UUIDs; this character class is a strict superset that
     * also accepts the formats used by federated providers Authentik supports.
     */
    public static function userBySub($sub) {
        if (!is_string($sub) || $sub === '') {
            return false;
        }
        if (strlen($sub) > 128 || !preg_match('/^[A-Za-z0-9._@-]+$/', $sub)) {
            error_log('OssnAuthentikLogin: rejected sub claim with disallowed characters');
            return false;
        }
        $entities = new OssnEntities();
        $hits     = $entities->searchEntities(array(
            'type'        => 'user',
            'subtype'     => 'authentik_sub',
            'value'       => $sub,
            'search_type' => false,
        ));
        if (empty($hits)) {
            return false;
        }
        $hit = is_array($hits) ? $hits[0] : $hits;
        if (empty($hit->owner_guid)) {
            return false;
        }
        return ossn_user_by_guid($hit->owner_guid);
    }
}
