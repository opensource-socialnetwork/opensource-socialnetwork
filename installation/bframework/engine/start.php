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

$lib_dir = dirname(dirname(__FILE__)) . '/libraries/';
$lib = 'bframework.php';
$path = $lib_dir .$lib ;
include_once($path); 
if(is_file(bframework_get_engine_path().'settings.php')){
      include_once(bframework_get_engine_path().'settings.php');
} else {
      header('Location: bframework/install/index.php');
exit;
}		
