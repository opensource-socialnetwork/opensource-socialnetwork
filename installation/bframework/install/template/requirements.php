<?php
/**
 * Buddyexpress Framework Core
 *
 * @package   Bframework
 * @author    Syed Arsalan Hussain Shah <arsalan@buddyexpress.net>
 * @copyright 2012 BUDDYEXPRESS.
 * @license   Buddyexpress Public License http://www.buddyexpress.net/Licences/bpl/ 
 * @link      http://bserver.buddyexpress.net
 * @Contributors http://www.buddyexpress.net/bframework/contributors.b
 */

$true =  bframework_installation_msg(1,'You have right php version '.PHP_VERSION);
$false = bframework_installation_msg('false','You have wrong php version '.PHP_VERSION.' Please update to php 5.3 or higher');
echo bframework_php_check(array(
        'true' => $true,
	    'false' => $false
 ));

if(extension_loaded('curl')){ 

echo  bframework_installation_msg(1,'cURL extension found, GOOD!'); 

} else { 

echo bframework_installation_msg('false','cURL extension need, Please enable it.'); 

}

if (in_array('mod_rewrite' , apache_get_modules())) { 

echo bframework_installation_msg(1,'Apache mod_rewrite found, NICE!');

}  else { 

echo bframework_installation_msg('false','Apache mod_rewrite need, please enablle it.'); 

}


bframework_requirements_next();
?>