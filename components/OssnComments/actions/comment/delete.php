<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$comment = input('comment');
$delete = new OssnComments;
$comment = $delete->GetComment($comment);

//group admins must be able to delete ANY comment in their own group #170
//first get wall post then get group and check if loggedin user is group owner
if ($comment->type == 'comments:post') {
    $post = ossn_get_object($comment->subject_guid);
    if ($post && $post->type == 'group') {
        $group = ossn_get_group_by_guid($post->owner_guid);
    }
}
if ($comment->type == 'comments:entity') {
    $entity = ossn_get_entity($comment->subject_guid);
}
//check if comment is based on entity then check entity ownerguid and if logged in user is entity owner delete comment
if (($comment->owner_guid == ossn_loggedin_user()->guid) || ($group->owner_guid == ossn_loggedin_user()->guid) || ($entity->owner_guid == ossn_loggedin_user()->guid) || ossn_isAdminLoggedin()) {
    if ($delete->deleteComment($comment->getID())) {
        if (ossn_is_xhr()) {
            echo 1;
        } else {
            ossn_trigger_message(ossn_print('comment:deleted'), 'success');
            redirect(REF);
        }
    } else {
        if (ossn_is_xhr()) {
            echo 0;
        } else {
            ossn_trigger_message(ossn_print('comment:delete:error'), 'error');
            redirect(REF);
        }
    }
} else {
    if (ossn_is_xhr()) {
        echo 0;
    } else {
        ossn_trigger_message(ossn_print('comment:delete:error'), 'error');
        redirect(REF);
    }
}