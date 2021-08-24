<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$wall       = new OssnWall;

$accesstype = ossn_get_homepage_wall_access();
$loggedinuser = ossn_loggedin_user();

// allow admin to watch ALL postings independant of Wall setting
if($loggedinuser->canModerate()) {
	$posts = $wall->getAllPosts(array(
				'type' => 'user',
				'distinct' => true,
	));
	$count = $wall->getAllPosts(array(
			'type' => 'user',
			'count' => true,
			'distinct' => true,
	));
// wall mode: all site posts
} elseif($accesstype == 'public') {
	$posts = $wall->getPublicPosts(array(
				'type' => 'user',
				'distinct' => true,
	));
	$count = $wall->getPublicPosts(array(
			'type' => 'user',
			'count' => true,
			'distinct' => true,
	));
// wall mode: friends-only posts	
} elseif($accesstype == 'friends') {
	$posts = $wall->getFriendsPosts(array(
				'type' => 'user',
				'distinct' => true,
	));
	$count = $wall->getFriendsPosts(array(
			'type' => 'user',
			'count' => true,
			'distinct' => true,
	));
}

if($posts) {
		foreach($posts as $post) {
				$item = ossn_wallpost_to_item($post);
				echo ossn_wall_view_template($item);
		}
		
}

echo ossn_view_pagination($count);
