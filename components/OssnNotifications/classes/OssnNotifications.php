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
class OssnNotifications extends OssnDatabase {
		/**
		 * Initialize the objects.
		 *
		 * @return void
		 */
		private function initAttributes() {
				if(empty($this->order_by)) {
						$this->order_by = '';
				}
				if(empty($this->limit)) {
						$this->limit = false;
				}
				$this->data = new stdClass();

				if(!isset($this->offset)) {
						$this->offset = 1;
				}
				if(!isset($this->page_limit)) {
						//default OssnPagination limit
						$this->page_limit = ossn_call_hook('pagination', 'per_page', false, 10);
				}
				if(!isset($this->count)) {
						$this->count = false;
				}
		}
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
		public function add($type, $poster_guid, $subject_guid, $item_guid = null, $notification_owner = '') {
				if(!empty($type) && !empty($subject_guid) && !empty($poster_guid)) {
						$vars = array(
								'type'               => $type,
								'poster_guid'        => $poster_guid,
								'owner_guid'         => null,
								'item_guid'          => $item_guid,
								'subject_guid'       => $subject_guid,
								'notification_owner' => $notification_owner,
						);
						$this->notification = ossn_call_hook('notification:add', $type, $vars, false);
						if(!$this->notification) {
								return false;
						}
						//check if notification owner is set then use it.
						if(!empty($this->notification['notification_owner'])) {
								$this->notification['owner_guid'] = $this->notification['notification_owner'];
						}
						//check if owner_guid is empty or owner_guid is same as poster_guid then return false,
						if(empty($this->notification['owner_guid']) || $this->notification['owner_guid'] == $this->notification['poster_guid']) {
								ossn_trigger_callback('notification', 'owner:poster:match', array(
										'instance'     => $this,
										'notification' => $this->notification,
								));
								return false;
						}
						$callback = array(
								'type'         => $this->notification['type'],
								'poster_guid'  => $this->notification['poster_guid'],
								'owner_guid'   => $this->notification['owner_guid'],
								'subject_guid' => $this->notification['subject_guid'],
								'item_guid'    => $this->notification['item_guid'],
						);
						$params['into']  = 'ossn_notifications';
						$params['names'] = array(
								'type',
								'poster_guid',
								'owner_guid',
								'subject_guid',
								'item_guid',
								'time_created',
						);
						$params['values'] = array(
								$this->notification['type'],
								$this->notification['poster_guid'],
								$this->notification['owner_guid'],
								$this->notification['subject_guid'],
								$this->notification['item_guid'],
								time(),
						);

						if($this->insert($params)) {
								//we need a callback when notification is added
								ossn_trigger_callback('notification', 'add', array(
										'id'           => $this->getLastEntry(),
										'instance'     => $this,
										'notification' => $this->notification,
								));
								return true;
						}
				}
				return false;
		}
		/**
		 * Add notification participant
		 *
		 * @param integer $partcipate  User guid who you wanted to notify
		 * @param array   $vars        Option values
		 *
		 * @return boolean
		 */		
		public function notifyParticipant($partcipate, $vars) {
				if(empty($partcipate)) {
						return false;
				}
				$params['into']  = 'ossn_notifications';
				$params['names'] = array(
						'type',
						'poster_guid',
						'owner_guid',
						'subject_guid',
						'item_guid',
						'time_created',
				);
				$params['values'] = array(
						$vars['type'],
						$vars['poster_guid'],
						$partcipate,
						$vars['subject_guid'],
						$vars['item_guid'],
						time(),
				);
				if($partcipate !== $vars['poster_guid']) {
						if($this->insert($params)) {
								$callback['owner_guid'] = $partcipate;
								ossn_trigger_callback('notification', 'participant:added', $callback);
								return true;
						}
				}
				return false;
		}
		/**
		 * Get notifications
		 *
		 * @param integer $guid_two User guid
		 * @param integer $poster_guid Guid of item poster;
		 *
		 * @return array
		 */
		public function get($guid_two = '', $unread = false, $limit = false, $count = false) {
				if($unread === true) {
						$vars['viewed'] = false;
				}
				if($limit) {
						$vars['limit'] = $limit;
				}
				$vars['owner_guid'] = $guid_two;
				$vars['count']      = $count;
				$vars['page_limit'] = false;
				$vars['order_by']   = 'n.guid DESC';
				$get                = $this->searchNotifications($vars);
				if($count) {
						return $get;
				}
				if($get) {
						foreach($get as $notif) {
								if(ossn_is_hook('notification:view', $notif->type)) {
										$messages[] = ossn_call_hook('notification:view', $notif->type, $notif);
								}
						}
						return $messages;
				}
				return false;
		}

		/**
		 * Count user notification
		 *
		 * @param integer $guid count user notifications
		 *
		 * @return integer;
		 */
		public function countNotification($guid) {
				return $this->searchNotifications(array(
						'owner_guid' => $guid,
						'count'      => true,
						'viewed'     => false,
				));
		}

