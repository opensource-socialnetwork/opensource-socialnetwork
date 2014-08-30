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
 * Get Core Version 
 * @return return false if values does not match
 * @uses bframework_get_version();
 */
function bframework_get_version(){
    static $BframeworkVersion;
	if (!isset($BframeworkVersion)) {
			if (!include(bframework_get_base_path() ."version.php")) {
				return false;
			}
		}
	return $BframeworkVersion;
} 
/*
 * Get Core Release
 * @return return false if values does not match
 * @uses bframework_get_release();
 */
function bframework_get_release(){
    static $BframeworkRelease;
	if (!isset($BframeworkRelease)) {
			if (!include(bframework_get_base_path() ."version.php")) {
				return false;
			}
		}
	return $BframeworkRelease;
} 
/*
 * Get application version
 * @return return false if values does not match
 * @uses bframework_get_app_version();
 */
function bframework_get_app_version(){
    static $BframeworkVersion;
	if (!isset($BframeworkVersion)) {
	if(is_file(bframework_get_approot_path()."application.php")){
			if (!include(bframework_get_approot_path()."application.php")) {
				return false;
			}
	}		
		}
	return $BframeworkVersion;
} 
/*
 * Get application Release
 * @return return false if values does not match
 * @uses bframework_get_app_release();
 */

function bframework_get_app_release(){
    static $BframeworkRelease;
	if (!isset($BframeworkRelease)) {
	if(is_file(bframework_get_approot_path()."application.php")){
			if (!include(bframework_get_approot_path()."application.php")) {
				return false;
			}
	}		
		}
	return $BframeworkRelease;
} 
/*
 * Get application Name
 * @return return false if values does not match
 * @uses bframework_get_app_name();
 */

function bframework_get_app_name(){
    static $BframeworkAppName;
	if (!isset($BframeworkAppName)) {
	if(is_file(bframework_get_approot_path()."application.php")){
			if (!include(bframework_get_approot_path()."application.php")) {
				return false;
			}
	}		
		}
	return $BframeworkAppName;
} 
/*
 * Get application Name, Version , Release
 * @return return false if values does not match
 * @uses bframework_get_app('name');
 * @uses bframework_get_app('version');
 * @uses bframework_get_app('release');
 */

function bframework_get_app($params){
if(isset($params) && !empty($params)){
   if($params == 'name'){
   return bframework_get_app_name();
      }
   if($params == 'release'){
   return bframework_get_app_release();
	  }
   if($params == 'version'){
   return bframework_get_app_version();
	  }     
    }
}
/*
 * Get application admin email
 * @return return false if values does not match
 * @uses bframework_app_admin_email();
 */
function bframework_app_admin_email(){
    static $BframeworkadminEmail;
	if (!isset($BframeworkadminEmail)) {
	if(is_file(bframework_get_approot_path()."application.php")){
			if (!include(bframework_get_approot_path()."application.php")) {
				return false;
			}
	}		
		}
	return $BframeworkadminEmail;
}