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
		} else {
				header('Content-Type: application/json');
				echo json_encode(array(
						'done'      => 0,
						'container' => false,
						'button'    => ossn_print('ossn:like'),
				));
		}
		exit();
}

$user_guid = (int)$user->guid;
$is_admin  = ossn_isAdminLoggedin();

$OssnLikes = new OssnLikes();
$anotation = input('post');
$entity    = input('entity');
$object    = input('object');

$reaction_type = input('reaction_type');

$subject = null;
$type    = null;

if(!empty($anotation)) {
		$subject = $anotation;
		$type    = 'post';
}
if(!empty($entity)) {
		$subject = $entity;
		$type    = 'entity';
}
if(!empty($object)) {
		$subject = $object;
		$type    = 'object';
}

$can_like = !empty($subject) && !empty($type);

if($can_like && $type == 'post') {
		$can_like = false;
		$wall     = new OssnWall();
		$wallpost = $wall->GetPost($subject);

		if($wallpost) {
				if($wallpost->type == 'group') {
						$group = ossn_get_group_by_guid($wallpost->owner_guid);
						if($group && ($is_admin || $group->isMember($group->guid, $user_guid))) {
								$can_like = true;
						}
				} else {
						if($is_admin || $wallpost->owner_guid == $user_guid || $wallpost->access == OSSN_PUBLIC) {
								$can_like = true;
						} elseif($wallpost->access == OSSN_FRIENDS && ossn_user_is_friend($wallpost->owner_guid, $user_guid)) {
								$can_like = true;
						}
				}
		}
}

if(!$can_like) {
		if(!ossn_is_xhr()) {
				redirect(REF);
		} else {
				header('Content-Type: application/json');
				echo json_encode(array(
						'done'      => 0,
						'container' => false,
						'button'    => ossn_print('ossn:like'),
				));
		}
		exit();
}

if($OssnLikes->Like($subject, $user_guid, $type, $reaction_type)) {
		if(!ossn_is_xhr()) {
				redirect(REF);
		} else {
				if($type == 'entity') {
						$likes_container = ossn_plugin_view('likes/post/likes_entity', array(
								'entity_guid' => $subject,
						));
				}
				if($type == 'object') {
						$likes_container = ossn_plugin_view('likes/post/likes_object', array(
								'object_guid' => $subject,
						));
				}
				if($type == 'post') {
						$object          = new stdClass();
						$object->guid    = $subject;
						$likes_container = ossn_plugin_view('likes/post/likes', $object);
				}
				header('Content-Type: application/json');
				$icon = ossn_plugin_view('likes/reacted_icon', array(
						'type' => $reaction_type,
				));
				echo json_encode(array(
						'done'      => 1,
						'container' => $likes_container,
						'class'     => "ossn-reacted-item ossn-reacted-{$reaction_type}",
						'button'    => "{$icon} <span>" . ossn_print("ossn:reaction:{$reaction_type}") . '</span>',
				));
		}
} else {
		if(!ossn_is_xhr()) {
				redirect(REF);
		} else {
				header('Content-Type: application/json');
				echo json_encode(array(
						'done'      => 0,
						'container' => false,
						'button'    => ossn_print('ossn:like'),
				));
		}
}
exit();