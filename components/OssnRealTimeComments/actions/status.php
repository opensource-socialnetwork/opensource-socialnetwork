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

$guid       = input('guid');
$type       = input('type');
$cids       = input('comments_ids');
$timestamp  = input('timestamp');
$commentids = array();
if($cids) {
		$cids = explode(',', $cids);
		foreach ($cids as $id) {
				$commentids[] = (int) $id;
		}
}

$RealTimeComments = new RealTimeComments();
$comments         = new OssnComments();

$vars                 = array();
$vars['subject_guid'] = $guid;
$vars['type']         = "comments:{$type}";
$vars['order_by']     = 'a.id ASC';
$vars['page_limit']   = false;

if(!empty($commentids)) {
		//$vars['wheres'] = "a.id NOT IN($commentids) AND a.time_created > {$timestamp}";
		$vars['wheres'] = array(
				array(
						'name'       => 'a.id',
						'comparator' => 'NOT IN',
						'value'      => $commentids,
				),
				array(
						'name'       => 'a.time_created',
						'comparator' => '>',
						'value'      => (int) $timestamp,
				),
		);
}
//[B] RealTimeComments shows comments if user are blocked #2482
if(com_is_active('OssnBlock')) {
		$user   = ossn_loggedin_user();
		$wheres = "(a.owner_guid NOT IN (SELECT DISTINCT relation_to FROM `ossn_relationships` WHERE relation_from={$user->guid} AND type='userblock') AND a.owner_guid NOT IN (SELECT 	DISTINCT relation_from FROM `ossn_relationships` WHERE relation_to='{$user->guid}' AND type='userblock'))";
		if(!isset($vars['wheres'])) {
				$vars['wheres'] = array();
		}
		$vars['wheres'][] = $wheres;
}

$comments = $comments->searchAnnotation($vars);
$lists    = array();
if($comments) {
		foreach ($comments as $comment) {
				$data['comment'] = get_object_vars($comment);
				$lists[]         = ossn_comment_view($data);
		}
}
header('Content-Type: application/json');

if($RealTimeComments->isTyping($guid, $type)) {
		echo json_encode(array(
				'status' => 'typing',
				'lists'  => $lists,
		));
} else {
		echo json_encode(array(
				'lists'  => $lists,
				'status' => 'nottyping',
		));
}
exit();