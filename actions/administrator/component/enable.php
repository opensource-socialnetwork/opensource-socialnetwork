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
 
$enable = new OssnComponents;
$com = input('com');
if($enable->ENABLE($com)){
       ossn_trigger_message(ossn_print('com:enabled'), 'error', 'admin');	
	   redirect(REF);	
}