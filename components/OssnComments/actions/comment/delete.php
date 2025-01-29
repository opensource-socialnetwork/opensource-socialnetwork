<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$comment = input('comment');
$delete  = new OssnComments();
$comment = $delete->GetComment($comment);

$object = false;
$entity = false;
$post   = false;
$group  = false;
//group admins must be able to delete ANY comment in their own group #170
//first get wall post then get group and check if loggedin user is group owner
if($comment->type == 'comments:post') {
		$post = ossn_get_object($comment->subject_guid);
		if($post && $post->type == 'group') {
				$group = ossn_get_group_by_guid($post->owner_guid);
		}
}

if($comment->type == 'comments:object') {
		$object = ossn_get_object($comment->subject_guid);
}

$user = ossn_loggedin_user();
if($comment->type == 'comments:entity') {
		$entity = ossn_get_entity($comment->subject_guid);
		if($entity->type == 'object'){
				$entity_object = ossn_get_object($entity->owner_guid);	
		}
}
//Post owner can not delete others comments #607
//21-04-2022 [E] isModerator (for groups) in comments section also. #2025
if(
		$comment->owner_guid == $user->guid ||
		($object && $object->type == 'user' && $user->guid == $object->owner_guid) ||
		($post && $post->type == 'user' && $user->guid == $post->owner_guid) ||
		($group && ($group->owner_guid == $user->guid || $group->isModerator($user->guid))) ||
		($entity && $entity->type == 'user' && $entity->owner_guid == $user->guid) ||
		($entity && $entity->type == 'object' && $entity_object && $user->guid == $entity_object->owner_guid) ||
		ossn_isAdminLoggedin()
) {
		if($delete->deleteComment($comment->getID())) {
				if(ossn_is_xhr()) {
						echo 1;
						exit();
				} else {
						ossn_trigger_message(ossn_print('comment:deleted'), 'success');
						redirect(REF);
				}
		} else {
				if(ossn_is_xhr()) {
						echo 0;
						exit();
				} else {
						ossn_trigger_message(ossn_print('comment:delete:error'), 'error');
						redirect(REF);
				}
		}
} else {
		if(ossn_is_xhr()) {
				echo 0;
		} else {
				ossn_trigger_message(ossn_print('comment:delete:error'), 'error');
				redirect(REF);
		}
}
