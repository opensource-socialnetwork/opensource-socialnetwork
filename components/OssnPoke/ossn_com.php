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

/* Define Paths */
define('__OSSN_POKE__', ossn_route()->com . 'OssnPoke/');

/* Load OssnPoke Class */
require_once(__OSSN_POKE__ . 'classes/OssnPoke.php');

/**
 * Initialize the poke component.
 *
 * @return void;
 * @access private;
 */
function ossn_poke() {
    //css
    ossn_extend_view('css/ossn.default', 'css/poke');

    //actions
    if (ossn_isLoggedin()) {
        ossn_register_action('poke/user', __OSSN_POKE__ . 'actions/user/poke.php');
    }
    //hooks
    ossn_add_hook('notification:view', 'ossnpoke:poke', 'ossn_poke_notification');
    //profile menu
    ossn_register_callback('page', 'load:profile', 'ossn_user_poke_menu', 1);

}

/**
 * User poke menu item in profile.
 *
 * @return void;
 * @access private;
 */
function ossn_user_poke_menu($name, $type, $params) {
    $user = ossn_get_page_owner_guid();
    $poke = ossn_site_url("action/poke/user?user={$user}", true);
    ossn_register_menu_link('poke', ossn_print('poke'), $poke, 'profile_extramenu');
}

/**
 * User notification menu item
 *
 * @return void;
 * @access private;
 */
function ossn_poke_notification($name, $type, $return, $params) {
    $notif = $params;
    $baseurl = ossn_site_url();
    $user = ossn_user_by_guid($notif->poster_guid);
    $user->fullname = "<strong>{$user->fullname}</strong>";

    $img = "<div class='notification-image'><img src='{$baseurl}avatar/{$user->username}/small' /></div>";

    $type = 'poke';
    $type = "<div class='ossn-notification-icon-poke'></div>";
    if ($notif->viewed !== NULL) {
        $viewed = '';
    } elseif ($notif->viewed == NULL) {
        $viewed = 'class="ossn-notification-unviewed"';
    }
    $url = $user->profileURL();
    $notification_read = "{$baseurl}notification/read/{$notif->guid}?notification=" . urlencode($url);
    return "<a href='{$notification_read}'>
	       <li {$viewed}> {$img} 
		   <div class='notfi-meta'> {$type}
		   <div class='data'>" . ossn_print("ossn:notifications:{$notif->type}", array($user->fullname)) . '</div>
		   </div></li></a>';

}

ossn_register_callback('ossn', 'init', 'ossn_poke');
