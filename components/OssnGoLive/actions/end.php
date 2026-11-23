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

$golive = new OssnGoLive();
if ($golive->stopStream($user->guid)) {
    header('Content-Type: application/json');
    echo json_encode(array('success' => true, 'message' => ossn_print('golive:ended:success')));
    exit();
}

header('Content-Type: application/json');
echo json_encode(array('success' => false, 'message' => ossn_print('golive:ended:error')));
exit();