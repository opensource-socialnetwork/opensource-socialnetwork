<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
define('__OSSN_WALL__', ossn_route()->com . 'OssnWall/');
require_once __OSSN_WALL__ . 'classes/OssnWall.php';
/**
 * Initialize Ossn Wall Component
 *
 * @return void
 * @access private
 */
function ossn_wall() {
		ossn_register_com_panel('OssnWall', 'settings');

		//actions
		if(ossn_isLoggedin()) {
				ossn_register_action('wall/post/a', __OSSN_WALL__ . 'actions/wall/post/home.php');
				ossn_register_action('wall/post/u', __OSSN_WALL__ . 'actions/wall/post/user.php');
				ossn_register_action('wall/post/g', __OSSN_WALL__ . 'actions/wall/post/group.php');
				ossn_register_action('wall/post/delete', __OSSN_WALL__ . 'actions/wall/post/delete.php');
				ossn_register_action('wall/post/edit', __OSSN_WALL__ . 'actions/wall/post/edit.php');
				ossn_register_action('wall/post/embed', __OSSN_WALL__ . 'actions/wall/post/embed.php');

				ossn_extend_view('forms/OssnWall/home/container', 'ossn_wall_container_assets');
				ossn_extend_view('forms/OssnWall/user/container', 'ossn_wall_container_assets');
				ossn_extend_view('forms/OssnWall/group/container', 'ossn_wall_container_assets');
		}
		if(ossn_isAdminLoggedin()) {
				ossn_register_action('wall/admin/settings', __OSSN_WALL__ . 'actions/wall/admin/settings.php');
		}
		//css and js
		ossn_extend_view('css/ossn.default', 'css/wall');
		ossn_extend_view('js/ossn.site', 'js/ossn_wall');

		ossn_new_external_js('jquery.tokeninput', 'vendors/jquery/jquery.tokeninput.js');

		//pages
		ossn_register_page('post', 'ossn_post_page');
		ossn_register_page('friendpicker', 'ossn_friend_picker');

		//hooks
		ossn_add_hook('notification:view', 'like:post', 'ossn_likes_post_notifiation');
		ossn_add_hook('notification:view', 'comments:post', 'ossn_likes_post_notifiation');
		ossn_add_hook('notification:view', 'wall:friends:tag', 'ossn_likes_post_notifiation');
		ossn_add_hook('notification:view', 'comments:post:group:wall', 'ossn_group_comment_post');
		ossn_add_hook('notification:view', 'like:post:group:wall', 'ossn_group_comment_post');

		ossn_add_hook('wall', 'post:menu', 'ossn_wall_post_menu');

		//templates
		ossn_add_hook('wall:template', 'user', 'ossn_wall_templates');
		ossn_add_hook('wall:template', 'group', 'ossn_wall_templates');

		//callbacks
		ossn_register_callback('group', 'delete', 'ossn_group_wall_delete');
		ossn_register_callback('user', 'delete', 'ossn_user_posts_delete');

		$menupost = array(
				'name' => 'post',
				'text' => '<i class="fa fa-bullhorn"><span>' . ossn_print('post') . '</span></i>',
				'href' => ossn_site_url(),
		);
		$container_controls = array(
				array(
						'name'  => 'tag_friend',
						'class' => 'ossn-wall-friend',
						'text'  => '<i class="fa fa-users"></i>',
				),
				array(
						'name'  => 'location',
						'class' => 'ossn-wall-location',
						'text'  => '<i class="fa fa-map-marker-alt"></i>',
				),
				array(
						'name'  => 'photo',
						'class' => 'ossn-wall-photo',
						'text'  => '<i class="fa fa-image"></i>',
				),
		);
		ossn_register_menu_item('wall/container/home', $menupost);
		ossn_register_menu_item('wall/container/group', $menupost);
		ossn_register_menu_item('wall/container/user', $menupost);

		foreach($container_controls as $key => $container_control) {
				ossn_register_menu_item('wall/container/controls/home', $container_control);
				ossn_register_menu_item('wall/container/controls/user', $container_control);
				if($container_control['name'] != 'tag_friend') {
						ossn_register_menu_item('wall/container/controls/group', $container_control);
				}
		}
		ossn_add_hook('required', 'components', 'ossn_location_asure_requirements');
}
/**
 * Location Make sure it is not disabled if Wall is active
 *
 * @return array
 */
