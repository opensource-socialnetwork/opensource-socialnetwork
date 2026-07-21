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

$guid  = input('guid');
$type  = input('type');
$acl   = input('acl');

$ctype = false;

switch ($type) {
case 'p':
		$ctype = 'post';
		break;
case 'o':
		$ctype = 'object';
		break;
case 'e':
		$ctype = 'entity';
		break;
}

$comments             = new OssnComments();
$comments->limit      = false;
$comments->page_limit = false;

$comments = $comments->GetComments($guid, $ctype);
$list     = '';
if($comments) {
		foreach ($comments as $comment) {
            	$comment->allow_comment_like = true;
            	if($acl == 'no'){
            	    $comment->allow_comment_like = false;
           	 	}			
				$data['comment'] = get_object_vars($comment);
				$list .= ossn_comment_view($data);
		}
}
header('Content-Type: application/json');
if(!empty($list)) {
		echo json_encode(array(
				'list' => $list,
		));
} else {
		echo json_encode(array(
				'list' => false,
		));
}