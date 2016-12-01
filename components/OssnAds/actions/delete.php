<?php
/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$delete = new OssnAds;
$entites = $_REQUEST['entites'];
foreach($entites as $entity){
   $entity = get_ad_entity((int)$entity);
   if(empty($entity->guid)){
 	  ossn_trigger_message(ossn_print('ad:delete:fail'), 'error');
   } else {
       if (!$delete->deleteAd($entity->guid)) {
		ossn_trigger_message(ossn_print('ad:delete:fail'), 'error');
	   } else {
		ossn_trigger_message(ossn_print('ad:deleted', array($entity->title)), 'success');  
	   }	   
   }
}

redirect(REF);