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
		if(ossn_isAdminLoggedin()) {
				ossn_register_action('location/admin/settings', __OSSN_LOCATION__ . 'actions/settings.php');
		}
		
		//css and js
		ossn_new_css('ossn.location', 'css/location');
		ossn_new_js('ossn.location', 'js/ossn_location');
		
		//[B] OssnLocation looking for key where as its removed in OSSN 9.6
		ossn_new_external_css('leaflet.css', '//unpkg.com/leaflet@1.9.4/dist/leaflet.css', false);
		ossn_new_external_js('leaflet.js', '//unpkg.com/leaflet@1.9.4/dist/leaflet.js', false);
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
