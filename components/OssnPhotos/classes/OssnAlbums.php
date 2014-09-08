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
class OssnAlbums extends OssnObject {
	public function CreateAlbum($owner_id, $name, $access = OSSN_PUBLIC, $type = 'user'){
	    if(!in_array($access, ossn_access_types())){
												$access = OSSN_PUBLIC;
											   }
		if(!empty($owner_id) && !empty($name) && $owner_id > 0){
		 	$this->owner_guid = $owner_id;
			$this->type = $type;
			$this->subtype = 'ossn:album';
			$this->data->access = $access;
			$this->title = strip_tags($name);
			if($this->addObject()){
			  $this->getObjectId = $this->getObjectId();
			  return true;	
			}
			return false;
		}
	}
	public function GetAlbumGuid(){
		if(isset($this->getObjectId)){
		return $this->getObjectId;	
		}
		return false;
	}
	public function GetAlbums($owner_id, $type = 'user'){
		if(!empty($owner_id)){
		   $this->owner_guid = $owner_id;	
		   $this->type = $type;
		   $this->subtype = 'ossn:album';
		   return $this->getObjectByOwner();
		}
	}
	public function GetAlbum($album_id){
		if(!empty($album_id)){
		   $this->object_guid = $album_id;	
		   $this->album = $this->getObjectbyId();
		   if(!empty($this->album)){
			  $this->photos = new OssnPhotos;   
			  $this->album = array(
								   'album' => $this->album, 
								   'photos' => $this->photos->GetPhotos($album_id)
								   );
			  return arrayObject($this->album, get_class($this));
		   }
		}
	}
	public function GetUserProfilePhotos($user){
		$photos = new OssnFile;
		$photos->owner_guid = $user;
		$photos->type = 'user';
		$photos->subtype = 'profile:photo';
		$photos->order_by = 'guid DESC';
		return $photos->getFiles();
	}
	
}