function ossn_location_asure_requirements($hook, $type, $return, $params) {
		$return[] = 'OssnLocation';
		return $return;
}
/**
 * Friends Picker
 *
 * @return false|null|mixed data
 * @access public
 */
function ossn_friend_picker() {
		header('Content-Type: application/json');
		if(!ossn_isLoggedin()) {
				exit();
		}
		$search_for = input('q');
		$usera      = array();
		$user       = new OssnUser();

		$options = array();
		if(!empty($search_for)) {
				$options = array(
						'wheres' => "(CONCAT(u.first_name,  ' ', u.last_name) LIKE '%{$search_for}%')",
				);
		}
		//[E] Enhance friends picker because now getFriends searched via OssnUser instance #2202
		$friends = $user->getFriends(ossn_loggedin_user()->guid, $options);
		if(!$friends) {
				echo json_encode(array());
				return false;
		}
		foreach($friends as $users) {
				$p['first_name'] = $users->first_name;
				$p['last_name']  = $users->last_name;
				$p['imageurl']   = ossn_site_url("avatar/{$users->username}/smaller");
				$p['id']         = $users->guid;
				$usera[]         = $p;
		}
		echo json_encode($usera);
}
/**
 * Setting up a template for notification view for like posts
 *
 * @param string $hook Name of hook
 * @param string $type Hook type
 * @param string $return mixed data
 * @param array $params Arrays or Objects
 *
 * @return mixed data
 * @access private
 */
function ossn_likes_post_notifiation($hook, $type, $return, $params) {
		$notif          = $params;
		$baseurl        = ossn_site_url();
		$user           = ossn_user_by_guid($notif->poster_guid);
		$user->fullname = "<strong>{$user->fullname}</strong>";
		$iconURL        = $user->iconURL()->small;

		$img = "<div class='notification-image'><img src='{$iconURL}' /></div>";
		$url = ossn_site_url("post/view/{$notif->subject_guid}");

		if(preg_match('/like/i', $notif->type)) {
				$type = 'like';
		}
		if(preg_match('/tag/i', $notif->type)) {
				$type = 'tag';
		}
		if(preg_match('/comments/i', $notif->type)) {
				$type = 'comment';
				$url  = ossn_site_url("post/view/{$notif->subject_guid}#comments-item-{$notif->item_guid}");
		}
		$type = "<div class='ossn-notification-icon-{$type}'></div>";
		if($notif->viewed !== null) {
				$viewed = '';
		} elseif($notif->viewed == null) {
				$viewed = 'class="ossn-notification-unviewed"';
		}
		$notification_read = "{$baseurl}notification/read/{$notif->guid}?notification=" . urlencode($url);
		return "<a href='{$notification_read}'>
	       <li {$viewed}> {$img}
		   <div class='notfi-meta'> {$type}
		   <div class='data'>" .
		ossn_print("ossn:notifications:{$notif->type}", array(
				$user->fullname,
		)) .
				'</div>
		   </div></li></a>';
}
/**
 * Setting up a template for notification view for commponent post
 *
 * @param string $hook Name of hook
 * @param string $type Hook type
 * @param string $return mixed data
 * @param array $params Arrays or Objects
 *
 * @return mixed data
 * @access private
 */
