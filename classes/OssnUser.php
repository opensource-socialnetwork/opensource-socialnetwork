<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
class OssnUser extends OssnEntities {
		/**
		 * Initialize the objects.
		 *
		 * @return void
		 */
		public function initAttributes() {
				$this->OssnDatabase   = new OssnDatabase;
				$this->OssnAnnotation = new OssnAnnotation;
				$this->notify         = new OssnMail;
				if(!isset($this->sendactiviation)) {
						$this->sendactiviation = false;
				}
				$this->data = new stdClass;
		}
		/**
		 * Add user to system.
		 *
		 * @return boolean
		 */
		public function addUser() {
				self::initAttributes();
				if(empty($this->usertype)) {
						$this->usertype = 'normal';
				}
				$user = $this->getUser();
				if(empty($user->username) && $this->isPassword() && $this->isUsername()) {
						//set default algo to bcrypt;
						$password_encryption_alog = ossn_call_hook('user', 'password:algorithm', false, 'bcrypt');
						$this->setPassAlgo($password_encryption_alog);
						
						$this->salt            = $this->generateSalt();
						$password              = $this->generate_password($this->password, $this->salt);
						$activation            = md5($this->password . time() . rand());
						$this->sendactiviation = ossn_call_hook('user', 'send:activation', false, $this->sendactiviation);
						$this->validated       = ossn_call_hook('user', 'create:validated', false, $this->validated);
						if($this->validated === true) {
								//don't set null , set empty value for users created by admin
								$activation = '';
						}
						$params['into']   = 'ossn_users';
						$params['names']  = array(
								'first_name',
								'last_name',
								'email',
								'username',
								'type',
								'password',
								'salt',
								'activation',
								'last_login',
								'last_activity',
								'time_created'
						);
						$params['values'] = array(
								$this->first_name,
								$this->last_name,
								$this->email,
								$this->username,
								$this->usertype,
								$password,
								$this->salt,
								$activation,
								0,
								0,
								time()
						);
						$create           = ossn_call_hook('user', 'create', array(
								'params' => $params,
								'instance' => $this
						), true);
						if($create) {
								if($this->insert($params)) {
										$guid   = $this->getLastEntry();
										//define user extra profile fields
										$fields = ossn_default_user_fields();
										if(!empty($guid) && is_int($guid)) {
												
												$this->owner_guid = $guid;
												$this->type       = 'user';
												
												//add user entities 
												$extra_fields = ossn_call_hook('user', 'signup:fields', $this, $fields);
												if(!empty($extra_fields['required'])) {
														foreach($extra_fields['required'] as $type) {
																foreach($type as $field) {
																		if(isset($this->{$field['name']})) {
																				$this->subtype = $field['name'];
																				$this->value   = $this->{$field['name']};
																				//add entity
																				$this->add();
																		}
																}
														}
												}
												//v5.1 allow a specific password algorithm for each user
												$this->subtype = 'password_algorithm';
												$this->value   = $this->getPassAlog();
												$this->add();
										}
										//should i send activation?
										if($this->sendactiviation === true) {
												$link       = ossn_site_url("uservalidate/activate/{$guid}/{$activation}");
												$link       = ossn_call_hook('user', 'validation:email:url', $this, $link);
												$sitename   = ossn_site_settings('site_name');
												$activation = ossn_print('ossn:add:user:mail:body', array(
														$sitename,
														$link,
														ossn_site_url()
												));
												$subject    = ossn_print('ossn:add:user:mail:subject', array(
														$this->first_name,
														$sitename
												));
												//notify users for activation
												$this->notify->NotifiyUser($this->email, $subject, $activation);
										}
										ossn_trigger_callback('user', 'created', array(
												'guid' => $guid
										));
										return $guid;
								}
						}
				}
				return false;
		}
		
		/**
		 * Check if username is exist in database or not.
		 *
		 * @return boolean
		 */
		public function isOssnUsername() {
				$user = $this->getUser();
				//[B] case insensitive emails and username issues during login or signup #1726
				if(!empty($user->guid) && strtolower($this->username) == strtolower($user->username)) {
						return true;
				}
				return false;
		}
		
