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
define('__THEMEDIR__', ossn_route()->themes . 'fbui/');

ossn_register_callback('ossn', 'init', 'ossn_fbui_theme_init');
ossn_register_callback('ossn', 'init', 'fbui_user_profile_init', 1000);

if(com_is_active('BusinessPage')){
	require_once __THEMEDIR__ . 'lib/bpage.php';
}

/**
 * Add or update a user shortcut based on type and guid, keeping a max limit of 10.
 *
 * @param int    $user_id   The ID of the user
 * @param string $type      The type of item (e.g., 'group', 'bpage')
 * @param int    $guid      The entity GUID of the group or page
 * @return bool
 */
function fbui_add_user_shortcut($user_id, $type, $guid) {
    if (empty($user_id) || empty($type) || empty($guid)) {
        return false;
    }

    // Use native OSSN user data directory
    $user_dir = ossn_get_userdata("user/{$user_id}/shortcuts");
    if (!is_dir($user_dir)) {
        mkdir($user_dir, 0755, true);
    }
    
    $file_path = $user_dir . "/shortcuts.json";
    
    $shortcuts = array();
    if (file_exists($file_path)) {
        $json_data = file_get_contents($file_path);
        $decoded = json_decode($json_data, true);
        if (is_array($decoded)) {
            $shortcuts = $decoded;
        }
    }

    // 1. Remove existing entry if it already exists (to prevent duplicates and bump to top)
    $shortcuts = array_filter($shortcuts, function($item) use ($type, $guid) {
        return !($item['type'] === $type && (int)$item['guid'] === (int)$guid);
    });

    // 2. RE-INDEX the array so keys are clean 0, 1, 2... (THIS FIXES THE BUG)
    $shortcuts = array_values($shortcuts);

    // 3. Create the new shortcut item storing just type and guid
    $new_shortcut = array(
        'type' => $type,
        'guid' => (int) $guid,
        'time' => time()
    );

    // 4. Prepend to the beginning of the array (most recent first)
    array_unshift($shortcuts, $new_shortcut);

    // 5. Enforce the strict maximum limit of 10 shortcuts
    if (count($shortcuts) > 10) {
        $shortcuts = array_slice($shortcuts, 0, 10);
    }

    // 6. Save back to the JSON file
    return file_put_contents($file_path, json_encode(array_values($shortcuts), JSON_PRETTY_PRINT));
}
function fbui_delete_shortcut_action() {
    $user = ossn_loggedin_user();
    if(!$user) {
        return;
    }
    
    $type = input('type');
    $guid = input('guid');
    
    // Load, filter out, and re-save the JSON file similar to your add function
    $user_dir = ossn_get_userdata("user/{$user->guid}/shortcuts");
    $file_path = $user_dir . "/shortcuts.json";
    
    if (file_exists($file_path)) {
        $shortcuts = json_decode(file_get_contents($file_path), true);
        if (is_array($shortcuts)) {
            $shortcuts = array_filter($shortcuts, function($item) use ($type, $guid) {
                return !($item['type'] === $type && (int)$item['guid'] === (int)$guid);
            });
            file_put_contents($file_path, json_encode(array_values($shortcuts), JSON_PRETTY_PRINT));
        }
    }
    echo json_encode(array('success' => true));
}
function fbui_user_profile_init() {
		ossn_unregister_page('u');
		ossn_register_page('u', '_profile_page_handler');

		ossn_unset_hook('newsfeed', 'sidebar:right', 'ossn_birthdays_newsfeed');

		ossn_register_page('play', 'games_page_handler');
		ossn_register_page('groups_feed', 'groups_feed_updates_init');

		ossn_extend_view('css/ossn.default', 'games/css');
}

