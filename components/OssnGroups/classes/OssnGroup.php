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
class OssnGroup extends OssnObject {
		/**
		 * Initialize the object.
		 *
		 * @return void;
		 */
		public function initAttributes(){
				$this->OssnDatabase = new OssnDatabase();
				$this->OssnFile     = new OssnFile();
		}

		/**
		 * Create group
		 *
		 * @params $params['name'] Name of group
		 *         $params['description'] Group description
		 *         $params['owner_guid']: Guid of owner creating group
		 *         $params['privacy'] Group Privacy
		 *
		 * @return bool;
		 */
		public function createGroup($params){
				self::initAttributes();
				$this->title       = trim($params['name']);
				$this->description = trim($params['description']);
				if(empty($this->title) || ($params['privacy'] != OSSN_PRIVATE && $params['privacy'] != OSSN_PUBLIC)){
						return false;
				}
				$this->owner_guid       = $params['owner_guid'];
				$this->type             = 'user';
				$this->subtype          = 'ossngroup';
				$this->data->membership = $params['privacy'];
				if($guid = $this->addObject()){
						ossn_add_relation($params['owner_guid'], $this->getGuid(), 'group:join');
						ossn_add_relation($this->getGuid(), $params['owner_guid'], 'group:join:approve');

						ossn_trigger_callback('group', 'add', array(
								'group_guid' => $guid,
						));
						return true;
				}
				return false;
		}

		/**
		 * Get guid of newly created group
		 *
		 * @return int;
		 * @access public;
		 */
		public function getGuid(){
				return $this->getObjectId();
		}

		/**
		 * Get User groups
		 *
		 * @param integer $owner_guid Guid of owner creating group
		 * @param array   $params Extra options
		 *
		 * @return object;
		 */
		public function getUserGroups($owner_guid, $params = array()){
				if(!empty($owner_guid)){
						$args = array(
								'type'       => 'user',
								'subtype'    => 'ossngroup',
								'owner_guid' => $owner_guid,
						);
						$vars = array_merge($args, $params);
						return $this->searchObject($vars);
				}
				return false;
		}

		/**
		 * Get group by guid
		 *
		 * @params $guid group guid
		 *
		 * @return object;
		 */
		public function getGroup($guid){
				$this->object_guid = $guid;
				$group             = $this->getObjectById();
				if($group && isset($group->subtype) && $group->subtype == 'ossngroup'){
						return $group;
				}
				return false;
		}

		/**
		 * Upgrade group
		 *
		 * @params $name Group name
		 *         $description Group description
		 *         $guid Group guid
		 *
		 * @return bool;
		 */
		public function updateGroup($name, $description, $guid){
				if(empty($name) || empty($guid)){
						return false;
				}
				$data = array(
						'title',
						'description',
				);
				$values = array(
						$name,
						$description,
				);
				if($this->updateObject($data, $values, $guid)){
						ossn_trigger_callback('group', 'update', array(
								'group_guid' => $guid,
						));					
						return true;
				}
				return false;
		}

		/**
		 * Change owner of group
		 *
		 * @params $owner Group new owner guid
		 *         $guid Group guid
		 *
		 * @return bool;
		 */
		public function changeOwner($owner, $guid){
				if(empty($owner) || empty($guid)){
						return false;
				}
				$data = array(
						'owner_guid',
				);
				$values = array(
						$owner,
				);
				if($this->updateObject($data, $values, $guid)){
						
						return true;
				}
				return false;
		}

		/**
		 * Delete group
		 *
		 * @params $guid Group guid
		 *
		 * @return bool;
		 */
		public function deleteGroup($guid){
				if(empty($guid)){
						return false;
				}
				$vars['entity'] = ossn_get_group_by_guid($guid);
				if($this->deleteObject($guid)){
						//delete notification
						//[B] Deleting a group should remove group:joinrequest records #2066
						if(class_exists('OssnNotifications')) {
								$notification = new OssnNotifications();
								$notification->deleteNotification(array(
										'subject_guid' => $guid,
										'type'         => array(
												'group:joinrequest',
										),
								));
						}					
						//delete group relations
						ossn_delete_group_relations($vars['entity']);
						//trigger callback so other components can be notified when group is deleted.
						ossn_trigger_callback('group', 'delete', $vars);
						return true;
				}
				return false;
		}

