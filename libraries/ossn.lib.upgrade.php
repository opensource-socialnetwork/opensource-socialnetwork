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
/**
 * Get upgrade files
 *
 * @return array
 * @access private
 */ 
function ossn_get_upgrade_files(){
	$path = ossn_validate_filepath(ossn_route()->upgrade.'upgrades/');
    $handle = opendir($path);
	if (!$handle) {
		return false;
	}

	$files = array();

	while ($file = readdir($handle)) {
	   if ($file != "." && $file != "..") {	
	     	$files[] = $file;
	   }
	}

	sort($files);
	return $files;	
}
/**
 * Get the list of files that already being upraded
 *
 * @return array
 * @access private
 */ 
function ossn_get_upgraded_files(){
	$upgrades = ossn_site_settings('upgrades');
	$upgrades = json_decode($upgrades);
	if(!is_array($upgrades) || empty($upgrades)){
		$upgrades = array();
	}
	return $upgrades;	
}
/**
 * Get the files that need to be run for upgrade
 *
 * @return array
 * @access private
 */ 
function ossn_get_process_upgrade_files(){
	$upgrades = ossn_get_upgraded_files();
	$available_upgrades = ossn_get_upgrade_files();
	return array_diff($available_upgrades, $upgrades);
}
/**
 * Trigger upgrade / Run upgrade
 *
 * @return void;
 * @access private
 */ 
function ossn_trigger_upgrades(){
    if(!ossn_isAdminLoggedin()){
       ossn_error_page();	
    }
    $upgrades = ossn_get_process_upgrade_files();
    if(!is_array($upgrades) || empty($upgrades)){
		 ossn_trigger_message(ossn_print('upgrade:not:available'), 'error', 'admin');   
	     redirect('administrator');	
         return false;	
    } 
    foreach($upgrades as $upgrade){
	    $file = ossn_route()->upgrade."upgrades/{$upgrade}";
	    if(!include_once($file)){
	       throw new exception(ossn_print('upgrade:file:load:error'));	
	    }
     }
	//need to reset cache files
	if(ossn_site_settings('cache') !== 0){
	  	ossn_trigger_css_cache();
	    ossn_trigger_js_cache();	
	}
	return true; 
 }
/**
 * Generate site screat key
 *
 * @return str;
 */  
 function ossn_generate_site_screat(){
  return substr(md5('ossn'.rand()),3, 8);	
 }
