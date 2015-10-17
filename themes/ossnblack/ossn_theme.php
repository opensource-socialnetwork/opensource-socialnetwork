<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
define('__THEMEDIR__', ossn_route()->themes . 'ossnblack/');

ossn_register_callback('ossn', 'init', 'ossn_black_theme_init');

function ossn_black_theme_init(){	
	//add bootstrap
	ossn_new_css('bootstrap.min', 'css/bootstrap/bootstrap.min.css');
	//ossn_new_js('bootstrap.min', 'js/bootstrap/bootstrap.min.js');
	
	ossn_new_css('ossn.default', 'css/default');
	ossn_new_css('ossn.admin.default', 'css/administrator');

	//load bootstrap
	ossn_load_css('bootstrap.min', 'admin');
	
	ossn_load_css('ossn.default');
	ossn_load_css('ossn.admin.default', 'admin');
	
	ossn_extend_view('ossn/admin/head', 'ossn_three_head');

	ossn_add_hook('css', 'group:background', 'ossntheme_black_group_background');
}

function ossn_three_head(){
	$siteurl = ossn_site_url();
	$head	 = array();
	
	$head[]  = ossn_html_css(array(
					'href' => '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'
			  ));	
	$head[]  = ossn_html_css(array(
					'href' =>  '//fonts.googleapis.com/css?family=Roboto+Slab:300,700,400'
			  ));		
	$head[]  = ossn_html_js(array(
					'src' => ossn_theme_url() . 'vendors/bootstrap/js/bootstrap.min.js'
			  ));
	return implode('', $head);
}
function ossntheme_black_group_background($hook, $type, $return, $params) {
    return '#FDFDFD';
}
