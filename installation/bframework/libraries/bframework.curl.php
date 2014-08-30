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
* Regestring a cUrl
* @uses bframework_core_print('<file>');
* bool curl_setopt ( resource $ch , int $option , mixed $value );
* void curl_close ( resource $ch );
*/  
function bframework_curl($file = '') {	
if(isset($file)){
	$curlinit = curl_init();
	curl_setopt($curlinit, CURLOPT_URL, $file);
	curl_setopt($curlinit, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($curlinit);
	curl_close($curlinit);
}
return $result;
}