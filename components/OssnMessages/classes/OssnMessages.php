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
class OssnMessages extends OssnDatabase {
		/**
		 * Send message
		 *
		 * @params integer $from: User 1 guid
		 * @params integer $to User 2 guid
		 * @params string $message Message
		 *
		 * @return boolean
		 */
		public function send($from, $to, $message) {
				if(empty($message)) {
						return false;
				}
				//send valid text to database only no html tags
				//missing reconversion of html escaped characters in messages #118
				$message = html_entity_decode($message, ENT_QUOTES, "UTF-8");
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
		 * Get recently chat list
		 *
		 * @params  $to User 2 guid
		 *
		 * @return object
		 */
		public function recentChat($to) {
				$params['from']     = 'ossn_messages';
				$params['wheres']   = array(
						"message_to='{$to}' OR message_from='{$to}'"
				);
				$params['order_by'] = "id DESC";
				$chats              = $this->select($params, true);
				if(!$chats) {
						return false;
				}
				foreach($chats as $rec) {
						$recents[$rec->message_from] = $rec->message_to;
				}
				
				foreach($recents as $k => $v) {
						if($k !== $to) {
								$message_get = $this->get($to, $k);
								if($message_get) {
										$latest = get_object_vars($message_get);
										$c      = end($latest);
										if(!empty($c)) {
												$users[] = $c;
										}
								}
						}
				}
				if(isset($users)) {
						return $users;
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
		 * Get recent sent messages
		 *
		 * @params  $from User 1 guid
		 *
		 * @return object
		 */
		public function recentSent($from) {
				$params['from']     = 'ossn_messages';
				$params['wheres']   = array(
						"message_from='{$from}'"
				);
				$params['order_by'] = "id DESC";
				$c                  = $this->select($params, true);
				foreach($c as $rec) {
						$r[$rec->message_from] = $rec->message_to;
				}
				return $r;
		}
		
		/**
		 * Count unread messages
		 *
		 * @params  integer $to Users guid
		 *
		 * @return object
		 */
		public function countUNREAD($to) {
				$params['from']   = 'ossn_messages';
				$params['wheres'] = array(
						"message_to='{$to}' AND viewed='0'"
				);
				$params['params'] = array(
						'count(*) as new'
				);
				$count            = $this->select($params, true);
				return $count->{0}->new;
		}
		/**
		 * Get message by id
		 *
		 * @params  integer $id ID of message
		 *
		 * @return object|false
		 */
		public function getMessage($id) {
				$params['from']   = 'ossn_messages';
				$params['wheres'] = array(
						"id='{$id}'"
				);
				$get              = $this->select($params);
				if($get) {
						return $get;
				}
				return false;
		}
		/**
		 * Delete users all messages.
		 * This will also delete someone else message to this user.
		 *
		 * @params integer $guid User guid.
		 *
		 * @return boolean
		 */
		public function deleteUser($guid) {
				if(empty($guid)) {
						return false;
				}
				return $this->delete(array(
						'from' => 'ossn_messages',
						'wheres' => array(
								"message_to='{$guid}' OR message_from='{$guid}'"
						)
				));
		}
} //class
