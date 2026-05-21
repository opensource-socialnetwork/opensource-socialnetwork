<?php
/**
 * OssnAuthentikLogin — OpenID Connect SSO via Authentik.
 */

define('OssnAuthentikLogin', ossn_route()->com . 'OssnAuthentikLogin/');

ossn_register_class(array(
    'OssnAuthentikLogin' => OssnAuthentikLogin . 'classes/OssnAuthentikLogin.php',
));

require_once OssnAuthentikLogin . 'pages/handler.php';

function ossn_authentik_login_init() {
    if (ossn_authentik_login_settings('client_id') && ossn_authentik_login_settings('issuer')) {
        ossn_extend_view('forms/login2/before/submit', 'authentik/login_button');
    }

    // Page handler — /authentik/login starts the flow, /authentik/callback receives Authentik's redirect.
    // Page handlers (vs actions) are the right OSSN primitive for unauthenticated entry points and
    // external IdP redirects: actions enforce CSRF tokens that an external IdP can't carry.
    ossn_register_page('authentik', 'ossn_authentik_login_pagehandler');

    if (ossn_isAdminLoggedin()) {
        ossn_register_com_panel('OssnAuthentikLogin', 'settings');
        ossn_register_action('authentik/admin/settings', OssnAuthentikLogin . 'actions/admin/settings.php');
    }
}

function ossn_authentik_login_settings($key = null) {
    static $settings = null;
    if ($settings === null) {
        $component = new OssnComponents();
        $settings  = $component->getComSettings('OssnAuthentikLogin');
        if (!$settings) {
            $settings = new stdClass();
        }
    }
    if ($key === null) {
        return $settings;
    }
    return isset($settings->{$key}) ? $settings->{$key} : '';
}

/**
 * Default redirect URI: <site>/authentik/callback (no /action prefix —
 * this is a page-handler endpoint). Admins can override for reverse-proxy setups.
 */
function ossn_authentik_login_redirect_uri() {
    $override = ossn_authentik_login_settings('redirect_uri');
    if (!empty($override)) {
        return $override;
    }
    return ossn_site_url('authentik/callback');
}

ossn_register_callback('ossn', 'init', 'ossn_authentik_login_init');
