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
		public function Post($post, $friends = '', $location = '', $access = '') {
				self::initAttributes();
				if(empty($access)) {
						$access = OSSN_PUBLIC;
				}
				if($this->owner_guid < 1 || $this->poster_guid < 1 || empty($post)) {
						return false;
				}
				if(isset($this->item_type) && !empty($this->item_type)) {
						$this->data->item_type = $this->item_type;
				}
				if(isset($this->item_guid) && !empty($this->item_guid)) {
						$this->data->item_guid = $this->item_guid;
				}
				$this->data->poster_guid = $this->poster_guid;
				$this->data->access      = $access;
				$this->subtype           = 'wall';
				$this->title             = '';
				
				$post             = preg_replace('/\t/', ' ', $post);
				$wallpost['post'] = htmlspecialchars($post, ENT_QUOTES, 'UTF-8');
				
				//wall tag a friend , GUID issue #566
				if(!empty($friends)) {
						$friend_guids = explode(',', $friends);
						//reset friends guids
						$friends      = array();
						foreach($friend_guids as $guid) {
								if(ossn_user_by_guid($guid)) {
										$friends[] = $guid;
								}
						}
						$wallpost['friend'] = implode(',', $friends);
				}
				if(!empty($location)) {
						$wallpost['location'] = $location;
				}
				//Encode multibyte Unicode characters literally (default is to escape as \uXXXX)
				$this->description = json_encode($wallpost, JSON_UNESCAPED_UNICODE);
				if($this->addObject()) {
						$this->wallguid = $this->getObjectId();
						if(isset($_FILES['ossn_photo'])) {
								$this->OssnFile->owner_guid = $this->wallguid;
								$this->OssnFile->type       = 'object';
								$this->OssnFile->subtype    = 'wallphoto';
								$this->OssnFile->setFile('ossn_photo');
								$this->OssnFile->setPath('ossnwall/images/');
								$this->OssnFile->setExtension(array(
										'jpg',
										'png',
										'jpeg',
										'gif'
								));
								$this->OssnFile->addFile();
						}
						$params['subject_guid'] = $this->wallguid;
						$params['poster_guid']  = $this->poster_guid;
						if(isset($wallpost['friend'])) {
								$params['friends'] = explode(',', $wallpost['friend']);
						}
						ossn_trigger_callback('wall', 'post:created', $params);
						return true;
				}
				return true;
		}
		
		/**
		 * Initialize the objects.
		 *
		 * @return void;
		 */
		public function initAttributes() {
				if(empty($this->type)) {
						$this->type = 'user';
				}
				$this->OssnFile = new OssnFile;
				if(!isset($this->data)) {
						$this->data = new stdClass;
				}
				$this->OssnDatabase = new OssnDatabase;
		}
		
		/**
		 * Get posts by owner
		 *
		 * @params $owner: Owner guid
		 *         $type Owner type
		 *
		 * @return object;
		 */
		public function GetPostByOwner($owner, $type = 'user') {
				self::initAttributes();
				$this->type       = $type;
				$this->subtype    = 'wall';
				$this->owner_guid = $owner;
				$this->order_by   = 'o.guid DESC';
				return $this->getObjectByOwner();
		}
		
		/**
		 * Get user posts
		 *
		 * @params $user: User guid
		 *
		 * @return object;
		 */
		public function GetUserPosts($user) {
				$this->type       = "user";
				$this->subtype    = 'wall';
				$this->owner_guid = $user;
				$this->order_by   = 'o.guid DESC';
				return $this->getObjectByOwner();
		}
		
		/**
		 * Get post by guid
		 *
		 * @params $guid: Post guid
		 *
		 * @return object;
		 */
		public function GetPost($guid) {
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
		public function deletePost($post) {
				if($this->deleteObject($post)) {
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
		public function deleteAllPosts() {
				$posts = $this->GetPosts();
				if(!$posts) {
						return false;
				}
				foreach($posts as $post) {
						$this->deleteObject($post->guid);
						ossn_trigger_callback('post', 'delete', $post->guid);
				}
		}
		
		/**
		 * Get all site wall posts
		 *
		 * @return object;
		 */
		public function GetPosts(array $params = array()) {
				$default = array(
						'subtype' => 'wall',
						'order_by' => 'o.guid DESC'
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
		public static function getUserGroupPostsGuids($userguid) {
				if(empty($userguid)) {
						return false;
				}
				$statement = "SELECT * FROM ossn_entities, ossn_entities_metadata WHERE(
				  ossn_entities_metadata.guid = ossn_entities.guid 
				  AND  ossn_entities.subtype='poster_guid'
				  AND type = 'object'
				  AND value = '{$userguid}'
				  );";
				$database  = new OssnDatabase;
				$database->statement($statement);
				$database->execute();
				$objects = $database->fetch(true);
				if($objects) {
						foreach($objects as $object) {
								$guids[] = $object->owner_guid;
						}
						asort($guids);
						return $guids;
				}
				return false;
		}
		/**
		 * Get user group posts guids
		 *
		 * @param integer $userguid Guid of user
		 *
		 * @return array;
		 */
		public function getFriendsPosts($params = array()) {
				$user = ossn_loggedin_user();
				if(isset($user->guid) && !empty($user->guid)) {
						$friends      = $user->getFriends();
						$friend_guids = '';
						if($friends) {
								foreach($friends as $friend) {
										$friend_guids[] = $friend->guid;
								}
						}
						// add all users posts;
						// (if user has 0 friends, show at least his own postings if wall access type = friends only)
						$friend_guids[] = $user->guid;
						$friend_guids   = implode(',', $friend_guids);
						
						//prepare default attributes
						$default  = array(
								'limit' => false,
								'offset' => input('offset', '', 1),
								'page_limit' => ossn_call_hook('pagination', 'page_limit', false, 10), //call hook for page limit
								'count' => false
						);
						$options  = array_merge($default, $params);
						//get only required result, don't bust your server memory
						$getlimit = $this->generateLimit($options['limit'], $options['page_limit'], $options['offset']);
						if($getlimit) {
								$options['limit'] = $getlimit;
						}
						$wheres = array(
								"md.guid = e.guid",
								"e.subtype='poster_guid'",
								"e.type = 'object'",
								"md.value IN ({$friend_guids})",
								"o.guid = e.owner_guid"
						);
						$vars   = array();
						
						$vars['from']     = 'ossn_entities as e, ossn_entities_metadata as md, ossn_object as o';
						$vars['params']   = array(
								"o.*"
						);
						$vars['wheres']   = array(
								$this->constructWheres($wheres)
						);
						$vars['order_by'] = "o.guid DESC";
						$vars['limit']    = $options['limit'];
						
						//prepare count data;
						if($options['count'] === true) {
								unset($vars['params']);
								unset($vars['limit']);
								$count           = array();
								$count['params'] = array(
										"count(*) as total"
								);
								$count           = array_merge($vars, $count);
								return $this->select($count)->total;
						}
						$data = $this->select($vars, true);
						if($data) {
								return $data;
						}
						
				}
				return false;
		}
} //class
