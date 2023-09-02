<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 
$site  = new OssnFile;
$site->setFile('logo_site');
$site->setExtension(array(
		'png',
));
if(isset($site->file['tmp_name']) && $site->typeAllowed()){
	$file = $site->file['tmp_name'];
	$size = filesize($file);
	if($size > 0){
			if($size > 500000){ //500KB
					ossn_trigger_message(ossn_print('theme:goblue:logo:large'), 'error');
					redirect(REF);
			}
			$contents = file_get_contents($file);
			if(strlen($contents) > 0 && file_put_contents(ossn_route()->themes.'goblue/images/logo.png', $contents)){
					$cache  = ossn_site_settings('cache');
					if($cache == false) {
							$done = true;
					} else {
							$done = 2;
					}								
			} else {
				$done = false;
		
			}
	}
}
$admin  = new OssnFile;
$admin->setFile('logo_admin');
$admin->setExtension(array(
		'jpg',
		'jpeg',
		'jfif',
));
if(isset($admin->file['tmp_name']) && $admin->typeAllowed()){
	$file = $admin->file['tmp_name'];
	$size = filesize($file);
	if($size > 0){
			if($size > 500000){ //500KB
					ossn_trigger_message(ossn_print('theme:goblue:logo:large'), 'error');
					redirect(REF);
			}
			$contents = file_get_contents($file);
			if(strlen($contents) > 0 && file_put_contents(ossn_route()->themes.'goblue/images/logo_admin.jpg', $contents)){
					$cache  = ossn_site_settings('cache');
					if($cache == false) {
							$done = true;
					} else {
							$done = 2;
					}								
			} else {
				$done = false;
		
			}
	}
}
if($done === true){
	ossn_trigger_message(ossn_print('theme:goblue:logo:changed'));
	redirect(REF);	
} elseif($done == 2){
	//redirect and flush cache
	ossn_trigger_message(ossn_print('theme:goblue:logo:changed'));	
	$action = ossn_add_tokens_to_url("action/admin/cache/flush");
	redirect($action);	
} else {
	ossn_trigger_message(ossn_print('theme:goblue:logo:failed'), 'error');
	redirect(REF);		
}
