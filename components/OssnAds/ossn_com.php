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
				ossn_extend_view('js/ossn.admin', 'js/ads.admin');
		}
		ossn_register_action('ad/viewinc', __OSSN_ADS__ . 'actions/view.php');

		ossn_extend_view('js/opensource.socialnetwork', 'js/ads');
		ossn_register_page('ossnads', 'ossn_ads_handler');

		ossn_extend_view('css/ossn.default', 'css/ads');
		ossn_extend_view('css/ossn.admin.default', 'css/ads.admin');

		ossn_add_hook('newsfeed', 'sidebar:right', 'ossn_ads_newsfeed_sidebar', 300);
		ossn_add_hook('profile', 'modules', 'profile_modules_ads', 300);
		ossn_add_hook('group', 'widgets', 'group_widgets_ads', 300);
		ossn_add_hook('theme', 'sidebar:right', 'theme_sidebar_right_ads', 300);

		ossn_register_callback('cli', 'loaded', 'ossn_ads_cli');
}
/**
 * OSSN Ads CLI
 *
 * /usr/bin/php system/handlers/cli --handler=AdsCron
 *
 * @return void
 */
function ossn_ads_cli($cb, $type, $args) {
		if($args['handler'] == 'AdsCron') {
				$component = new OssnComponents();
				$component->setSettings('OssnAds', array(
						'last_time' => time(),
				));

				$ads     = new OssnAds();
				$expired = $ads->getExpired();
				if($expired) {
						ossn_cli_output('Founds ads to mark expired', 'warning');
						foreach ($expired as $item) {
								ossn_cli_output("Ad with ID marked expired : {$item->guid}", 'success');

								$item->data->expired = true;
								$item->save();
						}
						ossn_cli_output('All found ads marked expired', 'success');
				} else {
						ossn_cli_output('No ads found for expiration', 'warning');
				}
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
		switch ($page) {
		case 'photo':
				$ad = ossn_get_ad($pages[1]);
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
		case 'go':
				$ad_guid = $pages[1];
				$ad      = ossn_get_ad($ad_guid);

				if(!empty($ad_guid) && $ad) {
						ossn_trigger_callback('ads', 'before:go', array(
								'ad' => $ad,
						));
						//avoid multiple click counts for same session
						if(!isset($_SESSION['ossn_ads_clicked']) || !is_array($_SESSION['ossn_ads_clicked'])) {
								$_SESSION['ossn_ads_clicked'] = array();
						}
						if(!in_array($ad_guid, $_SESSION['ossn_ads_clicked'])) {
								$ad->incClicks();
								$_SESSION['ossn_ads_clicked'][] = $ad_guid;
						}
						ossn_trigger_callback('ads', 'go', array(
								'ad' => $ad,
						));
						header("Location: {$ad->site_url}");
						exit();
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
		$ad = ossn_get_ad($guid);
		return $ad->getPhotoURL();
}
/**
 * Get ad
 *
 * @params $guid ad guid
 *
 * @return object|boolean
 */
function ossn_get_ad($guid) {
		if(empty($guid)) {
				return false;
		}
		$ad = ossn_get_object($guid);
		if($ad) {
				return arrayObject($ad, 'OssnAds');
		}
		return false;
}
/**
 * Display ads on sidebar newsfeed
 *
 * @param string $hook Name of the hook
 * @param string $type A hook type
 * @param array  $return A array with mixed data.
 *
 * @return array
 */
function ossn_ads_newsfeed_sidebar($hook, $type, $return) {
		$ads = new OssnAds();
		$ads = $ads->getByPlacement('newsfeed');

		$return[] = ossn_plugin_view('ads/page/view', array(
				'ads' => $ads,
		));
		return $return;
}
/**
 * Add Ads module to user profile
 *
 * @return array
 */
function profile_modules_ads($hook, $type, $module, $params) {
		$ads = new OssnAds();
		$ads = $ads->getByPlacement('profile');

		$module[] = ossn_plugin_view('ads/page/view', array(
				'ads' => $ads,
		));
		return $module;
}
/**
 * Add Ads widget to group page
 *
 * @return array
 */
function group_widgets_ads($hook, $type, $module, $params) {
		$ads = new OssnAds();
		$ads = $ads->getByPlacement('groups');

		$module[] = ossn_plugin_view('ads/page/view', array(
				'ads' => $ads,
		));
		return $module;
}
/**
 * Add Ads widget to some pages of a theme (e.g. messages)
 *
 * @return array
 */
function theme_sidebar_right_ads($hook, $type, $module, $params) {
		$ads = new OssnAds();
		$ads = $ads->getByPlacement('global');

		$module[] = ossn_plugin_view('ads/page/view', array(
				'ads' => $ads,
		));
		return $module;
}
ossn_register_callback('ossn', 'init', 'ossn_ads');