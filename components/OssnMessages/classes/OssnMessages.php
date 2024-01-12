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
class OssnMessages extends OssnEntities {
		/**
		 * Initialize the objects.
		 *
		 * @return void
		 */
		public function __construct() {
				//php warnings when deleting a message #1353
				$this->data = new stdClass();
		}
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
				if(!strlen($message) || empty($from) || empty($to)) {
						return false;
				}

				$this->data->is_deleted_from = false;
				$this->data->is_deleted_to   = false;

				$message = trim(strip_tags($message));

				$params['into']  = 'ossn_messages';
				$params['names'] = array(
						'message_from',
						'message_to',
						'message',
						'time',
						'viewed',
				);
				$params['values'] = array(
						(int) $from,
						(int) $to,
						$message,
						time(),
						'0',
				);
				if($this->insert($params)) {
						$this->lastMessage = $this->getLastEntry();
						//Attachment

						$file             = new OssnFile();
						$file->owner_guid = $this->lastMessage;
						$file->type       = 'message';
						$file->subtype    = 'attachment';

						$file->setFile('attachment');
						$file->setPath('attachment/');
						if(ossn_file_is_cdn_storage_enabled()) {
								$file->setStore('cdn');
						}
						$file->setExtension(array(
								'jpg',
								'png',
								'jpeg',
								'jfif',
								'gif',
								'webp',
								'docx',
								'pdf',
						));

						if($fileguid = $file->addFile()) {
								$this->data->attachment_guid = $fileguid;
								$this->data->attachment_name = 'file:' . $file->file['name'];

								if(str_contains($file->file['type'], 'image/')) {
										$this->data->attachment_name = 'image:' . $file->file['name'];
								}
						}
						if(isset($this->data) && is_object($this->data)) {
								foreach ($this->data as $name => $value) {
										$this->owner_guid = $this->lastMessage;
										$this->type       = 'message';
										$this->subtype    = $name;
										$this->value      = $value;
										$this->add();
								}
						}
						$params['message_id']   = $this->lastMessage;
						$params['message_from'] = $from;
						$params['message_to']   = $to;
						$params['message']      = $message;
						ossn_trigger_callback('message', 'created', $params);
						return $this->lastMessage;
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
				$params['table'] = 'ossn_messages';
				$params['names'] = array(
						'viewed',
				);
				$params['values'] = array(
						1,
				);
				$params['wheres'] = array(
						"message_from='{$from}' AND
								   message_to='{$to}'",
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
				if(empty($from) || empty($to)) {
						return false;
				}
				return $this->searchMessages(array(
						'message_from' => $from,
						'message_to'   => $to,
						'viewed'       => $viewed,
						'page_limit'   => false,
				));
		}

		/**
		 * Get recently chat list
		 *
		 * @params  $to User 2 guid
		 *
		 * @return object
		 */
		public function recentChat($to, $count = false) {
				if(empty($to)) {
						return false;
				}
				// return the most recent message of each corresponding partner
				// exclude deleted ones
				//include deleted once and show deleted text %arsalanshah
				$subquery = "SELECT sorted.id FROM (
				SELECT MAX(m2.id) as id FROM ossn_messages as m2

				INNER JOIN ossn_entities AS e0 ON e0.owner_guid = m2.id
				INNER JOIN ossn_entities_metadata AS emd0 ON e0.guid = emd0.guid

				INNER JOIN ossn_entities AS e1 ON e1.owner_guid = m2.id
				INNER JOIN ossn_entities_metadata AS emd1 ON e1.guid = emd1.guid

				WHERE
					  (e0.type = 'message' AND e0.subtype = 'is_deleted_from') AND
					  (e1.type = 'message' AND e1.subtype = 'is_deleted_to')
					  AND (
	 					 (m2.message_to={$to} AND emd1.value ='') OR
						 (m2.message_from={$to} AND emd0.value ='')
 					)
 				GROUP BY IF (`message_from`={$to}, `message_to`,`message_from`)
            			) AS sorted";

				$chats = $this->searchMessages(array(
						'wheres'   => array(
								"(
								  m.id IN(
										{$subquery}
									)
								  )",
						),
						'order_by' => 'm.time DESC',
						'offset'   => input('offset_message_xhr_recent', '', 1),
						'count'    => $count,
				));

