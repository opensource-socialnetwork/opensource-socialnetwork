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
	ossn_extend_view('css/ossn.default', 'components/OssnInvite/css/invite');
	ossn_register_page('invite', 'ossn_invite_pagehandler');
	
    if (ossn_isLoggedin()) {
        ossn_register_action('invite/friends', __OSSN_INVITE__. 'actions/invite.php');
    }	
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
   $contents['content'] = ossn_view('components/OssnInvite/pages/invite');
   $content = ossn_set_page_layout('newsfeed', $contents);
   echo ossn_view_page($title, $content);	
}
//initilize ossn wall
ossn_register_callback('ossn', 'init', 'ossn_invite_init');
