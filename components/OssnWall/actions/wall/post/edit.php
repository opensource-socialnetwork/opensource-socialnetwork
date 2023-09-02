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
$guid = input('guid');
$post = input('post');

$object = ossn_get_object($guid);
$user   = ossn_loggedin_user();
if($object && (strlen($post) || $object->{'file:wallphoto'})) {
		//[B] Emoji problem introduced in 6.4 #2186
		$json				 = $object->description;
		$data				 = json_decode($json, true);
		$data['post']		 = $post;
		$data				 = json_encode($data, JSON_UNESCAPED_UNICODE);
		$object->description = $data;
		if(($object->poster_guid == $user->guid || $user->canModerate()) && $object->save()) {
				$params           = array();
				$params['text']   = $post;
				$params['object'] = $object;
				ossn_trigger_callback('wall', 'post:edited', $params);
		
				ossn_trigger_message(ossn_print('ossn:wall:post:saved'));
				return;
		}
}
ossn_trigger_message(ossn_print('ossn:wall:post:save:error'), 'error');
