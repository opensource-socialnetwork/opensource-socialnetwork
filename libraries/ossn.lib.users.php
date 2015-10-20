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
 * Initialize user class
 *
 * @return bool;
 */
function ossn_user() {
		$user = new OssnUser;
		return $user;
}

/**
 * Initialize library
 *
 * @return bool
 */
function ossn_users() {
		ossn_register_page('uservalidate', 'ossn_uservalidate_pagehandler');
		
		/**
		 * Logout outuser if user didn't exists
		 */
		if(ossn_isLoggedin()) {
				$user = ossn_user_by_guid(ossn_loggedin_user()->guid);
				if(!$user) {
						ossn_logout();
						redirect();
				}
				//register menu item for logout, in topbar dropdown menu
				ossn_register_menu_item('topbar_dropdown', array(
						'name' => 'logout',
						'text' => ossn_print('logout'),
						'href' => ossn_site_url('action/user/logout'),
						'action' => true
				));
		}
}

/**
 * Check if the user is logged in or not
 *
 * @return bool
 */
function ossn_isLoggedin() {
		$user = forceObject($_SESSION['OSSN_USER']);
		if(isset($user) && is_object($user) && $user instanceof OssnUser) {
				return true;
		}
		return false;
}

/**
 * Check if the admin is logged in or not
 *
 * @return bool
 */
function ossn_isAdminLoggedin() {
		$user = forceObject($_SESSION['OSSN_USER']);
		if(isset($user) && is_object($user) && $user instanceof OssnUser) {
				if($user->type == 'admin') {
						return true;
				}
		}
		return false;
}

/**
 * Get a logged in user entity
 *
 * @return object
 */
function ossn_loggedin_user() {
		if(ossn_isLoggedin()) {
				return forceObject($_SESSION['OSSN_USER']);
		}
		return false;
}

/**
 * Get a user by username
 *
 * @param $username 'username' of user
 *
 * @return object
 */
function ossn_user_by_username($username) {
		$user           = new OssnUser;
		$user->username = $username;
		return $user->getUser();
}

/**
 * Get a user by user id
 *
 * @param $guid 'guid' of user
 *
 * @return object
 */
function ossn_user_by_guid($guid) {
		$user       = new OssnUser;
		$user->guid = $guid;
		return $user->getUser();
}

/**
 * Get a user by email id
 *
 * @param $guid 'guid' of user
 *
 * @return object
 */
function ossn_user_by_email($email) {
		$user        = new OssnUser;
		$user->email = $email;
		return $user->getUser();
}

/**
 * Get a user friends
 *
 * @param $guid 'guid' of user
 *
 * @return object
 */
function get_user_friends($guid) {
		$friends = new OssnUser;
		return $friends->getFriends($guid);
}

/**
 * Check if the user is from with other user
 *
 * @param $guid 'guid' of user
 *        $friend guid of other user
 *
 * @return bool
 */
function ossn_user_is_friend($guid, $friend) {
		$friends = new OssnUser;
		if($friends->isFriend($guid, $friend)) {
				return true;
		}
		return false;
}

/**
 * Add user a friend
 *
 * @param $form 'guid' of user
 *        $to guid of other user
 *
 * @return bool
 */
function ossn_add_friend($from, $to) {
		$add = new OssnUser;
		if($add->sendRequest($from, $to)) {
				return true;
		}
		return false;
}

/**
 * Remove user from friend list
 *
 * @param $form 'guid' of user
 *        $to guid of other user
 *
 * @return bool
 */
function ossn_remove_friend($from, $to) {
		$remove = new OssnUser;
		if($remove->deleteFriend($from, $to)) {
				return true;
		}
		return false;
}

/**
 * Get total site users
 *
 * @return object
 */
function ossn_total_site_users() {
		$users = new OssnUser;
		return count(get_object_vars($users->getSiteUsers()));
}

