<?php
/**
 * Buddyexpress Framework Core
 *
 * @package   Bframework
 * @author    Buddyexpress Core Team <admin@buddyexpress.net
 * @copyright 2012 BUDDYEXPRESS.
 * @license   Buddyexpress Public License http://www.buddyexpress.net/Licences/bpl/ 
 * @link      http://bserver.buddyexpress.net
 * @Contributors http://www.buddyexpress.net/bframework/contributors.b
 */
/*
* Setting up a path
* @uses system;
*/  
function bframework_paths(){
	global $Bframework;
	$install_root = str_replace("\\", "/", dirname(dirname(__FILE__)));
    $install_app_root = str_replace("\\", "/", dirname(dirname(dirname(__FILE__))));
	$defaults = array(
		'root_path'			=>	"$install_root/",
		'app_root_path'			=>	"$install_app_root/application/",
		'libs'		=>	"$install_root/libraries/",
		'engine'	=>	"$install_root/engine/",
		'languages'		=>	"$install_root/languages/",
		'app_languages'		=>	"$install_app_root/application/languages/",
		'actions'	=>	"$install_root/actions/",
		'media'	=>	"$install_root/media/",
		'vendors'	=>	"$install_root/vendors/",
		'classes' => "$install_root/classes/",
	);

	foreach ($defaults as $name => $value) {
		if (empty($Bframework->$name)) {
			$Bframework->$name = $value;
		}
	}

}
/*
* Fetch a engine directory
* @uses bframework_get_engine_path();
*/ 
function bframework_get_engine_path(){
global $Bframework;
if(isset($Bframework->engine) && !empty($Bframework->engine)){
return $Bframework->engine;
   }   
}
/*
* Fetch a libs directory
* @uses bframework_get_libs_path();
*/ 
function bframework_get_libs_path(){
global $Bframework;
if(isset($Bframework->libs) && !empty($Bframework->libs)){
return $Bframework->libs;
   }   
}
/*
* Fetch a base directory
* @uses bframework_get_base_path();
*/ 
function bframework_get_base_path(){
global $Bframework;
if(isset($Bframework->root_path) && !empty($Bframework->root_path)){
return $Bframework->root_path;
   }   
}
/*
* Fetch a classes directory
* @uses bframework_get_classes_path();
*/ 
function bframework_get_classes_path(){
global $Bframework;
if(isset($Bframework->classes) && !empty($Bframework->classes)){
return $Bframework->classes;
   }   
}
/*
* Fetch a actions directory
* @uses bframework_get_actions_path();
*/
function bframework_get_actions_path(){
global $Bframework;
if(isset($Bframework->actions) && !empty($Bframework->actions)){
return $Bframework->actions;
   }   
}
/*
* Fetch a vendors directory
* @uses bframework_get_vendors_path();
*/
function bframework_get_vendors_path(){
global $Bframework;
if(isset($Bframework->vendors) && !empty($Bframework->vendors)){
return $Bframework->vendors;
   }   
}
/*
* Fetch a meda directory
* @uses bframework_get_media_path();
*/
function bframework_get_media_path(){
global $Bframework;
if(isset($Bframework->media) && !empty($Bframework->media)){
return $Bframework->media;
    }    
}
/*
* Fetch a languages directory
* @uses bframework_get_languages_path();
*/
function bframework_get_languages_path(){
global $Bframework;
if(isset($Bframework->languages) && !empty($Bframework->languages)){
return $Bframework->languages;
    }    
}
/*
* Fetch a application base directory
* @uses bframework_get_languages_path();
*/
function bframework_get_approot_path(){
global $Bframework;
if(isset($Bframework->app_root_path) && !empty($Bframework->app_root_path)){
return $Bframework->app_root_path;
    }    
}
/*
* Fetch a application languages directory
* @uses bframework_get_app_languages_path();
*/
function bframework_get_app_languages_path(){
global $Bframework;
if(isset($Bframework->app_languages) && !empty($Bframework->app_root_path)){
return $Bframework->app_languages;
    }    
}
?>