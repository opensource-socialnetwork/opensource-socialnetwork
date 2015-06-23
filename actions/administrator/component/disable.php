<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */

$component = new OssnComponents;

$com 		 = input('com');
$cache_flush = input('flush_cache', '', false);
$cache		 = ossn_site_settings('cache');

if (!$cache_flush && $component->DISABLE($com)) {
    ossn_trigger_message(ossn_print('com:disabled'));
   if($cache == false){
		redirect(REF);
	} else {
		//redirect and flush cache
		$page = "action/component/disable?flush_cache=1";
		$page = ossn_add_tokens_to_url($page);
		redirect($page);
	}
}
if($cache_flush){
	if(ossn_disable_cache()){
		if(ossn_create_cache()){
				redirect('administrator/components');
		}
  	}	
}