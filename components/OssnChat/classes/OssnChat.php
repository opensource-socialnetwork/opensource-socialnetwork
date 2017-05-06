<?php

/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
class OssnChat extends OssnDatabase {
		/**
		 * Set uesr chat session
		 *
		 * @params = $to Friend Guid
		 *
		 * @return void;
		 */
		public static function setUserChatSession($user) {
				if(!isset($_SESSION['ossn_chat_users'])) {
						$_SESSION['ossn_chat_users'] = array();
				}
				if(!in_array($user->guid, $_SESSION['ossn_chat_users']) && $user) {
						$_SESSION['ossn_chat_users'][] = $user->guid;
				}
		}
		
		/**
		 * Get active sessions
		 *
		 * @return array;
		 */
		public static function GetActiveSessions() {
				if(isset($_SESSION['ossn_chat_users'])) {
						return array_unique($_SESSION['ossn_chat_users']);
				}
				return false;
		}
		
		/**
		 * Get user chat status
		 *
		 * @params = $user User guid
		 *           $intervals Time itervals
		 *
		 * @return string;
		 */
		public static function getChatUserStatus($user, $intervals = 100) {
				$user = ossn_user_by_guid($user);
				$time = time();
				if($user->last_activity > $time - $intervals) {
						return 'online';
				}
				return 'offline';
		}
		
		/**
		 * Remove chat tab
		 *
		 * @params = $tab Tab id
		 *
		 * @return bool;
		 */
		public static function removeChatTab($tab) {
				if(isset($_SESSION['ossn_chat_users']) && in_array($tab, $_SESSION['ossn_chat_users'])) {
						$tab = array_search($tab, $_SESSION['ossn_chat_users']);
						unset($_SESSION['ossn_chat_users'][$tab]);
						return true;
				}
				return false;
		}
		
		/**
		 * Replace icons to images
		 *
		 * @params = $message String
		 *
		 * @return string;
		 */
		public static function replaceIcon($message) {
				foreach(self::loadIcons() as $codes => $imgs) {
						$code[] = $codes;
						$img[]  = $imgs;
				}
				$icons = str_replace($code, $img, $message);
				return $icons;
		}
		
		/**
		 * Register a default emoticons
		 *
		 * @access system
		 * @return message;
		 */
		public static function loadIcons() {
				$icon  = ossn_site_url() . 'components/OssnChat/images/emoticons/';
				$icons = array(
						':(' => "<img src='{$icon}ossnchat-sad.gif' class='ossn-chat-icon' />",
						':)' => "<img src='{$icon}ossnchat-smile.gif' class='ossn-chat-icon' />",
						'=D' => "<img src='{$icon}ossnchat-happy.gif' class='ossn-chat-icon' />",
						';)' => "<img src='{$icon}ossnchat-wink.gif' class='ossn-chat-icon' />",
						':p' => "<img src='{$icon}ossnchat-tongue.gif' class='ossn-chat-icon' />",
						'8|' => "<img src='{$icon}ossnchat-sunglasses.gif' class='ossn-chat-icon' />",
						'o.O' => "<img src='{$icon}ossnchat-confused.gif' class='ossn-chat-icon' />",
						':O' => "<img src='{$icon}ossnchat-gasp.gif' class='ossn-chat-icon' />",
						':*' => "<img src='{$icon}ossnchat-kiss.gif' class='ossn-chat-icon' />",
						'a:' => "<img src='{$icon}ossnchat-angel.gif' class='ossn-chat-icon' />",
						':h:' => "<img src='{$icon}ossnchat-heart.gif' class='ossn-chat-icon' />",
						'3:|' => "<img src='{$icon}ossnchat-devil.gif' class='ossn-chat-icon' />",
						'u:' => "<img src='{$icon}ossnchat-upset.gif' class='ossn-chat-icon' />",
						':v' => "<img src='{$icon}ossnchat-pacman.gif' class='ossn-chat-icon' />",
						'g:' => "<img src='{$icon}ossnchat-grumpy.gif' class='ossn-chat-icon' />",
						'8)' => "<img src='{$icon}ossnchat-glasses.gif' class='ossn-chat-icon' />",
						"c:" => "<img src='{$icon}ossnchat-cry.gif' class='ossn-chat-icon' />"
				);
				return $icons;
				
		}
		
		/**
		 * Get user friendly time
		 *
		 * @params = $time Timestamp
		 *
		 * @return string;
		 */
		public static function messageTime($time) {
				$time = date('d/m/Y h:i A', $time);
				return $time;
		}
		
