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
* Bframework exception setup
* bframework_register_exception(<message>), <message>
*/  
function bframework_register_exception($exception){
if(isset($exception)){
echo bframework_div(array('attr' => array('style' => 'background:#F6CBCA;border:1px #CB2026 solid;color:#CB2026;font-weight:bold;','class' => 'bframework_error_red','align' => 'center'))); 
 echo "Exception: " , $exception->getMessage().' '.$exception->getFile()." Line number ".$exception->getLine();
 echo bframework_div(array('close' => 'close'));
 exit();
  }
}
set_exception_handler('bframework_register_exception');

