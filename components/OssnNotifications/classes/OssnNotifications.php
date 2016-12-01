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
class OssnNotifications extends OssnDatabase {
		/**
		 * Add notification to database
		 *
		 * @param integer $subject_id Id of item which user comment
		 * @param integer $poster_guid Guid of item poster
		 * @param integer $item_guid: Guid of item
		 * @param integer $notification_owner: Guid of notification owner
		 *
		 * @return boolean;
		 */
		public function add($type, $poster_guid, $subject_guid, $item_guid = NULL, $notification_owner = '') {
				if(!empty($type) && !empty($subject_guid) && !empty($poster_guid)) {
						$vars               = array(
								'type' => $type,
								'poster_guid' => $poster_guid,
								'owner_guid' => null,
								'item_guid' => $item_guid,
								'subject_guid' => $subject_guid,
								'notification_owner' => $notification_owner
						);
						$this->notification = ossn_call_hook('notification:add', $type, $vars, false);
						if(!$this->notification) {
								return false;
						}
						//check if owner_guid is empty or owner_guid is same as poster_guid then return false, 
						if(empty($this->notification['owner_guid']) || $this->notification['owner_guid'] == $this->notification['poster_guid']) {
								return false;
						}
						//check if notification owner is set then use it.
						if(!empty($this->notification['notification_owner'])) {
								$this->notification['owner_guid'] = $this->notification['notification_owner'];
						}
						$callback = array(
								'type' => $this->notification['type'],
								'poster_guid' => $this->notification['poster_guid'],
								'owner_guid' => $this->notification['owner_guid'],
								'subject_guid' => $this->notification['subject_guid'],
								'item_guid' => $this->notification['item_guid']
						);
						if($poster_guid == $guid_two) {
								$paricipates = $this->get_comments_participates($subject_guid);
								if($type !== 'like:post' && $paricipates) {
										foreach($paricipates as $partcipate) {
												$params['into']   = 'ossn_notifications';
												$params['names']  = array(
														'type',
														'poster_guid',
														'owner_guid',
														'subject_guid',
														'item_guid',
														'time_created'
												);
												$params['values'] = array(
														$this->notification['type'],
														$this->notification['poster_guid'],
														$partcipate,
														$this->notification['subject_guid'],
														$this->notification['item_guid'],
														time()
												);
												if($partcipate !== $poster_guid) {
														ossn_trigger_callback('notification', 'add:participates', $callback);
														$this->insert($params);
												}
										}
								}
								return false;
						}
						
						$params['into']   = 'ossn_notifications';
						$params['names']  = array(
								'type',
								'poster_guid',
								'owner_guid',
								'subject_guid',
								'item_guid',
								'time_created'
						);
						$params['values'] = array(
								$this->notification['type'],
								$this->notification['poster_guid'],
								$this->notification['owner_guid'],
								$this->notification['subject_guid'],
								$this->notification['item_guid'],
								time()
						);
						if($this->insert($params)) {
								//notify participates
								$paricipates = $this->get_comments_participates($subject_guid);
								if($type !== 'like:post' && $paricipates) {
										foreach($paricipates as $partcipate) {
												$params['into']   = 'ossn_notifications';
												$params['names']  = array(
														'type',
														'poster_guid',
														'owner_guid',
														'subject_guid',
														'item_guid',
														'time_created'
												);
												$params['values'] = array(
														$this->notification['type'],
														$this->notification['poster_guid'],
														$partcipate,
														$this->notification['subject_guid'],
														$this->notification['item_guid'],
														time()
												);
												if($partcipate !== $poster_guid) {
														if($this->insert($params)) {
																unset($callback['owner_guid']);
																$callback['owner_guid'] = $partcipate;
																ossn_trigger_callback('notification', 'add:participates', $callback);
														}
												}
										}
								}
								
								ossn_trigger_callback('notification', 'add', $callback);
								return true;
						}
				}
				return false;
		}
		
		/**
		 * Get comments participates
		 *
		 * @param integer $subject_id Id of item which user comment
		 *
		 * @return array;
		 */
		public function get_comments_participates($subject_guid) {
				$params['from']   = 'ossn_notifications';
				$params['wheres'] = array(
						"type='comments:post' AND subject_guid='{$subject_guid}'"
				);
				$users            = $this->select($params, true);
				$participates     = array();
				if($users) {
						foreach($users as $user) {
								$participates[] = $user->poster_guid;
						}
						return array_unique($participates);
				}
		}
		