function ossn_group_comment_post($hook, $type, $return, $params) {
		$notif          = $params;
		$baseurl        = ossn_site_url();
		$user           = ossn_user_by_guid($notif->poster_guid);
		$user->fullname = "<strong>{$user->fullname}</strong>";
		$iconURL        = $user->iconURL()->small;

		$img = "<div class='notification-image'><img src='{$iconURL}' /></div>";
		$url = ossn_site_url("post/view/{$notif->subject_guid}");

		if(preg_match('/like/i', $notif->type)) {
				$type = 'like';
		}
		if(preg_match('/comments/i', $notif->type)) {
				$type = 'comment';
				$url  = ossn_site_url("post/view/{$notif->subject_guid}#comments-item-{$notif->item_guid}");
		}
		$type = "<div class='ossn-notification-icon-{$type}'></div>";
		if($notif->viewed !== null) {
				$viewed = '';
		} elseif($notif->viewed == null) {
				$viewed = 'class="ossn-notification-unviewed"';
		}
		$notification_read = "{$baseurl}notification/read/{$notif->guid}?notification=" . urlencode($url);
		return "<a href='{$notification_read}'>
	       <li {$viewed}> {$img}
		   <div class='notfi-meta'> {$type}
		   <div class='data'>" .
		ossn_print("ossn:notifications:{$notif->type}", array(
				$user->fullname,
		)) .
				'</div>
		   </div></li></a>';
}
/**
 * OssnWall post page handlers
 *
 * @param array $pages List of pages
 *
 * @return false|mixed data
 * @access private
 */
function ossn_post_page($pages) {
		$page = $pages[0];
		if(empty($page)) {
				return false;
		}
		switch($page) {
			case 'view':
				$title = ossn_print('post:view');
				$wall  = new OssnWall();
				$post  = $pages[1];
				$post  = $wall->GetPost($post);
				if(empty($post->guid) || empty($pages[1])) {
						ossn_error_page();
				}
				$loggedin = ossn_loggedin_user();
				//Posts having friends privacy are visible to public using direct URL #1484
				//re-opened on 27-06-2021 thanks to Haydar Alkaduhimi for reporting it.
				//fixing again on 18-09-2021 user can not view own post.
				if(
						(isset($post->access) && $post->access == OSSN_FRIENDS && !ossn_isLoggedin()) ||
						(ossn_isLoggedin() && $loggedin->guid != $post->poster_guid && $post->access == OSSN_FRIENDS && ossn_isLoggedin() && !ossn_user_is_friend($loggedin->guid, $post->poster_guid))
				) {
						ossn_error_page();
				}
				//[B] Close group post is accessible when not loggedin #1997
				if($post->type == 'group' && com_is_active('OssnGroups')) {
						$group = ossn_get_group_by_guid($post->owner_guid);
						if($group && $group->membership == OSSN_PRIVATE) {
								if((ossn_isLoggedin() && !$group->isMember($group->guid, $loggedin->guid)) || !ossn_isLoggedin()) {
										ossn_error_page();
								}
						}
				}
				$params['post'] = $post;

				$contents = array(
						'content' => ossn_plugin_view('wall/pages/view', $params),
				);
				$content = ossn_set_page_layout('newsfeed', $contents);
				echo ossn_view_page($title, $content);
				break;
			case 'photo':
				$wall = new OssnWall();
				$post = $wall->GetPost($pages[1]);
				if(!empty($pages[1]) && !empty($pages[2]) && $post) {
						$file = $post->getPhotoFile();
						if(!$file) {
								ossn_error_page();
						}
						$file->output();
				} else {
						ossn_error_page();
				}
				break;
			case 'privacy':
				if(ossn_is_xhr()) {
						$params = array(
								'title'    => ossn_print('privacy'),
								'contents' => ossn_plugin_view('wall/privacy'),
								'callback' => '#ossn-wall-privacy',
						);
						echo ossn_plugin_view('output/ossnbox', $params);
				}
				break;
			case 'edit':
				$post = ossn_get_object($pages[1]);
				if(!ossn_is_xhr()) {
						ossn_error_page();
				}
				if(!$post) {
						header('HTTP/1.0 404 Not Found');
				}
				$user = ossn_loggedin_user();
				if($post->poster_guid == $user->guid || $user->canModerate()) {
						$params = array(
								'title'    => ossn_print('edit'),
								'contents' => ossn_view_form(
										'post/edit',
										array(
												'action'    => ossn_site_url('action/wall/post/edit'),
												'id'        => 'ossn-post-edit-form',
												'component' => 'OssnWall',
												'params'    => array(
														'post' => $post,
												),
										),
										false,
								),
								'callback' => '#ossn-post-edit-save',
						);
						echo ossn_plugin_view('output/ossnbox', $params);
				}
				break;
		default:
				ossn_error_page();
				break;
		}
}
/**
 * View post menu
 *
 * @param string $hook Name of hook
 * @param string $type Hook type
 * @param string $return mixed data
 * @param array $params Arrays or Objects
 *
 * @return mixed data
 * @access private
 */