		/**
		 * Check if email is exist in database or not.
		 *
		 * @return boolean
		 */
		public function isOssnEmail() {
				$user = $this->getUser();
				//[B] case insensitive emails and username issues during login or signup #1726
				if(!empty($user->guid) && strtolower($this->email) == strtolower($user->email)) {
						return true;
				}
				return false;
		}
		
		/**
		 * Get user with its entities.
		 *
		 * @return object
		 */
		public function getUser() {
				//[B] case insensitive emails and username issues during login or signup #1726
				if(!empty($this->email)) {
						$params['from']   = 'ossn_users';
						$params['wheres'] = array(
								"LOWER(email) = LOWER('{$this->email}')"
						);
						$user             = $this->select($params);
				}
				if(empty($user) && !empty($this->username)) {
						$params['from']   = 'ossn_users';
						$params['wheres'] = array(
								"LOWER(username) = LOWER('{$this->username}')"
						);
						$user             = $this->select($params);
				}
				if(empty($user) && !empty($this->guid)) {
						$params['from']   = 'ossn_users';
						$params['wheres'] = array(
								"guid='{$this->guid}'"
						);
						$user             = $this->select($params);
				}
				if(!$user) {
						return false;
				}
				$user->fullname   = "{$user->first_name} {$user->last_name}";
				$this->owner_guid = $user->guid;
				$this->type       = 'user';
				$entities         = $this->get_entities();
				if(empty($entities)) {
						$metadata       = arrayObject($user, get_class($this));
						$metadata->data = new stdClass;
						return ossn_call_hook('user', 'get', false, $metadata);
				}
				foreach($entities as $entity) {
						$fields[$entity->subtype] = $entity->value;
				}
				$data           = array_merge(get_object_vars($user), $fields);
				$metadata       = arrayObject($data, get_class($this));
				$metadata->data = new stdClass;
				return ossn_call_hook('user', 'get', false, $metadata);
		}
		
		/**
		 * Check if password is > 5 or not.
		 *
		 * @return boolean
		 */
		public function isPassword() {
				$password_minimum = ossn_call_hook('user', 'password:minimum:length', false, 6);
				if(strlen($this->password) >= $password_minimum && !(strlen($this->password) < 6)) {
						return true;
				}
				return false;
		}
		/**
		 * Check if password is > 5 or not.
		 *
		 * @return boolean
		 */
		public function isEmail() {
				if(filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
						return true;
				}
				return false;
		}
		/**
		 * Check if the user is correct or not.
		 *
		 * @return boolean
		 */
		public function isUsername() {
				if(preg_match("/^[a-zA-Z0-9]+$/", $this->username) && strlen($this->username) > 4) {
						return true;
				}
				return false;
		}
		
		/**
		 * Generate salt.
		 *
		 * @return string
		 */
		public function generateSalt() {
				return substr(uniqid(), 5);
		}
		/**
		 * Set a password encryption algorithm
		 *
		 * @param string $algo algorithm name bcrypt/argon2i/md5
		 *
		 * @return void
		 */
		public function setPassAlgo($algo = '') {
				$this->password_algorithm = $algo;
		}
		/**
		 * Get a password encryption algorithm
		 *
		 * @return string
		 */
		public function getPassAlog() {
				if(!isset($this->password_algorithm)) {
						return 'md5';
				}
				
				return $this->password_algorithm;
		}
		/**
		 * Verify a password 
		 *
		 * @param string $password New entered password
		 * @param string $salt	User actual password salt
		 * @param string $hash  Actual password 
		 *
		 * @return boolean
		 */
		public function verifyPassword($password, $salt, $hash) {
				$algo = $this->getPassAlog();
				switch($algo) {
						case 'bcrypt':
						case 'argon2i':
								return password_verify($password . $salt, $hash);
								break;
				}
				$this->setPassAlgo('md5');
				$password = $this->generate_password($password, $salt);
				if($password === $hash) {
						return true;
				}
				return false;
		}
		/**
		 * Generate password.
		 *
		 * @return string
		 */
		public function generate_password($password = '', $salt = '') {
				$algo = $this->getPassAlog();
				switch($algo) {
						case 'bcrypt':
								return password_hash($password . $salt, PASSWORD_BCRYPT);
								break;
						case 'argon2i':
								return password_hash($password . $salt, PASSWORD_ARGON2I);
								break;
				}
				//default is always md5 no matter what algo used (then above)
				return md5($password . $salt);
		}
		
