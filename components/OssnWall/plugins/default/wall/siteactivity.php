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
$group	    = new OssnGroup;

$accesstype = ossn_get_homepage_wall_access();
$loggedinuser = ossn_loggedin_user();

// allow admin to watch ALL postings independant of Wall setting
if($accesstype == 'public' || $loggedinuser->canModerate()) {
	$posts = $wall->GetPosts();
	$count = $wall->GetPosts(array(
		'count' => true
	));
} elseif($accesstype == 'friends') {
	$posts = $wall->getFriendsWallAndGroupPosts();
	$count = $wall->getFriendsWallAndGroupPosts(array(
		'count' => true
	));
}

if($posts) {
	foreach($posts as $post) {
		$item = ossn_wallpost_to_item($post);
		$user = ossn_user_by_guid($post->poster_guid);

		if($accesstype == 'public') {
			// wall type 'All Site Posts'
			if($post->access == OSSN_PUBLIC) {
				// show all public posts of type 'user'
				echo ossn_wall_view_template($item);
			} elseif($post->access == OSSN_PRIVATE) {
				// show all postings of all groups which I'm a member of
				// groups make no public/friends-only difference
				if ($group->isMember($post->owner_guid, ossn_loggedin_user()->guid) || $loggedinuser->canModerate()) {
					echo ossn_wall_view_template($item);
				}
			} else {
				// finally show postings of type 'user' which visibility is restricted to friends only
				// which may include my own 'friends-only' postings, too
				if(ossn_user_is_friend(ossn_loggedin_user()->guid, $post->owner_guid) || $loggedinuser->guid == $post->owner_guid || $loggedinuser->canModerate()) {
					echo ossn_wall_view_template($item);
				}
			}
		} elseif($accesstype == 'friends') {
			// wall type 'Friends Posts'
			if($post->access == OSSN_PUBLIC || $post->access == OSSN_FRIENDS) {
				// show only friend's and own postings of type 'user'
				if(ossn_user_is_friend(ossn_loggedin_user()->guid, $post->owner_guid) || $loggedinuser->guid == $post->owner_guid || $loggedinuser->canModerate()) {
					echo ossn_wall_view_template($item);
				}
			} elseif($post->access == OSSN_PRIVATE) { 
				// in case of type 'group'
				if ($group->isMember($post->owner_guid, ossn_loggedin_user()->guid) || $loggedinuser->canModerate()) { 
					// first check membership
					if(ossn_user_is_friend(ossn_loggedin_user()->guid, $post->poster_guid) || $loggedinuser->guid == $post->poster_guid || $loggedinuser->canModerate()) {
						// then show only friend's and own postings in that group
						echo ossn_wall_view_template($item);
					}
				}
			}
		}
	}
}
echo ossn_view_pagination($count);
