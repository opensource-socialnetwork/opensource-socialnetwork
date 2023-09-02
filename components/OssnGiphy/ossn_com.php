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

define('OssnGiphy', ossn_route()->com . 'OssnGiphy/');
ossn_register_class(array(
		'OssnGiphy' => OssnGiphy . 'classes/OssnGiphy.php',
));
/**
 * Giphy init function
 *
 * @return void
 */
function ossn_giphy_init(){
		ossn_extend_view('css/ossn.default', 'giphy/css');
		//register outside because if keys are entered it may show a broken page because new css/js cached.
		ossn_new_js('ossn.giphy', 'giphy/js');
		if(ossn_giphy_api_key()){
				ossn_load_js('ossn.giphy');
				ossn_add_hook('comment:view', 'template:params', 'ossn_giphy_in_comments', 1);

				if(ossn_isLoggedin()){
						ossn_register_action('giphy/search', OssnGiphy . 'actions/search.php');

						ossn_extend_view('ossn/page/footer', 'giphy/modal');
						ossn_extend_view('comments/attachment/buttons', 'giphy/comment/button');
				}
		}
		if(ossn_isAdminLoggedin()){
				ossn_register_com_panel('OssnGiphy', 'settings');
				ossn_register_action('giphy/admin/settings', OssnGiphy . 'actions/settings.php');
		}
}
/**
 * Giphy API key
 *
 * @return boolean|string
 */
function ossn_giphy_api_key(){
		$component = new OssnComponents();
		$settings  = $component->getComSettings('OssnGiphy');
		if($settings && isset($settings->api_key) && !empty($settings->api_key)){
				return $settings->api_key;
		}
		return false;
}
/**
 * Replace giphy URL with image tag
 *
 * @return string|void
 */
function ossn_giphy_replace($text){
		return preg_replace('/(https?:\/\/media[0-9]\.giphy\.com\/media\/(.*)\/200w_d.webp)/', '<img src="$0" class="ossn-giphy-image" />', $text);
}
/**
 * Replace the comments giphy URL with images
 *
 * @param string       $hook   comment:view
 * @param string       $type   template:params
 * @param void|string  $return Comment
 * @param array        $params Comment object array
 *
 * @return string|void
 */
function ossn_giphy_in_comments($hook, $type, $return, $params){
		if(isset($return['comment']['comments:post'])){
				$return['comment']['comments:post'] = ossn_giphy_replace($return['comment']['comments:post']);
		} elseif(isset($return['comment']['comments:entity'])){
				$return['comment']['comments:entity'] = ossn_giphy_replace($return['comment']['comments:entity']);
		}
		return $return;
}
ossn_register_callback('ossn', 'init', 'ossn_giphy_init');
