<?php

/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
class OssnLikes extends OssnDatabase {
		/**
		 * Like item
		 *
		 * @params integer $subject_id Id of item which users liked
		 * @params integer $guid Guid of user
		 * @params string  $type Subject type
		 *
		 * @return bool
		 */
		public function Like($subject_id, $guid, $type = 'post', $reaction_type = 'like') {
				if(empty($subject_id) || empty($guid) || empty($type)) {
						return false;
				}
				if(empty($reaction_type)){
					$reaction_type = 'like';	
				}
				if($type == 'annotation') {
						$annotation = ossn_get_annotation($subject_id);
						if(!$annotation) {
								return false;
						}
						ossn_trigger_callback('like', 'before:created', array(
									'type' => 'annotation',
									'annotation' => $annotation,
						));							
				}
				if($type == 'post' || $type == 'object') {
						$object = ossn_get_object($subject_id);
						if(!$object) {
								return false;
						}
						ossn_trigger_callback('like', 'before:created', array(
									'type' => 'object',
									'object' => $object,
						));							
				}
				if($type == 'entity') {
						$entity = ossn_get_entity($subject_id);
						if(!$entity) {
								return false;
						}
						ossn_trigger_callback('like', 'before:created', array(
									'type' => 'entity',
									'entity' => $entity,
						));	
				}				
				if(!$this->isLiked($subject_id, $guid, $type)) {
						$this->statement("INSERT INTO ossn_likes (`subject_id`, `guid`, `type`, `subtype`)
					           VALUES('{$subject_id}', '{$guid}', '{$type}', '{$reaction_type}');");
						if($this->execute()) {
								$params['subject_guid'] = $subject_id;
								$params['owner_guid']   = $guid;
								$params['type']         = "like:{$type}";
								ossn_trigger_callback('like', 'created', $params);
								return true;
						}
				}
				return false;
		}
		
		/**
		 * Check if user liked item or not
		 *
		 * @params integer $subject_id Id of item which users liked
		 * @params integer $guid Guid of user
		 * @params string  $type Subject type
		 *
		 * @return bool;
		 */
		public function isLiked($subject_id, $guid, $type = 'post') {
				$this->statement("SELECT * FROM ossn_likes WHERE (
	                     subject_id='{$subject_id}' AND guid='{$guid}' AND type='{$type}');");
				$this->execute();
				$this->check = $this->fetch();
				
				if(!empty($this->check->id)) {
						return true;
				}
				return false;
		}
		
		/**
		 * Unlike item
		 *
		 * @params integer $subject_id Id of item which users liked
		 * @params integer $guid Guid of user
		 * @params string  $type Subject type
		 *
		 * @return bool;
		 */
		public function UnLike($subject_id, $guid, $type = 'post') {
				if(empty($subject_id) || empty($guid) || empty($type)) {
						return false;
				}
			
				$vars               = array();
				$vars['subject_id'] = $subject_id;
				$vars['type']       = $type;
				$vars['guid']       = $guid;
				
				ossn_trigger_callback('like', 'before:deleted', $vars);
				if($this->isLiked($subject_id, $guid, $type)) {
						$this->statement("DELETE FROM ossn_likes WHERE(
	                         subject_id='{$subject_id}' AND guid='{$guid}' AND type='{$type}');");
						if($this->execute()) {
								ossn_trigger_callback('like', 'deleted', $vars);
								return true;
						}
				}
				return false;
		}
		
		/**
		 * Delte subject likes
		 *
		 * @params integer $subject_id Id of item which users liked
		 * @params string  $type Subject type
		 *
		 * @return bool;
		 */
		public function deleteLikes($subject_id, $type = 'post') {
				if(empty($subject_id) || empty($type)) {
						return false;
				}
				//[B]Like deleted callback triggered even if there is no likes #1643
				$likes = $this->GetLikes($subject_id, $type);
				if($likes){
					$this->statement("DELETE FROM ossn_likes WHERE(subject_id='{$subject_id}' AND type='{$type}');");
					if($this->execute()) {
							$vars               = array();
							$vars['subject_id'] = $subject_id;
							$vars['type']       = $type;
							ossn_trigger_callback('like', 'deleted', $vars);
							return true;
					}
				}
				return false;
		}
		/**
		 * Delete likes by user guid
		 *
		 * @params integer $owner_guid Guid of user
		 *
		 * @return bool;
		 */
		public function deleteLikesByOwnerGuid($owner_guid) {
				if(empty($owner_guid)) {
						return false;
				}
				$this->statement("DELETE FROM ossn_likes WHERE(guid='{$owner_guid}');");
				if($this->execute()) {
						return true;
				}
				return false;
		}
		/**
		 * Count likes
		 *
		 * @params integer $subject_id Id of item which users liked
		 * @params string  $type Subject type
		 *
		 * @return bool;
		 */
		public function CountLikes($subject_id, $type = 'post') {
				$likes = $this->GetLikes($subject_id, $type);
				$this->__likes_get_all = $likes;
				if($likes) {
						$likes = get_object_vars($likes);
						if(!empty($likes)) {
								return count($likes);
						}
				}
				return false;
		}
		
		/**
		 * Get likes
		 *
		 * @params integer $subject_id Id of item which users liked
		 * @params string  $type Subject type
		 *
		 * @return bool;
		 */
		public function GetLikes($subject_id, $type = 'post') {
				$this->statement("SELECT * FROM ossn_likes WHERE (
	                     subject_id='{$subject_id}' AND type='{$type}');");
				$this->execute();
				return $this->fetch(true);
		}
		
} //class
