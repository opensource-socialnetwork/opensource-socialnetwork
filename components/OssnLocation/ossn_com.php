<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Core Team, Rafael Amorim <amorim@rafaelamorim.com.br>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 *
 */
define('__OSSN_LOCATION__', ossn_route()->com . 'OssnLocation/');
/**
 * Initialize Ossn Location Component
 *
 * @return void
 * @access private
 */
function ossn_location() {
		ossn_register_com_panel('OssnLocation', 'settings');

		if(ossn_isAdminLoggedin()) {
				ossn_register_action('location/admin/settings', __OSSN_LOCATION__ . 'actions/settings.php');
		}
		
		//css and js
		ossn_new_css('ossn.location', 'css/location');
		ossn_new_js('ossn.location', 'js/ossn_location');
		
		if(ossn_location_api_key() && ossn_isLoggedin()) {
				//don't cache API keys
				ossn_extend_view('ossn/site/head', 'location/head');
				
				ossn_new_external_css('leaflet.css', '//unpkg.com/leaflet@1.9.4/dist/leaflet.css', false);
				ossn_new_external_js('leaflet.js', '//unpkg.com/leaflet@1.9.4/dist/leaflet.js', false);
		}
}

/**
 * Location API key
 *
 * @return boolean|string
 */
function ossn_location_api_key() {
		$component = new OssnComponents();
		$settings  = $component->getComSettings('OssnLocation');
		if($settings && isset($settings->api_key) && !empty($settings->api_key)) {
				return $settings->api_key;
		}
		return false;
}
function ossn_location_load_jscss($admin = false) {
		ossn_load_external_js('leaflet.js');
		ossn_load_external_css('leaflet.css');

		ossn_load_js('ossn.location');
		ossn_load_css('ossn.location');
		
		if($admin === true) {
				ossn_load_external_js('leaflet.js', 'admin');
				ossn_load_external_css('leaflet.css', 'admin');

				ossn_load_js('ossn.location', 'admin');
				ossn_load_css('ossn.location', 'admin');
		}
}
//initilize ossn location
ossn_register_callback('ossn', 'init', 'ossn_location');