				if($count == true && $chats) {
						return $chats;
				}
				if(!$chats) {
						return false;
				}
				foreach ($chats as $chat) {
						// if a more recent record of our own is found
						// the message is assumed to be answered
						$chat->answered   = 0;
						$params['params'] = array(
								'count(id) as answered',
						);
						$params['from']   = 'ossn_messages';
						$params['wheres'] = array(
								"message != '' AND message_from = '{$chat->message_to}' AND message_to = '{$chat->message_from}' AND id > '{$chat->id}'",
						);
						if($this->select($params, false)->answered) {
								$chat->answered = 1;
						}
						$processed_chats[] = $chat;
				}
				return $processed_chats;
		}
		/**
		 * Get messages between two users
		 *
		 * @params $from: User 1 guid
		 *         $to User 2 guid
		 *
		 * @return object
		 */
		public function getWith($from, $to, $count = false) {
				$messages = $this->searchMessages(array(
						'wheres'         => array(
								"((message_from='{$from}' AND message_to='{$to}' AND emd0.value='') OR (message_from='{$to}' AND message_to='{$from}' AND emd1.value=''))",
						),
						'order_by'       => 'm.id DESC',
						'offset'         => input('offset_message_xhr_with', '', 1),
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
		/**
		 * Get messages between two users
		 *
		 * @params $from: User 1 guid
		 *         $to User 2 guid
		 *
		 * @return object
		 */
		public function get($from, $to) {
				$params['from']   = 'ossn_messages';
				$params['wheres'] = array(
						"message_from='{$from}' AND
								  message_to='{$to}' OR
								  message_from='{$to}' AND
								  message_to='{$from}'",
				);
				$params['order_by'] = 'id ASC';
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
				$params['from']   = 'ossn_messages';
				$params['wheres'] = array(
						"message_from='{$from}'",
				);
				$params['order_by'] = 'id DESC';
				$c                  = $this->select($params, true);
				foreach ($c as $rec) {
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
						"message_to='{$to}' AND viewed='0'",
				);
				$params['params'] = array(
						'count(*) as new',
				);
				$count = $this->select($params, true);
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
						"id='{$id}'",
				);
				$get = $this->select($params);
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
				//obtained from DeleteMessages component.
				$params           = array();
				$params['params'] = array(
						'a.id',
				);
				$params['from']   = 'ossn_messages as a';
				$params['wheres'] = array(
						"a.message_to='{$guid}' OR a.message_from='{$guid}'",
				);
				$message_ids = $this->select($params, true);
				if($message_ids) {
						$deleted_messages = count((array) $message_ids);
						$message_id_list  = implode(
								',',
								array_map(function ($x) {
										return $x->id;
								}, (array) $message_ids)
						);

						$params           = array();
						$params['params'] = array(
								'e.guid',
						);
						$params['from']   = 'ossn_entities as e';
						$params['wheres'] = array(
								"e.owner_guid IN ({$message_id_list}) AND e.type = 'message'",
						);
						$entity_guids = $this->select($params, true);

						if($entity_guids) {
								$entity_guid_list = implode(
										',',
										array_map(function ($x) {
												return $x->guid;
										}, (array) $entity_guids)
								);
								$this->delete(array(
										'from'   => 'ossn_entities_metadata',
										'wheres' => array(
												"guid IN ({$entity_guid_list})",
										),
								));
								$this->delete(array(
										'from'   => 'ossn_entities',
										'wheres' => array(
												"guid IN ({$entity_guid_list})",
										),
								));
						}
						$this->delete(array(
								'from'   => 'ossn_messages',
								'wheres' => array(
										"id IN ({$message_id_list})",
								),
						));
						return $deleted_messages;
				}
				return false;
		}
		/**
		 * Search messages by some options
		 *
		 * @param array   $params A valid options in format:
		 * @param string  $params['id']  message id
		 * @param string  $params['message_from']  A user GUID who sent messages
		 * @param string  $params['message_to']   A user GUID who receieve messages
		 * @param integer $params['viewed']  True if message is viewed , false if message isn't viewed or 1/0
		 * @param integer $params['limit'] Result limit default, Default is 20 values
		 * @param string  $params['order_by']  To show result in sepcific order. Default is DESC.
		 * @param string  $params['count']  Count the message
		 *
		 * reutrn array|false;
		 */
		public function searchMessages(array $params = array()) {
				if(empty($params)) {
						return false;
				}
				//prepare default attributes
				$default = array(
						'id'             => false,
						'distinct'       => false,
						'message_from'   => false,
						'message_to'     => false,
						'limit'          => false,
						'order_by'       => false,
						'entities_pairs' => false,
						'offset'         => 1,
						'page_limit'     => ossn_call_hook('pagination', 'messages:list:limit', false, 10), //call hook for page limit
						'count'          => false,
				);
				$options      = array_merge($default, $params);
				$wheres       = array();
				$params       = array();
				$wheres_paris = array();
				//validate offset values
				if($options['limit'] !== false && $options['limit'] !== 0 && $options['page_limit'] !== false && $options['page_limit'] !== 0) {
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
				if(!empty($options['id'])) {
						$wheres[] = "m.id='{$options['id']}'";
				}
				if(!empty($options['message_from'])) {
						$wheres[] = "m.message_from ='{$options['message_from']}'";
				}
				if(!empty($options['message_to'])) {
						$wheres[] = "m.message_to ='{$options['message_to']}'";
				}
				//[B] searchMessages viewed option doesn't work #2235
				if(isset($options['viewed'])) {
						$wheres[] = "m.viewed ='{$options['viewed']}'";
				}
				if(isset($options['entities_pairs']) && is_array($options['entities_pairs'])) {
						foreach ($options['entities_pairs'] as $key => $pair) {
								$operand = empty($pair['operand']) ? '=' : $pair['operand'];
								if(!empty($pair['name']) && isset($pair['value']) && !empty($operand)) {
										if(!empty($pair['value'])) {
												$pair['value'] = addslashes($pair['value']);
										}
										$wheres_paris[] = "e{$key}.type='message'";
										$wheres_paris[] = "e{$key}.subtype='{$pair['name']}'";
										if(isset($pair['wheres']) && !empty($pair['wheres'])) {
												$pair['wheres'] = str_replace('[this].', "emd{$key}.", $pair['wheres']);
												$wheres_paris[] = $pair['wheres'];
										} else {
												$wheres_paris[] = "emd{$key}.value {$operand} '{$pair['value']}'";
										}
										$params['joins'][] = "INNER JOIN ossn_entities as e{$key} ON e{$key}.owner_guid=m.id";
										$params['joins'][] = "INNER JOIN ossn_entities_metadata as emd{$key} ON e{$key}.guid=emd{$key}.guid";
								}
						}
						if(!empty($wheres_paris)) {
								$wheres_entities = '(' . $this->constructWheres($wheres_paris) . ')';
								$wheres[]        = $wheres_entities;
						}
				}
				if(isset($options['wheres']) && !empty($options['wheres'])) {
						if(!is_array($options['wheres'])) {
								$wheres[] = $options['wheres'];
						} else {
								foreach ($options['wheres'] as $witem) {
										$wheres[] = $witem;
								}
						}
				}
				if(isset($options['joins']) && !empty($options['joins']) && is_array($options['joins'])) {
						foreach ($options['joins'] as $jitem) {
								$params['joins'][] = $jitem;
						}
				}
				$distinct = '';
				if($options['distinct'] === true) {
						$distinct = 'DISTINCT ';
				}
				//prepare search
				$params['from']   = 'ossn_messages as m';
				$params['params'] = array(
						"{$distinct}m.id",
						'm.*',
				);
				$params['wheres'] = array(
						$this->constructWheres($wheres),
				);
				$params['order_by'] = $options['order_by'];
				$params['limit']    = $options['limit'];

				if(!$options['order_by']) {
						$params['order_by'] = 'm.id DESC';
				}
				if(isset($options['group_by']) && !empty($options['group_by'])) {
						$params['group_by'] = $options['group_by'];
				}
				//override params
				if(isset($options['params']) && !empty($options['params'])) {
						$params['params'] = $options['params'];
				}
				$messages = $this->select($params, true);
				//prepare count data;
				if($options['count'] === true) {
						unset($params['params']);
						unset($params['limit']);
						$count           = array();
						$count['params'] = array(
								"count({$distinct}m.id) as total",
						);
						$count = array_merge($params, $count);
						return $this->select($count)->total;
				}
				if($messages) {
						foreach ($messages as $message) {
								$lists = array();
								if(isset($message->id)) {
										$entities = $this->searchEntities(array(
												'type'       => 'message',
												'owner_guid' => $message->id,
												'page_limit' => false,
										));
										if($entities) {
												foreach ($entities as $entity) {
														$lists[$entity->subtype] = $entity->value;
												}
										}
										$merged   = array_merge((array) $message, $lists);
										$result[] = arrayObject($merged, get_class($this));
								}
						}
						return $result;
				}
				return false;
		}
		/**
		 * A messages save function
		 *
		 * @return boolean
		 */
		public function save() {
				if(isset($this->id) && $this->id > 0) {
						$params['table'] = 'ossn_messages';
						$params['names'] = array(
								'message_from',
								'message_to',
								'message',
						);
						$params['values'] = $values = array(
								$this->message_from,
								$this->message_to,
								$this->message,
						);
						$params['wheres'] = array(
								"id='{$this->id}'",
						);
						if($this->update($params)) {
								if(isset($this->data)) {
										$this->owner_guid = $this->id;
										$this->type       = 'message';
										unset($this->subtype);

										parent::save();
								}
								return $this->id;
						}
				}
				return false;
		}
		/**
		 * Does message have attachment
		 *
		 * @return boolean
		 */
		public function isAttachment() {
				if(isset($this->attachment_guid) && !empty($this->attachment_guid)) {
						return true;
				}
				return false;
		}
		/**
		 * Type of attachment
		 *
		 * @return boolean|string
		 */
		public function typeOfAttachment() {
				if($this->isAttachment()) {
						if(str_starts_with($this->attachment_name, 'file:')) {
								return 'file';
						} elseif(str_starts_with($this->attachment_name, 'image:')) {
								return 'image';
						}
				}
				return false;
		}
		/**
		 * Return attachment URL
		 *
		 * @return void|string
		 */
		public function attachmentName() {
				if($this->isAttachment()) {
						return str_replace(
								array(
										'image:',
										'file:',
								),
								'',
								$this->attachment_name
						);
				}
		}
		/**
		 * Return attachment URL
		 *
		 * @return void|string
		 */
		public function attachmentURL() {
				if($this->isAttachment()) {
						$attachment_name = str_replace('file:', '', $this->attachment_name);
						$attachment_name = str_replace('image:', '', $attachment_name);
						//[B] OssnMessages image attachment broken if invalid file name #2339
						$path_info       = pathinfo($attachment_name);
						$attachment_name = OssnTranslit::urlize($path_info['filename']);
						return ossn_site_url("messages/attachment/{$this->attachment_guid}/{$attachment_name}.{$path_info['extension']}");
				}
		}
		/**
		 * Delete message from record
		 * [E] Permanently Delete message method needs to be created #2231
		 *
		 * @return boolean
		 */
		public function deleteMessage() {
				$message_id = $this->id;
				if(isset($message_id)) {
						$param = array(
								'from'   => 'ossn_messages',
								'wheres' => array(
										"id='{$message_id}'",
								),
						);
						if($this->delete($param)) {
								if($this->deleteByOwnerGuid($message_id, 'message')) {
										$data = ossn_get_userdata("message/{$message_id}/");
										if(is_dir($data)) {
												OssnFile::DeleteDir($data);
										}
								}
								return true;
						}
				}
				return false;
		}
		/**
		 * Get status for users by user guids
		 * We will use plain SQL to avoid loads because of entities checking
		 *
		 * @param string $ids User ids
		 *
		 * @return array|boolean
		 */
		public function onlineStatus($ids) {
				if(empty($ids)) {
						return false;
				}
				$vars = array(
						'from'   => 'ossn_users as u',
						'wheres' => array(
								"u.guid IN($ids)",
						),
				);
				$status  = $this->select($vars, true);
				$statues = array();
				if($status) {
						foreach ($status as $u) {
								$user                 = arrayObject($u, 'OssnUser');
								$statues[$user->guid] = $user->isOnline(10);
						}
						return $statues;
				}
				return false;
		}
} //class
