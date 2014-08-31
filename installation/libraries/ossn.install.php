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
function ossn_installation_url(){
  $type = true;
  $protocol = 'http';
  $uri = $_SERVER['REQUEST_URI'];
  if(!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
	  $protocol = 'https';
   }
  $port = ':' . $_SERVER["SERVER_PORT"];
  if ($port == ':80' || $port == ':443'){
     if($type == true){ 
	    $port = ''; 
	 }
  }
  $url = "$protocol://{$_SERVER['SERVER_NAME']}$port{$uri}";
  return preg_replace('/\\?.*/', '', $url);	
}
function ossn_url(){
   return str_replace('installation/', '', ossn_installation_url());	
}
function ossn_installation_paths(){
	global $OssnInstall;
	$path = str_replace("\\", "/", dirname(dirname(__FILE__)));
	$defaults = array(
		'root'  =>	"{$path}/",
		'url' => ossn_installation_url(),
		'ossn_url' => ossn_url(),

	);
	foreach ($defaults as $name => $value) {
		if (empty($OssnInstall->$name)) {
			$OssnInstall->$name = $value;
		}
	}
   return $OssnInstall;
}
function ossn_installation_include($file = '', $params = array()){
$file =  ossn_installation_paths()->root.$file;
if(!empty($file) && is_file($file)){
   ob_start(); $params = $params;	
   include($file);
   $contents = ob_get_clean();
   return $contents;
 }
  
}
function ossn_installation_register_languages($strings = array()){
	global $OssnInstall;
	$OssnInstall->langStrings = $strings;
}
function ossn_installation_languages(){
   include_once(ossn_installation_paths()->root.'locales/ossn.en.php');	
}
ossn_installation_languages();
function ossn_installation_print($string){
 global $OssnInstall; 
  if(isset($OssnInstall->langStrings[$string])){
	 return $OssnInstall->langStrings[$string];  
  } else {
	 return $string;  
  }
}
function ossn_installation_view_page($content, $title){
	return ossn_installation_include("templates/page.php", array(
	'contents' => $content,
	'title' => ossn_installation_print($title),
	));
}
function ossn_installation_page(){
   if(isset($_REQUEST['page'])){
	  $page = $_REQUEST['page'];   
   }
   if(!isset($page)){
	  $page = 'requirments';   
   }
   switch($page){
	 case 'requirments':
	  $data = ossn_installation_include('pages/check.php');
	  echo ossn_installation_view_page($data,  'ossn:check');
	 break;   
     case 'settings':
	  $data = ossn_installation_include('pages/settings.php');
	  echo ossn_installation_view_page($data,  'ossn:settings');
	 break;    
	 case 'account':
	  $data = ossn_installation_include('pages/account.php');
	  echo ossn_installation_view_page($data,  'ossn:setting:account');
	 break;
	case 'installed':
	  $data = ossn_installation_include('pages/installed.php');
	  echo ossn_installation_view_page($data,  'ossn:installed');
	 break;      
   }
}  
function ossn_installation_actions(){
   if(isset($_REQUEST['action'])){
	  $page = $_REQUEST['action'];   
   }
   if(!isset($page)){
	 return false;
   }
   switch($page){
	 case 'install':
	  include_once(ossn_installation_paths()->root.'actions/install.php');
	 break;   
	case 'account':
	 include_once(ossn_installation_paths()->root.'actions/account.php');
	 break;  
	case 'finish':
	 include_once(ossn_installation_paths()->root.'actions/finish.php');
	 break;  	      
   }
}  

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
