<?php
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$OssnWall = new OssnWall;
$posts = $OssnWall->GetUserPosts($params['user']);
//lastchage: site admins are unable to access member profile threads without friendship #176 
if(ossn_loggedin_user() && (ossn_user_is_friend(ossn_loggedin_user()->guid, $params['user']->guid) || ossn_loggedin_user()->guid == $params['user']->guid || ossn_isAdminLoggedin())) {
		echo '<div class="ossn-wall-container">';
		echo ossn_view_form('user/container', array(
				'action' => ossn_site_url() . 'action/wall/post/u',
				'component' => 'OssnWall',
				'id' => 'ossn-wall-form',
				'params' => array(
						'user' => $params['user']
				)
		), false);
		echo '</div>';
}
echo '<div class="user-activity">';
if($posts) {
		$count = $OssnWall->GetUserPosts($params['user'], array(
			'count' => true,													 
		));	
		foreach($posts as $post) {
				$item = ossn_wallpost_to_item($post);
				echo ossn_wall_view_template($item);
		}
		echo ossn_view_pagination($count);
}
echo '</div>';
