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

// Hard-validate the issuer URL — only https, well-formed, with a host.
if ($issuer !== '') {
    $issuer_scheme = strtolower((string) parse_url($issuer, PHP_URL_SCHEME));
    $issuer_host   = parse_url($issuer, PHP_URL_HOST);
    if ($issuer_scheme !== 'https' || !$issuer_host) {
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

    // Localhost is the only http exception (dev environments).
    $is_localhost = ($ru_host === 'localhost' || $ru_host === '127.0.0.1' || $ru_host === '::1');
    $scheme_ok    = ($ru_scheme === 'https') || ($is_localhost && $ru_scheme === 'http');

    if (!$scheme_ok || !$ru_host) {
        ossn_trigger_message(ossn_print('authentik:redirect_uri:scheme_invalid'), 'error');
        redirect(REF);
    }
    if (!$is_localhost && $site_host && strcasecmp($ru_host, $site_host) !== 0) {
        ossn_trigger_message(ossn_print('authentik:redirect_uri:host_mismatch'), 'error');
        redirect(REF);
    }
}

$settings = array(
    'issuer'        => $issuer,
    'client_id'     => trim((string) input('authentik_client_id')),
    'client_secret' => trim((string) input('authentik_client_secret')),
    'redirect_uri'  => $redirect_uri,
);

$saved = $component->setSettings('OssnAuthentikLogin', $settings);

if ($saved) {
    ossn_trigger_message(ossn_print('ossn:admin:settings:saved'));
} else {
    ossn_trigger_message(ossn_print('ossn:admin:settings:save:error'), 'error');
}
redirect(REF);