		/**
		 * Login into site.
		 *
		 * @return boolean
		 */
		public function Login() {
				$user = $this->getUser();
				if(isset($user->password_algorithm)) {
						//setting user password algo
						$this->setPassAlgo($user->password_algorithm);
				}
				if($user && $this->verifyPassword($this->password, $user->salt, $user->password) && $user->activation == NULL) {
						
						unset($user->password);
						unset($user->salt);
						
						OssnSession::assign('OSSN_USER', $user);
						$this->update_last_login();
						
						$vars         = array();
						$vars['user'] = $user;
						$login        = ossn_call_hook('user', 'login', $vars, true);
						return $login;
				}
				return false;
		}
		
		/**
		 * Update user last login time.
		 *
		 * @return boolean
		 */
		public function update_last_login() {
				$user             = ossn_loggedin_user();
				$guid             = $user->guid;
				$params['table']  = 'ossn_users';
				$params['names']  = array(
						'last_login'
				);
				$params['values'] = array(
						time()
				);
				$params['wheres'] = array(
						"guid='{$guid}'"
				);
				if($guid > 0 && $this->update($params)) {
						return true;
				}
				return false;
		}
		
		/**
		 * Get user friends requests.
		 *
		 * @return object
		 */
		public function getFriendRequests($user = '') {
				if(isset($this->guid)) {
						$user = $this->guid;
				}
				$this->statement("SELECT * FROM ossn_relationships WHERE(
					     relation_to='{$user}' AND
					     type='friend:request'
					     );");
				$this->execute();
				$from = $this->fetch(true);
				if(!is_object($from)) {
						return false;
				}
				foreach($from as $fr) {
						$this->statement("SELECT * FROM ossn_relationships WHERE(
                            relation_from='{$user}' AND
                            relation_to='{$fr->relation_from}' AND
                            type='friend:request'
                            );");
						$this->execute();
						$from = $this->fetch();
						if(!isset($from->relation_id)) {
								$uss[] = ossn_user_by_guid($fr->relation_from);
						}
				}
				if(isset($uss)) {
						return $uss;
				}
				return false;
		}
		
		/**
		 * Check if the user is friend with other or not.
		 *
		 * @return boolean
		 */
		public function isFriend($usera, $user2) {
				//Confirmed friendship needs to be based on the existance of a '1 to 2' AND a '2 to 1' relation #1442
				//Utilize the 4th argument of function that cross check $from - to, $to - from
				return ossn_relation_exists($usera, $user2, 'friend:request', true);
		}
		
		/**
		 * Get user friends.
		 *
		 * @return object
		 */
		public function getFriends($user = '', array $options = array()) {
				if(isset($this->guid)) {
						$user = $this->guid;
				}
				
				$default       = array(
						'page_limit' => false,
						'limit' => false,
						'count' => false
				);
				$args          = array_merge($default, $options);
				$relationships = ossn_get_relationships(array(
						'to' => $user,
						'type' => 'friend:request',
						'inverse' => true,
						'page_limit' => $args['page_limit'],
						'limit' => $args['limit'],
						'count' => $args['count'],
						'order_by' => $args['order_by']
				));
				if($args['count'] == true) {
						return $relationships;
				}
				if($relationships) {
						foreach($relationships as $relation) {
								$friends[] = ossn_user_by_guid($relation->relation_to);
						}
						return $friends;
				}
				return false;
		}
		
		/**
		 * Send request to other user.
		 *
		 * @return boolean
		 */
		public function sendRequest($from, $to) {
				if($this->requestExists($from, $to)) {
						return false;
				}
				if(ossn_add_relation($from, $to, 'friend:request')) {
						return true;
				}
				return false;
		}
		
		/**
		 * Check if the request already sent or not.
		 *
		 * @param integer $from Relation from guid
		 * @param integer $user Relation to , user guid
		 *
		 * @return boolean
		 */
		public function requestExists($from, $user) {
				if(isset($this->guid)) {
						$user = $this->guid;
				}
				return ossn_relation_exists($from, $user, 'friend:request');
		}
		
