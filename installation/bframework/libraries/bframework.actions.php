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
* setting up a page handler
* @uses bframework_page_handler(array('handler' => 'contact', 'file' => '<path>'));
* @url 'handler' must be without space like mypage not my page
*/  

function bframework_actions_page_handler($params = array()){
if (isset($_GET['action'])){
    switch($_GET["action"]){
        case $params['handler']:
		if(is_file($params['file'])){
        include_once($params['file']);
		}
        break;
        default:
        $title = NULL;
    }
  }
}   
/*
* Register a core css
* @uses bframework_resgiser_core_css(<file>);
*/ 
function bframework_resgister_action($action ,$file){
if(isset($file)){bframework_actions_page_handler(array(
               'handler' => $action, 
			   'file' => $file
));
}
}