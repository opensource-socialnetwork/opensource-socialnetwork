<?php
/**
 * Open Source Social Network
 *
 * @package   OssnGoLive
 */

if (!ossn_isLoggedin()) {
    header('Content-Type: application/json');
    echo json_encode(array('success' => false, 'message' => ossn_print('golive:unauthorized')));
    exit();
}

$user = ossn_loggedin_user();

// 1. Check if Admin Settings are Configured
$component = new OssnComponents();
$settings  = $component->getSettings('OssnGoLive');

if (empty($settings->cloudflare_account_id) || empty($settings->cloudflare_api_token)) {
    header('Content-Type: application/json');
    echo json_encode(array(
        'success' => false, 
        'message' => ossn_print('golive:error:settings:missing') // "Cloudflare Account ID or API Token is not configured in the admin panel."
    ));
    exit();
}

// 2. Get stream configuration (fires hooks so Pro can override if installed)
$stream_config = ossn_golive_get_config($user->guid);

try {
    $golive = new OssnGoLive();
    $result = $golive->startStream($user->guid, $stream_config['payload']);

    // Check if Cloudflare API call failed internally
    if (!isset($result['success']) || !$result['success']) {
        $error_msg = isset($result['message']) ? $result['message'] : ossn_print('golive:error:cloudflare:failed');
        header('Content-Type: application/json');
        echo json_encode(array('success' => false, 'message' => $error_msg));
        exit();
    }

    header('Content-Type: application/json');
    echo json_encode(array_merge($result, array('mode' => $stream_config['mode'])));
    exit();

} catch (Exception $e) {
    // Catch any unexpected connection or cURL/SDK exceptions
    header('Content-Type: application/json');
    echo json_encode(array(
        'success' => false, 
        'message' => ossn_print('golive:error:exception') . ': ' . $e->getMessage()
    ));
    exit();
}