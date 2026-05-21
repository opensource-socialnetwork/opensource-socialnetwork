<?php
/**
 * Save Authentik component settings (admin only).
 */

if (!ossn_isAdminLoggedin()) {
    ossn_error_page();
}

$component    = new OssnComponents();
$issuer       = trim((string) input('authentik_issuer'));
$redirect_uri = trim((string) input('authentik_redirect_uri'));

// Hard-validate the issuer URL — must be well-formed with a host. https is
// mandatory for any non-local host; http is permitted only when the host is a
// dev-style local target (loopback, *.local, RFC1918). Prod cannot accidentally
// downgrade because public hosts always fail the local-host check.
if ($issuer !== '') {
    $issuer_scheme = strtolower((string) parse_url($issuer, PHP_URL_SCHEME));
    $issuer_host   = parse_url($issuer, PHP_URL_HOST);
    $issuer_local  = ossn_authentik_login_is_local_host($issuer_host);
    $scheme_ok     = ($issuer_scheme === 'https') || ($issuer_local && $issuer_scheme === 'http');
    if (!$scheme_ok || !$issuer_host) {
        ossn_trigger_message(ossn_print('authentik:settings:issuer:invalid'), 'error');
        redirect(REF);
    }
}

// Hard-validate the redirect_uri override BEFORE saving. The auth code is
// delivered to whatever this resolves to — a typo or compromised admin
// session here becomes a credential-leak destination on every login.
if ($redirect_uri !== '') {
    $ru_scheme = strtolower((string) parse_url($redirect_uri, PHP_URL_SCHEME));
    $ru_host   = parse_url($redirect_uri, PHP_URL_HOST);
    $site_host = parse_url(ossn_site_url(), PHP_URL_HOST);

    // Local dev hosts (loopback, *.local, RFC1918) may use http; everything
    // else is https-only. Same policy as the issuer above.
    $is_local  = ossn_authentik_login_is_local_host($ru_host);
    $scheme_ok = ($ru_scheme === 'https') || ($is_local && $ru_scheme === 'http');

    if (!$scheme_ok || !$ru_host) {
        ossn_trigger_message(ossn_print('authentik:redirect_uri:scheme_invalid'), 'error');
        redirect(REF);
    }
    if (!$is_local && $site_host && strcasecmp($ru_host, $site_host) !== 0) {
        ossn_trigger_message(ossn_print('authentik:redirect_uri:host_mismatch'), 'error');
        redirect(REF);
    }
}

// Preserve the existing client_secret when the form field is submitted blank.
// The form deliberately renders the password input empty so the stored secret
// never round-trips through the browser DOM; treat empty here as "keep what's
// stored", not as "clear the secret".
$new_secret   = trim((string) input('authentik_client_secret'));
$keep_secret  = (string) ossn_authentik_login_settings('client_secret');

$settings = array(
    'issuer'        => $issuer,
    'client_id'     => trim((string) input('authentik_client_id')),
    'client_secret' => ($new_secret !== '') ? $new_secret : $keep_secret,
    'redirect_uri'  => $redirect_uri,
);

$saved = $component->setSettings('OssnAuthentikLogin', $settings);

if ($saved) {
    ossn_trigger_message(ossn_print('ossn:admin:settings:saved'));
} else {
    ossn_trigger_message(ossn_print('ossn:admin:settings:save:error'), 'error');
}
redirect(REF);
