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

require_once('libraries/bframework.install.php');
bframework_create_settingsfile(array(
               'site_url' => bframework_get_url(true),
			   'display_errors' => 'off',
			   'siteborn_time' => time()   
			   ));
$url = bframework_get_url(true);
header("Location: $url");
//bframework_installation_write();
/*bframework_instllation_header();
  if(empty($_GET['step'])){ bframework_instllation_requirments(); }
    if(isset($_GET['step']) && $_GET['step'] == '1'){ bframework_instllation_form(); }
       if(isset($_GET['step']) && $_GET['step'] == '2'){ bframework_instllation_ok();  } 
            bframework_instllation_footer(); 
			*/