		/**
		 * Get notitication by guid
		 *
		 * @param integer $guid Notification guid
		 *
		 * @return object;
		 */
		public function getbyGUID($guid = '') {
				if(empty($guid)) {
						return false;
				}
				$notifcation = $this->searchNotifications(array(
						'guid' => $guid,
				));
				if($notifcation) {
						return $notifcation[0];
				}
				return false;
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
				$vars          = array();
				$vars['table'] = 'ossn_notifications';
				$vars['names'] = array(
						'viewed',
				);
				$vars['values'] = array(
						'',
				);
				$vars['wheres'] = array(
						"owner_guid='{$guid}'",
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
								'item_guid',
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
								$this->constructWheres($wheres),
						);
						return $this->delete($vars);
				}
				return false;
		}
		/**
		 * Search Notifcations
		 *
		 * @param array $params A valid options in format,
		 * @param string $params['type'] Notification type
		 * @param string $params['owner_guid'] Notification owner guid
		 * @param string $params['poster_guid'] Notification poster guid
		 * @param string $params['subject_guid'] Notifcation subject guid
		 * @param string $params['item_created'] Notifcation time_created
		 * @param string $params['item_guid'] Notifcation item guid
		 * @param string $params['count'] If you wanted to count then true
		 * @param string $params['viewed'] If viewed true, if not then false
		 * @param string $params['guid'] Notifcation guid
		 * @param string $params['order_by'] Order list , default ASC guid
		 *
		 * reutrn array|false;
		 *
		 */
		public function searchNotifications(array $params = array()) {
				self::initAttributes();
				$default = array(
						'guid'         => false,
						'type'         => false,
						'poster_guid'  => false,
						'owner_guid'   => false,
						'subject_guid' => false,
						'time_created' => false,
						'item_guid'    => false,
						'limit'        => false,
						'order_by'     => false,
						'offset'       => 1,
						'page_limit'   => ossn_call_hook('pagination', 'per_page', false, 10), //call hook for page limit
						'count'        => false,
				);
				$options = array_merge($default, $params);
				$wheres  = array();
				//prepare limit
				$limit = $options['limit'];

				//validate offset values
				if(!empty($options['limit']) && !empty($options['limit']) && !empty($options['page_limit'])) {
						$offset_vals = ceil($options['limit'] / $options['page_limit']);
						$offset_vals = abs($offset_vals);
						$offset_vals = range(1, $offset_vals);
						if(!in_array($options['offset'], $offset_vals)) {
								return false;
						}
				}
				//get only required result, don't bust your server memory
				$getlimit = $this->generateLimit($options['limit'], $options['page_limit'], $options['offset']);
				if($getlimit) {
						$options['limit'] = $getlimit;
				}
				//search notifications
				if(!empty($options['guid'])) {
						$wheres[] = "n.guid='{$options['guid']}'";
				}
				if(!empty($options['type'])) {
						$wheres[] = "n.type='{$options['type']}'";
				}
				if(!empty($options['owner_guid'])) {
						$wheres[] = "n.owner_guid ='{$options['owner_guid']}'";
				}
				if(!empty($options['poster_guid'])) {
						$wheres[] = "n.poster_guid ='{$options['poster_guid']}'";
				}
				if(!empty($options['subject_guid'])) {
						$wheres[] = "n.subject_guid ='{$options['subject_guid']}'";
				}
				if(!empty($options['item_guid'])) {
						$wheres[] = "n.item_guid ='{$options['item_guid']}'";
				}
				if(!empty($options['time_created'])) {
						$wheres[] = "n.time_created ='{$options['time_created']}'";
				}
				if(isset($options['viewed']) && $options['viewed'] == true) {
						$wheres[] = "n.viewed =''";
				}
				if(isset($options['viewed']) && $options['viewed'] == false) {
						$wheres[] = 'n.viewed IS NULL';
				}
				if(empty($wheres)) {
						return false;
				}
				$params           = array();
				$params['from']   = 'ossn_notifications as n';
				$params['params'] = array(
						'n.*',
				);
				$params['wheres'] = array(
						$this->constructWheres($wheres),
				);
				$params['order_by'] = $options['order_by'];
				$params['limit']    = $options['limit'];

				if(!$options['order_by']) {
						$params['order_by'] = 'n.guid ASC';
				}
				if(isset($options['group_by']) && !empty($options['group_by'])) {
						$params['group_by'] = $options['group_by'];
				}
				//override params
				if(isset($options['params']) && !empty($options['params'])) {
						$params['params'] = $options['params'];
				}
				//prepare count data;
				if($options['count'] === true) {
						unset($params['params']);
						unset($params['limit']);
						$count           = array();
						$count['params'] = array(
								'count(*) as total',
						);
						$count = array_merge($params, $count);
						return $this->select($count)->total;
				}
				$fetched_data = $this->select($params, true);
				if($fetched_data) {
						foreach($fetched_data as $item) {
								$results[] = arrayObject($item, get_class($this));
						}
						return $results;
				}
				return false;
		}
		/**
		 * Make notifcation item to output view
		 *
		 * @return string|false
		 */
		public function toTemplate() {
				if(empty($this->guid)) {
						return false;
				}
				if(ossn_is_hook('notification:view', $this->type)) {
						return ossn_call_hook('notification:view', $this->type, $this);
				}
				return false;
		}
}