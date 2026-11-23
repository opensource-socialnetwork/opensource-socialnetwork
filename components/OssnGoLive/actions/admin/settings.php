<?php
/**
 * Open Source Social Network
 *
 * @package   OssnGoLive
 */

$account_id   = input('cloudflare_account_id');
$api_token    = input('cloudflare_api_token');
$cf_subdomain = input('cloudflare_subdomain');

$component = new OssnComponents();
$params = array(
    'cloudflare_account_id' => $account_id,
    'cloudflare_api_token'  => $api_token,
    'cloudflare_subdomain'  => $cf_subdomain
);

if ($component->setSettings('OssnGoLive', $params)) {
    ossn_trigger_message(ossn_print('golive:admin:settings:saved'), 'success');
} else {
    ossn_trigger_message(ossn_print('golive:admin:settings:save:error'), 'error');
}

redirect(REF);