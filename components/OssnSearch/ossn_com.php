<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence 
 * @link      http://www.opensource-socialnetwork.org/licence
 */

define('__OSSN_SEARCH__', ossn_route()->com.'OssnSearch/');
require_once(__OSSN_SEARCH__.'classes/OssnSearch.php');

function ossn_search(){
  ossn_register_page('search', 'ossn_search_page');
  ossn_add_hook('search', "left", 'search_menu_handler');

  ossn_extend_view('css/ossn.default', 'components/OssnSearch/css/search');
}
function search_menu_handler($hook, $type, $return){
	$return[] = ossn_view_menu('search');
	return $return;
}
function ossn_search_page($pages){
	$page = $pages[0];
    if(empty($page)){
		$page = 'search';
	}
	ossn_trigger_callback('page', 'load:search');	
	switch($page){
		case 'search':
		$query = input('q');
		$type = input('type');
		if(empty($type)){
		 $params['type'] = 'users';
	    } else {
		  $params['type'] = $type;	
		}
  		 $type = $params['type'];
         if(ossn_is_hook('search', "type:{$type}")){
     	    $contents['contents'] = ossn_call_hook('search', "type:{$type}", array('q' => input('q')));   
          }
		 $contents = array(
						'content' =>  ossn_view('components/OssnSearch/pages/search', $contents),
						);
	       $content = ossn_set_page_layout('search', $contents);
           echo ossn_view_page($title, $content); 
  		break;
		default:
		ossn_error_page();
		break;
	}
}
ossn_register_callback('ossn', 'init', 'ossn_search');
