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
$OssnLikes = new OssnLikes();
$anotation = input('post');
$entity    = input('entity');
$object    = input('object');

$reaction_type = input('reaction_type');

if(!empty($anotation)){
		$subject = $anotation;
		$type    = 'post';
}
if(!empty($entity)){
		$subject = $entity;
		$type    = 'entity';
}
if(!empty($object)){
		$subject = $object;
		$type    = 'object';
}
if($OssnLikes->Like($subject, ossn_loggedin_user()->guid, $type, $reaction_type)){
		if(!ossn_is_xhr()){
				redirect(REF);
		} else {
				if($type == 'entity'){
						$likes_container = ossn_plugin_view('likes/post/likes_entity', array(
								'entity_guid' => $subject,
						));
				}
				if($type == 'object'){
						$likes_container = ossn_plugin_view('likes/post/likes_object', array(
								'object_guid' => $subject,
						));
				}
				if($type == 'post'){
						$object          = new stdClass();
						$object->guid    = $subject;
						$likes_container = ossn_plugin_view('likes/post/likes', $object);
				}
				header('Content-Type: application/json');
				echo json_encode(array(
						'done'      => 1,
						'container' => $likes_container,
						'button'    => ossn_print('ossn:unlike'),
				));
		}
} else {
		if(!ossn_is_xhr()){
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