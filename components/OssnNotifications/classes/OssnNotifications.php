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
	public function get_comments_participates($subject_guid){
		$params['from'] = 'ossn_notifications';
		$params['wheres'] = array("type='comments:post' AND subject_guid='{$subject_guid}'");
		$users = $this->select($params ,true);
		foreach($users as $user){
			$participates[] = $user->poster_guid;
		}
		return array_unique($participates);
	}
	public function add($type ,$poster_guid, $subject_guid, $item_guid = NULL, $notification_owner = ''){
		if(!empty($type) && !empty($subject_guid) && !empty($poster_guid)){
		    if($type == 'comments:post' || $type == 'like:post'){
			 $object = new OssnObject;
			 $object->object_guid = $subject_guid;
			 $object =  $object->getObjectById();
			 $guid_two = $object->owner_guid;
			 if($object->type !== 'user'){
			   $type = "{$type}:{$object->type}:{$object->subtype}";
			 }
			}
		    if($type == 'like:annotation'){
             $annotation = new OssnAnnotation;
			 $annotation->annotation_id = $subject_guid;
			 $annotation = $annotation->getAnnotationById();
			 $guid_two = $annotation->owner_guid;
			 $subject_guid = $annotation->subject_guid;
			}
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
			if(!empty($notification_owner)){
			  $guid_two = $notification_owner;	
			}
			if($poster_guid == $guid_two){
			  $paricipates = $this->get_comments_participates($subject_guid);
			  if($type !== 'like:post'){
				 foreach($paricipates as $partcipate){
					$params['into'] = 'ossn_notifications';
		            $params['names'] = array('type','poster_guid', 'owner_guid', 'subject_guid', 'item_guid');
	 	            $params['values'] = array($type, $guid_two, $partcipate , $subject_guid, $item_guid); 
					if($partcipate !== $poster_guid){
					  $this->insert($params);
					}
			      }
			  }
			     return false;
			}
			
			$params['into'] = 'ossn_notifications';
		    $params['names'] = array('type','poster_guid', 'owner_guid', 'subject_guid', 'item_guid');
	 	    $params['values'] = array($type, $poster_guid, $guid_two , $subject_guid, $item_guid);
		    if($this->insert($params)){
			   $paricipates = $this->get_comments_participates($subject_guid);
			   if($type !== 'like:post'){
				 foreach($paricipates as $partcipate){
					$params['into'] = 'ossn_notifications';
		            $params['names'] = array('type','poster_guid', 'owner_guid', 'subject_guid');
	 	            $params['values'] = array($type, $poster_guid, $partcipate , $subject_guid); 
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

    public function get($guid_two, $image = false){
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
	public function getbyGUID($guid){
		$this->statement("SELECT * FROM ossn_notifications WHERE(guid='{$guid}');");
		$this->execute();
		$data = $this->fetch();
		return $data;
	}
	public function setViewed($guid){
	    $this->statement("UPDATE ossn_notifications SET viewed='' WHERE(guid='{$guid}');");
		if($this->execute()){
		return true;	
		}
	return false;	
	}

}