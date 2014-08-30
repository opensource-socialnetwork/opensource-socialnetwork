<?php
/**
 * OpenSocialWebsite
 *
 * @package   OpenSocialWebsite
 * @author    Open Social Website Core Team <info@opensocialwebsite.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensocialwebsite.com/licence 
 * @link      http://www.opensocialwebsite.com/licence
 */
class OssnLikes extends OssnDatabase{
	
    public function GetLikes($subject_id){
	    $this->statement("SELECT * FROM ossn_likes WHERE (
	                     subject_id='{$subject_id}');");
	    $this->execute();
	    return $this->fetch(true);
    }

    public function isLiked($subject_id, $guid){
	    $this->statement("SELECT * FROM ossn_likes WHERE (
	                     subject_id='{$subject_id}' AND guid='{$guid}');");
	    $this->execute();	
	    $this->check = $this->fetch();
	    
		if(!empty($this->check->id)){
	         return true;					  
        }
        return false;	
    }
    public function Like($subject_id, $guid, $type){
        if(empty($subject_id) || 
		       empty($guid) || 
		       empty($type)){
                    return false;	
         }
		  
         if(!$this->isLiked($subject_id, $guid)){
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
  
    public function UnLike($subject_id, $guid){ 
        if(empty($subject_id) || 
		     empty($guid)){
               return false;	  
        }
        if($this->isLiked($subject_id, $guid)){
	       $this->statement("DELETE FROM ossn_likes WHERE(
	                         subject_id='{$subject_id}' AND guid='{$guid}');");
          if($this->execute()){
	         return true;   
          }
       } 
       return false;
    }
    public function deleteLikes($post){
	   $this->statement("DELETE FROM ossn_likes WHERE(subject_id='{$post}');");
       if($this->execute()){
	       return true;   
       }
       return false;	 
    }
	 
    public function CountLikes($subject_id){
       $likes = get_object_vars($this->GetLikes($subject_id));
       if(!empty($likes)){
           return count($likes);	
       }
      return false; 
    }
	
}//class