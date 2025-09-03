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
class OssnChat extends OssnMessages {
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
				$count = count($_SESSION['ossn_chat_users']);
				if($count >= 2){
						array_shift($_SESSION['ossn_chat_users']);
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
		 * @return array
		 */
		public static function AllNew($intervals = 10) {
				$time = time();
				//[B] OssnChat showing only 10 users #2263
				$friends = ossn_loggedin_user()->getFriends(ossn_loggedin_user()->guid, array(
						'page_limit' => false,
						"wheres"     => "u.last_activity > {$time} - {$intervals}",
				));
				if(!$friends) {
						return false;
				}
				foreach($friends as $friend) {
						//default value should be offline  [B] OssnChat default value showing 0 in class #2163
						//$status = 'ossn-chat-icon-offline';
						//if($friend instanceof OssnUser && $friend->isOnline(10)) { 
						//[E] Show only online members in Chat #2287
						//so the status will be online by default
						$status = 'ossn-chat-icon-online';
						//}
						$vars['name']   = $friend->fullname;
						$vars['icon']   = $friend->iconURL()->small;
						$vars['guid']   = $friend->guid;
						$vars['status'] = $status;
						$all[]          = $vars;
				}
				$comp = function ($element) {
								return $element['status'];
				};
				$map = array_map($comp, $all);
				array_multisort($map,SORT_DESC,SORT_STRING,$all,);
				return $all;
		}
		/**
		 * Count online friends of user
		 *
		 * @param int  $intervals seconds
		 * @param int  $user USER GUID or Empty
		 *
		 * @return integer
		 */
		public function countOnlineFriends($user, $intervals = 100) {
				if(is_int($user)) {
						$user = ossn_user_by_guid($user);
				} else {
						$user = ossn_loggedin_user();
				}
				$time = time();
				return $user->getFriends($user->guid, array(
						'wheres' => "(u.last_activity > {$time} - {$intervals})",
						'count'  => true,
				));
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
				$time = time();
				return $user->getFriends($user->guid, array(
						'wheres'     => "(u.last_activity > {$time} - {$intervals})",
						'page_limit' => false,
				));
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
								'message',
						);
				}
				$parm             = implode(',', $parm);
				$user             = ossn_loggedin_user()->guid;
				$params['from']   = 'ossn_messages';
				$params['params'] = array(
						"{$parm}",
				);
				$params['wheres'] = array(
						"message_to='{$user}' AND viewed='0'",
				);
				$friends = $this->select($params, true);
				return $friends;
		}
		/**
		 * Get messages between two users
		 *
		 * @note this copied from OssnMessages and edited offest beacuse of #1832
		 *
		 * @param int $from User 1 guid
		 * @param int $to User 2 guid
		 *
		 * @return object
		 */
		public function getWith($from, $to, $count = false) {
				$messages = $this->searchMessages(array(
						'wheres'         => array(
								"((message_from='{$from}' AND message_to='{$to}' AND emd0.value='') OR (message_from='{$to}' AND message_to='{$from}' AND emd1.value=''))",
						),
						'order_by'       => 'm.id DESC',
						'offset'         => input("offset_message_xhr_with_{$to}", '', 1),
						'count'          => $count,
						'entities_pairs' => array(
								array(
										'name'   => 'is_deleted_from', //we don't wanted to show messages which user have expunged from record
										'value'  => false,
										'wheres' => '(emd0.value IS NOT NULL)',
								),
								array(
										'name'   => 'is_deleted_to', //we don't wanted to show messages which user have expunged from record
										'value'  => false,
										'wheres' => '(emd1.value IS NOT NULL)',
								),
						),
				));
				if($messages && !$count) {
						return array_reverse($messages);
				}
				return $messages;
		}
} //class
