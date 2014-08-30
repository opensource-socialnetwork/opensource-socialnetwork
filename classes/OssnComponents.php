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

class OssnComponents extends OssnDatabase {
/**
 * Get components from compnents directory
 *
 * @return components ids;
 */	
 public function getComponentsDir(){
	$dir = ossn_route()->com;
	$com_ids = array();
	$handle = opendir($dir);

	if ($handle) {
		while ($com_id = readdir($handle)) {
			if (substr($com_id, 0, 1) !== '.' 
					   && is_dir($dir . $com_id)
					   && !preg_match('/\s/', $com_id)
					   && is_file("{$dir}{$com_id}/ossn_com.php")
					   && is_file("{$dir}{$com_id}/ossn_com.xml")) {
				$com_ids[] = $com_id;
			}
		}
	}

	sort($com_ids);
    return $com_ids;
 }
 /**
 * Get components list
 *
 * @return components ids;
 */	
 public function getComponents(){
     $params['from'] = 'ossn_components';
	 $this->coms = $this->select($params, true);
	 foreach($this->coms as $com_id){
		$com_ids[] = $com_id->com_id;
	 }
	 return $com_ids;
 }
 /**
 * Count total components
 *
 * @return (int);
 */	 
 public function total(){ 
	return count($this->getComponents()); 
 }
 /**
 * Get active components
 *
 * @return active components;
 */	
 public function getActive(){
	 $params['from'] = 'ossn_components';
	 $params['wheres'] = array("active='1'");
	 return $this->select($params, true);	 
 }
 /**
 * Upload component
 *
 * @requires component package file, 
 *
 * @return bool;
 */	 
 public function upload(){
	 $archive = new ZipArchive;
	 $data_dir = ossn_get_userdata('tmp/components');
	 if(!is_dir($data_dir)){
	    mkdir($data_dir, 0755, true); 	 
	 } 
	 $zip = $_FILES['com_file'];
	 $newfile = "{$data_dir}/{$zip['name']}";
	 if(move_uploaded_file($zip['tmp_name'],  $newfile)){
		if ($archive->open($newfile) === TRUE) {
	 	   $archive->extractTo($data_dir);
		   $archive->close();
		   $validate = pathinfo($zip['name'], PATHINFO_FILENAME);
		   if(is_file("{$data_dir}/{$validate}/ossn_com.php") 
					  && is_file("{$data_dir}/{$validate}/ossn_com.xml")){
			  $archive->open($newfile);
			  $archive->extractTo(ossn_route()->com);
			  $archive->close();
			  $this->newCom($validate);
			  OssnFile::DeleteDir($data_dir);
			  return true;
		   }
		}
	 }
	 return false;
 }
 /**
 * Get component details
 *
 * @params $name = component id;
 *
 * @return (object) or return false;
 */ 
 public static function getCom($name){
     $name = trim($name);
     if(!preg_match('/\s/', $name)){
	     $dir = ossn_route()->com;
	     $component = $dir.$name;
	      if(is_file("{$component}/ossn_com.xml")){
           $component = simplexml_load_file("{$component}/ossn_com.xml");
	       return $component;
		  }
	 }
     return false;
 }
 /**
 * Load all active components
 *
 * @return components startup files;
 */  
 public function loadComs(){
	 $coms = $this->getActive();
	 $lang =  ossn_site_settings('language');
	 foreach($coms as $com){
		 $dir = ossn_route()->com; 
	     $name = $this->getCom($com->com_id);
		 if(!empty($name->com_name)){
				if(is_file("{$dir}{$com->com_id}/locale/ossn.{$lang}.php")){
				  include("{$dir}{$com->com_id}/locale/ossn.{$lang}.php"); 
			    } 
			   include_once("{$dir}{$com->com_id}/ossn_com.php"); 
		 }
	 }
 }
 /**
 * Check if component is active or not
 *
 * @return bool;
 */   
 public function isActive($id){
	 $params['from'] = 'ossn_components';
	 $params['wheres'] = array("com_id='{$id}'");
	 $this->settings = $this->select($params);
	 if($this->settings->active == 1){
		return true; 
	 }
	 return false;
 }
  
/**
 * Enable Component
 *
 * @return bool;
 */  
  public function ENABLE($com){
  if(!empty($com) && is_dir(ossn_route()->com.$com)){	
	/*
	* Get a com;
	* @last edit: $arsalanshah
    * @Reason: Initial;
	*/
	$this->statement("SELECT * FROM ossn_components 
			    WHERE (com_id='$com');"
			  );
	$this->execute();
	$CHECK = $this->fetch();
	/*
	* Update com status;
	* @last edit: $arsalanshah
    * @Reason: Initial;
	*/
    if(isset($CHECK->active) && $CHECK->active == 0){
	$this->statement("UPDATE ossn_components 
			    SET active='1' 
			    WHERE (com_id='$com');"
			  );
	$this->execute();
	return true;
	} 
	elseif(!isset($CHECK->active)){
	/*
	* Update com  status;
	* @last edit: $arsalanshah 
    * @Reason: Initial;
	*/
	$this->statement("INSERT INTO `ossn_components` 
			  (`com_id`, `active`) 
		          VALUES ('$com', '1')"
			  );
	$this->execute();
	return true;
	}
   }
   return false; 
  }
  
  
 /**
 * Insert a new component to system
 *
 * @return bool;
 */  
  public function newCom($com){
  if(!empty($com) && is_dir(ossn_route()->com.$com)){	
	/*
	* Get a com;
	* @last edit: $arsalanshah
    * @Reason: Initial;
	*/
	$this->statement("SELECT * FROM ossn_components 
			    WHERE (com_id='$com');"
			  );
	$this->execute();
	$CHECK = $this->fetch();
    if(!isset($CHECK->active)){
	/*
	* Update com  status;
	* @last edit: $arsalanshah 
    * @Reason: Initial;
	*/
	$this->statement("INSERT INTO `ossn_components` 
			  (`com_id`, `active`) 
		          VALUES ('$com', '0')"
			  );
	$this->execute();
	return true;
	}
   }
   return false; 
  }
 /**
 * Disable component
 *
 * @return bool;
 */  
  public function DISABLE($com = NULL){
	if(in_array($com, $this->requiredComponents())){
	   return false;
    }									
    if(!empty($com)){	
	   $this->statement("UPDATE ossn_components 
			    SET active='0' WHERE (com_id='$com')"
			   );
	   $this->execute();
	   return true;
     }
     return false;
  } 
 
 /**
 * Delete component
 *
 * @return bool;
 */  
 public function deletecom($com){
	if(in_array($com, $this->requiredComponents())){
	   return false;
	}			
	if($this->DISABLE($com)){
	OssnFile::DeleteDir(ossn_route()->com."{$com}/"); 
	rmdir(ossn_route()->com."{$com}/");
	return true;
	} 
  return false;
 }
 /**
 * Required Components
 *
 * Admin can't disable required components;
 *
 * @return array;
 */  
 public function requiredComponents(){
	return array('OssnAds', 
				 'OssnComments', 
				 'OssnLikes', 
				 'OssnMessages', 
				 'OssnNotifications', 
				 'OssnPhotos', 
				 'OssnProfile', 
				 'OssnSearch',
				 'OssnWall',
				 ); 
 }
  /**
 * Required Components
 *
 * Admin can't disable required components;
 *
 * @return array;
 */  
 public function bundledComponents(){
	return array_merge(array('OssnGroups', 'OssnSitePages'), $this->requiredComponents()); 
 }
 	
}//class