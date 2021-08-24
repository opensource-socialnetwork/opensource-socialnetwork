<?php
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
class OssnWall extends OssnObject {
		/**
		 * Post on wall
		 *
		 * @params $post: Post text
		 *         $friends: Friend guids
		 *         $location: Post location
		 *         $access: (OSSN_PUBLIC, OSSN_PRIVATE, OSSN_FRIENDS)
		 * @param string $post
		 *
		 * @return bool;
		 */
		public function Post($post, $friends = '', $location = '', $access = ''){
				self::initAttributes();
				if(empty($access)){
						$access = OSSN_PUBLIC;
				}
				$canpost = false;
				if(strlen($post)){
						$canpost = true;
				}
				if(!empty($_FILES['ossn_photo']['tmp_name'])){
						$canpost = true;
				}
				if(empty($this->owner_guid) || empty($this->poster_guid) || $canpost === false){
						return false;
				}
				if(isset($this->item_type) && !empty($this->item_type)){
						$this->data->item_type = $this->item_type;
				} else {
						$this->data->item_type = false;
				}
				if(isset($this->item_guid) && !empty($this->item_guid)){
						$this->data->item_guid = $this->item_guid;
				} else {
						$this->data->item_guid = false;
				}
				$this->data->poster_guid  = $this->poster_guid;
				$this->data->access       = $access;
				$this->data->time_updated = 0;
				$this->subtype            = 'wall';
				$this->title              = '';

				$post             = preg_replace('/\t/', ' ', $post);
				$wallpost['post'] = htmlspecialchars($post, ENT_QUOTES, 'UTF-8');

				//wall tag a friend , GUID issue #566
				if(!empty($friends)){
						$friend_guids = explode(',', $friends);
						//reset friends guids
						$friends = array();
						foreach ($friend_guids as $guid){
								if(ossn_user_by_guid($guid)){
										$friends[] = $guid;
								}
						}
						$wallpost['friend'] = implode(',', $friends);
				}
				if(!empty($location)){
						$wallpost['location'] = $location;
				}
				//Encode multibyte Unicode characters literally (default is to escape as \uXXXX)
				$this->description = json_encode($wallpost, JSON_UNESCAPED_UNICODE);
				if($this->addObject()){
						$this->wallguid = $this->getObjectId();
						if(isset($_FILES['ossn_photo'])){
								$this->OssnFile->owner_guid = $this->wallguid;
								$this->OssnFile->type       = 'object';
								$this->OssnFile->subtype    = 'wallphoto';
								$this->OssnFile->setFile('ossn_photo');
								$this->OssnFile->setPath('ossnwall/images/');
								$this->OssnFile->setExtension(array(
										'jpg',
										'png',
										'jpeg',
										'jfif',
										'gif',
								));
								$this->OssnFile->addFile();
						}
						$params['object_guid'] = $this->wallguid;
						$params['guid']        = $this->wallguid; //object_guid should be removed
						$params['type']        = $this->type;
						$params['poster_guid'] = $this->poster_guid;
						if(isset($wallpost['location'])){
								$params['location'] = $wallpost['location'];
						}

						if(isset($wallpost['friend'])){
								$params['friends'] = explode(',', $wallpost['friend']);
						}
						ossn_trigger_callback('wall', 'post:created', $params);
						return $this->wallguid;
				}
				return true;
		}

		/**
		 * Initialize the objects.
		 *
		 * @return void;
		 */
		public function initAttributes(){
				if(empty($this->type)){
						$this->type = 'user';
				}
				$this->OssnFile = new OssnFile();
				if(!isset($this->data)){
						$this->data = new stdClass();
				}
				$this->OssnDatabase = new OssnDatabase();
		}

		/**
		 * Get posts by owner
		 *
		 * @params $owner: Owner guid
		 *         $type Owner type
		 *
		 * @return object;
		 */
		public function GetPostByOwner($owner, $type = 'user', $count = false){
				self::initAttributes();
				if(empty($owner) || empty($type)){
						return false;
				}
				$vars = array(
						'type'       => $type,
						'subtype'    => 'wall',
						'order_by'   => 'o.guid DESC',
						'owner_guid' => $owner,
						'count'      => $count,
				);
				$extra_param = array(
						'owner' => $owner,
						'type'  => $type,
						'count' => $count,
				);
				$attrs = ossn_call_hook('wall', 'GetPostByOwner', $extra_param, $vars);
				return $this->searchObject($attrs);
		}

