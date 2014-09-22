<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence 
 * @link      http://www.opensource-socialnetwork.org/licence
 */
class OssnLikes extends OssnDatabase{
   /**
	* Get likes
	*
	* @params $subject_id: Id of item which users liked
	*         $type: Post or Entity
	*
	* @return bool;
	*/		
    public function GetLikes($subject_id, $type = 'post'){
	    $this->statement("SELECT * FROM ossn_likes WHERE (
	                     subject_id='{$subject_id}' AND type='{$type}');");
	    $this->execute();
	    return $this->fetch(true);
    }
   /**
	* Check if user liked item or not
	*
	* @params $subject_id: Id of item which users liked
	*         $guid: Guid of user
	*         $type: Post or Entity
	*
	* @return bool;
	*/	
    public function isLiked($subject_id, $guid, $type = 'post'){
	    $this->statement("SELECT * FROM ossn_likes WHERE (
	                     subject_id='{$subject_id}' AND guid='{$guid}' AND type='{$type}');");
	    $this->execute();	
	    $this->check = $this->fetch();
	    
		if(!empty($this->check->id)){
	         return true;					  
        }
        return false;	
    }
   /**
	* Like item
	*
	* @params $subject_id: Id of item which users liked
	*         $guid: Guid of user
	*         $type: Post or Entity
	*
	* @return bool
	*/	
    public function Like($subject_id, $guid, $type = 'post'){
        if(empty($subject_id) || 
		       empty($guid) || 
		       empty($type)){
                    return false;	
         }
		 if($type == 'annotation'){
		    $annotation = new OssnAnnotation;
		    $annotation->annotation_id = $subject_id;
		    $annotation = $annotation->getAnnotationById();
		    if(empty($annotation->id)){
			   return false; 
		    }
		 }
		 if($type == 'post'){
			$post = new OssnObject;
		    $post->object_guid = $subject_id;
		    $post = $post->getObjectById();
		    if(empty($post->time_created)){
			   return false; 
		    }	 
		 }
         if(!$this->isLiked($subject_id, $guid, $type)){
	         $this->statement("INSERT INTO ossn_likes (`subject_id`, `guid`, `type`)
					           VALUES('{$subject_id}', '{$guid}', '{$type}');");
            if($this->execute()){
	          $params['subject_guid'] = $subject_id;
	          $params['owner_guid'] = $guid ;
           	  $params['type'] = "like:{$type}";
 	          ossn_trigger_callback('like', 'created', $params);   
	          return true;   
            }
         } 
         return false;
	}
   /**
	* Unlike item
	*
	* @params $subject_id: Id of item which users liked
	*         $guid: Guid of user
	*         $type: Post or Entity
	*
	* @return bool;
	*/	
    public function UnLike($subject_id, $guid, $type = 'post'){ 
        if(empty($subject_id) || 
		     empty($guid)){
               return false;	  
        }
        if($this->isLiked($subject_id, $guid, $type)){
	       $this->statement("DELETE FROM ossn_likes WHERE(
	                         subject_id='{$subject_id}' AND guid='{$guid}');");
          if($this->execute()){
	         return true;   
          }
       } 
       return false;
    }
   /**
	* Delte subject likes
	*
	* @params $subject_id: Id of item which users liked
	*         $type: Post or Entity
	*
	* @return bool;
	*/		
    public function deleteLikes($post, $type = 'post'){
	   $this->statement("DELETE FROM ossn_likes WHERE(subject_id='{$post}' AND type='{$type}');");
       if($this->execute()){
	       return true;   
       }
       return false;	 
    }
   /**
	* Count likes
	*
	* @params $subject_id: Id of item which users liked
	*         $type: Post or Entity
	*
	* @return bool;
	*/		 
    public function CountLikes($subject_id, $type = 'post'){
       $likes = get_object_vars($this->GetLikes($subject_id, $type));
       if(!empty($likes)){
           return count($likes);	
       }
      return false; 
    }
	
}//class