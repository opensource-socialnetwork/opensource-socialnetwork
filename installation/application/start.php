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
 

$core = dirname(dirname(dirname(__FILE__)));
require_once(dirname(dirname(__FILE__)).'/bframework/buddyexpress.php'); 
session_start();

function ossn_installation_message($message, $type){
	$_SESSION['ossn-installation-messages']["ossn-installation-{$type}"][] = $message;
}
function ossn_installation_messages(){
  if(!isset($_SESSION['ossn-installation-messages'])){
	  return false;  
  }
  foreach($_SESSION['ossn-installation-messages'] as $message => $data){
	   foreach($data as $msg){
	              $msgs[] = "<div class='ossn-installation-message {$message}'>{$msg}</div>";
	   }
  }
  unset($_SESSION['ossn-installation-messages']);
  return implode('', $msgs);
}
if(is_file(bframework_get_approot_path().'INSTALLED')){
    exit('It seems the Opensource-Socialnetwork is already installed');
}

require_once(bframework_get_approot_path().'classes/OssnInstall.php');

bframework_register_css('css/css.php');

bframework_page_handler(array(
							  'handler' => 'index', 
							  'file' => bframework_get_approot_path().'pages/index.php'
							  ));
bframework_page_handler(array(
							  'handler' => 'settings', 
							  'file' => bframework_get_approot_path().'pages/settings.php'
							  ));
bframework_page_handler(array(
							  'handler' => 'check', 
							  'file' => bframework_get_approot_path().'pages/check.php'
							  ));

bframework_page_handler(array(
							  'handler' => 'installed', 
							  'file' => bframework_get_approot_path().'pages/installed.php'
							  ));
							  
bframework_page_handler(array(
							  'handler' => 'account', 
							  'file' => bframework_get_approot_path().'pages/account.php'
							  ));
bframework_resgister_action('install', bframework_get_approot_path().'actions/install.php');


bframework_resgister_action('finish', bframework_get_approot_path().'actions/finish.php');
bframework_resgister_action('account', bframework_get_approot_path().'actions/useradd.php');

function Bdesk_url(){
  return str_replace('installation/', '', bframework_get_url());
}