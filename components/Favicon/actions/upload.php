<?php
require_once(ossn_route()->com . 'Favicon/classes/Favicon.php');
if(Favicon::Upload()){
		ossn_trigger_message(ossn_print('Favicon updated'));
		redirect(REF);
} else {
		ossn_trigger_message(ossn_print('Favicon update error'), 'error');
		redirect(REF);	
}