		/**
		 * Get user posts
		 *
		 * @params $user: User guid
		 *
		 * @return object;
		 */
		public function GetUserPosts($user, $params = array()){
				if(isset($user->guid) && !empty($user->guid)){
						$friends = $user->getFriends();
						//operator not supported for strings #999
						$friend_guids = array();
						if($friends){
								foreach ($friends as $friend){
										$friend_guids[] = $friend->guid;
								}
						}
						// add all users posts;
						// (if user has 0 friends, show at least his own postings if wall access type = friends only)
						//this will show a friends posts who posted on user wall.
						$friend_guids[] = $user->guid;
						$friend_guids   = implode(',', $friend_guids);

						$default = array(
								'type'       => 'user',
								'subtype'    => 'wall',
								'owner_guid' => $user->guid,
								'order_by'   => 'o.guid DESC',
						);
						$default['entities_pairs'][] = array(
								'name'   => 'access',
								'value'  => true,
								'wheres' => '(1=1)',
						);
						if(ossn_isLoggedin() && !ossn_user_is_friend(ossn_loggedin_user()->guid, $user->guid) && ossn_loggedin_user()->guid != $user->guid && !ossn_isAdminLoggedin()){
								$default['wheres'][] = '(emd0.value=2)';
						}
						$extra_param = array(
								'friends_guids' => $friend_guids,
								'user'          => $user,
						);
						$options = array_merge($default, $params);
						$attrs   = ossn_call_hook('wall', 'GetUserPosts', $extra_param, $options);
						return $this->searchObject($attrs);
				}
				return false;
		}

		/**
		 * Get post by guid
		 *
		 * @params $guid: Post guid
		 *
		 * @return object;
		 */
		public function GetPost($guid){
				$this->object_guid = $guid;
				return $this->getObjectById();
		}

		/**
		 * Delete post
		 *
		 * @params $post: Post guid
		 *
		 * @return bool;
		 */
		public function deletePost($post){
				if(empty($post)){
						return false;
				}
				ossn_trigger_callback('post', 'before:delete', $post);
				if($this->deleteObject($post)){
						ossn_trigger_callback('post', 'delete', $post);
						return true;
				}
				return false;
		}

		/**
		 * Delete All Posts
		 *
		 * @return void;
		 */
		public function deleteAllPosts(){
				$posts = $this->GetPosts(array(
						'page_limit' => false,
				));
				if(!$posts){
						return false;
				}
				foreach ($posts as $post){
						$this->deleteObject($post->guid);
						ossn_trigger_callback('post', 'delete', $post->guid);
				}
		}

