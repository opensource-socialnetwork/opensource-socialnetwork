<?php
/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$from = $params['message_to'];
$to = ossn_loggedin_user();

foreach(ossn_chat()->getNew($from, $to) as as $message){
			 if(ossn_loggedin_user()->guid == $message->message_from){
				 $vars['message'] = $message->message;
				 echo ossn_view('components/OssnChat/views/OssnChat/message-item-send', $vars); 
			 } else {
				 $vars['reciever'] = ossn_user_by_guid($message->message_from);
			     $vars['message'] = $message->message;
				 echo ossn_view('components/OssnChat/views/OssnChat/message-item-received', $vars); 	 
			 }
}