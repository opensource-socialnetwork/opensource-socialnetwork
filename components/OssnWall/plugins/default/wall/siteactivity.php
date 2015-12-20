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
$wall       = new OssnWall;
$accesstype = ossn_get_homepage_wall_access();
if($accesstype == 'public' || ossn_isAdminLoggedin()) {
		$posts = $wall->GetPosts(array(
				'type' => 'user'
		));
		$count = $wall->GetPosts(array(
				'count' => true
		));
} elseif($accesstype == 'friends') {
		$posts = $wall->getFriendsPosts();
		$count = $wall->getFriendsPosts(array(
				'count' => true
		));
}
$loggedinuser = ossn_loggedin_user();
if($posts) {
		foreach($posts as $post) {
				$item = ossn_wallpost_to_item($post);
				
				$user = ossn_user_by_guid($post->poster_guid);
				if($post->access == OSSN_FRIENDS) {
						if(ossn_user_is_friend(ossn_loggedin_user()->guid, $post->owner_guid) || $loggedinuser->guid == $post->owner_guid || $loggedinuser->canModerate()) {
								echo ossn_wall_view_template($item);
						}
				}
				if($post->access == OSSN_PUBLIC) {
						echo ossn_wall_view_template($item);
				}
		}
		
}
echo ossn_view_pagination($count);