		/**
		 * Get all site wall posts
		 *
		 * @return object;
		 */
		public function GetPosts(array $params = array()){
				$default = array(
						'subtype'  => 'wall',
						'order_by' => 'o.guid DESC',
				);
				$options = array_merge($default, $params);
				return $this->searchObject($options);
		}
		/**
		 * Get user group posts guids
		 *
		 * @param integer $userguid Guid of user
		 *
		 * @return array;
		 */
		public static function getUserGroupPostsGuids($userguid){
				if(empty($userguid)){
						return false;
				}
				$statement = "SELECT * FROM ossn_entities, ossn_entities_metadata WHERE(
				  ossn_entities_metadata.guid = ossn_entities.guid
				  AND  ossn_entities.subtype='poster_guid'
				  AND type = 'object'
				  AND value = '{$userguid}'
				  );";
				$database = new OssnDatabase();
				$database->statement($statement);
				$database->execute();
				$objects = $database->fetch(true);
				if($objects){
						foreach ($objects as $object){
								$guids[] = $object->owner_guid;
						}
						asort($guids);
						return $guids;
				}
				return false;
		}
		/**
		 * Get user wall postings for wall mode set to Friends-Only
		 *
		 * @param
		 *
		 * @return array;
		 */
		public function getFriendsPosts($params = array()){
				$user = ossn_loggedin_user();
				if(isset($user->guid) && !empty($user->guid)){
						$friends = $user->getFriends();
						//operator not supported for strings #999
						$friend_guids = array();
						if($friends){
								foreach ($friends as $friend){
										$friend_guids[] = $friend->guid;
								}
						}
						// add all users posts;
						// (if user has 0 friends, show at least his own postings if wall access type = friends only)
						$friend_guids[] = $user->guid;

						//add visibility of admin postings to friends-only wall? #1294
						$admins = ossn_get_admin_users();
						if($admins){
								foreach ($admins as $item){
										if(!in_array($item->guid, $friend_guids)){
												$friend_guids[] = $item->guid;
										}
								}
						}
						$friend_guids = implode(',', $friend_guids);

						$default = array(
								'type'           => 'user',
								'subtype'        => 'wall',
								'order_by'       => 'o.guid DESC',
								'entities_pairs' => array(
										array(
												'name'   => 'access',
												'value'  => true,
												'wheres' => '(1=1)',
										),
										array(
												'name'   => 'poster_guid',
												'value'  => true,
												'wheres' => "((emd0.value=2 OR emd0.value=3) AND [this].value IN({$friend_guids}))",
										),
								),
						);

						$extra_param = array(
								'friends_guids' => $friend_guids,
								'user'          => $user,
						);
						$options = array_merge($default, $params);
						$attrs   = ossn_call_hook('wall', 'getFriendsPosts', $extra_param, $options);
						return $this->searchObject($attrs);
				}
				return false;
		}

		/**
		 * Get user wall postings for wall mode set to All-Site-Posts
		 *
		 * @param
		 *
		 * @return array;
		 */
		public function getPublicPosts($params = array()){
				$user = ossn_loggedin_user();
				if(isset($user->guid) && !empty($user->guid)){
						$friends = $user->getFriends();
						//operator not supported for strings #999
						$friend_guids = array();
						if($friends){
								foreach ($friends as $friend){
										$friend_guids[] = $friend->guid;
								}
						}
						// add all users posts;
						// (if user has 0 friends, show at least his own postings if wall access type = friends only)
						$friend_guids[] = $user->guid;
						$friend_guids   = implode(',', $friend_guids);

						$default = array(
								'type'           => 'user',
								'subtype'        => 'wall',
								'order_by'       => 'o.guid DESC',
								'entities_pairs' => array(
										array(
												'name'   => 'access',
												'value'  => true,
												'wheres' => '(1=1)',
										),
										array(
												'name'   => 'poster_guid',
												'value'  => true,
												'wheres' => "((emd0.value=2) OR (emd0.value=3 AND [this].value IN({$friend_guids})))",
										),
								),
						);
						$extra_param = array(
								'friends_guids' => $friend_guids,
								'user'          => $user,
						);
						$options = array_merge($default, $params);
						$attrs   = ossn_call_hook('wall', 'getPublicPosts', $extra_param, $options);
						return $this->searchObject($attrs);
				}
				return false;
		}

		/**
		 * Get all user wall posts for admins
		 *
		 * @param
		 *
		 * @return array;
		 */
		public function getAllPosts($params = array()){
				$user = ossn_loggedin_user();
				if(isset($user->guid) && !empty($user->guid)){
						$friends = $user->getFriends();
						//operator not supported for strings #999
						$friend_guids = array();
						if($friends){
								foreach ($friends as $friend){
										$friend_guids[] = $friend->guid;
								}
						}
						// add all users posts;
						// (if user has 0 friends, show at least his own postings if wall access type = friends only)
						$friend_guids[] = $user->guid;
						$friend_guids   = implode(',', $friend_guids);

						$default = array(
								'type'           => 'user',
								'subtype'        => 'wall',
								'order_by'       => 'o.guid DESC',
								'entities_pairs' => array(
										array(
												'name'   => 'access',
												'value'  => true,
												'wheres' => '(1=1)',
										),
										array(
												'name'   => 'poster_guid',
												'value'  => true,
												'wheres' => '(emd0.value=2 OR emd0.value=3)',
										),
								),
						);
						$extra_param = array(
								'friends_guids' => $friend_guids,
								'user'          => $user,
						);
						$options = array_merge($default, $params);
						$attrs   = ossn_call_hook('wall', 'getAllPosts', $extra_param, $options);
						return $this->searchObject($attrs);
				}
				return false;
		}
		/**
		 * Get Posts of user
		 *
		 * @param integer $guid A user id
		 *
		 * @return array;
		 */
		public function getPosterPosts($guid = ''){
				if(isset($guid) && !empty($guid)){
						//Deleting user didn't delete users wall posts if wall poster_guid is not same user as deleted #1505
						//added page_limit => false
						$default = array(
								'subtype'        => 'wall',
								'order_by'       => 'o.guid DESC',
								'page_limit'     => false,
								'entities_pairs' => array(
										array(
												'name'  => 'poster_guid',
												'value' => $guid,
										),
								),
						);
						return $this->searchObject($default);
				}
				return false;
		}
} //class
