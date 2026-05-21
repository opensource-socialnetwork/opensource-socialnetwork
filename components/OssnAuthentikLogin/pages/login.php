<?php
/**
 * Start the Authentik OIDC login flow.
 *
 * Generates state + nonce, stashes them in the session, and redirects the
 * user to Authentik's authorize endpoint.
 */

if (ossn_isLoggedin()) {
    redirect('home');
}

if (!ossn_authentik_login_settings('client_id') || !ossn_authentik_login_settings('issuer')) {
    ossn_trigger_message(ossn_print('authentik:not:configured'), 'error');
    redirect('login');
}

$state = bin2hex(random_bytes(16));
$nonce = bin2hex(random_bytes(16));

// PKCE (RFC 7636 / OAuth 2.1 baseline): 32-byte verifier → S256 challenge.
// Even if the authorization code is later intercepted (referer leak, proxy log,
// permissive redirect_uri), it cannot be redeemed without this verifier.
$code_verifier  = rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
$code_challenge = rtrim(strtr(base64_encode(hash('sha256', $code_verifier, true)), '+/', '-_'), '=');

OssnSession::assign('authentik_state', $state);
OssnSession::assign('authentik_nonce', $nonce);
OssnSession::assign('authentik_pkce_verifier', $code_verifier);

try {
    $client = new OssnAuthentikLogin();
    $url    = $client->buildAuthorizeUrl($state, $nonce, $code_challenge);
} catch (Exception $e) {
    error_log('OssnAuthentikLogin login: ' . $e->getMessage());
    ossn_trigger_message(ossn_print('authentik:login:error'), 'error');
    redirect('login');
}

header('Location: ' . $url);
exit;
