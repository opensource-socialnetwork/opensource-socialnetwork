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
 

class OssnInstallation {
/**
* Get database user;
* @last edit: $arsalanshah
* @Reason: Initial;
* 
*/ 
public function dbusername($username){
	if(!empty($username)){
	   $this->dbusername = $username;	
	} 
	else {
	  $this->dbusername = 'root';	
	}
}
/**
* Get db password;
* @last edit: $arsalanshah
* @Reason: Initial;
* 
*/ 
public function dbpassword($password){
	   $this->dbpassword = $password;	
}
/**
* Get databasename;
* @last edit: $arsalanshah
* @Reason: Initial;
* 
*/ 
public function dbname($dbname){
	if(!empty($dbname)){
	   $this->dbname = $dbname;	
	} 
	else {
	   $this->dbname = 'BuddyexpressDesk';	
	}
}
/**
* Get db host;
* @last edit: $arsalanshah
* @Reason: Initial;
* 
*/ 
public function dbhost($dbhost){
	if(!empty($dbhost)){
	   $this->dbhost = $dbhost;	
	} 
	 else {
		   $this->dbhost = 'localhost';		
	}
}
/**
* Get web url;
* @last edit: $arsalanshah
* @Reason: Initial;
* 
*/ 
public function weburl($weburl){
	if(!empty($weburl)){
	   $this->weburl = $weburl;	
	}
}

/**
* Set a datadriectory;
* @last edit: $arsalanshah
* @retun void;
* 
*/ 
public function datadir($dir){
	   $this->datadir = $dir;	
}
/**
* Connect to database;
* @last edit: $arsalanshah
* @Reason: Initial;
* 
*/ 
public function dbconnect(){	
$connect =  new mysqli(
					   $this->dbhost, 
					   $this->dbusername, 
					   $this->dbpassword, 
					   $this->dbname
					   );
if($connect->connect_errno){
	$this->connect_err->connect_errn = mysqli_connect_error();
	return false;
} 
else {
    	return $connect;
}

}
public function setStartupSettings($data){
	$this->startup_settings = $data;
}
/**
* Database configuration;
* @last edit: $arsalanshah
* @Reason: Initial;
* 
*/ 
function configurations_db(){
$params = array(
		'host' => $this->dbhost,
		'user' => $this->dbusername,
		'password' => $this->dbpassword,
		'dbname' => $this->dbname
);
$this->path = str_replace('installation/', '' , ossn_installation_paths()->root);
$templateFile = $this->path."configurations/ossn.config.db.example.php";
$template = file_get_contents($templateFile);
if (!$template) {
			throw new Exception('All files are required please check your files');
}

foreach ($params as $k => $v) {
	$template = str_replace("<<" . $k . ">>", $v, $template);
}

$settingsFilename = $this->path."configurations/ossn.config.db.php";
$result = file_put_contents($settingsFilename, $template);
if (!$result) {
		return false;
}

return true;	
}
/**
* Web site configuration;
* @last edit: $arsalanshah
* @Reason: Initial;
* @return bool;
*/ 
function configurations_site(){
$params = array(
		'siteurl' => $this->weburl,
		'datadir' => $this->datadir ,
);
$this->path = str_replace('installation/', '' , ossn_installation_paths()->root);
$templateFile = $this->path."configurations/ossn.config.site.example.php";
$template = file_get_contents($templateFile);
if (!$template) {
			throw new Exception('All files are required please check your files');
}

foreach ($params as $k => $v) {
	$template = str_replace("<<" . $k . ">>", $v, $template);
}

$settingsFilename = $this->path."configurations/ossn.config.site.php";
$result = file_put_contents($settingsFilename, $template);
if (!$result) {
		return false;
}

return true;	
}
/**
* Process Data;
* @last edit: $arsalanshah
* @Reason: Initial;
* @return bool;
*/ 
public function INSTALL(){	
if(stripos($this->datadir, $this->ossnInstallationDir()) === 0){
  $this->error_mesg = 'Data directory must outside';	
  return false;	
} 
if(!is_dir($this->datadir) && !is_writable($this->datadir)){
  $this->error_mesg = 'Invalid data directoy or directory is not writeable';	
  return false;		
}
if(!$this->dbconnect()){
  $this->error_mesg = $this->connect_err->connect_errn;
  return false;	
}
if ($script = file_get_contents(ossn_installation_paths()->root.'sql/opensource-socialnetwork.sql')) {
	    $script = str_replace('<<owner_email>>', $this->startup_settings['owner_email'], $script);
	    $script = str_replace('<<notification_email>>', $this->startup_settings['notification_email'], $script);
	    $script = str_replace('<<sitename>>', $this->startup_settings['sitename'], $script);
		
		$errors = array();
        $script = preg_replace('/\-\-.*\n/', '', $script);
        $sql_statements = preg_split('/;[\n\r]+/', $script);
        
		foreach ($sql_statements as $statement) {
			$statement = trim($statement);
			if (!empty($statement)) {
				try {
					$this->dbconnect()->query($statement);
				} catch (Exception $e) {
					$errors[] = $e->getMessage();
				}
			}
		}
		$this->configurations_db();
		$this->configurations_site();
		if (!empty($errors)) {
			$errortxt = "";
			foreach ($errors as $error) {
				$errortxt .= " {$error};";
			}

			$msg = $errortxt;
			throw new Exception($msg);
		}
	} 
	return true;
}	
/**
* Installation Url;
* @last edit: $arsalanshah
* @Reason: Initial;
* 
*/ 
public  static function url(){
   return str_replace('installation/','', ossn_installation_paths()->url);
}

/**
* Get data directory;
* @last edit: $arsalanshah
* @Reason: Initial;
* 
*/
public static function DefaultDataDir(){
 $return = dirname(dirname(__FILE__));	
 $return = str_replace("\\", "/", dirname(dirname($return)));
 return "{$return}/ossn_data/";
}
/**
* Get Installation dir path;
* @last edit: $arsalanshah
* @Reason: Initial;
* 
*/ 
public static function ossnInstallationDir(){
   return str_replace("\\", "/", dirname(dirname(dirname(__FILE__)))).'/';	
}
/**
* Check if mod_rewrite exist or not;
* @last edit: $arsalanshah
* @Reason: Initial;
* 
*/ 
public static function is_mod_rewrite(){
  if(function_exists('apache_get_modules') 
     && in_array('mod_rewrite' , apache_get_modules())) {
	  return true; 
  } elseif(getenv('HTTP_MOD_REWRITE')== 1){
    return true;
  }
 return false; 
}
/**
* Check if php curl library installed or not
* @last edit: $arsalanshah
* @Reason: Initial;
* 
*/ 
public static function isCurl(){
     return function_exists('curl_version');	
}
/**
* Check if php GD library is installed or not
* @last edit: $arsalanshah
* @Reason: Initial;
* 
*/ 
public static function isPhpGd(){
  if (extension_loaded('gd') && function_exists('gd_info')) {
    return true; 
  }
 return false; 
}
/**
* Check if php is > than 5.3
* @last edit: $arsalanshah
* @Reason: Initial;
* 
*/ 
public static function isPhp(){
    if(substr(PHP_VERSION, 0, 6) >= 5.3){
	     return true;	
	}
	return false;
}
/**
* Check if server is running apache or litespeed
* @last edit: $arsalanshah
* @Reason: Initial;
* 
*/ 
public static function isApache(){
  if(preg_match('/apache/i', $_SERVER["SERVER_SOFTWARE"]) 
  || preg_match('/LiteSpeed/i', $_SERVER["SERVER_SOFTWARE"])){
	 return true;  
  }
  return false;
}
/**
* Check if configuration directory is writeable or not
*
* @last edit: $arsalanshah
* @Reason: Initial;
* @return bool;
*/ 
public static function isCon_WRITEABLE(){
	$path = str_replace('installation/', '' , ossn_installation_paths()->root);
	$path = $path.'configurations';
	if(is_dir($path) && is_writable($path)){
	    return true;	
	}
	return false;
}
}//class
