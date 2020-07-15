<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
class OssnInstallation {
		/**
		 * Installation Url;
		 * @last edit: $arsalanshah
		 * @Reason: Initial;
		 *
		 */
		public static function url() {
				return str_replace('installation/', '', ossn_installation_paths()->url);
		}
		
		/**
		 * Get data directory;
		 * @last edit: $arsalanshah
		 * @Reason: Initial;
		 *
		 */
		public static function DefaultDataDir() {
				$return = dirname(dirname(__FILE__));
				$return = str_replace("\\", "/", dirname(dirname($return)));
				return "{$return}/ossn_data/";
		}
		
		/**
		 * Check if mod_rewrite exist or not;
		 * @last edit: $arsalanshah
		 * @Reason: Initial;
		 *
		 */
		public static function is_mod_rewrite() {
				if(isset($_REQUEST['mod_rewrite_check_skip']) && $_REQUEST['mod_rewrite_check_skip'] == true) {
						return true;
				}
				$file    = ossn_url();
				$rewrite = ossn_installation_simple_curl($file . 'rewrite.php');
				if($rewrite == 1) {
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
		public static function isCurl() {
				return function_exists('curl_version');
		}
		
		/**
		 * Check if php GD library is installed or not
		 * @last edit: $arsalanshah
		 * @Reason: Initial;
		 *
		 */
		public static function isPhpGd() {
				if(extension_loaded('gd') && function_exists('gd_info')) {
						return true;
				}
				return false;
		}
		/**
		 * Check if the ZipArchive class exists or not
		 *
		 * @return boolean
		 */
		public static function isZipClass() {
				return class_exists('ZipArchive');
		}
		/**
		 * Check if allow_url_fopen is available or not
		 *
		 * @return boolean
		 */
		public static function allowUrlFopen() {
				return ini_get('allow_url_fopen');
		}
		/**
		 * Check if php is > than 5.4
		 * @last edit: $arsalanshah
		 * @Reason: Initial;
		 *
		 */
		public static function isPhp() {
				$phpversion = substr(PHP_VERSION, 0, 6);
				//$phpversion >= 5.6 , works fine with php 5.6
			        //Support php 5.6 or larger remove support for < 5.6 #1287
				//8tH April 2020, remove support for outdated PHP version
				if($phpversion >= 7.0) {
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
		public static function isApache() {
				if(preg_match('/apache/i', $_SERVER["SERVER_SOFTWARE"]) || preg_match('/LiteSpeed/i', $_SERVER["SERVER_SOFTWARE"])) {
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
		public static function isCon_WRITEABLE() {
				$path = str_replace('installation/', '', ossn_installation_paths()->root);
				$path = $path . 'configurations';
				if(is_dir($path) && is_writable($path)) {
						return true;
				}
				return false;
		}
		/**
		 * Check if cache directory is writeable or not
		 *
		 * @return boolean
		 */
		 public static function isCacheWriteable(){
					$path = str_replace('installation/', '', ossn_installation_paths()->root);
					$path = $path . 'cache';	
					if(!is_dir($path)){
						if(mkdir($path, 0755, true)){
								rmdir($path);
								return true;	
						} else {
								return false;	
						}
					}
					return false;
		 }
		/**
		 * Check if mysqli class exist exist or not
		 *
		 * @last edit: $arsalanshah
		 * @Reason: Initial;
		 * @return bool;
		 */
		public static function is_mysqli_enabled() {
				return class_exists('mysqli');
		}
		
		/**
		 * Get database user;
		 * @last edit: $arsalanshah
		 * @Reason: Initial;
		 *
		 */
		public function dbusername($username) {
				if(!empty($username)) {
						$this->dbusername = $username;
				} else {
						$this->dbusername = 'root';
				}
		}
		
		/**
		 * Get db password;
		 * @last edit: $arsalanshah
		 * @Reason: Initial;
		 *
		 */
		public function dbpassword($password) {
				$this->dbpassword = $password;
		}
		
		/**
		 * Get databasename;
		 * @last edit: $arsalanshah
		 * @Reason: Initial;
		 *
		 */
		public function dbname($dbname) {
				if(!empty($dbname)) {
						$this->dbname = $dbname;
				} else {
						$this->dbname = 'Ossn';
				}
		}
		
		/**
		 * Get db host;
		 * @last edit: $arsalanshah
		 * @Reason: Initial;
		 *
		 */
		public function dbhost($dbhost) {
				preg_match('/([\w-\.]+)(|\:(\d+))$/', $dbhost, $matches);
				//set the host without port
				if(isset($matches[1])){
					$dbhost = $matches[1];
				}
				if(!empty($dbhost)) {
						$this->dbhost = $dbhost;
				} else {
						$this->dbhost = 'localhost';
				}
				//set the port
				if(isset($matches[3]) && !empty($matches[3])){
					$this->dbport($matches[3]);
				} else {
					$port = ini_get("mysqli.default_port");
					if(empty($port)){
						$port = 3306;
					}
					$this->dbport($port);					
				}
				
		}

		/**
		 * Get db host;
		 * @last edit: $arsalanshah
		 * @Reason: Initial;
		 *
		 */
		public function dbport($dbport) {
				if(!empty($dbport) && (int)$dbport > 0) {
						$this->dbport = $dbport;
				}
		}
		
		/**
		 * Get web url;
		 * @last edit: $arsalanshah
		 * @Reason: Initial;
		 *
		 */
		public function weburl($weburl) {
				if(!empty($weburl)) {
						$this->weburl = $weburl;
				}
		}
		
		/**
		 * Set a datadriectory;
		 * @last edit: $arsalanshah
		 * @retun void;
		 *
		 */
		public function datadir($dir) {
				$this->datadir = $dir;
		}
		
		public function setStartupSettings($data) {
				$this->startup_settings = $data;
		}
		
		/**
		 * Process Data;
		 * @last edit: $arsalanshah
		 * @Reason: Initial;
		 * @return bool;
		 */
		public function INSTALL() {
				if(stripos($this->datadir, $this->ossnInstallationDir()) === 0) {
						$this->error_mesg = ossn_installation_print('data:directory:outside');
						return false;
				}
				if(!is_dir($this->datadir) && !is_writable($this->datadir)) {
						$this->error_mesg = ossn_installation_print('data:directory:invalid');
						return false;
				}			
				if(!file_put_contents($this->datadir . 'writeable', 1)){
						$this->error_mesg = ossn_installation_print('data:directory:invalid');
						return false;						
				} else {
					$writeable  = file_get_contents($this->datadir . 'writeable');	
					if(!$writeable || $writeable &&  $writeable != 1){
						$this->error_mesg = ossn_installation_print('data:directory:invalid');
						return false;							
					}
				}
				unlink($this->datadir . 'writeable');
				
				if(!$this->dbconnect()) {
						$this->error_mesg = $this->connect_err->connect_errn;
						return false;
				}
				if($script = file_get_contents(ossn_installation_paths()->root . 'sql/opensource-socialnetwork.sql')) {
						$script         = str_replace('<<owner_email>>', $this->startup_settings['owner_email'], $script);
						$script         = str_replace('<<notification_email>>', $this->startup_settings['notification_email'], $script);
						$script         = str_replace('<<sitename>>', $this->startup_settings['sitename'], $script);
						$script         = str_replace("<<secret>>", substr(md5('ossn' . bin2hex(random_bytes(6))), 3, 8), $script);
						$errors         = array();
						$script         = preg_replace('/\-\-.*\n/', '', $script);
						$sql_statements = preg_split('/;[\n\r]+/', $script);
						
						foreach($sql_statements as $statement) {
								$statement = trim($statement);
								if(!empty($statement)) {
										try {
												$this->dbconnect()->query($statement);
										}
										catch(Exception $e) {
												$errors[] = $e->getMessage();
										}
								}
						}
						$this->configurations_db();
						$this->configurations_site();
						if(!empty($errors)) {
								$errortxt = "";
								foreach($errors as $error) {
										$errortxt .= " {$error};";
								}
								
								$msg = $errortxt;
								throw new Exception($msg);
						}
				}
				return true;
		}
		
		/**
		 * Get Installation dir path;
		 * @last edit: $arsalanshah
		 * @Reason: Initial;
		 * @return string
		 */
		public static function ossnInstallationDir() {
				return str_replace("\\", "/", dirname(dirname(dirname(__FILE__)))) . '/';
		}
		
		/**
		 * Connect to database;
		 * @last edit: $arsalanshah
		 * @Reason: Initial;
		 */
		public function dbconnect() {
				$connect = new mysqli($this->dbhost, $this->dbusername, $this->dbpassword, $this->dbname, $this->dbport);
				if($connect->connect_errno) {
						$this->connect_err->connect_errn = mysqli_connect_error();
						return false;
				} else {
						return $connect;
				}
				
		}
		
		/**
		 * Database configuration;
		 * @last edit: $arsalanshah
		 * @Reason: Initial;
		 */
		function configurations_db() {
				$params       = array(
						'host' => $this->dbhost,
						'port' => $this->dbport,
						'user' => $this->dbusername,
						'password' => $this->dbpassword,
						'dbname' => $this->dbname
				);
				$this->path   = str_replace('installation/', '', ossn_installation_paths()->root);
				$templateFile = $this->path . "configurations/ossn.config.db.example.php";
				$template     = file_get_contents($templateFile);
				if(!$template) {
						throw new Exception(ossn_installation_print('all:files:required'));
				}
				
				foreach($params as $k => $v) {
						$template = str_replace("<<" . $k . ">>", $v, $template);
				}
				
				$settingsFilename = $this->path . "configurations/ossn.config.db.php";
				$result           = file_put_contents($settingsFilename, $template);
				if(!$result) {
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
		function configurations_site() {
				$params       = array(
						'siteurl' => $this->weburl,
						'datadir' => $this->datadir
				);
				$this->path   = str_replace('installation/', '', ossn_installation_paths()->root);
				$templateFile = $this->path . "configurations/ossn.config.site.example.php";
				$template     = file_get_contents($templateFile);
				if(!$template) {
						throw new Exception(ossn_installation_print('all:files:required'));
				}
				
				foreach($params as $k => $v) {
						$template = str_replace("<<" . $k . ">>", $v, $template);
				}
				
				$settingsFilename = $this->path . "configurations/ossn.config.site.php";
				$result           = file_put_contents($settingsFilename, $template);
				if(!$result) {
						return false;
				}
				
				return true;
		}
} //class
