<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */

/**
 * Register a page handler;
 * @params: $handler = page;
 * @params: $function = function which handles page;
 * @param string $handler
 * @param string $function
 *
 * @last edit: $arsalanshah
 * @Reason: Initial;
 */
function ossn_register_page($handler, $function) {
    global $Ossn;
    $pages = $Ossn->page[$handler] = $function;
    return $pages;
}
/**
 * Unregister a page from syste,
 * @param (string) $handler Page handler name;
 *
 * @last edit: $arsalanshah
 * @return void;
 */
function ossn_unregister_page($handler) {
    global $Ossn;
    unset($Ossn->page[$handler]);
}

/**
 * Output a page.
 *
 * If page is not registered then user will see a 404 page;
 *
 * @param  (string) $handler Page handler name;
 * @param  (string) $page  handler/page;
 * @last edit: $arsalanshah
 * @Reason: Initial;
 *
 * @return mix|null data
 * @access private
 */

function ossn_load_page($handler, $page) {
    global $Ossn;
	$context = $handler;
	if(isset($page) && !empty($page)){
		$context = "$handler/$page";
	}
    //set context
	ossn_add_context($context);
    
	$page = explode('/', $page);
    if(isset($Ossn->page) && isset($Ossn->page[$handler]) && !empty($handler) && is_callable($Ossn->page[$handler])){
       
	    //get page contents
	    ob_start();
        call_user_func($Ossn->page[$handler], $page, $handler);
	    $contents = ob_get_clean();
		
		//supply params to hook
        $params['page'] 	= $page;
        $params['handler'] 	= $handler;
		
        return ossn_call_hook('page', 'load', $params, $contents);
    } else {
        return ossn_error_page();
    }

}

/**
 * Set page owner guid, this is very useful
 *
 * @param (int) $guid  Guid of owner
 *
 * @return void
 */

function ossn_set_page_owner_guid($guid) {
    global $Ossn;
    $Ossn->pageOwnerGuid = $guid;
}

/**
 * Get page owner guid
 *
 * @return (int)
 */

function ossn_get_page_owner_guid() {
    global $Ossn;
    return $Ossn->pageOwnerGuid;
}