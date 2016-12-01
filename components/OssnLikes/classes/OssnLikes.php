<?php

/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
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
		public function Like($subject_id, $guid, $type = 'post') {
				if(empty($subject_id) || empty($guid) || empty($type)) {
						return false;
				}
				if($type == 'annotation') {
						$annotation                = new OssnAnnotation;
						$annotation->annotation_id = $subject_id;
						$annotation                = $annotation->getAnnotationById();
						if(empty($annotation->id)) {
								return false;
						}
				}
				if($type == 'post') {
						$post              = new OssnObject;
						$post->object_guid = $subject_id;
						$post              = $post->getObjectById();
						if(empty($post->time_created)) {
								return false;
						}
				}
				if(!$this->isLiked($subject_id, $guid, $type)) {
						$this->statement("INSERT INTO ossn_likes (`subject_id`, `guid`, `type`)
					           VALUES('{$subject_id}', '{$guid}', '{$type}');");
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
				if($this->isLiked($subject_id, $guid, $type)) {
						$this->statement("DELETE FROM ossn_likes WHERE(
	                         subject_id='{$subject_id}' AND guid='{$guid}' AND type='{$type}');");
						if($this->execute()) {
								$vars               = array();
								$vars['subject_id'] = $subject_id;
								$vars['type']       = $type;
								$vars['guid']       = $guid;
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
				$this->statement("DELETE FROM ossn_likes WHERE(subject_id='{$subject_id}' AND type='{$type}');");
				if($this->execute()) {
						$vars               = array();
						$vars['subject_id'] = $subject_id;
						$vars['type']       = $type;
						ossn_trigger_callback('like', 'deleted', $vars);
						return true;
				}
				return false;
		}
		/**
		 * Delte likes by user guid
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