		/**
		 * Get all new friends json
		 *
		 * @return json;
		 */
		public static function AllNew() {
				$friends = ossn_loggedin_user()->getFriends();
				if(!$friends) {
						return false;
				}
				foreach($friends as $friend) {
						$status = 0;
						if(($friend instanceof OssnUser) && $friend->isOnline(10)) {
								$status = 'ossn-chat-icon-online';
						}
						$vars['name']   = $friend->fullname;
						$vars['icon']   = $friend->iconURL()->small;
						$vars['guid']   = $friend->guid;
						$vars['status'] = $status;
						$all[]          = $vars;
				}
				return $all;
		}
		
		/**
		 * Send message
		 *
		 * @params $from: User 1 guid
		 *         $to User 2 guid
		 *         $message Message
		 *
		 * @return bool;
		 */
		public function send($from, $to, $message) {
				if(empty($from) || empty($to) || empty($message)) {
						return false;
				}
				$message = strip_tags($message);
				$message = ossn_restore_new_lines($message);
				$message = ossn_input_escape($message, false);
				
				$params['into']   = 'ossn_messages';
				$params['names']  = array(
						'message_from',
						'message_to',
						'message',
						'time',
						'viewed'
				);
				$params['values'] = array(
						(int) $from,
						(int) $to,
						$message,
						time(),
						'0'
				);
				if($this->insert($params)) {
						$this->lastMessage      = $this->getLastEntry();
						$params['message_id']   = $this->lastMessage;
						$params['message_from'] = $from;
						$params['message_to']   = $to;
						$params['message']      = $message;
						ossn_trigger_callback('message', 'created', $params);
						return true;
				}
				return false;
		}
		
		/**
		 * Get messages between two users
		 *
		 * @params $from: User 1 guid
		 *         $to User 2 guid
		 *
		 * @return object
		 */
		public function get($from, $to) {
				$params['from']     = 'ossn_messages';
				$params['wheres']   = array(
						"message_from='{$from}' AND
								  message_to='{$to}' OR
								  message_from='{$to}' AND
								  message_to='{$from}'"
				);
				$params['order_by'] = "id ASC";
				return $this->select($params, true);
		}
		
		/**
		 * Mark message as viewed
		 *
		 * @params $from: User 1 guid
		 *         $to User 2 guid
		 *
		 * @return bool
		 */
		public function markViewed($from, $to) {
				$params['table']  = 'ossn_messages';
				$params['names']  = array(
						'viewed'
				);
				$params['values'] = array(
						1
				);
				$params['wheres'] = array(
						"message_from='{$from}' AND
								   message_to='{$to}'"
				);
				if($this->update($params)) {
						return true;
				}
				return false;
		}
		
		/**
		 * Get new messages
		 *
		 * @params $from: User 1 guid
		 *         $to User 2 guid
		 *
		 * @return bool
		 */
		public function getNew($from, $to, $viewed = 0) {
				$params['from']   = 'ossn_messages';
				$params['wheres'] = array(
						"message_from='{$from}' AND
			 message_to='{$to}' AND viewed='{$viewed}'"
				);
				return $this->select($params, true);
		}
		
		/**
		 * Count online user friends
		 *
		 * @params = $intervals => seconds
		 *           $user User guid
		 *
		 * @return object;
		 */
		public function countOnlineFriends($user, $intervals = 100) {
				$friends = $this->getOnlineFriends($user, $intervals);
				if($friends) {
						$online = get_object_vars($friends);
						return count($online);
				}
				return 0;
		}
		
		/**
		 * Get online user friends
		 *
		 * @params = $intervals => seconds
		 *           $user User guid
		 *
		 * @return object;
		 */
		public function getOnlineFriends($user, $intervals = 100) {
				if(empty($user->guid)) {
						$user = ossn_loggedin_user();
				} else {
						$user = ossn_user_by_guid($user);
				}
				$friends      = $user->getFriends();
				$friend_guids = array();
				if($friends) {
						foreach($friends as $friend) {
								$friend_guids[] = $friend->guid;
						}
				}
				if(!is_array($friend_guids) || empty($friend_guids)) {
						return false;
				}
				$friend_guids     = implode(',', $friend_guids);
				$time             = time();
				$params['from']   = 'ossn_users';
				$params['wheres'] = array(
						"last_activity > {$time} - {$intervals} AND guid IN ({$friend_guids})"
				);
				$friends          = $this->select($params, true);
				return $friends;
		}
		
		/**
		 * Get all new non-viewed messages
		 *
		 * @params = $parm (ossn_messages)
		 *
		 * @return object;
		 */
		public function getNewAll($parm = array()) {
				if(empty($params)) {
						$parm = array(
								'message_from',
								'message'
						);
				}
				$parm             = implode(',', $parm);
				$user             = ossn_loggedin_user()->guid;
				$params['from']   = 'ossn_messages';
				$params['params'] = array(
						"{$parm}"
				);
				$params['wheres'] = array(
						"message_to='{$user}' AND viewed='0'"
				);
				$friends          = $this->select($params, true);
				return $friends;
		}
} //class
