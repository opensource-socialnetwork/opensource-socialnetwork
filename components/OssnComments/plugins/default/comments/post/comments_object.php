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

$vars 		 = $params;
$object_guid = $params['object_guid'];
$params 	 = $params['params'];	


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
if(isset($vars['allow_comment']) && $vars['allow_comment'] == false){
	$allow_post_comment = false;
}
$comments = $comments->GetComments($object_guid, 'object');

echo "<div class='ossn-comments-list-o{$object_guid}'>";
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
    $inputs = ossn_view_form('object/comment_add', array(
        'action' => ossn_site_url() . 'action/post/object/comment',
        'component' => 'OssnComments',
        'id' => "comment-container-o{$object_guid}",
        'class' => 'comment-container comment-container-o',
        'autocomplete' => 'off',
        'params' => array('object' => $object_guid)
    ), false);

$form = <<<html
<div class="comments-item">
    <div class="row">
        <div class="col-md-1">
            <img class="comment-user-img" src="{$iconurl}" />
        </div>
        <div class="col-md-11">
            $inputs
        </div>
    </div>
</div>
html;

$form .= '<script>  Ossn.ObjectComment(' . $object_guid . '); </script>';
$form .= '<div class="ossn-comment-attachment" id="comment-attachment-container-o' . $object_guid . '">';
$form .= '<script>Ossn.CommentImage(' . $object_guid . ',  "object");</script>';
$form .= ossn_view_form('comment_image', array(
        'id' => "ossn-comment-attachment-o{$object_guid}",
        'component' => 'OssnComments',
        'params' => array(
			'object' => $object_guid,
			'type' => 'o',
		)    
	), false);
$form .= '</div>';
echo $form;
}
