<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
define('__OSSN_ADS__', ossn_route()->com . 'OssnAds/');
require_once(__OSSN_ADS__ . 'classes/OssnAds.php');
/**
 * Initialize Ads Component
 *
 * @return void;
 * @access private
 */
function ossn_ads() {
		ossn_register_com_panel('OssnAds', 'settings');
		if(ossn_isAdminLoggedin()) {
				ossn_register_action('ossnads/add', __OSSN_ADS__ . 'actions/add.php');
				ossn_register_action('ossnads/edit', __OSSN_ADS__ . 'actions/edit.php');
				ossn_register_action('ossnads/delete', __OSSN_ADS__ . 'actions/delete.php');
		}
		ossn_register_page('ossnads', 'ossn_ads_handler');
		
		ossn_extend_view('css/ossn.default', 'css/ads');
		ossn_extend_view('css/ossn.admin.default', 'css/ads.admin');
		
		ossn_add_hook('newsfeed', "sidebar:right", 'ossn_ads_sidebar', 300);
		ossn_add_hook('profile', 'modules', 'profile_modules_ads', 300);
		ossn_add_hook('group', 'widgets', 'group_widgets_ads', 300);
		ossn_add_hook('theme', 'sidebar:right', 'theme_sidebar_right_ads', 300);
}

/**
 * Get ad image
 *
 * @return image;
 * @access public
 */
function ossn_ad_image($guid) {
		$photo             = new OssnFile;
		$photo->owner_guid = $guid;
		$photo->type       = 'object';
		$photo->subtype    = 'ossnads';
		$photos            = $photo->getFiles();
		if(isset($photos->{0}->value) && !empty($photos->{0}->value)) {
				$datadir = ossn_get_userdata("object/{$guid}/{$photos->{0}->value}");
				return file_get_contents($datadir);
		}
}

/**
 * Ad image page handler
 *
 * Pages: photo
 *
 * @return image;
 * @access public
 */
function ossn_ads_handler($pages) {
		$page = $pages[0];
		if(empty($page)) {
				return false;
		}
		switch($page) {
				case 'photo':
						header('Content-Type: image/jpeg');
						if(!empty($pages[1]) && !empty($pages[1]) && $pages[2] == md5($pages[1]) . '.jpg') {
								$etag = md5($pages[1]);
								header("Etag: $etag");
								
								if(isset($_SERVER['HTTP_IF_NONE_MATCH']) && trim($_SERVER['HTTP_IF_NONE_MATCH']) == "\"$etag\"") {
										header("HTTP/1.1 304 Not Modified");
										exit;
								}
								$image    = ossn_ad_image($pages[1]);
								$filesize = strlen($image);
								header("Content-type: image/jpeg");
								header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', strtotime("+6 months")), true);
								header("Pragma: public");
								header("Cache-Control: public");
								header("Content-Length: $filesize");
								header("ETag: \"$etag\"");
								echo $image;
						}
						break;
				default:
						echo ossn_error_page();
						break;
		}
}

/**
 * Get ad image url
 *
 * @params $guid ad guid
 *
 * @return url;
 * @access public
 */
function ossn_ads_image_url($guid) {
		$image = md5($guid);
		return ossn_site_url("ossnads/photo/{$guid}/{$image}.jpg");
}
/**
 * Get ad entity
 *
 * @params $guid ad guid
 *
 * @return object;
 * @access public
 */
function get_ad_entity($guid) {
		if($guid < 1 || empty($guid)) {
				return false;
		}
		$resume              = new OssnObject;
		$resume->object_guid = $guid;
		$resume              = $resume->getObjectById();
		if(isset($resume->guid)) {
				return arrayObject($resume, 'OssnAds');
		}
		return false;
}
/**
 * Display ads on sidebar
 *
 * @param string $hook Name of the hook
 * @param string $type A hook type
 * @param array  $return A array with mixed data.
 *
 * @return array
 */
function ossn_ads_sidebar($hook, $type, $return){
	$return[] =  ossn_plugin_view('ads/page/view');
	return $return;
}
/**
 * Add Ads module to user profile
 *
 * @return array
 */
function profile_modules_ads($hook, $type, $module, $params) {
		$module[] = ossn_plugin_view("ads/page/view_small");
		return $module;
}
/**
 * Add Ads widget to group page
 *
 * @return array
 */
function group_widgets_ads($hook, $type, $module, $params) {
		$module[] = ossn_plugin_view("ads/page/view");
		return $module;
}
/**
 * Add Ads widget to some pages of a theme (e.g. messages)
 *
 * @return array
 */
function theme_sidebar_right_ads($hook, $type, $module, $params) {
		$module[] = ossn_plugin_view("ads/page/view");
		return $module;
}
ossn_register_callback('ossn', 'init', 'ossn_ads');
