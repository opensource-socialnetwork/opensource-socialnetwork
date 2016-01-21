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
$wall  = new OssnWall;
$group = new OssnGroup;

$accesstype   = ossn_get_homepage_wall_access();
$loggedinuser = ossn_loggedin_user();

// allow admin to watch ALL postings independant of Wall setting
if($loggedinuser->canModerate()) {
		$posts = $wall->GetPosts();
		$count = $wall->GetPosts(array(
				'count' => true
		));
} elseif($accesstype == 'public' && !$loggedinuser->canModerate()) {
		$posts = $wall->getNewsFeedPosts();
		$count = $wall->getNewsFeedPosts(array(
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
				echo ossn_wall_view_template($item);
		}
}
echo ossn_view_pagination($count);