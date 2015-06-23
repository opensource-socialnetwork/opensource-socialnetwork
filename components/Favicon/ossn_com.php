<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */

function favicon_init() {
	ossn_register_com_panel('Favicon', 'settings');
    ossn_extend_view('ossn/site/head', 'favicon');
    ossn_extend_view('ossn/admin/head', 'favicon');
	
	if(ossn_isLoggedin()) {
			ossn_register_action('favicon/upload', ossn_route()->com . 'Favicon/actions/upload.php');
	}	
}
function favicon() {
	$path = ossn_site_url("components/Favicon/images/favicon.ico");
	return "<link rel=\"shortcut icon\" href=\"{$path}\" />";
}
ossn_register_callback('ossn', 'init', 'favicon_init');
