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
set_time_limit(0);
$id     = input('id'); //user guid
$friend = ossn_user_by_guid($id);

if(!$friend) {
		echo 0;
		exit();
}
$userguid = ossn_loggedin_user()->guid;
$from     = $userguid;
$to       = $friend->guid;

$messages = new OssnMessages();
$list     = $messages->searchMessages(array(
		'wheres'         => array(
				"((message_from='{$from}' AND message_to='{$to}' AND emd0.value='') OR (message_from='{$to}' AND message_to='{$from}' AND emd1.value=''))",
		),
		'order_by'       => 'm.id DESC',
		'offset'         => false,
		'page_limit'     => false,
		'entities_pairs' => array(
				array(
						'name'   => 'is_deleted_from',
						'value'  => false,
						'wheres' => '(emd0.value IS NOT NULL)',
				),
				array(
						'name'   => 'is_deleted_to',
						'value'  => false,
						'wheres' => '(emd1.value IS NOT NULL)',
				),
		),
));
if($list) {
		foreach($list as $message) {
				if($message->message_from == $userguid) {
						$message->data->is_deleted_from = true;
						$message->save();
				}
				if($message->message_to == $userguid) {
						$message->data->is_deleted_to = true;
						$message->save();
				}
		}
}
echo 1;
exit();