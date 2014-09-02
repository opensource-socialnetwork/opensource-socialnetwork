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
* Register a page handler;
* @params: $handler = page;
* @params: $function = function which handles page;
*
* @last edit: $arsalanshah
* @Reason: Initial;
*/
function ossn_register_page($handler, $function){
  global  $Ossn;
  $pages = $Ossn->page[$handler] = $function;
  return $pages;
}
function ossn_unregister_page($handler){
  global  $Ossn;
  unset($Ossn->page[$handler]);
}
/**
 * Output a page.
 *
 * If page is not registered then user will see a 404 page;
 *
 * @params: #handler  = page handler;
 * @params:  $page = subpage;
 * @last edit: $arsalanshah
 * @Reason: Initial;
 *
 * @return mixed data
 * @access private
 */

function ossn_load_page($handler, $page){
global $Ossn;
ossn_add_context($handler);
$page = explode('/', $page);
if(isset($Ossn->page) 
		 && isset($Ossn->page[$handler]) 
		 && !empty($handler) 
		 && is_callable($Ossn->page[$handler])){
                   ob_start();
				   call_user_func($Ossn->page[$handler], $page, $handler);
				   $contents = ob_get_clean();
				   return $contents;
} 
else {      
           return ossn_error_page();
}

}
/**
 * Set page owner guid, this is very useful
 *
 * @params = $guid => owner guid
 *
 * @return void
 */ 

function ossn_set_page_owner_guid($guid){
	global $Ossn;
	$Ossn->pageOwnerGuid = $guid;
}
/**
 * Get page owner guid
 *
 * @return (int)
 */ 

function ossn_get_page_owner_guid(){
   	global $Ossn;
	return $Ossn->pageOwnerGuid;	
}