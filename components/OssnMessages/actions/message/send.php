<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$send = new OssnMessages;
$message = input('message');

// If the message is array, just split the array by space.
if (is_array($message)) {
    $message = implode(" ", $message);
}

if(trim(ossn_restore_new_lines($message)) == ''){
	echo 0;
	exit;
}
$to = intval(input('to')); // it's a BIGINT and causes PHP error if we don't treat it as INT

// Convert negative number "to" to a positive
if (0 > $to) {
    $to = -$to;
}

// Return 0 if the user with guid equal to the value of "to" doesn't exist
if (!ossn_user_by_guid($to)) {
    echo 0;
    exit;
}

if ($message_id = $send->send(ossn_loggedin_user()->guid, $to, $message)) {
	$user = ossn_user_by_guid(ossn_loggedin_user()->guid);
	
	$instance = ossn_get_message($message_id);
	$message = $instance->message;
	
	$params['message_id'] = $message_id;
	$params['user'] = $user;
	$params['message'] = $message;
	$params['instance'] = $instance;
	$params['view_type'] = 'actions/send';
	echo ossn_plugin_view('messages/templates/message-send', $params);
} else {
	echo 0;
}
//messages only at some points #470
// don't mess with system ajax requests
exit;
