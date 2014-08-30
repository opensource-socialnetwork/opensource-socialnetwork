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
* Register a default page
* @uses bframework_get_engine_path();
*/  
function bframework_page_default($title = '' , $body = '' , $header = '', $footer = '',$head = '', $view = NULL){
$page['body'] = $body;
$page['header'] = $header;
$page['footer'] = $footer;
$page['title'] = $title;
$page['head'] = $head;
if(empty($view)){
     if(!is_file(bframework_get_approot_path().'views/default/layout/default.php')){
     include(bframework_get_base_path().'views/layout/default.php');
     } else {
     include(bframework_get_approot_path().'views/default/layout/default.php'); 
     }
} elseif(!empty($view) && is_file(bframework_get_approot_path()."views/default/layout/{$view}.php")){
     include(bframework_get_approot_path()."views/default/layout/{$view}.php");
   }	 
}
/*
* Register a default page layout
* @uses bframework_view_page(array());
*/ 
function bframework_view_page($params = array(), $view = NULL){
if(isset($params['body'])){$body = $params['body'];} else { $body = ''; }
if(isset($params['title'])){ $title = $params['title']; } else { $title = ''; }
if(isset($params['header'])){$header = $params['header']; } else {$header = ''; }
if(isset($params['head'])){$head = $params['head']; } else {$head = ''; }
if(isset($params['footer'])){$footer = $params['footer']; } else { $footer = ''; }

bframework_page_default($title, $body, $header, $footer, $head, $view);   
}
