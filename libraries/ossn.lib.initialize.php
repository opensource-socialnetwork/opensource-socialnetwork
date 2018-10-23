<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

//register all available language
$available_languages = ossn_get_available_languages();
foreach($available_languages as $language) {
		ossn_register_language($language, ossn_route()->locale . "ossn.{$language}.php");
}
//ossn_default_load_locales();
/**
 * Initialize the css library
 *
 * @return void
 */
function ossn_initialize() {
		$url = ossn_site_url();
		
		$icon = ossn_site_url('components/OssnWall/images/news-feed.png');
		ossn_register_sections_menu('newsfeed', array(
				'name' => 'newsfeed',
				'text' => ossn_print('news:feed'),
				'url' => "{$url}home",
				'parent' => 'links',
				'icon' => $icon
		));
		ossn_extend_view('ossn/js/head', 'javascripts/head');
		ossn_extend_view('ossn/admin/js/head', 'javascripts/head');
		//actions
		ossn_register_action('user/login', ossn_route()->actions . 'user/login.php');
		ossn_register_action('user/register', ossn_route()->actions . 'user/register.php');
		ossn_register_action('user/logout', ossn_route()->actions . 'user/logout.php');
		
		ossn_register_action('friend/add', ossn_route()->actions . 'friend/add.php');
		ossn_register_action('friend/remove', ossn_route()->actions . 'friend/remove.php');
		ossn_register_action('resetpassword', ossn_route()->actions . 'user/resetpassword.php');
		ossn_register_action('resetlogin', ossn_route()->actions . 'user/resetlogin.php');
		
		
		ossn_register_page('index', 'ossn_index_pagehandler');
		ossn_register_page('home', 'ossn_user_pagehandler');
		ossn_register_page('login', 'ossn_user_pagehandler');
		ossn_register_page('registered', 'ossn_user_pagehandler');
		ossn_register_page('syserror', 'ossn_system_error_pagehandler');
		
		ossn_register_page('resetlogin', 'ossn_user_pagehandler');
		
		ossn_add_hook('newsfeed', "sidebar:left", 'newfeed_menu_handler');
		
		ossn_register_menu_item('footer', array(
				'name' => 'a_copyrights',
				'text' => ossn_print('copyright') . ' ' . ossn_site_settings('site_name'),
				'href' => ossn_site_url()
		));
		
		ossn_register_menu_item('footer', ossn_pow_lnk_args());
		
		ossn_extend_view('ossn/endpoint', 'author/view');
}

/**
 * Add left menu to newsfeed page
 *
 * @return menu
 */
function newfeed_menu_handler($hook, $type, $return) {
		$return[] = ossn_view_sections_menu('newsfeed');
		return $return;
}

/**
 * System Errors
 * @pages:
 *       unknown,
 *
 * @return boolean|null
 */
function ossn_system_error_pagehandler($pages) {
		$page = $pages[0];
		if(empty($page)) {
				$page = 'unknown';
		}
		switch($page) {
				case 'unknown':
						$error  = "<div class='ossn-ajax-error'>" . ossn_print('system:error:text') . "</div>";
						$params = array(
								'title' => ossn_print('system:error:title'),
								'contents' => $error,
								'callback' => false
						);
						echo ossn_plugin_view('output/ossnbox', $params);
						break;
		}
}

/**
 * Register basic pages
 * @pages:
 *       home,
 *    login,
 *       registered
 *
 * @return mixed contents
 */
function ossn_user_pagehandler($home, $handler) {
		switch($handler) {
				case 'home':
						if(!ossn_isLoggedin()) {
								//Redirect User to login page if session expired from home page #929
								redirect('login');
						}
						$title = ossn_print('news:feed');
						if(com_is_active('OssnWall')) {
								$contents['content'] = ossn_plugin_view('wall/pages/wall');
						}
						$content = ossn_set_page_layout('newsfeed', $contents);
						echo ossn_view_page($title, $content);
						break;
				case 'resetlogin':
						if(ossn_isLoggedin()) {
								redirect('home');
						}
						$user                = input('user');
						$code                = input('c');
						$contents['content'] = ossn_plugin_view('pages/contents/user/resetlogin');
						
						if(!empty($user) && !empty($code)) {
								$contents['content'] = ossn_plugin_view('pages/contents/user/resetcode');
						}
						$title   = ossn_print('reset:login');
						$content = ossn_set_page_layout('startup', $contents);
						echo ossn_view_page($title, $content);
						break;
				case 'login':
						if(ossn_isLoggedin()) {
								redirect('home');
						}
						$title               = ossn_print('site:login');
						$contents['content'] = ossn_plugin_view('pages/contents/user/login');
						$content             = ossn_set_page_layout('startup', $contents);
						echo ossn_view_page($title, $content);
						break;
				
				case 'registered':
						if(ossn_isLoggedin()) {
								redirect('home');
						}
						$title               = ossn_print('account:registered');
						$contents['content'] = ossn_plugin_view('pages/contents/user/registered');
						$content             = ossn_set_page_layout('startup', $contents);
						echo ossn_view_page($title, $content);
						break;
				
				default:
						ossn_error_page();
						break;
						
		}
}

/**
 * Register site index page
 * @pages:
 *       index or home,
 *
 * @return boolean|null
 */
function ossn_index_pagehandler($index) {
		if(ossn_isLoggedin()) {
				redirect('home');
		}
		$page = $index[0];
		if(empty($page)) {
				$page = 'home';
		}
		switch($page) {
				case 'home':
						echo ossn_plugin_view('pages/index');
						break;
				
				default:
						ossn_error_page();
						break;
						
		}
}
/**
 * Ossn pow lnk args
 * 
 * @return array
 */
function ossn_pow_lnk_args() {
		$pw  = base64_decode(OSSN_POW);
		$pow = ossn_string_decrypt($pw, 'ossn');
		$pow = trim($pow);
		
		$lnk = base64_decode(OSSN_LNK);
		$lnk = ossn_string_decrypt($lnk, 'ossn');
		$lnk = trim($lnk);
		
		return array(
				'name' => $pow,
				'text' => ossn_print($pow),
				'href' => $lnk,
				'priority' => 1000,
		);
}
/**
 * Loads system plugins before we load components.
 *
 * @return void
 */
function ossn_system_plugins_load() {
		//load system plugins before components load #451
		ossn_register_plugins_by_path(ossn_route()->system . 'plugins/');
}
ossn_register_callback('ossn', 'init', 'ossn_initialize');
ossn_register_callback('components', 'before:load', 'ossn_system_plugins_load');
