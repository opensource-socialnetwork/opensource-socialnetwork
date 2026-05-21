<?php
/**
 * Page handler for /authentik/* — dispatches to login (start of OIDC flow)
 * or callback (Authentik's redirect target).
 *
 * Page handlers don't run OSSN's CSRF check; that's intentional here:
 *   - /authentik/login is hit by an unauthenticated user via a plain link;
 *     CSRF on it has no meaningful threat surface.
 *   - /authentik/callback is hit by Authentik's redirect; no IdP can include
 *     OSSN tokens. The OIDC `state` parameter (validated in callback.php)
 *     is the structurally correct CSRF defence here.
 */
function ossn_authentik_login_pagehandler($pages) {
    $page = isset($pages[0]) ? $pages[0] : '';
    switch ($page) {
        case 'login':
            require OssnAuthentikLogin . 'pages/login.php';
            return;
        case 'callback':
            require OssnAuthentikLogin . 'pages/callback.php';
            return;
        default:
            ossn_error_page();
            return;
    }
}
