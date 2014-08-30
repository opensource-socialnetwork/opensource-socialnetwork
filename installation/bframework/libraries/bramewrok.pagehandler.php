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
function bframework_page_handler($params = array()){
if (isset($_GET['bframework'])){
    switch($_GET["bframework"]){
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
?>