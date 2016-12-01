<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$guid = input('guid');
$post = input('post');

$object = ossn_get_object($guid);
$user   = ossn_loggedin_user();
if(!$object || empty($post)) {
		ossn_trigger_message(ossn_print('ossn:wall:post:save:error'), 'error');
		redirect(REF);
}

$post = htmlspecialchars($post, ENT_QUOTES, 'UTF-8');
$json = html_entity_decode($object->description);

$data         = json_decode($json, true);
$data['post'] = $post;

$data                = json_encode($data, JSON_UNESCAPED_UNICODE);
$object->description = $data;
if(($object->poster_guid == $user->guid || $user->canModerate()) && $object->save()) {
		$params           = array();
		$params['text']   = $post;
		$params['object'] = $object;
		ossn_trigger_callback('wall', 'post:edited', $params);
		
		ossn_trigger_message(ossn_print('ossn:wall:post:saved'));
		redirect(REF);
} else {
		ossn_trigger_message(ossn_print('ossn:wall:post:save:error'), 'error');
		redirect(REF);
}
  