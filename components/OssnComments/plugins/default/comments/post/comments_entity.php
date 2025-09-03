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
$object = $params['entity_guid'];
$comments = new OssnComments;

if(isset($params['params']) && isset($params['params']['full_view']) &&  $params['params']['full_view'] !== true){
	$comments->limit = 5;
}
if(isset($params['params']) && isset($params['params']['full_view']) &&  $params['params']['full_view'] == true){
	$comments->limit = false;
	$comments->page_limit = false;
}
//[E] Show a group comments to non-member user #1861
//by default allow it!
$allow_post_comment = true;
if(isset($params['allow_comment']) && $params['allow_comment'] == false){
	$allow_post_comment = false;
}
$comments = $comments->GetComments($object, 'entity');
echo "<div class='ossn-comments-list-e{$object}'>";
if ($comments) {
    foreach ($comments as $comment) {
			//if $allow_post_comment is not allowed then we should not allow to like posts comments also
			$comment->allow_comment_like = true;
			if($allow_post_comment == false){
					$comment->allow_comment_like = false;
			}		
            $data['comment'] = get_object_vars($comment);
            echo ossn_comment_view($data);
    }
}
echo '</div>';
if (ossn_isLoggedIn() && $allow_post_comment){	
	$user = ossn_loggedin_user();
	$iconurl = $user->iconURL()->smaller;
    $inputs = ossn_view_form('entity/comment_add', array(
        'action' => ossn_site_url() . 'action/post/comment',
        'component' => 'OssnComments',
        'id' => "comment-container-e{$object}",
        'class' => 'comment-container comment-container-e',
        'autocomplete' => 'off',
        'params' => array('object' => $object)
    ), false);

$form = <<<html
<div class="comments-item">
    <div class="d-flex flex-row">
        <div class="pe-1">
            <img class="comment-user-img" src="{$iconurl}" />
        </div>
        <div class="ps-1 w-100">
            $inputs
        </div>
    </div>
</div>
html;

$form .= '<script>  Ossn.EntityComment(' . $object . '); </script>';
$form .= '<div class="ossn-comment-attachment" id="comment-attachment-container-e' . $object . '">';
$form .= '<script>Ossn.CommentImage(' . $object . ', "entity");</script>';
$form .= ossn_view_form('comment_image', array(
        'id' => "ossn-comment-attachment-e{$object}",
        'component' => 'OssnComments',
        'params' => array(
			'object' => $object,
			'type' => 'e',
		)
    ), false);
$form .= '</div>';
echo $form;
}
