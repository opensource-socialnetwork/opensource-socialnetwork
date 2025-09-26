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
		//[E] Normalize Wall Remove JSON #2460
		// Replace tabs with a space abd multiple new lines to signle
		$post = ossn_restore_new_lines($post);
		$post = preg_replace('/\t/', ' ', $post); // Replace tabs with spaces
		$post = preg_replace('/(\r\n|\r|\n)/', "\n", $post); // Normalize newlines to \n
		$post = preg_replace('/\n{3,}/', "\n\n", $post); // Allow max 1 empty line
		$post = trim($post); // Trim leading/trailing whitespace and newlines

		$object->description = $post;
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