		/**
		 * Delete friend from list
		 *
		 * @return boolean
		 */
		public function deleteFriend($from, $to) {
				$this->statement("DELETE FROM ossn_relationships WHERE(
						 (relation_from='{$from}' AND relation_to='{$to}' AND type='friend:request') OR
						 (relation_from='{$to}' AND relation_to='{$from}' AND type='friend:request'))");
				if($this->execute()) {
						return true;
				}
				return false;
		}
		
		/**
		 * Get site users.
		 *
		 * @param array $params A options values
		 * 
		 * @note This method will be removed from Ossn v5
		 *
		 * @return array
		 */
		public function getSiteUsers($params = array()) {
				$default = array(
						'keyword' => false
				);
				$vars    = array_merge($default, $params);
				return $this->searchUsers($vars);
				
		}
		
		/**
		 * Update user last activity time
		 *
		 * @return boolean
		 */
		public function update_last_activity() {
				$user = ossn_loggedin_user();
				if($user) {
						$guid             = $user->guid;
						$params['table']  = 'ossn_users';
						$params['names']  = array(
								'last_activity'
						);
						$params['values'] = array(
								time()
						);
						$params['wheres'] = array(
								"guid='{$guid}'"
						);
						if($guid > 0 && $this->update($params)) {
								return true;
						}
				}
				return false;
		}
		
		/**
		 * Count Total online site users.
		 *
		 * @return boolean
		 */
		public function online_total() {
				return count((array) $this->getOnline());
		}
		
		/**
		 * Get online site users.
		 *
		 * @params integer $intervals Seconds
		 *
		 * @return object
		 */
		public function getOnline($intervals = '100') {
				$time             = time();
				$params['from']   = 'ossn_users';
				$params['wheres'] = array(
						"last_activity > {$time} - {$intervals}"
				);
				$data             = $this->select($params, true);
				if($data) {
						foreach($data as $user) {
								$result[] = arrayObject((array) $user, get_class($this));
						}
						return $result;
				}
				return false;
		}
		
		/**
		 * Search users using a keyword or entities_pairs
		 *
		 * @param array $params A valid options in format:
		 * 	  'keyword' 		=> A keyword to search users
		 *    'entities_pairs'  => A entities pairs options, must be array
		 *    'limit'			=> Result limit default, Default is 10 values
		 *    'count'			=> True if you wanted to count search items.
		 *	  'order_by'    	=> To show result in sepcific order. Default is Assending
		 * 
		 * reutrn array|false;
		 *
		 */
		public function searchUsers(array $params = array()) {
				if(empty($params)) {
						return false;
				}
				//prepare default attributes
				$default = array(
						'keyword' => false,
						'order_by' => false,
						'offset' => input('offset', '', 1),
						'page_limit' => ossn_call_hook('pagination', 'page_limit', false, 10), //call hook for page limit
						'count' => false,
						'entities_pairs' => false
				);
				
				$options      = array_merge($default, $params);
				$wheres       = array();
				$params       = array();
				$wheres_paris = array();
				//validate offset values
				if($options['limit'] !== false && $options['limit'] != 0 && $options['page_limit'] != 0) {
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
				if(!empty($options['keyword'])) {
						$wheres[] = "(CONCAT(u.first_name, ' ', u.last_name) LIKE '%{$options['keyword']}%' OR
									  u.username LIKE '%{$options['keyword']}%' OR
									  u.email LIKE '%{$options['keyword']}%')";
				}
				if(isset($options['entities_pairs']) && is_array($options['entities_pairs'])) {
						foreach($options['entities_pairs'] as $key => $pair) {
								$operand = (empty($pair['operand'])) ? '=' : $pair['operand'];
								if(!empty($pair['name']) && isset($pair['value']) && !empty($operand)) {
										if(!empty($pair['value'])) {
												$pair['value'] = addslashes($pair['value']);
										}
										$wheres_paris[] = "e{$key}.type='user'";
										$wheres_paris[] = "e{$key}.subtype='{$pair['name']}'";
										if(isset($pair['wheres']) && !empty($pair['wheres'])) {
												$pair['wheres'] = str_replace('[this].', "emd{$key}.", $pair['wheres']);
												$wheres_paris[] = $pair['wheres'];
										} else {
												$wheres_paris[] = "emd{$key}.value {$operand} '{$pair['value']}'";
												
										}
										$params['joins'][] = "JOIN ossn_entities as e{$key} ON e{$key}.owner_guid=u.guid";
										$params['joins'][] = "JOIN ossn_entities_metadata as emd{$key} ON e{$key}.guid=emd{$key}.guid";
								}
						}
						if(!empty($wheres_paris)) {
								$wheres_entities = '(' . $this->constructWheres($wheres_paris) . ')';
								$wheres[]        = $wheres_entities;
						}
				}
				$wheres[] = "u.time_created IS NOT NULL";
				if(isset($options['wheres']) && !empty($options['wheres'])) {
						if(!is_array($options['wheres'])) {
								$wheres[] = $options['wheres'];
						} else {
								foreach($options['wheres'] as $witem) {
										$wheres[] = $witem;
								}
						}
				}
				if(isset($options['joins']) && !empty($options['joins']) && is_array($options['joins'])) {
						foreach($options['joins'] as $jitem) {
								$params['joins'][] = $jitem;
						}
				}
				$distinct = '';
				if($options['distinct'] === true) {
						$distinct = "DISTINCT ";
				}
				$params['from']     = 'ossn_users as u';
				$params['params']   = array(
						"{$distinct} u.guid",
						'u.*'
				);
				$params['order_by'] = $options['order_by'];
				$params['limit']    = $options['limit'];
				
				if(!$options['order_by']) {
						$params['order_by'] = "u.guid ASC";
				}
				if(isset($options['group_by']) && !empty($options['group_by'])) {
						$params['group_by'] = $options['group_by'];
				}
				//override params
				if(isset($options['params']) && !empty($options['params'])) {
						$params['params'] = $options['params'];
				}
				$params['wheres'] = array(
						$this->constructWheres($wheres)
				);
				if($options['count'] === true) {
						unset($params['params']);
						unset($params['limit']);
						$count           = array();
						$count['params'] = array(
								"count({$distinct}u.guid) as total"
						);
						$count           = array_merge($params, $count);
						return $this->select($count)->total;
				}
				$users = $this->select($params, true);
				if($users) {
						foreach($users as $user) {
								$result[] = ossn_user_by_guid($user->guid);
						}
						return $result;
				}
				return false;
		}
		
