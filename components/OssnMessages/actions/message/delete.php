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
header('Content-Type: application/json'); 
$id = input('id');
$type = input('type');
$message = ossn_get_message($id);

if(!$id){
	echo json_encode(array(
		'type' => $type,
		'status' => 0,
	));
	exit;
}
$userguid = ossn_loggedin_user()->guid;
if($type == 'all' && $message->message_from == $userguid){
	$message->message = ''; //delete message data
	$message->data->is_deleted = true;
	if($message->save()){
			echo json_encode(array(
				'type' => $type,
				'status' => true,
				'id' => $id,
			));
			exit;
	}
}
if($type == 'me' && $message->message_from == $userguid){
	$message->data->is_deleted_from = true;
	if($message->save()){
			echo json_encode(array(
				'type' => $type,
				'status' => true,
				'id' => $id,
			));
			exit;
	}
}
if($type == 'me' && $message->message_to == $userguid){
	$message->data->is_deleted_to = true;
	if($message->save()){
			echo json_encode(array(
				'type' => $type,
				'status' => true,
				'id' => $id,
			));
			exit;
	}
}

echo json_encode(array(
	'type' => $type,
	'status' => false,
	'id' => $id,
));
exit;