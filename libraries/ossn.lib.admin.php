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
/**
 * Initialize the admin library
 *
 * @return void
 */
function ossn_admin() {
    ossn_register_admin_sidemenu('admin/sidemenu', 'admin:components', ossn_site_url('administrator/components'), ossn_print('admin:sidemenu:components'));
    ossn_register_admin_sidemenu('admin/sidemenu', 'admin:install', ossn_site_url('administrator/com_installer'), ossn_print('admin:sidemenu:components'));

    ossn_register_admin_sidemenu('admin/sidemenu', 'admin:themes', ossn_site_url('administrator/themes'), ossn_print('admin:sidemenu:themes'));
    ossn_register_admin_sidemenu('admin/sidemenu', 'admin:install', ossn_site_url('administrator/theme_installer'), ossn_print('admin:sidemenu:themes'));

    ossn_register_admin_sidemenu('admin/sidemenu', 'admin:basic', ossn_site_url('administrator/settings/basic'), ossn_print('admin:sidemenu:settings'));
    ossn_register_admin_sidemenu('admin/sidemenu', 'admin:cache', ossn_site_url('administrator/cache'), ossn_print('admin:sidemenu:settings'));
    //ossn_register_admin_sidemenu('admin/sidemenu', 'admin:mode', ossn_site_url('administrator/theme_installer'), ossn_print('admin:sidemenu:settings'));

    ossn_register_admin_sidemenu('admin/sidemenu', 'admin:users', ossn_site_url('administrator/users'), ossn_print('admin:sidemenu:usermanager'));
    ossn_register_admin_sidemenu('admin/sidemenu', 'admin:add:user', ossn_site_url('administrator/adduser'), ossn_print('admin:sidemenu:usermanager'));
    ossn_register_admin_sidemenu('admin/sidemenu', 'admin:users:unvalidated', ossn_site_url('administrator/unvalidated_users'), ossn_print('admin:sidemenu:usermanager'));


    ossn_register_menu_link('home', 'admin:dashboard', ossn_site_url('administrator'), 'topbar_admin');

    ossn_register_menu_link('configure', 'Configure', '#', 'topbar_admin');
    ossn_register_menu_link('help', 'admin:help', 'http://community.opensource-socialnetwork.org', 'topbar_admin');
    ossn_register_menu_link('support', 'admin:support', 'http://community.opensource-socialnetwork.org', 'topbar_admin');

   ossn_register_menu_link('viewsite', 'admin:view:site', ossn_site_url('home'), 'topbar_admin');
    
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
		
	}

    /*
     * Register login and backend pages
     */
    if (ossn_isAdminLoggedin()) {
        ossn_register_page('administrator', 'ossn_administrator_pagehandler');
        ossn_register_site_settings_page('basic', 'settings/admin/basic_settings');
    } else {
        ossn_register_page('administrator', 'ossn_administrator_login_pagehandler');
    }
}

/**
 * Register sidebar menu
 *
 * @param string $name The name of the menu
 *               $text Link text
 *               $link Full url
 *               $section Menu section
 *               $for sidebar name
 * @param string $text
 * @param string $link
 * @param string $section
 *
 * @return void
 */
function ossn_register_admin_sidemenu($name, $text, $link, $section, $for = 'admin/sidemenu') {
    global $Ossn;
    $Ossn->menu[$for][$name][$section][$text] = $link;
}

