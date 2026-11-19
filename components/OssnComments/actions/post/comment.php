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
$user = ossn_loggedin_user();
if(!ossn_isLoggedin() || !$user || empty($user->guid)) {
		if(!ossn_is_xhr()) {
				redirect(REF);
		}
		header('Content-Type: application/json');
		echo json_encode(array(
				'process' => 0
		));
		exit;
}

$user_guid   = (int)$user->guid;
$is_admin    = ossn_isAdminLoggedin();
$OssnComment = new OssnComments();
$image       = input('comment-attachment');
//comment image check if is attached or not
if(!empty($image)) {
		$OssnComment->comment_image = $image;
}
//post on which comment is going to be posted
$post = input('post');

$wall     = new OssnWall();
$wallpost = $wall->GetPost($post);

$can_comment = false;

if($wallpost) {
		if($wallpost->type == 'group') {
				$group = ossn_get_group_by_guid($wallpost->owner_guid);
				if($group && ($is_admin || $group->isMember($group->guid, $user_guid))) {
						$can_comment = true;
				}
		} else {
				if($is_admin || $wallpost->owner_guid == $user_guid || $wallpost->access == OSSN_PUBLIC) {
						$can_comment = true;
				} elseif($wallpost->access == OSSN_FRIENDS && ossn_user_is_friend($wallpost->owner_guid, $user_guid)) {
						$can_comment = true;
				}
		}
}

if(!$can_comment) {
		if(!ossn_is_xhr()) {
				redirect(REF);
		}
		header('Content-Type: application/json');
		echo json_encode(array(
				'process' => 0
		));
		exit;
}

//comment text
$comment = input('comment');
if($OssnComment->PostComment($post, $user_guid, $comment)) {
		$vars            = array();
		$vars['comment'] = (array)ossn_get_comment($OssnComment->getCommentId());
		$data            = ossn_comment_view($vars);
		if(!ossn_is_xhr()) {
				redirect(REF);
		} else {
				header('Content-Type: application/json');
				echo json_encode(array(
						'comment' => $data,
						'process' => 1
				));
				exit;
		}
} else {
		if(!ossn_is_xhr()) {
				redirect(REF);
		} else {
				header('Content-Type: application/json');
				echo json_encode(array(
						'process' => 0
				));
				exit;
		}
}