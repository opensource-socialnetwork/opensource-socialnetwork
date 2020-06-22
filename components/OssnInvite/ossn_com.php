<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 
define('__OSSN_INVITE__', ossn_route()->com . 'OssnInvite/');
require_once(__OSSN_INVITE__ . 'classes/OssnInvite.php');

/**
 * Initialize Ossn Invite component
 *
 * @note Please don't call this function directly in your code.
 * 
 * @return void
 * @access private
 */
function ossn_invite_init() {
	ossn_extend_view('css/ossn.default', 'css/invite');
	ossn_register_page('invite', 'ossn_invite_pagehandler');
    if (ossn_isLoggedin()) {
        ossn_register_action('invite/friends', __OSSN_INVITE__. 'actions/invite.php');
		
    	$icon = ossn_site_url('components/OssnProfile/images/friends.png');
    	ossn_register_sections_menu('newsfeed', array(
			'name' => 'invite_friends',
        	'text' => ossn_print('com:ossn:invite:friends'),
        	'url' => ossn_site_url('invite'),
        	'parent' => 'links',
        	'icon' => $icon
    	));		
    }
	//[E] Add friends automatically when user joined using invitation email #1744
	ossn_extend_view('forms/signup', 'invites/addfriends');
	ossn_register_callback('user', 'created', 'ossn_invite_addfriends');
}
/**
 * Invite page handler
 * 
 * @note Please don't call this function directly in your code.
 *
 * @return mixed
 * @access private
 */
function ossn_invite_pagehandler(){
   if (!ossn_isLoggedin()) {
            ossn_error_page();
   }
   $title = ossn_print('com:ossn:invite:friends');
   $contents['content'] = ossn_plugin_view('invites/pages/invite');
   $content = ossn_set_page_layout('newsfeed', $contents);
   echo ossn_view_page($title, $content);	
}
/**
 * Add friends during invite 
 * 
 * @param string $callback
 * @param string $type
 * @param array  $params
 *
 * @return arrau
 */
function ossn_invite_addfriends($callback, $type, $params){
	   $friend = input('com_invite_friend');
	   if(isset($params['guid']) && !empty($params['guid']) && isset($friend) && !empty($friend)){
				ossn_add_friend($friend, $params['guid']);
				ossn_add_friend($params['guid'], $friend);
	   }
}
//initilize ossn wall
ossn_register_callback('ossn', 'init', 'ossn_invite_init');