/**
 * Register component panel page
 *
 * @param string $component Component Id
 *               $page Page url
 * @param string $page
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
    if (!isset($Ossn->com_panel)) {
        return false;
    }
    foreach ($Ossn->com_panel as $key => $name) {
        $registered[] = $key;
    }
    return $registered;
}

/**
 * Register settings/<page>
 *
 * @param string $name <page> path
 *               $page page contents file
 * @param string $page
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
    if (!isset($Ossn->adminSettingsPage)) {
        return false;
    }
    foreach ($Ossn->adminSettingsPage as $key => $name) {
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
    $active_theme = ossn_site_settings('theme');
    return ossn_plugin_view("menus/admin_sidemenu", $params);
}


/**
 * Register a page handler for administrator;
 * @pages:
 *       administrator,
 *    administrator/dasbhoard,
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
    if (empty($page)) {
        $page = 'dashboard';
    }

    switch ($page) {
        case 'dashboard':
            $title = ossn_print('admin:dashboard');
            $contents['contents'] = ossn_plugin_view('pages/administrator/contents/dashboard');
            $contents['title'] = $title;
            $content = ossn_set_page_layout('administrator/administrator', $contents);
            echo ossn_view_page($title, $content, 'administrator');
            break;
        case 'component':
            global $Ossn;
            if (isset($pages[1]) && in_array($pages[1], ossn_registered_com_panel())) {
                $com['com'] = OssnComponents::getCom($pages[1]);
                $com['settings'] = ossn_components()->getComSettings($pages[1]);
                $title = $com['com']->name;
                $contents['contents'] = ossn_plugin_view("settings/administrator/{$pages[1]}/{$Ossn->com_panel[$pages[1]]}", $com);
                $contents['title'] = $title;
                $content = ossn_set_page_layout('administrator/administrator', $contents);
                echo ossn_view_page($title, $content, 'administrator');
            }
            break;
        case 'components':
            $title = ossn_print('admin:components');
            $contents['contents'] = ossn_plugin_view("pages/administrator/contents/components");
            $contents['title'] = $title;
            $content = ossn_set_page_layout('administrator/administrator', $contents);
            echo ossn_view_page($title, $content, 'administrator');
            break;
        case 'themes':
            $title = ossn_print('admin:themes');
            $contents['contents'] = ossn_plugin_view("pages/administrator/contents/themes");
            $contents['title'] = $title;
            $content = ossn_set_page_layout('administrator/administrator', $contents);
            echo ossn_view_page($title, $content, 'administrator');
            break;
        case 'com_installer':
            $title = ossn_print('admin:com:installer');
            $contents['contents'] = ossn_plugin_view("pages/administrator/contents/com_installer");
            $contents['title'] = $title;
            $content = ossn_set_page_layout('administrator/administrator', $contents);
            echo ossn_view_page($title, $content, 'administrator');
            break;
        case 'theme_installer':
            $title = ossn_print('admin:theme:installer');
            $contents['contents'] = ossn_plugin_view("pages/administrator/contents/theme_installer");
            $contents['title'] = $title;
            $content = ossn_set_page_layout('administrator/administrator', $contents);
            echo ossn_view_page($title, $content, 'administrator');
            break;
        case 'settings':
            global $Ossn;
            if (isset($pages[1]) && in_array($pages[1], ossn_registered_settings_pages())) {
                $title = ossn_print("{$pages[1]}:settings");
                //file should be in plugins/views/default/settings/<file> $arsalanshah
                $contents['contents'] = ossn_plugin_view($Ossn->adminSettingsPage[$pages[1]]);
                $contents['title'] = $title;
                $content = ossn_set_page_layout('administrator/administrator', $contents);
                echo ossn_view_page($title, $content, 'administrator');
            }
            break;
        case 'cache':
            $title =  ossn_print('admin:cache:settings');
            $contents['contents'] = ossn_plugin_view("pages/administrator/contents/cache");
            $contents['title'] = $title;
            $content = ossn_set_page_layout('administrator/administrator', $contents);
            echo ossn_view_page($title, $content, 'administrator');
            break;
        case 'adduser':
            $title = ossn_print('admin:add:user');
            $contents['contents'] = ossn_plugin_view("pages/administrator/contents/adduser");
            $contents['title'] = $title;
            $content = ossn_set_page_layout('administrator/administrator', $contents);
            echo ossn_view_page($title, $content, 'administrator');
            break;
        case 'users':
            $title = ossn_print('admin:user:list');
            $contents['contents'] = ossn_plugin_view("pages/administrator/contents/users/list");
            $contents['title'] = $title;
            $content = ossn_set_page_layout('administrator/administrator', $contents);
            echo ossn_view_page($title, $content, 'administrator');
            break;
        case 'unvalidated_users':
            $title = ossn_print('admin:users:unvalidated');
            $contents['contents'] = ossn_plugin_view("pages/administrator/contents/users/unvalidated");
            $contents['title'] = $title;
            $content = ossn_set_page_layout('administrator/administrator', $contents);
            echo ossn_view_page($title, $content, 'administrator');
            break;			
        case 'edituser':
            if (isset($pages[1])) {
                $user['user'] = ossn_user_by_username($pages[1]);
            }
            $title = ossn_print('admin:edit:user');
            $contents['contents'] = ossn_plugin_view("pages/administrator/contents/user/edit", $user);
            $contents['title'] = $title;
            $content = ossn_set_page_layout('administrator/administrator', $contents);
            echo ossn_view_page($title, $content, 'administrator');
            break;
		case 'version':
			header('Content-Type: application/json');
			$version = array(
							 'version' => ossn_check_update()
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
    if (empty($page)) {
        $page = 'login';
    }
	$logout = input('logout');
	if($logout == 'true'){
		ossn_trigger_message(ossn_print('logged:out'));
		redirect('administrator');
	}
    switch ($page) {
        case 'login':
            $title = ossn_print('admin:login');
            $contents['contents'] = ossn_plugin_view("pages/administrator/contents/login");
            $contents['title'] = $title;
            $content = ossn_set_page_layout('administrator/login', $contents);
            echo ossn_view_page($title, $content, 'administrator');
            break;
        default:
            ossn_error_page();
            break;

    }
}
ossn_register_callback('ossn', 'init', 'ossn_admin');
