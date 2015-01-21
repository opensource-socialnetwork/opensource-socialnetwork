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
$posts = new OssnWall;
$accesstype = ossn_get_homepage_wall_access();
if($accesstype == 'friends'){
 	$posts = $posts->getFriendsPosts();
} elseif($accesstype == 'public'){
	$posts = $posts->GetPosts();	
}
$Pagination = new OssnPagination;
$Pagination->setItem($posts);
$posts = $Pagination->getItem();

if ($posts) {
    foreach ($posts as $post) {
		if(!isset($post->poster_guid)){
			$post = ossn_get_object($post->guid);
		}
        $data = json_decode(html_entity_decode($post->description));
        $text = $data->post;
        $location = '';

        if (isset($data->location)) {
            $location = '- ' . $data->location;
        }
        if (isset($post->{'file:wallphoto'})) {
            $image = str_replace('ossnwall/images/', '', $post->{'file:wallphoto'});
        } else {
            $image = '';
        }

        $user = ossn_user_by_guid($post->poster_guid);
        if ($post->access == OSSN_FRIENDS) {
            if (ossn_user_is_friend(ossn_loggedin_user()->guid, $post->owner_guid) || ossn_loggedin_user()->guid == $post->owner_guid) {
                echo ossn_view('components/OssnWall/templates/activity-item', array(
                    'post' => $post,
                    'friends' => explode(',', $data->friend),
                    'text' => $text,
                    'location' => $location,
                    'user' => $user,
                    'image' => $image,

                ));
            }
        }
        if ($post->access == OSSN_PUBLIC) {
            echo ossn_view('components/OssnWall/templates/activity-item', array(
                'post' => $post,
                'friends' => explode(',', $data->friend),
                'text' => $text,
                'location' => $location,
                'user' => $user,
                'image' => $image,
            ));
        }
        unset($data->friend);
    }
}
echo $Pagination->pagination();