		/**
		 * Validate User Registration
		 *
		 * @return boolean
		 */
		public function ValidateRegistration($code) {
				$user_activation = $this->getUser();
				$guid            = $user_activation->guid;
				if($user_activation->activation == $code) {
						$params['table']  = 'ossn_users';
						$params['names']  = array(
								'activation'
						);
						$params['values'] = array(
								''
						);
						$params['wheres'] = array(
								"guid='{$guid}'"
						);
						if($this->update($params)) {
								return true;
						}
				}
				return false;
		}
		
		/**
		 * View user icon url
		 *
		 * @return string
		 */
		public function iconURL() {
				$this->iconURLS = new stdClass;
				//[E] Default profile picture #1647
				if(!isset($this->icon_guid) || isset($this->icon_guid) && empty($this->icon_guid)){
						$this->icon_guid = false;
				}
				foreach(ossn_user_image_sizes() as $size => $dimensions){
						$seo                   = md5($this->username . $size . $this->icon_time . $this->icon_guid);
						$url                   = ossn_site_url("avatar/{$this->username}/{$size}/{$seo}.jpeg");
						$this->iconURLS->$size = $url;
				}
				return ossn_call_hook('user', 'icon:urls', $this, $this->iconURLS);
		}
		
		/**
		 * View user profile url
		 *
		 * @return string
		 */
		public function profileURL($extends = '') {
				$this->profileurl = ossn_site_url("u/{$this->username}") . $extends;
				return ossn_call_hook('user', 'profile:url', $this, $this->profileurl);
		}
		
