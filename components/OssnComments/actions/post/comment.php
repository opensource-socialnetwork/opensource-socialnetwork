<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$OssnComment = new OssnComments;
$image = input('comment-attachment');
//comment image check if is attached or not
if (!empty($image)) {
    $OssnComment->comment_image = $image;
}
if(!empty($image))
{
$img = 1;
}else
{
$img = 0;
}
//post on which comment is going to be posted
$post = input('post');

//comment text
$comment = input('comment');
if ($OssnComment->PostComment($post, ossn_loggedin_user()->guid, $comment, 'post' , $img)) {
    $data['comment'] = ossn_get_comment($OssnComment->getCommentId());
    $data = ossn_view('components/OssnComments/templates/comment', $data);;
    if (!ossn_is_xhr()) {
        redirect(REF);
    } else {
        header('Content-Type: application/json');
        echo json_encode(array(
                'comment' => $data,
                'process' => 1,
            ));
    }
} else {
    if (!ossn_is_xhr()) {
        redirect(REF);
    } else {
        header('Content-Type: application/json');
        echo json_encode(array('process' => 0,));
    }
}
