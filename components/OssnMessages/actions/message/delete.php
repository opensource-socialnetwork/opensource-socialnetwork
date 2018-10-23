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

$id = input('id');
$message = ossn_get_message($id);
if(!$id){
	echo 1;	
	exit;
}
if($message->message_from !== ossn_loggedin_user()->guid){
			echo 0;	
			exit;
}
$message->message = ''; //delete message data
$message->data->is_deleted = true;
if($message->save()){
		echo 1;	
} else {
		echo 0;	
}
exit;