		/**
		 * Count member requests
		 *
		 * @return int;
		 */
		public function countRequests(){
				$group = $this->guid;

				$this->statement("SELECT COUNT(*) as join_requests FROM ossn_relationships  WHERE(
					relation_to='{$group}' AND
					type='group:join'
				);");
				$this->execute();
				$from = $this->fetch(false);
				$join_requests = $from->join_requests;

				$this->statement("SELECT COUNT(*) as approved_members FROM ossn_relationships WHERE(
					relation_from='{$group}' AND
					type='group:join:approve'
				);");
				$this->execute();
				$from = $this->fetch(false);
				$approved_members = $from->approved_members;

				return $join_requests - $approved_members;
		}

		/**
		 * Get group member requests
		 *
		 * @params $object->guid Group guid
		 *
		 * @return object;
		 */
		public function getMembersRequests(){
				$group = $this->guid;
				$this->statement("SELECT relation_from FROM ossn_relationships WHERE
						relation_to = '{$group}' AND
						type = 'group:join' AND
						relation_from NOT IN (SELECT relation_to FROM ossn_relationships WHERE
						relation_from = '{$group}' AND
						type ='group:join:approve')
				;");
				$this->execute();
				$requests = $this->fetch(true);
				if ($requests) {
						$users = array();
						foreach ($requests as $request) {
								$users[] = ossn_user_by_guid($request->relation_from);
						}
						return $users;
				}
				return false;
		}

		/**
		 * Cehck if the user is memeber of group or not
		 *
		 * @params $user User guid
		 *         $group Group guid
		 *
		 * @return bool;
		 */
		public function isMember($group, $user){
				if(isset($this->guid)){
						$group = $this->guid;
				}
				$this->statement("SELECT * FROM ossn_relationships WHERE(
					     relation_from='{$group}' AND
					     relation_to='{$user}' AND
					     type='group:join:approve'
					     );");
				$this->execute();
				$from = $this->fetch();
				if(isset($from->relation_id)){
						return true;
				}
				return false;
		}

		/**
		 * Get group members
		 *
		 * @params $object->guid Group guid
		 *
		 * @return object;
		 */
		public function getMembers($count = false){
				if(!isset($this->guid)){
						return false;
				}
				$members = ossn_get_relationships(array(
						'from'  => $this->guid,
						'type'  => 'group:join:approve',
						'count' => $count,
				));
				if($count){
						return $members;
				}
				if($members){
						foreach ($members as $member){
								$users[] = ossn_user_by_guid($member->relation_to);
						}
				}
				if(isset($users)){
						return $users;
				}
				return false;
		}

		/**
		 * Send group join request
		 *
		 * @params $from Member guid
		 *         $group Group guid
		 *
		 * @return bool;
		 */
		public function sendRequest($from, $group){
				self::initAttributes();
				if(!$this->requestExists($from, $group)){
						if(ossn_add_relation($from, $group, 'group:join')){
								// #186 send notification to Group Owner
								$current_group = $this->getGroup($group);
								$group_owner   = $current_group->owner_guid;

								$type            = 'group:joinrequest';
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
										$type,
										$from,
										$group_owner,
										$group,
										0,
										time(),
								);
								if($this->OssnDatabase->insert($params)){
										ossn_trigger_callback('group', 'send:request', array(
												'user_guid'  => $from,
												'group_guid' => $group,
										));
										return true;
								}
						}
				}
				return false;
		}
		/**
		 * Check if member request exist or not
		 *
		 * @params $from Member guid
		 *         $group Group guid
		 *
		 * @return bool;
		 */
		public function requestExists($from, $group){
				if(isset($this->guid)){
						$group = $this->guid;
				}
				$this->statement("SELECT * FROM ossn_relationships WHERE(
					     relation_to='{$group}' AND
						 relation_from='{$from}' AND
					     type='group:join'
					     );");
				$this->execute();
				$request = $this->fetch();
				if(!empty($request->relation_id)){
						return true;
				}
				return false;
		}