/**
 * Get total online users
 *
 * @return int
 */
function ossn_total_online() {
		$users = new OssnUser;
		return $users->online_total();
}

/**
 * Get friends suggestion
 *
 * @param $guid 'guid' of user
 *
 * @return bool
 */
function ossn_friends_suggestion($guid) {
		$user    = new OssnUser;
		$friends = $user->getFriends($guid);
		if(!$friends) {
				return false;
		}
		foreach($friends as $friend) {
				$friends_friend[] = $user->getFriends($friend->guid);
		}
		return $friends_friend;
}

/**
 * Update user last activity time
 *
 * @return void
 */
function update_last_activity() {
		$update = new OssnUser;
		$update->update_last_activity();
}

/**
 * Convert time to to user recognize from
 *
 * @param $tm => time stamp
 *
 * @return bool
 */
function ossn_user_friendly_time($tm, $rcs = 0) {
		$cur_tm     = time();
		$dif        = $cur_tm - $tm;
		// get language dependend items for display
		$passedtime = ossn_print('site:timepassed:data');
		// put them into array
		// 0  = second
		// 15 = decades
		$pds        = explode('|', $passedtime);
		
		// BETTER DO explode ONLY ONCE on start and when language changes
		// and get already prepared array from there
		// don't know how and where to do this correctly ?!?
		$lngh = array(
				1,
				60,
				3600,
				86400,
				604800,
				2630880,
				31570560,
				315705600
		);
		for($v = count($lngh) - 1; ($v >= 0) && (($no = $dif / $lngh[$v]) <= 1); $v--);
		if($v < 0)
				$v = 0;
		$_tm = $cur_tm - ($dif % $lngh[$v]);
		$no  = ($rcs ? floor($no) : round($no)); // if last denomination, round
		// since our array now has 16 time elements instead of 8, we need to skip odd entries and fetch the next even one (the singular)
		$v   = $v * 2;
		
		if($no != 1)
		// $pds[$v] .= 's';
				
		// in case of plural we need the current element's index + 1
				$v++;
		$x = $no . ' ' . $pds[$v];
		if(($rcs > 0) && ($v >= 1))
				$x .= ' ' . ossn_user_friendly_time($_tm, $rcs - 1);
		return ossn_print('site:timepassed:text', $x);
}

/**
 * Register a uservalidation page
 * @pages:
 *       uservalidate,
 *
 * @return bool
 */
function ossn_uservalidate_pagehandler($pages) {
		$page = $pages[0];
		if(empty($page)) {
				echo ossn_error_page();
		}
		switch($page) {
				case 'activate':
						if(!empty($pages[1]) && !empty($pages[2])) {
								$user       = new OssnUser;
								$user->guid = $pages[1];
								if($user->ValidateRegistration($pages[2])) {
										ossn_trigger_message(ossn_print('user:account:validated'), 'success');
										redirect();
								} else {
										ossn_trigger_message(ossn_print('user:account:validate:fail'), 'success');
										redirect();
								}
						}
						break;
						
		}
		
}
/**
 * Load a site language
 *
 * If user have different language then site language it will return user language
 * What a hack lol its was not easy to override a site lanuage with user custom language
 *
 * @return string
 */
function ossn_site_user_lang_code($hook, $type, $return, $params) {
		$lang = $return;
		if(ossn_isLoggedin()) {
				$user = ossn_loggedin_user();
				if(isset($user->language)) {
						$lang = $user->language;
				}
		}
		return $lang;
}
/**
 * Logout user from system
 * 
 * @return boolean
 */
function ossn_logout() {
		unset($_SESSION['OSSN_USER']);
		@session_destroy();
		if(!isset($_SESSION['OSSN_USER'])) {
				return true;
		}
		return false;
}
ossn_register_callback('ossn', 'init', 'ossn_users');
ossn_add_hook('load:settings', 'language', 'ossn_site_user_lang_code');