		/**
		 * Send user reset password link
		 *
		 * @return boolean
		 */
		public function SendResetLogin() {
				self::initAttributes();
				$this->old_code   = $this->getParam('login:reset:code');
				$this->type       = 'user';
				$this->subtype    = 'login:reset:code';
				$this->owner_guid = $this->guid;
				
				$site_secret = ossn_site_settings('site_key');
				$code        = hash('sha256', time() . $this->guid . $site_secret . rand());
				if(!isset($this->{'login:reset:code'}) && empty($this->old_code)){
						$this->value = $code;
						$this->add();
				} else {
						$this->value                      = $code;
						$this->data->{'login:reset:code'} = $this->value;
						$this->save();
				}
				$emailreset_url = ossn_site_url("resetlogin?user={$this->username}&c={$this->value}");
				$emailreset_url = ossn_call_hook('user', 'reset:login:url', $this, $emailreset_url);
				$sitename       = ossn_site_settings('site_name');
				
				$emailmessage = ossn_print('ossn:reset:password:body', array(
						$this->first_name,
						$emailreset_url,
						$sitename
				));
				$emailsubject = ossn_print('ossn:reset:password:subject');
				if(!empty($this->value) && $this->notify->NotifiyUser($this->email, $emailsubject, $emailmessage)) {
						return true;
				}
				return false;
		}
		
		/**
		 * Reset user password
		 *
		 * @return boolean
		 */
		public function resetPassword($password) {
				if(!empty($password)) {
						$this->salt      = $this->generateSalt();
						$password        = $this->generate_password($password, $this->salt);
						$reset['table']  = 'ossn_users';
						$reset['names']  = array(
								'password',
								'salt'
						);
						$reset['values'] = array(
								$password,
								$this->salt
						);
						$reset['wheres'] = array(
								"guid='{$this->guid}'"
						);
						if($this->update($reset)) {
								return true;
						}
				}
				return false;
		}
		
		/**
		 * Remove user reset code
		 *
		 * @return boolean
		 */
		public function deleteResetCode() {
				$this->type       = 'user';
				$this->subtype    = 'login:reset:code';
				$this->owner_guid = $this->guid;
				$code             = $this->get_entities();
				if($this->deleteEntity($code[0]->guid)) {
						return true;
				}
				return false;
		}
		
		/**
		 * Check if user is online or not
		 *
		 * @return boolean
		 */
		public function isOnline($intervals = 100) {
				if(isset($this->last_activity)) {
						$time = time();
						if($this->last_activity > $time - $intervals) {
								return true;
						}
				}
				return false;
		}
		
