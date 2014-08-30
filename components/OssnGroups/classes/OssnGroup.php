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
class OssnGroup extends OssnObject {
    public function initAttributes(){
			$this->OssnDatabase = new OssnDatabase;
			$this->OssnFile = new OssnFile;
	}	
	public function createGroup($params){
	    self::initAttributes();
		if(empty($this->title)){
			return false;
		}
		$this->title = trim($params['name']);
		$this->description = trim($params['description']);
		
		$this->owner_guid = $params['owner_guid']; 
		$this->type = 'user';
		$this->subtype = 'ossngroup';
		if($params['privacy'] == OSSN_PRIVATE || $params['privacy'] == OSSN_PUBLIC){
	    $this->data->membership = $params['privacy'];
		}
		if($this->addObject()){
		ossn_add_relation($params['owner_guid'], $this->getGuid(), 'group:join');
		ossn_add_relation($this->getGuid(),$params['owner_guid'], 'group:join');
		return true;	
		}
		return false;
	}
	public function getGuid(){
	  return $this->getObjectId();	
	}
	public function getUserGroups($owner_guid){
		$this->owner_guid = $owner_guid;
		$this->type = 'user';
		$this->subtype = 'ossngroup';
		return $this->getObjectByOwner();
	}
	public function getGroups($owner_guid){
		$this->type = 'user';
		$this->subtype = 'ossngroups';
		return $this->getObjectsByTypes();
	}
	public function getGroup($guid){
	   $this->object_guid = $guid;
	   $group  = $this->getObjectById();
	   if($group->subtype == 'ossngroup'){
		 return $group;   
	   }
	   return false;
	}
	public function updateGroup($name, $description, $guid){
		$data = array('title', 'description');
		$values = array($name, $description);
		if($this->updateObject($data, $values, $guid)){
		  return true;	
		}
		return true;
	}
	public function deleteGroup($guid){
	  if($this->deleteObject($guid)){
		 return true;  
	  }
	  return false;
	}
	public function isMember($group, $user){
		if(isset($this->guid)){
		   $group = $this->guid;	
		}
      	$this->statement("SELECT * FROM ossn_relationships WHERE(
					     relation_from='{$group}' AND 
					     relation_to='{$user}' AND
					     type='group:join'
					     );");
	    $this->execute();
	    $from = $this->fetch();
	    $this->statement("SELECT * FROM ossn_relationships WHERE(
					     relation_from='{$user}' AND 
					     relation_to='{$group}' AND
				 	     type='group:join'
					     );");
	    $this->execute();
	    $to = $this->fetch();
	    if(isset($from->relation_id) && isset($to->relation_id)){
	    return true;	
     	}
	    return false;	
	}

    public function getMembersRequests(){
		$group = $this->guid;
	    $this->statement("SELECT * FROM ossn_relationships WHERE(
					     relation_to='{$group}' AND
					     type='group:join'
					     );");
	    $this->execute();
	    $from = $this->fetch(true);
        if(!is_object($from)){
	   	   return false; 
	    }
	    foreach($from  as $fr){
            if(!$this->isMember($group,  $fr->relation_from)){
                $uss[] =  ossn_user_by_guid($fr->relation_from);
            }
		}
	   if(isset($uss)){
		   return $uss; 
	   }
	   return false;
	}
    public function countRequests(){
	 $count = $this->getMembersRequests();
	 $cc = 0;
	 foreach($count as $c){
		 $cc++;
	 }
	 return $cc;
	}
    public function getMembers(){
		$group = $this->guid;	
	    $this->statement("SELECT * FROM ossn_relationships WHERE(
			   		     relation_to='{$group}' AND
					     type='group:join'
					     );");
	    $this->execute();
	    $from = $this->fetch(true);
        if(!is_object($from)){
		  return false; 
	     }
	    foreach($from  as $fr){
            if($this->isMember($group,  $fr->relation_from)){
                $uss[] =  ossn_user_by_guid($fr->relation_from);
            }
		}
	   if(isset($uss)){
	   	   return $uss; 
	   }
	   return false;
	}
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
    public function sendRequest($from, $group){
	if(!$this->requestExists($from, $group)){	
	    if(ossn_add_relation($from, $group, 'group:join')){
	      return true;
	    }
	}
	 return false; 
	}
    public function approveRequest($from, $group){
	if($this->requestExists($from, $group)){	
	    if(ossn_add_relation($group, $from, 'group:join')){
	      return true;
	    }
	}
	 return false; 
	}
   public function deleteMember($from, $group){
	  if(!$this->requestExists($from, $group)){   
	     return false;
	   }
	    $this->statement("DELETE FROM ossn_relationships WHERE(
						 relation_from='{$from}' AND relation_to='{$group}' OR 
						 relation_from='{$group}' AND relation_to='{$from}' AND type='group:join')");
	     if($this->execute()){
	         return true;  
	     }
		 return false;
	}
   public function searchGroups($q){
		$params['from'] = 'ossn_object';
		$params['wheres'] = array("(title LIKE '%{$q}%' OR description LIKE '%{$q}%') AND 
		                           type='user' AND subtype='ossngroup'");
		$search = $this->select($params, true);

         foreach($search as $group){
	      $groupentity[] = ossn_get_group_by_guid($group->guid);		
		}
		$data = $groupentity;
		return $data;
	}	
}//class