function ossn_wall_post_menu($hook, $type, $return, $params) {
		$user = ossn_loggedin_user();
		if($params['post']->type == 'group') {
				$group = ossn_get_group_by_guid($params['post']->owner_guid);
		}
		if(
				$params['post']->poster_guid == ossn_loggedin_user()->guid ||
				$params['post']->owner_guid == $user->guid ||
				(isset($group) && ($group->owner_guid == $user->guid || $group->isModerator($user->guid))) ||
				$user->canModerate()
		) {
				$deleteurl = ossn_site_url("action/wall/post/delete?post={$params['post']->guid}", true);

				ossn_unregister_menu('delete', 'wallpost');
				ossn_register_menu_item('wallpost', array(
						'name'      => 'delete',
						'class'     => 'ossn-wall-post-delete',
						'text'      => ossn_print('delete'),
						'href'      => $deleteurl,
						'data-guid' => $params['post']->guid,
				));
		} else {
				ossn_unregister_menu('delete', 'wallpost');
		}
		if(($params['post']->poster_guid == ossn_loggedin_user()->guid || ossn_isAdminLoggedin()) && empty($params['post']->item_guid)) {
				ossn_unregister_menu('edit', 'wallpost');
				ossn_register_menu_item('wallpost', array(
						'name'      => 'edit',
						'class'     => 'ossn-wall-post-edit',
						'text'      => ossn_print('edit'),
						'href'      => 'javascript:void(0);',
						'priority'  => 1,
						'data-guid' => $params['post']->guid,
				));
		} else {
				ossn_unregister_menu('edit', 'wallpost');
		}
		return ossn_view_menu('wallpost', 'wall/menus/post-controls');
}
/**
 * Delete group wall posts
 *
 * @param string $callback Name of callback
 * @param string $type Callback type
 * @param array $params Arrays or Objects
 *
 * @return mixed data
 * @access private
 */
function ossn_group_wall_delete($callback, $type, $params) {
		$wall  = new OssnWall();
		$posts = $wall->GetPostByOwner($params['entity']->guid, 'group');
		if($posts) {
				foreach($posts as $post) {
						$wall->deletePost($post->guid);
				}
		}
}
/**
 * Delete user wall posts
 *
 * @param string $callback Name of callback
 * @param string $type Callback type
 * @param array $params Arrays or Objects
 *
 * @return mixed data
 * @access private
 */
function ossn_user_posts_delete($callback, $type, $params) {
		$wall  = new OssnWall();
		$posts = $wall->getUserGroupPostsGuids($params['entity']->guid);
		if($posts) {
				foreach($posts as $post) {
						//$post is here int
						$wall->deletePost($post);
				}
		}
		//Broken wall posts upon deleting user #1129
		$wall      = new OssnWall();
		$userposts = $wall->getPosterPosts($params['entity']->guid);
		if($userposts) {
				foreach($userposts as $item) {
						$wall->deletePost($item->guid);
				}
		}
		//Deleting user didn't delete users wall posts if wall poster_guid is not same user as deleted #1505
		if(!empty($params['entity']->guid)) {
				$posts_by_owner_guid = $wall->searchObject(array(
						'type'       => 'user',
						'subtype'    => 'wall',
						'owner_guid' => $params['entity']->guid,
						'page_limit' => false,
				));
				if($posts_by_owner_guid) {
						foreach($posts_by_owner_guid as $posti) {
								$posti->deletePost($posti->guid);
						}
				}
		}
}
/**
 * Encode unecaped unicode characters
 *
 * @return mixed data
 * @access private
 */
