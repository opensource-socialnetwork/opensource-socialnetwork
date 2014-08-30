<?php
/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.com/licence
 */
 
$sitename = input('sitename');
$owneremail = input('owneremail');
$sitelang = input('sitelang');

if(empty($sitename) 
		 || empty($owneremail) 
		 || empty($sitelang)){
	redirect(REF);
}

ossn_site_setting_update('site_name', $sitename, 2);
ossn_site_setting_update('lang', $sitelang, 3);
ossn_site_setting_update('owner_email', $owneremail, 5);
ossn_trigger_message(ossn_print('settings:saved'), 'success', 'admin');
redirect(REF);