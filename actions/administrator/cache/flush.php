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
 
 $disable = input('disabled');
 if(ossn_site_settings('cache') == true || !empty($disable)){
  	if(ossn_disable_cache() && empty($disable)){
				//flush cache didn't flush the plugins path #460
				$action =  ossn_add_tokens_to_url("action/admin/cache/flush?disabled=disabled");
				redirect($action);		
  	} elseif($disable == 'disabled'){
		if(ossn_create_cache()){
			    ossn_trigger_message(ossn_print('cache:flushed'));
				redirect(REF);
		}
	}
 } 
 ossn_trigger_message(ossn_print('cache:flush:error'), 'error');
 redirect(REF);

  