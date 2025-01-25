<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
/**
 * Initialize the admin library
 *
 * @return void
 */
function ossn_admin_init() {
		ossn_register_action('admin/login', ossn_route()->actions . 'administrator/login.php');
		ossn_register_action('admin/logout', ossn_route()->actions . 'administrator/logout.php');

		if(ossn_isAdminLoggedin()) {
				ossn_register_site_settings_page('account', 'pages/account');

				ossn_register_action('component/enable', ossn_route()->actions . 'administrator/component/enable.php');
				ossn_register_action('component/disable', ossn_route()->actions . 'administrator/component/disable.php');
				ossn_register_action('component/delete', ossn_route()->actions . 'administrator/component/delete.php');

				ossn_register_action('theme/enable', ossn_route()->actions . 'administrator/theme/enable.php');
				ossn_register_action('theme/delete', ossn_route()->actions . 'administrator/theme/delete.php');

				ossn_register_action('admin/add/user', ossn_route()->actions . 'administrator/user/add.php');
				ossn_register_action('admin/edit/user', ossn_route()->actions . 'administrator/user/edit.php');
				ossn_register_action('admin/delete/user', ossn_route()->actions . 'administrator/user/delete.php');
				ossn_register_action('admin/validate/user', ossn_route()->actions . 'administrator/user/validate.php');

				ossn_register_action('admin/com_install', ossn_route()->actions . 'administrator/component/com_install.php');
				ossn_register_action('admin/theme_install', ossn_route()->actions . 'administrator/theme/theme_install.php');

				ossn_register_action('admin/settings/save/basic', ossn_route()->actions . 'administrator/settings/save/basic.php');
				ossn_register_action('admin/cache/create', ossn_route()->actions . 'administrator/cache/create.php');
				ossn_register_action('admin/cache/flush', ossn_route()->actions . 'administrator/cache/flush.php');
				ossn_register_action('admin/dynamic/cache', ossn_route()->actions . 'administrator/cache/dynamic.php');
				ossn_register_action('admin/dynamic/cache/test', ossn_route()->actions . 'administrator/cache/dynamic_test.php');
		}

		if(ossn_isAdminLoggedin()) {
				ossn_register_page('administrator', 'ossn_administrator_pagehandler');
				ossn_register_site_settings_page('basic', 'settings/admin/basic_settings');

				ossn_register_menu_item('topbar_dropdown', array(
						'name' => 'administration',
						'text' => ossn_print('admin'),
						'href' => ossn_site_url('administrator'),
				));
		} else {
				ossn_register_page('administrator', 'ossn_administrator_login_pagehandler');
		}
}
function ossn_admin_menus_init() {
		$sidemenus = array(
				array(
						'name'   => 'admin:components',
						'text'   => ossn_print('admin:components'),
						'href'   => ossn_site_url('administrator/components'),
						'parent' => 'admin:sidemenu:components',
				),
				array(
						'name'   => 'admin:install',
						'text'   => ossn_print('admin:install'),
						'href'   => ossn_site_url('administrator/com_installer'),
						'parent' => 'admin:sidemenu:components',
				),
				array(
						'name'   => 'admin:themes',
						'text'   => ossn_print('admin:themes'),
						'href'   => ossn_site_url('administrator/themes'),
						'parent' => 'admin:sidemenu:themes',
				),
				array(
						'name'   => 'admin:install',
						'text'   => ossn_print('admin:install'),
						'href'   => ossn_site_url('administrator/theme_installer'),
						'parent' => 'admin:sidemenu:themes',
				),
				array(
						'name'   => 'admin:basic',
						'text'   => ossn_print('admin:basic'),
						'href'   => ossn_site_url('administrator/settings/basic'),
						'parent' => 'admin:sidemenu:settings',
				),
				array(
						'name'   => 'admin:cache',
						'text'   => ossn_print('admin:cache'),
						'href'   => ossn_site_url('administrator/cache'),
						'parent' => 'admin:sidemenu:settings',
				),
				array(
						'name'   => 'admin:users',
						'text'   => ossn_print('admin:users'),
						'href'   => ossn_site_url('administrator/users'),
						'parent' => 'admin:sidemenu:usermanager',
				),
				array(
						'name'   => 'admin:add:user',
						'text'   => ossn_print('admin:add:user'),
						'href'   => ossn_site_url('administrator/adduser'),
						'parent' => 'admin:sidemenu:usermanager',
				),
				array(
						'name'   => 'admin:users:unvalidated',
						'text'   => ossn_print('admin:users:unvalidated'),
						'href'   => ossn_site_url('administrator/unvalidated_users'),
						'parent' => 'admin:sidemenu:usermanager',
				),
		);
		foreach($sidemenus as $item) {
				ossn_register_menu_item('admin/sidemenu', $item);
		}

		//ossn_register_menu_link('home', 'admin:dashboard', ossn_site_url('administrator'), 'topbar_admin');
		//ossn_register_menu_link('help', 'admin:help', 'https://www.opensource-socialnetwork.org/', 'topbar_admin');
		//ossn_register_menu_link('viewsite', 'admin:view:site', ossn_site_url(), 'topbar_admin');

		$topbar_admin = array(
				array(
						'name' => 'home',
						'text' => ossn_print('admin:dashboard'),
						'href' => ossn_site_url('administrator'),
				),
				array(
						'name' => 'help',
						'text' => ossn_print('admin:help'),
						'href' => 'https://www.opensource-socialnetwork.org/',
				),
				array(
						'name' => 'viewsite',
						'text' => ossn_print('admin:view:site'),
						'href' => ossn_site_url(),
				),
				array(
						'name'   => 'support',
						'text'   => ossn_print('ossn:premium'),
						'href'   => 'https://www.openteknik.com/',
						'target' => '_blank',
				),
		);
		foreach($topbar_admin as $item) {
				ossn_register_menu_item('topbar_admin', $item);
		}
}
/**
 * Register component panel page
 *
 * @param string $component Component Id
 * @param string $page A page URL
 *
 * @return void
 */
