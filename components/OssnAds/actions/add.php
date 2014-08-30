<?php
/**
 * OpenSocialWebsite
 *
 * @package   OpenSocialWebsite
 * @author    Open Social Website Core Team <info@opensocialwebsite.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensocialwebsite.com/licence 
 * @link      http://www.opensocialwebsite.com/licence
 */
$add = new OssnAds;

$params['title'] = input('title');
$params['description'] = input('description');
$params['siteurl'] = input('siteurl');
foreach($params as $field){
  if(empty($field)){
    ossn_trigger_message(ossn_print('fields:required'), 'error', 'admin');
	redirect(REF);			   
   }
}

if($add->addNewAd($params)){
    ossn_trigger_message(ossn_print('ad:created'), 'success', 'admin');
	redirect(REF);		
} else {
    ossn_trigger_message(ossn_print('ad:create:fail'), 'success', 'admin');
	redirect(REF);		
}