		/**
		 * Approve member request
		 *
		 * @params $from Member guid
		 *         $group Group guid
		 *
		 * @return bool;
		 */
		public function approveRequest($from, $group){
				//[B] Multiple clicks on same action add member multiple times in group #2147
				//used ossn_relation_exists for #2147
				if($this->requestExists($from, $group) && !ossn_relation_exists($group, $from, 'group:join:approve')){
						if(ossn_add_relation($group, $from, 'group:join:approve')){
								ossn_trigger_callback('group', 'approve:request', array(
										'user_guid'  => $from,
										'group_guid' => $group,
								));
								return true;
						}
				}
				return false;
		}

		/**
		 * Delete member from group
		 *
		 * @params $from Member guid
		 *         $group Group guid
		 *
		 * @return bool;
		 */
		public function deleteMember($from, $group){
				if(!$this->requestExists($from, $group)){
						return false;
				}
				$this->statement("DELETE FROM ossn_relationships WHERE(
						 relation_from='{$from}' AND relation_to='{$group}'  AND type='group:join' OR
						 relation_from='{$group}' AND relation_to='{$from}' AND type='group:join:approve')");
				if($this->execute()){
						ossn_trigger_callback('group', 'delete:member', array(
								'user_guid'  => $from,
								'group_guid' => $group,
						));
						return true;
				}
				return false;
		}

		/**
		 * Search group in database
		 *
		 * @params $q Group Metadata
		 *
		 * @return object;
		 */
		public function searchGroups($q, array $args = array()){
				$params['from']    = 'ossn_object';
				$params['type']    = 'user';
				$params['subtype'] = 'ossngroup';
				$params['wheres']  = array(
						"(title LIKE '%{$q}%' OR description LIKE '%{$q}%')",
				);
				$params['count'] = false;
				$vars            = array_merge($params, $args);
				$search          = $this->searchObject($vars, true);
				if(!$search){
						return false;
				}
				if($vars['count'] === true){
						return $search;
				}
				foreach ($search as $group){
						$groupentity[] = ossn_get_group_by_guid($group->guid);
				}
				$data = $groupentity;
				return $data;
		}

		/**
		 * Upload group cover
		 *
		 * @return boolean|null
		 * @access public;
		 */
		public function UploadCover(){
				self::initAttributes();
				if(empty($this->guid) || $this->guid < 1){
						return false;
				}
				$this->OssnFile->owner_guid = $this->guid;
				$this->OssnFile->type       = 'object';
				$this->OssnFile->subtype    = 'cover';
				$this->OssnFile->setFile('coverphoto');
				$this->OssnFile->setExtension(array(
						'jpg',
						'png',
						'jpeg',
						'jfif',
						'gif',
						'webp',
				));
				$this->OssnFile->setPath('cover/');
				if(ossn_file_is_cdn_storage_enabled()) {
						$this->OssnFile->setStore('cdn');
				}				
				$files = clone $this->OssnFile;
				if($cover_guid = $this->OssnFile->addFile()){
						//Different sanity checks on uploading images? #667
						$files = $files->getFiles();
						$count = (array) $files;
						if(count($count) > 1){
								unset($files->{0});
								if($files){
										foreach ($files as $file){
												//Uploading new group cover, it keeps the old cover file only. #1528
												if($file->isFile()){
														unlink($file->getPath());
												}
												$file->deleteEntity();
										}
								}
						}
						$this->data->cover_guid = $cover_guid;
						$this->save();
						$this->ResetCoverPostition();
						return true;
				}
		}