function ossn_register_com_panel($component, $page) {
		global $Ossn;
		$Ossn->com_panel[$component] = $page;
}

/**
 * Get registered component panel pages
 *
 * @return array
 */
function ossn_registered_com_panel() {
		global $Ossn;
		if(!isset($Ossn->com_panel)) {
				return false;
		}
		foreach($Ossn->com_panel as $key => $name) {
				$registered[] = $key;
		}
		return $registered;
}

/**
 * Register settings/<page>
 *
 * @param string $name <page> path
 * @param string $page A page contents
 *
 * @return void
 */
function ossn_register_site_settings_page($name, $page) {
		global $Ossn;
		$Ossn->adminSettingsPage[$name] = $page;
}

/**
 * View registered settings pages
 *
 * @return array
 */
function ossn_registered_settings_pages() {
		global $Ossn;
		if(!isset($Ossn->adminSettingsPage)) {
				return false;
		}
		foreach($Ossn->adminSettingsPage as $key => $name) {
				$registered[] = $key;
		}
		return $registered;
}

/**
 * View admin sidebar menu
 *
 * @return html
 */
function ossn_view_admin_sidemenu() {
		global $Ossn;
		$params['menu'] = $Ossn->menu['admin/sidemenu'];
		$active_theme   = ossn_site_settings('theme');
		return ossn_plugin_view('menus/admin_sidemenu', $params);
}

/**
 * Register a page handler for administrator;
 * @pages:
 *       administrator,
 *   	 administrator/dasbhoard,
 *       administrator/component,
 *       administrator/components,
 *       administrator/com_installer,
 *       administrator/theme_installer,
 *       administrator/settings/<page>,
 *       administrator/cache,
 *       administrator/users,
 *       administrator/edituser
 *
 * @return boolean|null
 */
