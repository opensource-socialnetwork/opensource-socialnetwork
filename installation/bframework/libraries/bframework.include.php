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
* Register a return able include handler
* @uses bframework_include(<file>);
*/  
function bframework_include($file = '', $arg = array()){
if(isset($file) && is_file($file)){
   ob_start();
   $args = $arg;
   include_once($file);
   $contents = ob_get_clean();
   return $contents;
 }
}
/*
* Register a view handler
* @uses bframework_view(<path>, <file>);
*/  
function bframework_view($path = '', $arg = array()){
if(isset($path) && !empty($path)){
   return bframework_include($path.'.php', $arg);
  }
}  
