<?php
/**
 * Open Source Social Network
 *
 * @package   OssnGoLive
 */

$live_input_id = input('live_input_id');

if (empty($live_input_id)) {
    header('Content-Type: application/json');
    echo json_encode(array('success' => false, 'liveViewers' => 0));
    exit();
}

$component = new OssnComponents();
$settings  = $component->getSettings('OssnGoLive');

$account_id   = $settings->cloudflare_account_id;
$api_token    = $settings->cloudflare_api_token;
$cf_subdomain = $settings->cloudflare_subdomain;

if (empty($account_id) || empty($api_token) || empty($cf_subdomain)) {
    header('Content-Type: application/json');
    echo json_encode(array('success' => false, 'liveViewers' => 0));
    exit();
}

// 1. Fetch active videos from Cloudflare Live Input API using the stream/input ID
$ch = curl_init("https://api.cloudflare.com/client/v4/accounts/{$account_id}/stream/live_inputs/{$live_input_id}/videos");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer {$api_token}",
    "Content-Type: application/json"
]);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);
$active_video_uid = null;

if (!empty($data['result']) && is_array($data['result'])) {
    foreach ($data['result'] as $video) {
        if (!empty($video['uid'])) {
            $active_video_uid = $video['uid'];
            break;
        }
    }
}

if (!$active_video_uid) {
    header('Content-Type: application/json');
    echo json_encode(array('success' => true, 'liveViewers' => 0));
    exit();
}

// 2. Query the edge views endpoint using the active video UID
$clean_subdomain = str_replace(['https://', 'http://', '.cloudflarestream.com', 'customer-'], '', $cf_subdomain);
$views_url = "https://customer-{$clean_subdomain}.cloudflarestream.com/{$active_video_uid}/views";

$ch2 = curl_init($views_url);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
$views_response = curl_exec($ch2);
curl_close($ch2);

$views_data = json_decode($views_response, true);
$live_viewers = $views_data['liveViewers'] ?? 0;

header('Content-Type: application/json');
echo json_encode(array('success' => true, 'liveViewers' => $live_viewers));
exit();