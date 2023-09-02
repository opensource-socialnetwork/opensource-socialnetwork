<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$message = input('message');
$to = input('to');
$from = ossn_loggedin_user()->guid;

header('Content-Type: application/json');
if ($to && $from && strlen($message)) {
	$send = ossn_chat();
	if ($message_id = $send->send($from, $to, $message)) {
		$instance = ossn_get_message($message_id);
		
		$vars['message']     = $message;
		$vars['time'] 	 	 = time();
		$vars['instance']  = $instance;
		$vars['view_type'] = 'actions/chat/send';
		//New Message missing message id in div ... id='message-item-' #1841
		$vars['id'] = $message_id;
	
		echo json_encode(array(
			'type' => 1,
			'message' => ossn_plugin_view('chat/message-item-send', $vars),
		));
		exit;
	}
}
echo json_encode(array('type' => 0));
