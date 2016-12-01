<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$enable 	 = new OssnThemes;
$theme 		 = input('theme');
$cache_flush = input('flush_cache', '', false);
$cache		 = ossn_site_settings('cache');

if (!$cache_flush && $enable->Enable($theme)) {
    ossn_trigger_message(ossn_print('theme:enabled'), 'success');
   if($cache == false){
		redirect(REF);
	} else {
		//redirect and flush cache
		$page = "action/theme/enable?flush_cache=1";
		$page = ossn_add_tokens_to_url($page);
		redirect($page);
	}
}

if($cache_flush){
	if(ossn_disable_cache()){
		if(ossn_create_cache()){
				redirect('administrator/themes');
		}
  	}	
}