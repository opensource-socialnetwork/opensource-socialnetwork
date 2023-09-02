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
$guid    = input('guid');
$text    = input('comment');
$comment = ossn_get_annotation($guid);

if($comment && (strlen($text) || $comment->{'file:comment:photo'})) {
		//editing, then saving a comment gives warning #685
		$comment->data	= new stdClass;
		if($comment->type == 'comments:entity') {
				$comment->data->{'comments:entity'} = $text;
		} elseif($comment->type == 'comments:object') {
				$comment->data->{'comments:object'} = $text;
		} elseif($comment->type == 'comments:post') {
				$comment->data->{'comments:post'} = $text;
		}
		$user = ossn_loggedin_user();
		if(($comment->owner_guid == $user->guid || $user->canModerate()) && $comment->save()) {
				$params               = array();
				$params['text']       = $text;
				$params['annotation'] = $comment;
				ossn_trigger_callback('comment', 'edited', $params);
		
				ossn_trigger_message(ossn_print('comment:edit:success'));
				return;
		}
}
ossn_trigger_message(ossn_print('comment:edit:failed'), 'error');
