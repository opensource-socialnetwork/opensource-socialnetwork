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
class OssnUser extends OssnEntities {
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
						$this->salt            = $this->generateSalt();
						$password              = $this->generate_password($this->password, $this->salt);
						$activation            = md5($this->password . time() . rand());
						$this->sendactiviation = ossn_call_hook('user', 'send:activation', false, $this->sendactiviation);
						if($this->sendactiviation === false) {
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
								time()
						);
						if($this->insert($params)) {
								$guid = $this->getLastEntry();
								
								//define user extra profile fields
								$fields = array(
										'text' => array(
												'birthdate'
										),
										'radio' => array(
												'gender'
										)
								);
								if(!empty($guid) && is_int($guid)) {
										
										$this->owner_guid = $guid;
										$this->type       = 'user';
										
										//add user entities 
										$extra_fields = ossn_call_hook('user', 'signup:fields', $this, $fields);
										if(!empty($extra_fields)) {
												foreach($extra_fields as $type) {
														foreach($type as $field) {
																if(isset($this->$field)) {
																		$this->subtype = $field;
																		$this->value   = $this->$field;
																		//add entity
																		$this->add();
																}
														}
												}
										}
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
								return true;
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
				if(!empty($user->guid) && $this->username == $user->username) {
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
				if(!empty($user->guid) && $this->email == $user->email) {
						return true;
				}
				return false;
		}
		
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
		}
		
		/**
		 * Get user with its entities.
		 *
		 * @return object
		 */
		public function getUser() {
				if(!empty($this->email)) {
						$params['from']   = 'ossn_users';
						$params['wheres'] = array(
								"email='{$this->email}'"
						);
						$user             = $this->select($params);
				}
				if(empty($user) && !empty($this->username)) {
						$params['from']   = 'ossn_users';
						$params['wheres'] = array(
								"username='{$this->username}'"
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
						$metadata = arrayObject($user, get_class($this));
						return ossn_call_hook('user', 'get', false, $metadata);
				}
				foreach($entities as $entity) {
						$fields[$entity->subtype] = $entity->value;
				}
				$data     = array_merge(get_object_vars($user), $fields);
				$metadata = arrayObject($data, get_class($this));
				return ossn_call_hook('user', 'get', false, $metadata);
		}
		
		/**
		 * Check if password is > 5 or not.
		 *
		 * @return boolean
		 */
		public function isPassword() {
				if(strlen($this->password) > 5) {
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
		 * Generate password.
		 *
		 * @return string
		 */
		public function generate_password($password = '', $salt = '') {
				return md5($password . $salt);
		}
		
		/**
		 * Login into site.
		 *
		 * @return boolean
		 */
		public function Login() {
				$user     = $this->getUser();
				$salt     = $user->salt;
				$password = $this->generate_password($this->password . $salt);
				if($password == $user->password && $user->activation == NULL) {
						unset($user->password);
						unset($user->salt);
						$_SESSION['OSSN_USER'] = $user;
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
				$this->statement("SELECT * FROM ossn_relationships WHERE(
					     relation_from='{$usera}' AND
					     relation_to='{$user2}' AND
					     type='friend:request'
					     );");
				$this->execute();
				$from = $this->fetch();
				$this->statement("SELECT * FROM ossn_relationships WHERE(
					     relation_from='{$user2}' AND
					     relation_to='{$usera}' AND
				 	     type='friend:request'
					     );");
				$this->execute();
				$to = $this->fetch();
				if(isset($from->relation_id) && isset($to->relation_id)) {
						return true;
				}
				return false;
		}
		
		/**
		 * Get user friends.
		 *
		 * @return object
		 */
		public function getFriends($user = '') {
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
						if($this->isFriend($user, $fr->relation_from)) {
								$uss[] = ossn_user_by_guid($fr->relation_from);
						}
				}
				if(isset($uss)) {
						return $uss;
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
		 * @return boolean
		 */
		public function requestExists($from, $user) {
				if(isset($this->guid)) {
						$user = $this->guid;
				}
				$this->statement("SELECT * FROM ossn_relationships WHERE(
					     relation_to='{$user}' AND
						 relation_from='{$from}' AND
					     type='friend:request'
					     );");
				$this->execute();
				$request = $this->fetch();
				if(!empty($request->relation_id)) {
						return true;
				}
				return false;
		}
		
		/**
		 * Delete friend from list
		 *
		 * @return boolean
		 */
		public function deleteFriend($from, $to) {
				$this->statement("DELETE FROM ossn_relationships WHERE(
						 relation_from='{$from}' AND relation_to='{$to}' OR
						 relation_from='{$to}' AND relation_to='{$from}')");
				if($this->execute()) {
						return true;
				}
				return false;
		}
		
		/**
		 * Get site users.
		 *
		 * @return object
		 */
		public function getSiteUsers($params = array()) {
				$vars         = array();
				$vars['from'] = 'ossn_users';
				
				$args  = array_merge($vars, $params);
				$users = $this->select($args, true);
				return $users;
				
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
								$result[] = arrayObject((array)$user, get_class($this));
						}
						return $result;
				}
				return false;
		}
		
		/**
		 * Search site users with its entities
		 *
		 * @return boolean
		 */
		public function searchUsers($q, $limit = '') {
				$search = $this->SearchSiteUsers($q, $limit);
				if(!$search) {
						return false;
				}
				$users = new OssnUser;
				foreach($search as $user) {
						$users->guid  = $user->guid;
						$userentity[] = $users->getUser();
				}
				$data = $userentity;
				return $data;
		}
		
		/**
		 * Search users without entities.
		 *
		 * @return object
		 */
		public function SearchSiteUsers($search, $limit = '') {
				//don't listup all users if search query is empty
				if(empty($search)) {
						return false;
				}
				$params = array();
				$wheres = array();
				if(!empty($search)) {
						$wheres[] = "CONCAT(first_name, ' ', last_name) LIKE '%$search%'";
						$wheres[] = "username LIKE '%$search%'";
						$wheres[] = "email LIKE '%$search%'";
				}
				if(!empty($limit)) {
						$params['limit'] = $limit;
				}
				$params['from']   = 'ossn_users';
				$params['wheres'] = array(
						$this->constructWheres($wheres, 'OR')
				);
				$users            = $this->select($params, true);
				if($users) {
						return $users;
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
				foreach(ossn_user_image_sizes() as $size => $dimensions) {
						$seo                   = md5($this->username . $size . $this->icon_time);
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
				if(!isset($this->{'login:reset:code'}) && empty($this->old_code)) {
						$this->value = md5(time() . $this->guid);
						$this->add();
				} else {
						$this->value                      = md5(time() . $this->guid);
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
				$params         = array();
				$params['from'] = 'ossn_users';
				if($count) {
						$params['params'] = array(
								"count(*) as total"
						);
				}
				if(empty($search)) {
						$params['wheres'] = array(
								"activation <> ''"
						);
				} else {
						$params['wheres'] = array(
								"activation <> '' AND",
								"CONCAT(first_name, ' ', last_name) LIKE '%$search%' AND activation <> '' OR
					 		 username LIKE '%$search%' AND activation <> '' OR email LIKE '%$search%' AND activation <> ''"
						);
				}
				$users = $this->select($params, true);
				if($users) {
						if($count) {
								return $users->{0}->total;
						}
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
				if(!empty($this->guid)) {
						$this->owner_guid = $this->guid;
						$this->type       = 'user';
						$this->subtype    = 'file:profile:photo';
						$this->limit      = 1;
						$this->order_by   = "guid DESC";
						$entity           = $this->get_entities();
						if(isset($entity[0])) {
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
				if(!empty($this->guid)) {
						$this->owner_guid = $this->guid;
						$this->type       = 'user';
						$this->subtype    = 'file:profile:cover';
						$this->limit      = 1;
						$this->order_by   = "guid DESC";
						$entity           = $this->get_entities();
						if(isset($entity[0])) {
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
				session_destroy();
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
						"COUNT(guid) AS total"
				);
				$params['group_by'] = "DATE_FORMAT(FROM_UNIXTIME(time_created) ,  '%Y%m')";
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
		 * Gender types
		 *
		 * @return object|false
		 * @access public
		 */
		public function genderTypes() {
				$gender = array(
						'male',
						'female'
				);
				return ossn_call_hook('user', 'gender:types', $this, $gender);
		}
		/**
		 * Get total users per month for each year
		 *
		 * @return object|false
		 * @access public
		 */
		public function countByGender($gender = 'male') {
				if(!in_array($gender, $this->genderTypes())) {
						return false;
				}
				$params                = array();
				$params['type']        = 'user';
				$params['subtype']     = 'gender';
				$params['page_limit']  = false;
				$params['search_type'] = false;
				$params['count']       = true;
				$params['value']       = $gender;
				
				$data = $this->searchEntities($params);
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
				$wheres['wheres'][] = "last_activity > {$time} - {$intervals}";
				
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
} //CLASS
