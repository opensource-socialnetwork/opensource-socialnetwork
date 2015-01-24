<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */
$posts = new OssnWall;
$posts = $posts->GetUserPosts($params['user']->guid);

//lastchage: site admins are unable to access member profile threads without friendship #176 
if(ossn_user_is_friend(ossn_loggedin_user()->guid, $params['user']->guid) || ossn_loggedin_user()->guid == $params['user']->guid || ossn_isAdminLoggedin()) {
		echo '<div class="ossn-wall-container">';
		echo ossn_view_form('user/container', array(
				'action' => ossn_site_url() . 'action/wall/post/u',
				'component' => 'OssnWall',
				'params' => array(
						'user' => $params['user']
				)
		), false);
		echo '</div>';
}
echo '<div class="user-activity">';
$Pagination = new OssnPagination;
$Pagination->setItem($posts);
$posts = $Pagination->getItem();
if($posts) {
		foreach($posts as $post) {
				$data     = json_decode(html_entity_decode($post->description));
				$text     = $data->post;
				$location = '';
				if(isset($data->location)) {
						$location = '- ' . $data->location;
				}
				if(!isset($data->friend)) {
						$data->friend = '';
				}
				if(isset($post->{'file:wallphoto'})) {
						$image = str_replace('ossnwall/images/', '', $post->{'file:wallphoto'});
				} else {
						$image = '';
				}
				$user = ossn_user_by_guid($post->poster_guid);
				if($post->access == OSSN_FRIENDS) {
						//lastchage: site admins are unable to access member profile threads without friendship #176 
						if(ossn_user_is_friend(ossn_loggedin_user()->guid, $post->owner_guid) || ossn_loggedin_user()->guid == $post->owner_guid || ossn_isAdminLoggedin()) {
								echo ossn_view('components/OssnWall/templates/activity-item', array(
										'post' => $post,
										'friends' => explode(',', $data->friend),
										'text' => $text,
										'location' => $location,
										'user' => $user,
										'image' => $image
								));
						}
				}
				if($post->access == OSSN_PUBLIC) {
						echo ossn_view('components/OssnWall/templates/activity-item', array(
								'post' => $post,
								'friends' => explode(',', $data->friend),
								'text' => $text,
								'location' => $location,
								'user' => $user,
								'image' => $image
						));
				}
				
				
		}
}
echo $Pagination->pagination();
echo '</div>';