		/**
		 * Delete user from syste,
		 *
		 * @return boolean
		 */
		public function deleteUser() {
				self::initAttributes();
				if(!empty($this->guid) && !empty($this->username)) {
						$params['from']   = 'ossn_users';
						$params['wheres'] = array(
								"guid='{$this->guid}'"
						);
						if($this->delete($params)) {
								//delete user files
								$datadir = ossn_get_userdata("user/{$this->guid}/");
								
								if(is_dir($datadir)) {
										OssnFile::DeleteDir($datadir);
										//From of v2.0 DeleteDir delete directory also #138
										//rmdir($datadir);
								}
								//delete user entites also
								$this->deleteByOwnerGuid($this->guid, 'user');
								
								//delete annotations
								$this->OssnAnnotation->owner_guid = $this->guid;
								$this->OssnAnnotation->deleteAnnotationByOwner($this->guid);
								//trigger callback so other components can be notified when user deleted.
								
								//should delete relationships
								ossn_delete_user_relations($this);
								
								$vars['entity'] = $this;
								ossn_trigger_callback('user', 'delete', $vars);
								return true;
						}
				}
				return false;
		}
		/**
		 * Check if user is validated or not
		 * 
		 * @return boolean
		 */
		public function isUserVALIDATED() {
				if(isset($this->activation) && empty($this->activation)) {
						return true;
				}
				return false;
		}
		/**
		 * Resend validation email to user
		 *
		 * @return boolean
		 */
		public function resendValidationEmail() {
				self::initAttributes();
				if(!$this->isUserVALIDATED()) {
						$link       = ossn_site_url("uservalidate/activate/{$this->guid}/{$this->activation}");
						$link       = ossn_call_hook('user', 'validation:email:url', $this, $link);
						$sitename   = ossn_site_settings('site_name');
						$activation = ossn_print('ossn:add:user:mail:body', array(
								$sitename,
								$link,
								ossn_site_url()
						));
						$subject    = ossn_print('ossn:add:user:mail:subject', array(
								$this->first_name,
								$sitename
						));
						return $this->notify->NotifiyUser($this->email, $subject, $activation);
				}
				return false;
		}
		/**
		 * Get list of unvalidated users
		 *
		 * @return false|object
		 */
		public function getUnvalidatedUSERS($search = '', $count = false) {
				if($count) {
						$params['count'] = true;
				}
				if(empty($search)) {
						$params['wheres'] = array(
								"activation <> ''"
						);
				} else {
						$params['wheres'] = array(
								"activation <> ''",
								"CONCAT(first_name, ' ', last_name) LIKE '%$search%' AND activation <> '' OR
					 		 username LIKE '%$search%' AND activation <> '' OR email LIKE '%$search%' AND activation <> ''"
						);
				}
				$users = $this->searchUsers($params);
				if($users) {
						return $users;
				}
				return false;
		}
		/**
		 * Get a user last profile photo
		 *
		 * @return object|false
		 */
		public function getProfilePhoto() {
				//[E] Default profile picture #1647
				if(!empty($this->guid) && isset($this->icon_guid)){
					  	return ossn_get_file($this->icon_guid);
				}
				//fallback to old picture selection solution
				if(!empty($this->guid) && !isset($this->icon_guid)) {
						$this->owner_guid = $this->guid;
						$this->type       = 'user';
						$this->subtype    = 'file:profile:photo';
						$this->limit      = 1;
						$this->order_by   = "guid DESC";
						$entity           = $this->get_entities();
						if(isset($entity[0])){
								//save the icon_guid and move to new procedure #1647
								$user			= ossn_user_by_guid($this->guid);
								$user->data->icon_guid  = $entity[0]->guid;
								$user->save();
								
								return $entity[0];
						}
				}
				return false;
		}
		/**
		 * Get a user last coverphoto photo
		 *
		 * @return object|false
		 */
		public function getProfileCover() {
				//[E] Default cover picture #1647
				if(!empty($this->guid) && isset($this->cover_guid)){
					  	return ossn_get_file($this->cover_guid);
				}			
				if(!empty($this->guid)) {
						$this->owner_guid = $this->guid;
						$this->type       = 'user';
						$this->subtype    = 'file:profile:cover';
						$this->limit      = 1;
						$this->order_by   = "guid DESC";
						$entity           = $this->get_entities();
						if(isset($entity[0])) {
								//save the cover_guid and move to new procedure #1647
								$user			 = ossn_user_by_guid($this->guid);
								$user->data->cover_guid  = $entity[0]->guid;
								$user->save();
								
								return $entity[0];
						}
				}
				return false;
		}
		/**
		 * User logout
		 *
		 * @return void
		 */
		public static function Logout() {
				unset($_SESSION['OSSN_USER']);
				@session_destroy();
				$_SESSION['OSSN_USER'] = false;
		}
		/**
		 * Get total users per month for each year
		 *
		 * @return object|false
		 * @access public
		 */
		public function countByYearMonth() {
				$wheres = array();
				$params = array();
				
				$wheres[] = "time_created > 0";
				
				$params['from']     = "ossn_users";
				$params['params']   = array(
						"DATE_FORMAT(FROM_UNIXTIME(time_created), '%Y') AS year",
						"DATE_FORMAT(FROM_UNIXTIME(time_created) , '%m') AS month",
						"DATE_FORMAT(FROM_UNIXTIME(time_created),'%Y%m') AS YM",
						"COUNT(guid) AS total"
				);
				$params['group_by'] = "YEAR, MONTH, YM";
				$params["wheres"]   = array(
						$this->constructWheres($wheres)
				);
				$data               = $this->select($params, true);
				if($data) {
						return $data;
				}
				return false;
		}
		/**
		 * List existing Genders
		 *
		 * @return array
		 * @access public
		 */
		public function getGenders() {
				$params             = array();
				$params['params']   = array(
						"emd.value as gender"
				);
				$params['from']     = "ossn_entities as e";
				$params['joins']    = array(
						"JOIN ossn_entities_metadata AS emd ON e.guid = emd.guid"
				);
				$params["wheres"]   = array(
						"e.type = 'user' AND e.subtype = 'gender'"
				);
				$params['group_by'] = 'gender';
				$genders            = $this->select($params, true);
				$lists              = array();
				if($genders) {
						foreach($genders as $list) {
								$lists[] = $list->gender;
						}
				}
				return $lists;
		}
		/**
		 * Gender types
		 *
		 * @return object|false
		 * @access public
		 */
		public function genderTypes() {
				$gender = $this->getGenders();
				return ossn_call_hook('user', 'gender:types', $this, $gender);
		}
		/**
		 * Get total users per month for each year
		 *
		 * @return object|false
		 * @access public
		 */
		public function countByGender($gender = 'male') {
				if(empty($gender)) {
						return false;
				}
				$data = $this->searchUsers(array(
						'count' => true,
						'entities_pairs' => array(
								array(
										'name' => 'gender',
										'value' => $gender
								)
						)
				));
				if($data) {
						return $data;
				}
				return false;
		}
		/**
		 * Get online users by gender
		 *
		 * @param string $gender Gender type
		 * @param boolean $count true or false
		 * @param integer $intervals Seconds
		 *
		 * @return object|false
		 * @access public
		 */
		public function onlineByGender($gender = 'male', $count = false, $intervals = 100) {
				if(empty($gender) || !in_array($gender, $this->genderTypes())) {
						return false;
				}
				$time             = time();
				$params           = array();
				$wheres['wheres'] = array();
				$params['joins']  = array();
				
				$params['params'] = array(
						'u.*, emd.value as gender'
				);
				$params['from']   = 'ossn_users as u';
				
				$wheres['wheres'][] = "e.type='user'";
				$wheres['wheres'][] = "e.subtype='gender'";
				$wheres['wheres'][] = "emd.value='{$gender}'";
				$wheres['wheres'][] = "u.last_activity > {$time} - {$intervals}";
				
				$params['joins'][] = "JOIN ossn_entities as e ON e.owner_guid=u.guid";
				$params['joins'][] = "JOIN ossn_entities_metadata as emd ON emd.guid=e.guid";
				$params['wheres']  = array(
						$this->constructWheres($wheres['wheres'])
				);
				
				if($count) {
						$params['params'] = array(
								"count(*) as total"
						);
						$count            = $this->select($params);
						return $count->total;
				}
				
				$users = $this->select($params, true);
				if($users) {
						foreach($users as $user) {
								$result[] = arrayObject($user, get_class($this));
						}
						return $result;
				}
				return false;
		}
		/**
		 * Save a user entity
		 *
		 * @return boolean
		 */
		public function save() {
				
				if(!isset($this->guid) || empty($this->guid)) {
						return false;
				}
				$this->owner_guid = $this->guid;
				$this->type       = 'user';
				if(parent::save()) {
						//check if owner is loggedin user guid , if so update session
						if(ossn_loggedin_user()->guid == $this->guid) {
								$_SESSION['OSSN_USER'] = ossn_user_by_guid($this->guid);
						}
						return true;
				}
				return false;
		}
		/**
		 * Can Moderate
		 * Check if user can moderate the requested item or not
		 *
		 * @return boolean
		 */
		public function canModerate() {
				$allowed = false;
				if(isset($this->guid) && $this instanceof OssnUser) {
						if(($this->type == 'normal' && $this->can_moderate == 'yes') || $this->type == 'admin') {
								$allowed = true;
						}
				}
				return ossn_call_hook('user', 'can:moderate', $this, $allowed);
		}
		/**
		 * isAdmin
		 * Check if user is admin or not
		 *
		 * @return boolean
		 */
		public function isAdmin() {
				if(isset($this->guid) && $this->type == 'admin') {
						return true;
				}
				return false;
		}
		/**
		 * login the user based on given input (by username, email, guid)
		 *
		 * @param  int|string $user A username, email, guid
		 *
		 * @return boolean
		 */
		public static function setLogin($userid) {
				if(!empty($userid)) {
						$user = false;
						if(is_int($userid)) {
								$user = ossn_user_by_guid($userid);
						}
						if(filter_var($userid, FILTER_VALIDATE_EMAIL)) {
								$user = ossn_user_by_email($userid);
						}
						if(is_string($userid)) {
								$user = ossn_user_by_username($userid);
						}
						if($user) {
								OssnSession::assign('OSSN_USER', $user);
								return true;
						}
				}
				return false;
		}
} //CLASS
