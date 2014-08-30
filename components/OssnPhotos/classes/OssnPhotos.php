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
class OssnPhotos extends OssnFile {
	public function AddPhoto($album, $photo = 'ossnphoto', $access = OSSN_PUBLIC){
		if(!in_array($access, ossn_access_types())){
												$access = OSSN_PUBLIC;
											   }
		$this->album = new OssnAlbums;
		$this-> album = $this->album->GetAlbum($album);
		if(!empty($album) && $album > 0 && $this->album->album->owner_guid == ossn_loggedin_user()->guid){
		    $this->owner_guid = $album;
		    $this->type = 'object';
			$this->subtype = 'ossn:aphoto';
		    $this->setFile($photo);
			$this->premission = $access;
		    $this->setPath('album/photos/');
		    if($this->addFile()){
		        $sizes = ossn_photos_sizes();
				$resize = $this->getFiles();
				if(isset($resize->{0}->value)){
					 $datadir = ossn_get_userdata("object/{$album}/{$resize->{0}->value}");	
	                 $file_name = str_replace('album/photos/', '', $resize->{0}->value);
					 $sizes = ossn_photos_sizes();
					 foreach($sizes as $size => $params){
		                 $params = explode('x', $params);
		                 $width = $params[1];
		                 $height = $params[0];
						 if($size !== 'view'){
		                 $resized = ossn_resize_image($datadir, $width, $height, true);
						 } else {
						  $resized = ossn_resize_image($datadir, $width, $height, false);	 
					     }
		                 file_put_contents(ossn_get_userdata("object/{$album}/album/photos/{$size}_{$file_name}"), $resized);
		             }	
					return true; 
				 }
		    }
		    return false;
		}
	}
	public function GetPhotos($album){
		$this->owner_guid = $album;
		$this->subtype = 'ossn:aphoto';
		$this->type = 'object';
		return $this->getFiles();
	}
	
    public function GetPhoto($photo){
		$this->file_id = $photo;
		$this->type = 'object';
		return $this->fetchFile();
	}
	
}