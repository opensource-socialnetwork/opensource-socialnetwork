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
define('__OSSN_ADS__', ossn_route()->com . 'OssnAds/');
require_once __OSSN_ADS__ . 'classes/OssnAds.php';
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

		ossn_add_hook('newsfeed', 'sidebar:right', 'ossn_ads_sidebar', 300);
		ossn_add_hook('profile', 'modules', 'profile_modules_ads', 300);
		ossn_add_hook('group', 'widgets', 'group_widgets_ads', 300);
		ossn_add_hook('theme', 'sidebar:right', 'theme_sidebar_right_ads', 300);
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
				$ad = get_ad_entity($pages[1]);
				if(!empty($pages[1]) && !empty($pages[2]) && $ad) {
						$file = $ad->getPhotoFile();
						if(!$file) {
								ossn_error_page();
						}
						$file->output();
				} else {
						ossn_error_page();
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
		$ad = get_ad_entity($guid);
		return $ad->getPhotoURL();
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
		$ad = ossn_get_object($guid);
		if($ad) {
				return arrayObject($ad, 'OssnAds');
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
function ossn_ads_sidebar($hook, $type, $return) {
		$return[] = ossn_plugin_view('ads/page/view');
		return $return;
}
/**
 * Add Ads module to user profile
 *
 * @return array
 */
function profile_modules_ads($hook, $type, $module, $params) {
		$module[] = ossn_plugin_view('ads/page/view_small');
		return $module;
}
/**
 * Add Ads widget to group page
 *
 * @return array
 */
function group_widgets_ads($hook, $type, $module, $params) {
		$module[] = ossn_plugin_view('ads/page/view');
		return $module;
}
/**
 * Add Ads widget to some pages of a theme (e.g. messages)
 *
 * @return array
 */
function theme_sidebar_right_ads($hook, $type, $module, $params) {
		$module[] = ossn_plugin_view('ads/page/view');
		return $module;
}
ossn_register_callback('ossn', 'init', 'ossn_ads');