function ossn_administrator_pagehandler($pages) {
		$page = $pages[0];
		if(empty($page)) {
				$page = 'dashboard';
		}
		//admin only JS lib to avoid a load of unused/unrequired code
		if(ossn_isAdminLoggedin()) {
				ossn_load_js('ossn.admin', 'admin');
		}
		switch($page) {
			case 'dashboard':
				$title                = ossn_print('admin:dashboard');
				$contents['contents'] = ossn_plugin_view('pages/administrator/contents/dashboard');
				$contents['title']    = $title;
				$content              = ossn_set_page_layout('administrator/administrator', $contents);
				echo ossn_view_page($title, $content, 'administrator');
				break;
			case 'component':
				global $Ossn;
				if(isset($pages[1]) && in_array($pages[1], ossn_registered_com_panel())) {
						$com['com']           = OssnComponents::getCom($pages[1]);
						$com['settings']      = ossn_components()->getComSettings($pages[1]);
						$title                = $com['com']->name;
						$contents['contents'] = ossn_plugin_view("settings/administrator/{$pages[1]}/{$Ossn->com_panel[$pages[1]]}", $com);
						$contents['title']    = $title;
						$content              = ossn_set_page_layout('administrator/administrator', $contents);
						echo ossn_view_page($title, $content, 'administrator');
				}
				break;
			case 'components':
				$title                = ossn_print('admin:components');
				$contents['contents'] = ossn_plugin_view('pages/administrator/contents/components');
				$contents['title']    = $title;
				$content              = ossn_set_page_layout('administrator/administrator', $contents);
				echo ossn_view_page($title, $content, 'administrator');
				break;
			case 'themes':
				$title                = ossn_print('admin:themes');
				$contents['contents'] = ossn_plugin_view('pages/administrator/contents/themes');
				$contents['title']    = $title;
				$content              = ossn_set_page_layout('administrator/administrator', $contents);
				echo ossn_view_page($title, $content, 'administrator');
				break;
			case 'com_installer':
				$title                = ossn_print('admin:com:installer');
				$contents['contents'] = ossn_plugin_view('pages/administrator/contents/com_installer');
				$contents['title']    = $title;
				$content              = ossn_set_page_layout('administrator/administrator', $contents);
				echo ossn_view_page($title, $content, 'administrator');
				break;
			case 'theme_installer':
				$title                = ossn_print('admin:theme:installer');
				$contents['contents'] = ossn_plugin_view('pages/administrator/contents/theme_installer');
				$contents['title']    = $title;
				$content              = ossn_set_page_layout('administrator/administrator', $contents);
				echo ossn_view_page($title, $content, 'administrator');
				break;
			case 'settings':
				global $Ossn;
				if(isset($pages[1]) && in_array($pages[1], ossn_registered_settings_pages())) {
						$title = ossn_print("{$pages[1]}:settings");
						//file should be in plugins/views/default/settings/<file> $arsalanshah
						$contents['contents'] = ossn_plugin_view($Ossn->adminSettingsPage[$pages[1]]);
						$contents['title']    = $title;
						$content              = ossn_set_page_layout('administrator/administrator', $contents);
						echo ossn_view_page($title, $content, 'administrator');
				}
				break;
			case 'cache':
				$title                = ossn_print('admin:cache:settings');
				$contents['contents'] = ossn_plugin_view('pages/administrator/contents/cache');
				$contents['title']    = $title;
				$content              = ossn_set_page_layout('administrator/administrator', $contents);
				echo ossn_view_page($title, $content, 'administrator');
				break;
			case 'adduser':
				$title                = ossn_print('admin:add:user');
				$contents['contents'] = ossn_plugin_view('pages/administrator/contents/adduser');
				$contents['title']    = $title;
				$content              = ossn_set_page_layout('administrator/administrator', $contents);
				echo ossn_view_page($title, $content, 'administrator');
				break;
			case 'users':
				$title                = ossn_print('admin:user:list');
				$contents['contents'] = ossn_plugin_view('pages/administrator/contents/users/list');
				$contents['title']    = $title;
				$content              = ossn_set_page_layout('administrator/administrator', $contents);
				echo ossn_view_page($title, $content, 'administrator');
				break;
			case 'unvalidated_users':
				$title                = ossn_print('admin:users:unvalidated');
				$contents['contents'] = ossn_plugin_view('pages/administrator/contents/users/unvalidated');
				$contents['title']    = $title;
				$content              = ossn_set_page_layout('administrator/administrator', $contents);
				echo ossn_view_page($title, $content, 'administrator');
				break;
			case 'edituser':
				if(isset($pages[1])) {
						$user['user'] = ossn_user_by_username($pages[1]);
				}
				$title                = ossn_print('admin:edit:user');
				$contents['contents'] = ossn_plugin_view('pages/administrator/contents/user/edit', $user);
				$contents['title']    = $title;
				$content              = ossn_set_page_layout('administrator/administrator', $contents);
				echo ossn_view_page($title, $content, 'administrator');
				break;
			case 'version':
				header('Content-Type: application/json');
				$version = array(
						'version' => ossn_check_update(),
				);
				echo json_encode($version);
				break;
		default:
				ossn_error_page();
				break;
		}
}
/**
 * Register a page handler for administrator login;
 * @pages:
 *       administrator/login,
 * @return mixeddata
 */
function ossn_administrator_login_pagehandler($pages) {
		$page = $pages[0];
		if(empty($page)) {
				$page = 'login';
		}
		$logout = input('logout');
		if($logout == 'true') {
				ossn_trigger_message(ossn_print('logged:out'));
				redirect('administrator');
		}
		switch($page) {
			case 'login':
				$title                = ossn_print('admin:login');
				$contents['contents'] = ossn_plugin_view('pages/administrator/contents/login');
				$contents['title']    = $title;
				$content              = ossn_set_page_layout('administrator/login', $contents);
				echo ossn_view_page($title, $content, 'administrator');
				break;
		default:
				redirect('administrator');
				break;
		}
}
ossn_register_callback('ossn', 'init', 'ossn_admin_init');
ossn_register_callback('ossn', 'init', 'ossn_admin_menus_init');
