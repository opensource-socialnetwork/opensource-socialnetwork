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
global $OssnInstall;
if (!isset($OssnInstall)) {
	$OssnInstall = new stdClass;
} 
session_start();
if(is_file('INSTALLED')){
    exit('It seems the Opensource-Socialnetwork is already installed');
}
require_once('/libraries/ossn.install.php');
require_once('/classes/OssnInstall.php');
if(!isset($_REQUEST['action'])){ 
   ossn_installation_page();
}
if(!isset($_REQUEST['page'])){
   ossn_installation_actions();	
}
  

