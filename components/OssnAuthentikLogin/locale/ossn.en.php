<?php
/**
 * English locale for OssnAuthentik.
 */
ossn_register_languages('en', array(
    'authentik:login:button'           => 'Sign in with Authentik',
    'authentik:or'                     => '— or —',
    'authentik:not:configured'         => 'Authentik SSO is not configured. Contact an administrator.',
    'authentik:login:error'            => 'Sign-in via Authentik failed. Please try again.',
    'authentik:state:mismatch'         => 'Sign-in session expired or was tampered with. Please try again.',
    'authentik:no:verified:email'      => 'Authentik did not return a verified email address. Verify your email with Authentik before signing in.',
    'authentik:account:exists'         => 'An OSSN account with this email already exists. Sign in with your password.',
    'authentik:provision:failed'       => 'Could not create your account from Authentik.',
    'authentik:settings:issuer:invalid'      => 'Issuer URL must be a valid https:// URL with a hostname.',
    'authentik:redirect_uri:scheme_invalid'  => 'Redirect URI must use https:// (or http:// for localhost development).',
    'authentik:redirect_uri:host_mismatch'   => 'Redirect URI host must match the site URL host. To use a different host, change the site URL first.',

    'authentik:settings:issuer'        => 'Issuer URL',
    'authentik:settings:issuer:help'   => 'The full issuer URL from Authentik (ends with the application slug and a trailing slash).',
    'authentik:settings:client_id'     => 'Client ID',
    'authentik:settings:client_secret' => 'Client Secret',
    'authentik:settings:redirect_uri'  => 'Redirect URI override',
    'authentik:settings:redirect_uri:help' => 'Leave blank to use the site default. Override only if you reverse-proxy through a different host.',
));
