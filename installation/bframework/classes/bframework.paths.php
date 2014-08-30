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
 
/**
* bframework paths register a new class
* @version: 0.1
*/ 
class bframework_path{
	/**
	 * Counstruct a path for engine directory
	 */
    public function getEngine($extend = NULL){
    return bframework_get_engine_path().$extend;
    }
   /**
	* Counstruct a path for root directory
	*/
    public function getRoot($extend = NULL){
    return bframework_get_base_path().$extend;
    }
   /**
	* Counstruct a path for application langugaes directory
	*/
    public function getAppLang($extend = NULL){
    return bframework_get_app_languages_path().$extend;
    }
   /**
	* Counstruct a path for application root directory
	*/
    public function getAppRoot($extend = NULL){
    return bframework_get_approot_path().$extend;
    }
   /**
	* Counstruct a path for languages directory
	*/
    public function getLang($extend = NULL){
    return bframework_get_languages_path().$extend;
    }
    /**
	* Counstruct a path for Media root directory
	*/
    public function getMedia($extend = NULL){
    return bframework_get_media_path().$extend;
    }
	
}
?>