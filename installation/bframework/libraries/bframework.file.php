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
 * write a file with data
 * @params File
 * @data the data that is to be replaced
 * @access system
 */	
function bframework_write_file($file, $data) {
if(!empty($file) && !empty($data)){
  if (is_array($data)){
        file_put_contents($file, $data);
      } else {
        file_put_contents($file, $data);
      }
   }
}
/*
 * backup a file
 * $params get array
 * @access system
 */	
function bframework_backup($file = ''){
if(isset($file) && !empty($file) && is_array($file)){
    $file = $file['file'];
    $renamefile = $file['newfile'];
    $error = $file['file'];
    if (!copy($file, $renamefile)) {
     return false;     
	 } 
  } 
}  

