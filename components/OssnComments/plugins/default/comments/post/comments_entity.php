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
$object = $params['entity_guid'];

$OssnComments = new OssnComments;
$OssnLikes = new OssnLikes;

$comments = $OssnComments->GetComments($object, 'entity');
echo "<div class='ossn-comments-list-{$object}'>";
if ($comments) {
    $count = 0;
    foreach ($comments as $comment) {
        if ($count <= 5) {
            $data['comment'] = get_object_vars($comment);
            echo ossn_plugin_view('comments/templates/comment', $data);
        } elseif($params->full_view === true){
            $data['comment'] = get_object_vars($comment);
            echo ossn_plugin_view('comments/templates/comment', $data);				
		}
        $count++;
    }
}
echo '</div>';
if (ossn_isLoggedIn()) {
    echo '<div class="poster-image">';
    echo '<img src="' . ossn_site_url() . 'avatar/' . ossn_loggedin_user()->username . '/smaller" />';
    echo '</div>';
    echo '<script>  Ossn.EntityComment(' . $object . '); </script>';
    echo ossn_view_form('entity/comment_add', array(
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
