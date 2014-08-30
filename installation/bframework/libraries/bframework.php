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
 
global $Bframework;
if (!isset($Bframework)) {
	$Bframework = new stdClass;
} 

if(is_file(dirname(__FILE__).'/bframework.paths.php')){
include(dirname(__FILE__).'/bframework.paths.php');
} else {
die('library "bframework.paths.php" was not found all libraries are required.');
}
bframework_paths();

$libs = array('bframework.exception.php','bframework.datetime.php','bframework.curl.php','bframework.include.php','bframework.args.php','bframework.html.elements.php','bframework.url.php','bramewrok.pagehandler.php','bframework.css.php','bframework.js.php','bframework.languages.php','bframework.application.php','bframework.page.php','bframework.forms.php','bframework.mail.php','bframework.mysql.php','bframework.actions.php');
$classes = array('bframework.paths.php','bframework.GetException.php','bframework.AppException.php','bframework.CallException.php','bframework.ClassNotFoundException.php','bframework.DatabaseException.php','bframework.InstallationException.php');

foreach($libs as $lib){
include($lib);
}
foreach($classes as $class){
include(bframework_get_classes_path().$class);
}

