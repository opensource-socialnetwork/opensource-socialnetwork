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
    if (ossn_isAdminLoggedin()) {
        ossn_register_action('ossnads/add', __OSSN_ADS__ . 'actions/add.php');
        ossn_register_action('ossnads/edit', __OSSN_ADS__ . 'actions/edit.php');
        ossn_register_action('ossnads/delete', __OSSN_ADS__ . 'actions/delete.php');
    }
    ossn_register_page('ossnads', 'ossn_ads_handler');
	
    ossn_extend_view('css/ossn.default', 'css/ads');
	ossn_extend_view('css/ossn.admin.default', 'css/ads.admin');
}

/**
 * Get ad image
 *
 * @return image;
 * @access public
 */
function ossn_ad_image($guid) {
    $photo = new OssnFile;
    $photo->owner_guid = $guid;
    $photo->type = 'object';
    $photo->subtype = 'ossnads';
    $photos = $photo->getFiles();
    if (isset($photos->{0}->value) && !empty($photos->{0}->value)) {
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
    if (empty($page)) {
        return false;
    }
    switch ($page) {
        case 'photo':
            header('Content-Type: image/jpeg');
            if (!empty($pages[1]) && !empty($pages[1]) && $pages[2] == md5($pages[1]) . '.jpg'
            ) {
                echo ossn_ad_image($pages[1]);
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
function get_ad_entity($guid){
	if($guid < 1 || empty($guid)){
		return false;
	}
	$resume = new OssnObject;
	$resume->object_guid = $guid;
	$resume = $resume->getObjectById();
	if(isset($resume->guid)){
		return arrayObject($resume, 'OssnAds');
	}
	return false;
}
ossn_register_callback('ossn', 'init', 'ossn_ads');
