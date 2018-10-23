<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
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

  