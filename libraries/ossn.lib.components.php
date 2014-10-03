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
 * Get components object
 *
 * @return bool
 */ 
function ossn_components(){
	$coms = new OssnComponents;
	return $coms;
}
/**
 * Check whether component is active or not.
 *
 * @param string $com   Component id
 *
 * @return bool
 */ 
function com_is_active($comn){
	$com = new OssnComponents;
	if($com->isActive($comn)){
	return true;	
	}
return false;	
}
/**
 * Count total components
 *
 * @return bool
 */ 
function ossn_total_components(){
	$com = new OssnComponents;	
	return $com->total();
}

/**
 * Load the locales
 *
 * @return array
 */ 
ossn_load_locales();

/**
 * Includes all components and active theme
 *
 * @return bool
 */ 
 
 //loads active theme
$themes = new OssnThemes;
include_once($themes->getActivePath());

//load active components
$coms = new OssnComponents;
$coms->loadComs();

/**
 * Initialize components
 *
 * @return bool
 * @access private;
 */ 
 
function ossn_components_init(){
  foreach(ossn_registered_com_panel() as $configure){
     ossn_register_menu_link('configure', 
							 $configure, 
							  ossn_site_url("administrator/component/{$configure}"), 
							 'topbar_admin');	
  }	
}
ossn_register_callback('ossn', 'init', 'ossn_components_init');