		/**
		 * Get notifications
		 *
		 * @param integer $guid_two User guid
		 * @param integer $poster_guid Guid of item poster;
		 *
		 * @return array
		 */
		public function get($guid_two, $unread = false, $limit = false) {
				$getunread = '';
				if($unread === true) {
						$getunread = "AND viewed IS NULL";
				}
				if($limit) {
						$listlimit = "LIMIT {$limit}";
				}
				$baseurl = ossn_site_url();
				$this->statement("SELECT * FROM ossn_notifications WHERE(
		                  owner_guid='{$guid_two}' {$getunread}) ORDER by guid DESC {$listlimit}");
				$this->execute();
				$get = $this->fetch(true);
				if(!$get) {
						return false;
				}
				foreach($get as $notif) {
						if(ossn_is_hook('notification:view', $notif->type)) {
								$messages[] = ossn_call_hook('notification:view', $notif->type, $notif);
						}
				}
				return $messages;
		}
		
		/**
		 * Count user notification
		 *
		 * @params integer $guid Count user notifications
		 *
		 * @return int;
		 */
		public function countNotification($guid) {
				$notifications = $this->get($guid, true);
				if($notifications) {
						$count = count($notifications);
						if($count > 0) {
								return $count;
						}
				}
				return false;
		}
		
		/**
		 * Get notitication by guid
		 *
		 * @param integer $guid Notification guid
		 *
		 * @return object;
		 */
		public function getbyGUID($guid) {
				$this->statement("SELECT * FROM ossn_notifications WHERE(guid='{$guid}');");
				$this->execute();
				$data = $this->fetch();
				return $data;
		}
		
		/**
		 * Mark notification as viewd
		 *
		 * @param integer $guid Notification guid
		 *
		 * @return object;
		 */
		public function setViewed($guid) {
				$this->statement("UPDATE ossn_notifications SET viewed='' WHERE(guid='{$guid}');");
				if($this->execute()) {
						return true;
				}
				return false;
		}
		/**
		 * Delete user notifications
		 *
		 * @param object $user User entity
		 *
		 * @return boolean;
		 */
		public function deleteUserNotifications($user) {
				if($user) {
						$this->statement("DELETE FROM ossn_notifications WHERE(
							  poster_guid='{$user->guid}' OR owner_guid='{$user->guid}');");
						if($this->execute()) {
								return true;
						}
				}
				return false;
		}
		/**
		 * Clear all notifications of specific user
		 * See : 3 state logic for notifications #202 
		 * https://github.com/opensource-socialnetwork/opensource-socialnetwork/issues/202
		 *
		 * @param integer $guid User guid
		 *
		 * @return boolean;
		 */
		public function clearAll($guid) {
				if(empty($guid)) {
						return false;
				}
				$vars           = array();
				$vars['table']  = "ossn_notifications";
				$vars['names']  = array(
						'viewed'
				);
				$vars['values'] = array(
						''
				);
				$vars['wheres'] = array(
						"owner_guid='{$guid}'"
				);
				return $this->update($vars);
		}
		/**
		 * Delete a notifications
		 * 
		 * @param array $params A wheres clause
		 * 
		 * @return boolean
		 */
		public function deleteNotification(array $params = array()) {
				if(!empty($params)) {
						$valid = array(
								'guid',
								'type',
								'poser_guid',
								'owner_guid',
								'subject_guid',
								'item_guid'
						);
						foreach($params as $key => $item) {
								if(!in_array($key, $valid)) {
										unset($params[$key]);
								}
						}
						if(empty($params)) {
								return false;
						}
						foreach($params as $key => $where) {
								if(is_array($where)) {
										foreach($where as $implode) {
												$items[] = "'{$implode}'";
										}
										$in       = implode(',', $items);
										$wheres[] = "{$key} IN ($in)";
										unset($items);
										unset($in);
								} else {
										$wheres[] = "{$key} = '{$where}'";
								}
						}
						if(empty($wheres)) {
								return false;
						}
						$vars           = array();
						$vars['from']   = 'ossn_notifications';
						$vars['wheres'] = array(
								$this->constructWheres($wheres)
						);
						return $this->delete($vars);
				}
				return false;
		}
		
}