		/**
		 * Reset cover position
		 *
		 * @return bool
		 */
		public function ResetCoverPostition(){
				if(!isset($this->cover)){
						return false;
				}
				$position = array(
						'',
						'',
				);
				$this->data->cover   = json_encode($position);
				return $this->save();
		}

		/**
		 * Check if group have cover or not
		 *
		 * @return bool;
		 * @access private;
		 */
		public function haveCover(){
				$covers = $this->groupCovers();
				if(isset($covers->{0})){
						return true;
				}
				return false;
		}

		/**
		 * Get group covers
		 *
		 * @return object;
		 * @access public;
		 */
		public function groupCovers(){
				self::initAttributes();
				if(empty($this->guid) || $this->guid < 1){
						return false;
				}
				$this->OssnFile->owner_guid = $this->guid;
				$this->OssnFile->type       = 'object';
				$this->OssnFile->subtype    = 'cover';
				return $this->OssnFile->getFiles();
		}

		/**
		 * Get group latest cover url
		 *
		 * @return url;
		 * @access public;
		 */
		public function coverURL(){
				if(!isset($this->cover_guid) || (isset($this->cover_guid) && empty($this->cover_guid))){
						return false;
				}
				$file              = md5($this->cover_guid);
				$this->coverurl    = ossn_add_cache_to_url(ossn_site_url("groups/cover/{$this->cover_guid}/{$file}.jpg"));
				return ossn_call_hook('group', 'cover:url', $this, $this->coverurl);
		}

		/**
		 * Reposition group cover
		 *
		 *  @param int $top  Position from top
		 *  @param int $left Position from left
		 *
		 * @return boolean
		 */
		public function repositionCOVER($top, $left){
				$position = array($top,$left);
				$this->data->cover   = json_encode($position);
				return $this->save();
		}

		/**
		 * Get cover position params
		 *
		 * @param int $guid Group guid
		 *
		 * @return array;
		 * @access public;
		 */
		public function coverParameters($guid){
				$group = ossn_get_group_by_guid($guid);
				if(isset($group->cover)){
						$parameters = $group->cover;
						return json_decode($parameters);
				}
				return false;
		}
		/**
		 * Get user groups (owned groups and groups user member of)
		 *
		 * @param object $user User entity
		 * @return array
		 */
		public function getMyGroups($user){
				self::initAttributes();
				if(empty($user->guid) || !$user instanceof OssnUser){
						return false;
				}
				$params           = array();
				$params['from']   = 'ossn_relationships';
				$params['wheres'] = array(
						"relation_to = '{$user->guid}'",
						"AND type = 'group:join:approve'",
				);
				# zfix #177 old code throws PHP warnings if user is not member of any group
				if($myGroups = $this->OssnDatabase->select($params, true)){
						$myGroups = get_object_vars($myGroups);
						foreach ($myGroups as $group){
								$group = $this->getGroup($group->relation_from);
								$groupsEntities[] = arrayObject($group, get_class($this));
						}
						if(!empty($groupsEntities)){
								return $groupsEntities;
						}
				}
				return false;
		}
		/**
		 * isModerator check if user is group moderator
		 *
		 * @return boolean
		 */
		public function isModerator($user_guid){
				$group_guid = $this->guid;
				if(empty($user_guid) || empty($group_guid)){
						return false;
				}
				$params = array(
						'group'     => $this,
						'user_guid' => $user_guid,
				);
				//please must use relation:type =  group:moderator
				//use of this hook via component to write actual functionality of moderators
				return ossn_call_hook('group', 'is:moderator', $params, false);
		}
		/**
		 * Get group cover photo file
		 *
		 * @return string|object
		 */
		public function getPhotoFile() {
				$file   = new OssnFile();
				$search = $file->searchFiles(array(
						'limit'      => 1,
						'owner_guid' => $this->guid,
						'type'       => 'object',
						'subtype'    => 'cover',
				));
				if($search) {
						return $search[0];
				}
				return false;
		}		
} //class
