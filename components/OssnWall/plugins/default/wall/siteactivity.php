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
$wall = new OssnWall;
$accesstype = ossn_get_homepage_wall_access();
if($accesstype == 'public' || ossn_isAdminLoggedin()){
	$posts = $wall->GetPosts();	
	$count = $wall->GetPosts(array('count' => true));
} elseif($accesstype == 'friends'){
 	$posts = $wall->getFriendsPosts();
	//OssnWall Settings (Homepage Posts) #555
	$count = $wall->getFriendsPosts(array('count' => true));
}
if ($posts) {
    foreach ($posts as $post) {
		if(!isset($post->poster_guid)){
			$post = ossn_get_object($post->guid);
		}
        $data = json_decode(html_entity_decode($post->description));
        $text = ossn_restore_new_lines($data->post, true);
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
                echo  ossn_plugin_view('wall/templates/activity-item', array(
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
            echo ossn_plugin_view('wall/templates/activity-item', array(
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
echo ossn_view_pagination($count);