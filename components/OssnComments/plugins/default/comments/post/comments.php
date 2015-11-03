<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */

$object = $params->guid;

$comments = new OssnComments;

if($params->full_view !== true){
	$comments->limit = 5;
}
if($params->full_view == true){
	$comments->limit = false;
	$comments->page_limit = false;
}
$comments = $comments->GetComments($object);

echo "<div class='ossn-comments-list-{$object}'>";
if ($comments) {
    foreach ($comments as $comment) {
            $data['comment'] = get_object_vars($comment);
            echo ossn_comment_view($data);
    }
}
echo '</div>';
if (ossn_isLoggedIn()) {
    echo '<div class="poster-image">';
    echo '<img class="poster-image-icon" src="' . ossn_loggedin_user()->iconURL()->smaller . '" />';
    echo '</div>';
    echo '<script>  Ossn.PostComment(' . $object . '); </script>';

    echo ossn_view_form('post/comment_add', array(
        'action' => ossn_site_url() . 'action/post/comment',
        'component' => 'OssnComments',
        'id' => "comment-container-{$object}",
        'class' => 'comment-container',
        'autocomplete' => 'off',
        'params' => array('object' => $object)
    ), false);
    echo '<div class="ossn-comment-attachment" id="comment-attachment-container-' . $object . '">';
    echo '<script>Ossn.CommentImage(' . $object . ');</script>';
    echo ossn_view_form('comment_image', array(
        'id' => "ossn-comment-attachment-{$object}",
        'component' => 'OssnComments',
        'params' => array('object' => $object)
    ), false);
    echo '</div>';

}
