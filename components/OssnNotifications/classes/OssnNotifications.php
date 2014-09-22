<?php
/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.com/licence
 */
class OssnNotifications extends OssnDatabase {
   /**
	* Get comments participates
	*
	* @params $subject_id: Id of item which user comment
	*
	* @return array;
	*/			
	public function get_comments_participates($subject_guid){
		$params['from'] = 'ossn_notifications';
		$params['wheres'] = array("type='comments:post' AND subject_guid='{$subject_guid}'");
		$users = $this->select($params ,true);
		foreach($users as $user){
			$participates[] = $user->poster_guid;
		}
		return array_unique($participates);
	}
   /**
	* Add notification to database
	*
	* @params $subject_id: Id of item which user comment
	*         $poster_guid: Guid of item poster
	*         $item_guid: Guid of item
	*         $notification_owner: Guid of notification owner
	*
	* @return bool;
	*/		
	public function add($type ,$poster_guid, $subject_guid, $item_guid = NULL, $notification_owner = ''){
		if(!empty($type) && !empty($subject_guid) && !empty($poster_guid)){
		    //check if notification is type of comment or like => post
			if($type == 'comments:post' || $type == 'like:post'){
			 $object = new OssnObject;
			 $object->object_guid = $subject_guid;
			 $object =  $object->getObjectById();
			 $guid_two = $object->owner_guid;
			 if($object->type !== 'user'){
			   $type = "{$type}:{$object->type}:{$object->subtype}";
			 }
			}
			// check if notfication for liking comment
		    if($type == 'like:annotation'){
             $annotation = new OssnAnnotation;
			 $annotation->annotation_id = $subject_guid;
			 $annotation = $annotation->getAnnotationById();
			 $guid_two = $annotation->owner_guid;
			 $subject_guid = $annotation->subject_guid;
			}
			//check if user comment of entity or like it
			if($type == 'comments:entity' || $type == 'like:entity'){
			 $entity = new OssnEntities;
			 $entity->entity_guid = $subject_guid;
			 $entity = $entity->get_entity();
			 $type = "{$type}:{$entity->subtype}";
			 if($entity->type == 'user'){
			     $guid_two = $entity->owner_guid;
			 }
		     if($entity->type == 'object'){
			    $object = new OssnObject;
			    $object->object_guid = $entity->owner_guid;
			    $object =  $object->getObjectById();
			    $guid_two = $object->owner_guid; 
			 }
			
			}
			//check if comment is posted on group wall
			if($type == 'comments:post:group:wall'){
		       $object = new OssnObject;
			   $object->object_guid = $subject_guid;
			   $object =  $object->getObjectById();
			   $guid_two = $object->poster_guid; 		
			}
			//check if notification owner is set then use it
			if(!empty($notification_owner)){
			  $guid_two = $notification_owner;	
			}
			if($poster_guid == $guid_two){
			  $paricipates = $this->get_comments_participates($subject_guid);
			  if($type !== 'like:post'){
				 foreach($paricipates as $partcipate){
					$params['into'] = 'ossn_notifications';
		            $params['names'] = array('type','poster_guid', 'owner_guid', 'subject_guid', 
					                         'item_guid', 'time_created');
	 	            $params['values'] = array($type, $guid_two, $partcipate , $subject_guid, 
					                          $item_guid, time()); 
					if($partcipate !== $poster_guid){
					  $this->insert($params);
					}
			      }
			  }
			     return false;
			}
			
			$params['into'] = 'ossn_notifications';
		    $params['names'] = array('type','poster_guid', 'owner_guid', 'subject_guid', 
			                         'item_guid', 'time_created');
	 	    $params['values'] = array($type, $poster_guid, $guid_two , $subject_guid, 
			                          $item_guid, time());
		    if($this->insert($params)){
			   $paricipates = $this->get_comments_participates($subject_guid);
			   if($type !== 'like:post'){
				 foreach($paricipates as $partcipate){
					$params['into'] = 'ossn_notifications';
		            $params['names'] = array('type','poster_guid', 'owner_guid', 'subject_guid',
					                         'item_guid', 'time_created');
	 	            $params['values'] = array($type, $poster_guid, $partcipate , $subject_guid,
					                          $item_guid, time()); 
					if($partcipate !== $poster_guid){
					  $this->insert($params);
					}
			      }
			   }
			   return true;
	 	    }
		}
		return false;
	}
   /**
	* Get notifications
	*
	* @params $guid_two User guid
	*         $poster_guid: Guid of item poster;
	*
	* @return array
	*/		
    public function get($guid_two){
		$baseurl = ossn_site_url();
		$this->statement("SELECT * FROM ossn_notifications WHERE(
		                  owner_guid='{$guid_two}') ORDER by guid DESC");
		$this->execute();
	    
		foreach($this->fetch(true) as $notif){
		  if(ossn_is_hook('notification:view', $notif->type)){
		   $messages[] = ossn_call_hook('notification:view', $notif->type, $notif);
		   }
		}
		return $messages;
	}
   /**
	* Count user notification
	*
	* @params $guid: Count user notifications
	*
	* @return int;
	*/		
	public function countNotification($guid){
		$this->statement("SELECT * FROM ossn_notifications WHERE(
		                  owner_guid='{$guid}' AND viewed IS NULL) ORDER by guid DESC");
		$this->execute();
		$count = count(get_object_vars($this->fetch(true)));
		if($count > 0){
		  return $count;	
		}
		return false;
	}
   /**
	* Get notitication by guid
	*
	* @params $guid: Notification guid
    *
    * @return object;
	*/			
	public function getbyGUID($guid){
		$this->statement("SELECT * FROM ossn_notifications WHERE(guid='{$guid}');");
		$this->execute();
		$data = $this->fetch();
		return $data;
	}
   /**
	* Mark notification as viewd
	*
	* @params $guid: Notification guid
    *
    * @return object;
	*/		
	public function setViewed($guid){
	    $this->statement("UPDATE ossn_notifications SET viewed='' WHERE(guid='{$guid}');");
		if($this->execute()){
		return true;	
		}
	return false;	
	}

}