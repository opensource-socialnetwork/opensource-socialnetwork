<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
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