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
$custom_settings = ossn_goblue_get_custom_logos_bgs_setting();

$site = new OssnFile();
$site->setFile('logo_site');
$site->setExtension(array(
		'jpg',
		'png',
		'jpeg',
		'jfif',
		'gif',
		'webp',
));

$logo_dir = ossn_route()->themes . "goblue/logos_backgrounds/";
//[B] Logo upload failed #2369
if(!is_dir($logo_dir)){
		mkdir($logo_dir, 0755, true);	
}
if(isset($site->file['tmp_name']) && $site->typeAllowed()) {
		$file = $site->file['tmp_name'];
		$size = filesize($file);
		if($size > 0) {
				if($size > 500000) {
						//500KB
						ossn_trigger_message(ossn_print('theme:goblue:logo:large'), 'error');
						redirect(REF);
				}
				$contents  = file_get_contents($file);
				$path_info = pathinfo($site->file['name']);
				$filename  = md5($site->file['name'] . time() . 'logo_site') . '.' . $path_info['extension'];
				$tosave    = ossn_route()->themes . "goblue/logos_backgrounds/logo_site_{$filename}";

				if(strlen($contents) > 0 && file_put_contents($tosave, $contents)) {
						//delete old one
						if(isset($custom_settings['logo_site'])) {
								$tounlink = ossn_route()->themes . "goblue/logos_backgrounds/{$custom_settings['logo_site']}";
								unlink($tounlink);
						}
						ossn_goblue_set_custom_logos_bgs_setting('logo_site', $filename);

						$cache = ossn_site_settings('cache');
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
$admin = new OssnFile();
$admin->setFile('logo_admin');
$admin->setExtension(array(
		'jpg',
		'png',
		'jpeg',
		'jfif',
		'gif',
		'webp',
));
if(isset($admin->file['tmp_name']) && $admin->typeAllowed()) {
		$file = $admin->file['tmp_name'];
		$size = filesize($file);
		if($size > 0) {
				if($size > 500000) {
						//500KB
						ossn_trigger_message(ossn_print('theme:goblue:logo:large'), 'error');
						redirect(REF);
				}
				$contents  = file_get_contents($file);
				$path_info = pathinfo($admin->file['name']);
				$filename  = md5($admin->file['name'] . time() . 'logo_admin') . '.' . $path_info['extension'];
				$tosave    = ossn_route()->themes . "goblue/logos_backgrounds/logo_admin_{$filename}";

				if(strlen($contents) > 0 && file_put_contents($tosave, $contents)) {
						//delete old one
						if(isset($custom_settings['logo_admin'])) {
								$tounlink = ossn_route()->themes . "goblue/logos_backgrounds/logo_admin_{$custom_settings['logo_admin']}";
								unlink($tounlink);
						}
						ossn_goblue_set_custom_logos_bgs_setting('logo_admin', $filename);

						$cache = ossn_site_settings('cache');
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
if($done === true) {
		ossn_trigger_message(ossn_print('theme:goblue:logo:changed'));
		redirect(REF);
} elseif($done == 2) {
		//redirect and flush cache
		ossn_trigger_message(ossn_print('theme:goblue:logo:changed'));
		$action = ossn_add_tokens_to_url('action/admin/cache/flush');
		redirect($action);
} else {
		ossn_trigger_message(ossn_print('theme:goblue:logo:failed'), 'error');
		redirect(REF);
}
