<?php
/**
 * Open Source Social Network
 *
 * @package   OssnGoLive
 */

$live_input_id   = input('live_input_id');
$last_id_comment = (int) input('last_id_comment');
$last_id_like    = (int) input('last_id_like');

header('Content-Type: application/json');

if (empty($live_input_id)) {
    echo json_encode(array('success' => false, 'comments' => [], 'likes_count' => 0, 'reactions' => []));
    exit();
}

$wall = new \OssnWall();
$posts = $wall->GetPosts(array(
    'page_limit'     => 1,
    'entities_pairs' => array(
        array(
            'name'  => 'item_guid',
            'value' => $live_input_id,
        ),
        array(
            'name'  => 'item_type',
            'value' => 'golive',
        ),
    ),
));

if (!$posts || !is_array($posts)) {
    echo json_encode(array('success' => false, 'comments' => [], 'likes_count' => 0, 'reactions' => []));
    exit();	
}

$post_guid = (int)$posts[0]->guid;

// 1. Fetch new comments (delta polling)
$comments_handler = new OssnComments();
$annotations = $comments_handler->searchAnnotation(array(
    'page_limit'   => false,
    'limit'        => false,
    'type'         => 'comments:post',
    'subject_guid' => $post_guid,
    'wheres'       => array(
        OssnDatabase::wheres("a.id", '>', $last_id_comment),
    ),
));

$cresult = array();
if ($annotations) {
    foreach ($annotations as $comment) {
        $owner = ossn_user_by_guid($comment->owner_guid);
        if ($owner) {
            $cresult[] = array(
                'id'           => (int)$comment->id,
                'time_created' => ossn_user_friendly_time($comment->time_created),
                'text'         => $comment->getParam('comments:post'),	
                'user'         => array(
                    'fullname' => $owner->fullname,
                    'icon'     => $owner->iconURL()->smaller,
                    'profile'  => $owner->profileURL(),
                ),
            );
        }
    }
}

// 2. Fetch total likes count using your custom database helper closure
$helper_count = function($id){
    if(empty($id)){
        return 0;   
    }
    $default = array(
        OssnDatabase::wheres('subject_id', '=', $id),
        OssnDatabase::wheres('type', '=', 'post'),
    );
    $args = array(
        'from'   => 'ossn_likes as l',
        'params' => array("count(*) as total"),
        'wheres' => $default
    );
    $db = new OssnDatabase();
    $result = $db->select($args);
    
    // $result[0] is the row object -> use ->total instead of ['total']
    if($result && isset($result->total)){
        return (int)$result->total;   
    } 
    return 0;
};

$likes_count = $helper_count($post_guid);

// 3. Fetch new reactions (delta likes) for flying animations
$likes = new OssnLikes();
$reactions_list = $likes->GetLikes($post_guid, 'post', array(
    OssnDatabase::wheres('id', '>', $last_id_like)
));

$rresult = array();
if ($reactions_list) {
    foreach ($reactions_list as $reaction) {
        $rresult[] = array(
            'id'   => (int)$reaction->id,
            'type' => $reaction->subtype,
        );
    }
}

echo json_encode(array(
    'success'     => true,
    'comments'    => $cresult,
    'likes_count' => $likes_count,
    'reactions'   => $rresult
));
exit();