function ossnwall_json_unencaped_unicode($matches) {
		return mb_convert_encoding(pack('H*', $matches[1]), 'UTF-8', 'UTF-16');
}
/**
 * View wall post view template
 *
 * @param array $params Options
 *
 * @return mixed data
 * @access private
 */
function ossn_wall_view_template(array $params = array()) {
		if(!is_array($params)) {
				return false;
		}
		$type = $params['post']->type;
		if(isset($params['post']->item_type) && !empty($params['post']->item_type)) {
				$type = $params['post']->item_type;
		}
		if(ossn_is_hook('wall:template', $type)) {
				return ossn_call_hook('wall:template', $type, $params);
		}
		return false;
}
/**
 * Wall template view
 * Depends on wall post type
 *
 * @param string $callback Name of callback
 * @param string $type Callback type
 * @param array $params Arrays or Objects
 *
 * @return mixed data
 * @access private
 */
function ossn_wall_templates($hook, $type, $return, $params) {
		ossn_trigger_callback('wall', 'load:item', $params);
		$params = ossn_call_hook('wall', 'templates:item', $params, $params);
		return ossn_plugin_view("wall/templates/wall/{$type}/item", $params);
}
/**
 * Set homepage wall items type friends/public
 *
 * @param strig $default friends/public
 *
 * @return mixed data
 * @access private
 */
function ossn_set_homepage_wall_access($default = 'friends') {
		$data = ossn_get_entities(array(
				'type'       => 'component',
				'subtype'    => 'ossnwall_defaultwall',
				'owner_guid' => 2,
		));
		if(!$data) {
				return ossn_add_entity(array(
						'type'       => 'component',
						'subtype'    => 'ossnwall_defaultwall',
						'owner_guid' => 2,
						'value'      => $default,
				));
		} else {
				$settings = $data[0];
				return ossn_update_entity($settings->guid, $default);
		}
}
/**
 * Wall template view
 * Depends on wall post type
 *
 * @param string $callback Name of callback
 * @param string $type Callback type
 * @param array $params Arrays or Objects
 *
 * @return mixed data
 * @access private
 */
function ossn_get_homepage_wall_access() {
		$data = ossn_get_entities(array(
				'type'       => 'component',
				'subtype'    => 'ossnwall_defaultwall',
				'owner_guid' => 2,
		));
		if($data) {
				return $data[0]->value;
		} else {
				return 'public';
		}
}
/**
 * Convert wallobject to wall post item
 *
 * @param object $post A wall object
 *
 * @return array|false
 */
function ossn_wallpost_to_item($post) {
		if($post && $post instanceof OssnWall) {
				if(!isset($post->poster_guid)) {
						$post = ossn_get_object($post->guid);
				}
				$data = json_decode($post->description);
				$text = '';
				if($data) {
						$text = ossn_restore_new_lines($data->post, true);
				}
				$location = '';

				if(isset($data->location)) {
						$location = '- ' . $data->location;
				}
				if(isset($post->{'file:wallphoto'})) {
						$image = $post->getPhotoURL();
				} else {
						$image = '';
				}

				$user = ossn_user_by_guid($post->poster_guid);
				if(!isset($data->friend)) {
						if(!$data) {
								$data = new stdClass();
						}
						$data->friend = '';
				}
				return array(
						'post'     => $post,
						'friends'  => explode(',', $data->friend),
						'text'     => $text,
						'location' => $location,
						'user'     => $user,
						'image'    => $image,
				);
		}
		return false;
}
/**
 * Wall container assets
 *
 **/
function ossn_wall_container_assets() {
		ossn_location_load_jscss();
		ossn_load_external_js('jquery.tokeninput');
}
//initilize ossn wall
ossn_register_callback('ossn', 'init', 'ossn_wall');
