<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)   http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

define('__GOLIVE__', ossn_route()->com . 'OssnGoLive/');
ossn_register_class(array(
		'OssnGoLive' => __GOLIVE__ . 'classes/OssnGoLive.php',
));
function ossn_golive_init() {
		// Extend site views for CSS and Frontend JavaScript
		ossn_extend_view('css/ossn.default', 'css/golive');
		ossn_extend_view('css/ossn.admin.default', 'css/golive.admin');
		
		ossn_extend_view('js/ossn.site', 'js/golive');
		ossn_new_js('golive', 'js/studio');

		// Ensure OssnWall component is present to attach stream posts
		ossn_add_hook('required', 'components', function ($hook, $type, $return, $params) {
				$return[] = 'OssnWall';
				$return[] = 'OssnProfile';
				$return[] = 'OssnNotifications';
				$return[] = 'OssnLikes';
				return $return;
		});

		// Register backend actions for stream lifecycle
		if(ossn_isLoggedin()) {
				ossn_register_action('golive/start', __GOLIVE__ . 'actions/start.php');
				ossn_register_action('golive/end', __GOLIVE__ . 'actions/end.php');
				ossn_register_action('golive/get_views', __GOLIVE__ . 'actions/get_views.php');
				ossn_register_action('golive/comments_likes', __GOLIVE__ . 'actions/comments_likes.php');

				ossn_register_page('golive', 'ossn_golive_page');
				ossn_add_hook('notification:add', 'golive', 'golive_notification_add_config');
				ossn_add_hook('notification:view', 'golive', 'golive_notification_view');
				ossn_add_hook('notification:redirect:uri', 'golive', 'golive_notification_redirect_uri');

				ossn_register_sections_menu('newsfeed', array(
						'name'   => 'golive',
						'text'   => ossn_print('golive'),
						'url'    => ossn_site_url('golive/select'),
						'parent' => 'links',
				));
		}
		if(ossn_isAdminLoggedin()) {
				ossn_register_com_panel('OssnGoLive', 'settings');
				ossn_register_action('golive/admin/settings', __GOLIVE__ . 'actions/admin/settings.php');
		}
		ossn_add_hook('wall:template', 'golive', 'ossn_wall_golive');
}
function golive_notification_redirect_uri($hook, $type, $return, $params) {
		$notification = $params['notification'];
		$uri          = "post/{$notification->item_guid}";
		return $uri;
}
function golive_notification_view($name, $type, $return, $params) {
		$notif   = $params;
		$baseurl = ossn_site_url();
		$user    = ossn_user_by_guid($params->poster_guid);

		$iconURL = $user->iconURL()->small;
		return ossn_plugin_view('notifications/template/view', array(
				'iconURL'   => $iconURL,
				'guid'      => $notif->guid,
				'type'      => 'golive',
				'viewed'    => $notif->viewed,
				'icon_type' => 'golive',
				'instance'  => $notif,
				'fullname'  => $user->fullname,
		));
}
function golive_notification_add_config($hook, $type, $return, $params) {
		$params['owner_guid'] = $params['notification_owner'];
		return $params;
}
function ossn_wall_golive($hook, $type, $return, $params) {
		return ossn_plugin_view('golive/wall/item', $params);
}
function ossn_golive_page($pages) {
		switch ($pages[0]) {
		case 'select':
				$title    = ossn_print('golive');
				$contents = array(
						'content' => ossn_plugin_view('golive/pages/select'),
				);
				$content = ossn_set_page_layout('contents', $contents);
				echo ossn_view_page($title, $content);
				break;
		case 'studio':
				ossn_unload_js('ossn.chat');
				ossn_load_js('golive');

				$title    = ossn_print('golive:choose');
				$contents = array(
						'content' => ossn_plugin_view('golive/pages/studio'),
				);
				$content = ossn_set_page_layout('contents', $contents);
				echo ossn_view_page($title, $content);
				break;
		default:
				ossn_error_page();
		}
}
function ossn_golive_get_config($user_guid) {
		$config = array(
				'mode'    => 'whip',
				'payload' => array(
						'meta'      => array(
								'name' => 'OssnGoLive - ' . $user_guid,
						),
						'recording' => array(
								'mode'                => 'off',
								'hideLiveViewerCount' => false,
								'timeoutSeconds'      => 60,
						),
				),
		);
		$config = ossn_call_hook('golive', 'stream:config', $config, $config);
		return $config;
}
ossn_register_callback('ossn', 'init', 'ossn_golive_init');