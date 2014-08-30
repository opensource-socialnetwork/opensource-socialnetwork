<?php
/**
 * Buddyexpress Framework Core
 *
 * @package   Bframework
 * @author    Buddyexpress Core Team <admin@buddyexpress.net
 * @copyright 2012 BUDDYEXPRESS.
 * @license   Buddyexpress Public License http://www.buddyexpress.net/Licences/bpl/ 
 * @link      http://bserver.buddyexpress.net
 * @Contributors http://www.buddyexpress.net/bframework/contributors.b
 */


/**
* Bframework Print Message 
* $var if message is true then $var is 1 else it is 2
* $msg message
*/

function bframework_installation_msg($var = '', $msg =''){
if(!empty($var) && !empty($msg)){ 
    if($var == 1){
     $true = '<div class="bframework-success"><div class="bframework_msg">'.$msg.'</div></div><br/>';
     return $true;
    }
	if($var == 'false'){
$false = '<div class="bframework-fail"><div class="bframework_msg">'.$msg.'</div></div><br/>';
return $false;
    }
   }
}
/*
 * Get Core Version 
 * @return return false if values does not match
 * @uses bframework_get_version();
 */
function bframework_installation_get_version(){
    static $BframeworkVersion;
	if (!isset($BframeworkVersion)) {
			if (!include(bframework_installation('root') ."version.php")) {
				return false;
			}
		}
	return $BframeworkVersion;
} 

/**
* Bframework Installation Paths Configure
*/ 
function bframework_installation($params = ''){ 
$install = str_replace("\\", "/", dirname(dirname(dirname(__FILE__))));
$install_main = str_replace("\\", "/", dirname(dirname(__FILE__)));

if($params == 'engine'){
return $install.'/engine/';
   }
if($params == 'root'){
return $install.'/';
   }
if($params = 'template'){
return $install_main.'/template/';
   }
}
/**
* Bframework Check Php version 
* $params[] use ['true'] if you want to print message on true
* $params[] use ['false'] if you want to print message on false
*/
function bframework_php_check($params = ''){
if(substr(PHP_VERSION, 0, 6) >= 5.3){
   return $params['true'];
   } else {
   return $params['false'];
 }
} 
/**
* Bframework installation header setup
*/
function bframework_instllation_header(){
include(bframework_installation('template').'header.php');
}
/**
* Bframework installation forms setup
*/
function bframework_instllation_form(){
include(bframework_installation('template').'form.php');
}
/**
* Bframework installation final step setup
*/
function bframework_instllation_ok(){
include(bframework_installation('template').'ok.php');
}
/**
* Bframework installation footer setup
*/
function bframework_instllation_footer(){
include(bframework_installation('template').'footer.php');
}
/**
* Bframework installation requirment's setup
*/
function bframework_instllation_requirments(){
include(bframework_installation('template').'requirements.php');
}
/**
* Bframework installation configuration write
*/
function bframework_create_settingsfile($params) {
		$templateFile = bframework_installation('engine')."settings.example.php";
		$template = file_get_contents($templateFile);
		if (!$template) {
			return FALSE;
		}

		foreach ($params as $k => $v) {
			$template = str_replace("<<" . $k . ">>", $v, $template);
		}

		$settingsFilename = bframework_installation('engine')."settings.php";
		$result = file_put_contents($settingsFilename, $template);
		if (!$result) {
		return FALSE;
		}

		return TRUE;
	}
/**
* Bframework installation configuration write
*/
function bframework_installation_write(){
if(isset($_POST["siteurl"]) && !empty($_POST["siteurl"])){
bframework_create_settingsfile(array(
               'site_url' => bframework_get_url(true),
			   'display_errors' => 'off',
			   'siteborn_time' => time()   
			   ));
header('Location: ?step=2');
    }
}
/**
* Bframework installation self url get
*/
function bframework_get_installation_url(){
return $_SERVER['PHP_SELF'];
}
/** 
* Bframework detect a site url
*/
function bframework_get_url($params = ''){
		$protocol = 'http';
		$uri = $_SERVER['REQUEST_URI'];
		$remove = strpos($uri, 'bframework/install/');
		if($params == true){ $uri = substr($uri, 0, $remove); }
		if (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$protocol = 'https';}
		$port = ':' . $_SERVER["SERVER_PORT"];
		if ($port == ':80' || $port == ':443'){
       		if($params == true){ $port = ''; }
		}
		$url = "$protocol://{$_SERVER['SERVER_NAME']}$port{$uri}";
		return $url;
}		
/**
* Bframework return true if requirments fullfill's
*/
function bframework_check_premission(){
if(substr(PHP_VERSION, 0, 6) >= 5.3 && extension_loaded('curl') && in_array('mod_rewrite' , apache_get_modules())){
return true;
} else {
return false;
  }
}
/**
* Bframework installation return continue button if requirments fullfill's
*/
function bframework_requirements_next(){
if(bframework_check_premission()){
echo '<form method="post" action="'.bframework_get_installation_url().'?step=1">
    <button class="button-submit" type="submit">Continue</button>
</form>';
 }
}
  
