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
class OssnWall extends OssnObject {
   public function initAttributes(){
			if(empty($this->type)){
			  $this->type = 'user';	
			}
			$this->OssnFile = new OssnFile;
	}		
	public function Post($post, $friends = '', $location = '', $access = ''){
	     self::initAttributes();
		 if(empty($access)){
			$access = OSSN_PUBLIC; 
		 }
		 $this->owner_guid = $this->owner_guid;
		 $this->data->poster_guid = $this->poster_guid;
		 $this->data->access = $access;
		 $this->subtype = 'wall';
		 $this->title = '';
		 
		 $wallpost['post'] = $post;
		 if(!empty($friends)){ 
		     $wallpost['friend'] = $friends; 
		 }
         if(!empty($location)){ 
		   $wallpost['location'] = $location; 
		 } 
		 
		 $this->description = htmlspecialchars(json_encode($wallpost), ENT_QUOTES);
		 if($this->addObject()){
			$this->wallguid = $this->getObjectId(); 
			if(isset($_FILES['ossn_photo'])){
			   $this->OssnFile->owner_guid = $this->wallguid;
		       $this->OssnFile->type = 'object';
		       $this->OssnFile->subtype = 'wallphoto';
		       $this->OssnFile->setFile('ossn_photo');
		       $this->OssnFile->setPath('ossnwall/images/');
		       $this->OssnFile->addFile();
			}
			$params['subject_guid'] = $this->wallguid;
			$params['poster_guid'] =  $this->poster_guid ;
			$params['friends'] =  explode(',' , $wallpost['friend']);
 		    ossn_trigger_callback('wall', 'post:created', $params);	 
			return true;
		 }
		return true; 
	}
   public function GetPosts(){	
  	  self::initAttributes(); 
	  $this->subtype = 'wall';
	  $this->order_by = 'guid DESC';
	  return $this->getObjectsByTypes();
   }
   public function GetPostByOwner($owner){
	  self::initAttributes(); 
	  $this->subtype = 'wall';
	  $this->owner_guid = $owner;
	  $this->order_by = 'guid DESC';
	  return $this->getObjectByOwner();
   }
   public function GetUserPosts($user){	
      $this->type = "user";
	  $this->subtype = 'wall';
	  $this->owner_guid = $user;
	  $this->order_by = 'guid DESC';
	  return $this->getObjectByOwner();
   }
   public function GetPost($guid){	
      $this->object_guid = $guid;
	  return $this->getObjectById();
   }
   public function deletePost($post){
		$this->deleteObject($post);
		ossn_trigger_callback('post', 'delete', $post);   
   }
   public function deleteAllPosts(){
	    foreach($this->GetPosts() as $post){
			$this->deleteObject($post->guid);
			ossn_trigger_callback('post', 'delete', $post->guid);
		}
   }
   
}//class