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

class OssnFile extends OssnEntities {
   /**
   * Get server post max size
   *
   * @return float;
   */		
   public function MaxSize(){
       $val =  ini_get('post_max_size');
       $val = trim($val);
       $last = strtolower($val[strlen($val)-1]);
       switch($last) {
        case 'g':
            $val *= 1024;
        case 'm':
            $val *= 1024;
        case 'k':
            $val *= 1024;
        }
		return $val;
   }
   /**
   * Get Image MimeTypes
   *
   * @return array;
   */   
   private function MimeTypeImages(){
	  return array(
		     'image/jpeg' => 'jpeg',
		     'image/pjpeg' => 'jpeg',
		     'image/png' => 'png',
		     'image/x-png' => 'png',
		     'image/gif' => 'gif'
	         );
   }
   /**
   * Set a required file in memory
   *
   * @return void;
   */   
   public function setFile($name){
       if(isset($_FILES[$name]['type'])){
	       $file = $_FILES[$name];
           $this->file = $file;
        }
   }
  /**
   * Set a path for file where it need to upload
   *
   * @return void;
   */
   public function setPath($path){
       $this->path =  $path;
   }
  /**
   * Add file to database
   *
   * @params = (object)->owner_guid => guid of owner , the file belongs to
   *           (object)->type = owner type 
   *           (object)->subtype = file type
   *
   * @return bool
   */   
   public function addFile(){
	 if(isset($this->file) && !empty($this->file) 
									 && !empty($this->owner_guid)
									 && !empty($this->subtype) 
									 && !empty($this->type)){ 
		 if(preg_match('/image/i', $this->file['type'])){
			 $this->mime = $this->MimeTypeImages();         
			 $this->newfilename = md5($this->file['name'].rand().time()).'.'.$this->mime[$this->file['type']];
			 $this->newfile = $this->path.$this->newfilename;
			 $this->dir = ossn_get_userdata("{$this->type}/{$this->owner_guid}/{$this->path}");
			 if(!is_dir(ossn_get_userdata($this->dir))){
				 mkdir($this->dir, 0755, true); 
			 }
			 
			 $this->subtype = "file:{$this->subtype}";
	         $this->value = $this->newfile;
			 if($this->add()){
			     $image = ossn_resize_image($this->file['tmp_name'], 2048,  2048);
			     file_put_contents("{$this->dir}{$this->newfilename}", $image);
				 return true;
			 }
		 }
		
	       //normal types goes here
		   //version 1.x
		   //dev $arsalanshah
		   
	 }
	 
   }
  /**
   * Get owner files
   *
   * @params = (object)->owner_guid => guid of owner , the file belongs to
   *           (object)->type = owner type 
   *           (object)->subtype = file type
   *
   * @return (object)
   */      
   public function getFiles(){
	   if(!empty($this->type) && !empty($this->owner_guid) && !empty($this->subtype)){
		   $this->filetype = "file:{$this->subtype}";
		   $this->subtype = preg_replace('/file:file:/i', 'file:', $this->filetype);
		   $this->order_by = 'guid DESC';
		   return arrayObject($this->get_entities(), get_class($this));
	   }
   }
  /**
   * Get file by id
   *
   * @params = (object)->file_id => id of file in database
   *           (object)->type = owner type 
   *           (object)->subtype = file type
   *
   * @return (object)
   */    
  public function fetchFile(){
	  $this->entity_guid = $this->file_id;
	  $file = $this->get_entity();
	  return $file;
  }
  /**
   * Delete the directory
   *
   * @params = $path => path of directory
   *
   * @return (object)
   */      
  public static function DeleteDir($path) {
        if (is_dir($path)) {
            array_map(function($value) {
                self::DeleteDir($value);
                rmdir($value);
            },glob($path . '/*', GLOB_ONLYDIR));
            array_map('unlink', glob($path."/*"));
        }
 }

}//class