function groups_feed_updates_init() {
		if(!ossn_isLoggedin()) {
				//Redirect User to login page if session expired from home page #929
				redirect('login');
		}
		$title               = ossn_print('fbui:groups:feed');
		$contents['content'] = ossn_plugin_view('fbui/groups_feed');
		$content             = ossn_set_page_layout('newsfeed', $contents);
		echo ossn_view_page($title, $content);
}
function games_page_handler($pages) {
		if(empty($pages[0])) {
				$pages[0] = 'all';
		}
		switch ($pages[0]) {
		case 'all':
				$title   = ossn_print('games:all');
				$content = ossn_plugin_view('games/pages/all');
				break;

		case 'game':
				$title   = ossn_print('games:play');
				$content = ossn_plugin_view('games/pages/play', array(
						'game_id' => $pages[1],
				));
				break;

		default:
				ossn_error_page();
				break;
		}

		$contents = array(
				'content' => $content,
		);
		$content = ossn_set_page_layout('contents', $contents);
		echo ossn_view_page($title, $content);
}
function ossn_fbui_theme_init() {
		ossn_add_hook('newsfeed', 'sidebar:right', 'fbui_newsfeed_sidebar_widgets_right', 1);
		//add bootstrap
		ossn_new_css('bootstrap.min', 'css/bootstrap/bootstrap.min.css');

		ossn_new_css('ossn.default', 'css/core/default');
		ossn_new_css('ossn.admin.default', 'css/core/administrator');

		//load bootstrap
		ossn_load_css('bootstrap.min', 'admin');
		ossn_load_css('bootstrap.min');

		ossn_load_css('ossn.default');
		ossn_load_css('ossn.admin.default', 'admin');

		ossn_extend_view('ossn/admin/head', 'ossn_fbui_admin_head');
		ossn_extend_view('ossn/site/head', 'ossn_fbui_head');
		ossn_extend_view('js/opensource.socialnetwork', 'js/fbui');
		ossn_extend_view('profile/newsfeed/info', 'fbui_search_bar_sidebar');

		if(ossn_isAdminLoggedin()) {
				ossn_register_menu_item('admin/sidemenu', array(
						'name'   => 'admin:theme:fbui',
						'text'   => ossn_print('admin:themefbui:brandings'),
						'href'   => ossn_site_url('administrator/settings/fbui'),
						'parent' => 'admin:sidemenu:themes',
				));
				ossn_register_site_settings_page('fbui', 'settings/admin/fbui');
				ossn_register_action('fbui/settings', __THEMEDIR__ . 'actions/settings.php');
				//[E] Allow custom logos to be saved with different file name #2334
				ossn_register_action('fbui/settings/logos_bgs_reset', __THEMEDIR__ . 'actions/logos_bgs_reset.php');
		}
		if(ossn_isLoggedin()) {
				ossn_register_action('fbuichat/friends', __THEMEDIR__ . 'actions/friends.php');
				ossn_register_action('fbuichat/contacts_status', __THEMEDIR__ . 'actions/contacts_status.php');
				ossn_register_action('fbui/shortcut/delete', __THEMEDIR__ . 'actions/shortcut/delete.php');
				
		}

		ossn_extend_view('ossn/site/head', 'theme_meta_favicon');
		ossn_extend_view('ossn/admin/head', 'theme_meta_favicon');
}
function fbui_newsfeed_sidebar_widgets_right($hook, $type, $return) {
		if(com_is_active('Birthdays')){
			$return[] = ossn_plugin_view('fbui/birthdays');
		}
		$return[] = ossn_plugin_view('fbui/chat_sidebar');
		return $return;
}
function _profile_page_handler($page) {
		$user = ossn_user_by_username($page[0]);
		if(empty($user->guid)) {
				ossn_error_page();
		}
		ossn_set_page_owner_guid($user->guid);
		ossn_trigger_callback('page', 'load:profile');
		ossn_load_external_js('jquery.ui.touch.punch.js');

		$params['user'] = $user;
		$params['page'] = $page;
		if(isset($page[1])) {
				$params['subpage'] = $page[1];
		} else {
				$params['subpage'] = '';
		}
		if(!ossn_is_profile_subapge($params['subpage']) && !empty($params['subpage'])) {
				ossn_error_page();
		}
		$title = $user->fullname;
		$vars  = array(
				'user' => $user,
		);
		$content             = ossn_plugin_view('profile/pages/profile', $params);
		$contents['content'] = ossn_call_hook('profile', 'load:content', $vars, $content);
		$content             = ossn_set_page_layout('profile', $contents);
		echo ossn_view_page($title, $content);
}
function fbui_search_bar_sidebar() {
		return ossn_view_form(
				'search',
				array(
						'component'       => 'OssnSearch',
						'class'           => 'ossn-search',
						'autocomplete'    => 'off',
						'method'          => 'get',
						'security_tokens' => false,
						'action'          => ossn_site_url('search'),
				),
				false
		);
}
function theme_meta_favicon() {
		$icon = ossn_add_cache_to_url(ossn_theme_url() . 'images/favicon.ico');
		return "\r\n<link rel='icon' href='{$icon}' type='image/x-icon' />";
}
function ossn_fbui_set_custom_logos_bgs_setting($key, $val) {
		$settings = ossn_fbui_get_custom_logos_bgs_setting();
		if(!empty($key) && !empty($val)) {
				if(!$settings) {
						$settings = array();
				}
				$settings[$key] = $val;
				$json           = json_encode($settings);
				$config         = ossn_route()->themes . 'fbui/logos_backgrounds/config.json';
				return file_put_contents($config, $json);
		}
		return false;
}
function ossn_fbui_get_custom_logos_bgs_setting() {
		$config = ossn_route()->themes . 'fbui/logos_backgrounds/config.json';
		if(file_exists($config)) {
				$json = file_get_contents($config);
				if(!empty($json)) {
						$json = json_decode($json, true);
						if(json_last_error() === JSON_ERROR_NONE) {
								return $json;
						}
				}
		}
		return false;
}
function ossn_fbui_head() {
		$head = array();

		$head[] = ossn_html_css(array(
				'href' => ossn_theme_url() . 'vendors/fontawesome/7.3.1/css/all.min.css',
		));
		$head[] = ossn_html_js(array(
				'src' => ossn_theme_url() . 'vendors/bootstrap/js/bootstrap.min.js?v5.3.8',
		));
		return implode('', $head);
}
function ossn_fbui_admin_head() {
		$head   = array();
		$head[] = ossn_html_css(array(
				'href' => ossn_theme_url() . 'vendors/fontawesome/7.3.1/css/all.min.css',
		));
		$head[] = ossn_html_js(array(
				'src' => ossn_theme_url() . 'vendors/bootstrap/js/bootstrap.min.js?v5.3.8',
		));
		return implode('', $head);
}