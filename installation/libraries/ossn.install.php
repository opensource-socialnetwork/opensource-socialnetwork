<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

/**
 * Ossn Installation Url
 * Get a installation path url
 *
 * @return string
 */
function ossn_installation_url() {
		$type     = true;
		$protocol = 'http';
		$uri      = $_SERVER['REQUEST_URI'];
		if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
				$protocol = 'https';
		}
		$port = ':' . $_SERVER['SERVER_PORT'];
		if($port == ':80' || $port == ':443') {
				if($type == true) {
						$port = '';
				}
		}
		$url = "$protocol://{$_SERVER['SERVER_NAME']}$port{$uri}";
		return preg_replace('/\\?.*/', '', $url);
}
/**
 * Ossn Url
 * Get a root url
 *
 * @return string
 */
function ossn_url() {
		return str_replace('installation/', '', ossn_installation_url());
}
/**
 * Ossn instalaltion paths
 * Get paths needed for installing Ossn
 *
 * @return object
 */
function ossn_installation_paths() {
		global $OssnInstall;
		$path     = str_replace('\\', '/', dirname(dirname(__FILE__)));
		$defaults = array(
				'root'     => "{$path}/",
				'url'      => ossn_installation_url(),
				'ossn_url' => ossn_url(),
		);
		foreach($defaults as $name => $value) {
				if(empty($OssnInstall->$name)) {
						$OssnInstall->$name = $value;
				}
		}
		return $OssnInstall;
}
/**
 * Ossn Instalaltion Include
 * Include a file
 *
 * @return string|null data
 */
function ossn_installation_include($file = '', $params = array()) {
		$file = ossn_installation_paths()->root . $file;
		if(!empty($file) && is_file($file)) {
				ob_start();
				$params = $params;
				include $file;
				$contents = ob_get_clean();
				return $contents;
		}
}
/**
 * Ossn Installation Register Languages
 * Register a labguages need for installation
 *
 * @return void
 */
function ossn_installation_register_languages($strings = array()) {
		global $OssnInstall;
		$OssnInstall->langStrings = $strings;
}
/**
 * Ossn load a installation language
 *
 * @return arrays
 */
function ossn_installation_languages() {
		include_once ossn_installation_paths()->root . 'locales/ossn.en.php';
}
ossn_installation_languages();
/**
 * Ossn print language string
 *
 * @return string
 */
function ossn_installation_print($string) {
		global $OssnInstall;
		if(isset($OssnInstall->langStrings[$string])) {
				return $OssnInstall->langStrings[$string];
		} else {
				return $string;
		}
}
/**
 * Ossn view instalaltion page
 *
 * @param string|null $content
 * @param string $title
 * @return string|null
 */
function ossn_installation_view_page($content, $title) {
		return ossn_installation_include('templates/page.php', array(
				'contents' => $content,
				'title'    => ossn_installation_print($title),
		));
}
/**
 * Handle insallation pages
 *
 * @return mixed data
 */
function ossn_installation_page() {
		if(isset($_REQUEST['page'])) {
				$page = $_REQUEST['page'];
		}
		if(!isset($page)) {
				$page = 'requirments';
		}
		switch($page) {
			case 'requirments':
				$data = ossn_installation_include('pages/check.php');
				echo ossn_installation_view_page($data, 'ossn:check');
				break;
			case 'license':
				$data = ossn_installation_include('pages/license.php');
				echo ossn_installation_view_page($data, 'ossn:check');
				break;
			case 'settings':
				$data = ossn_installation_include('pages/settings.php');
				echo ossn_installation_view_page($data, 'ossn:settings');
				break;
			case 'account':
				$data = ossn_installation_include('pages/account.php');
				echo ossn_installation_view_page($data, 'ossn:setting:account');
				break;
			case 'installed':
				$data = ossn_installation_include('pages/installed.php');
				echo ossn_installation_view_page($data, 'ossn:installed');
				break;
		}
}
/**
 * Handle insallation actions
 *
 * @return false|null data
 */
function ossn_installation_actions() {
		if(isset($_REQUEST['action'])) {
				$page = $_REQUEST['action'];
		}
		if(!isset($page)) {
				return false;
		}
		switch($page) {
			case 'install':
				include_once ossn_installation_paths()->root . 'actions/install.php';
				break;
			case 'account':
				include_once ossn_installation_paths()->root . 'actions/account.php';
				break;
			case 'finish':
				include_once ossn_installation_paths()->root . 'actions/finish.php';
				break;
		}
}
/**
 * Handle insallation error massages
 *
 * @return void
 */
function ossn_installation_message($message, $type) {
		$_SESSION['ossn-installation-messages']["ossn-installation-{$type}"][] = $message;
}
/**
 * View installation error messages
 *
 * @return false|string data
 */
function ossn_installation_messages() {
		if(!isset($_SESSION['ossn-installation-messages'])) {
				return false;
		}
		foreach($_SESSION['ossn-installation-messages'] as $message => $data) {
				foreach($data as $msg) {
						$msgs[] = "<div class='ossn-installation-message {$message}'>{$msg}</div>";
				}
		}
		unset($_SESSION['ossn-installation-messages']);
		return implode('', $msgs);
}
/**
 * Simple curl, get content of url
 *
 * @return mixed data
 */
function ossn_installation_simple_curl($url = '') {
		if(isset($url)) {
				$curlinit = curl_init();
				curl_setopt($curlinit, CURLOPT_URL, $url);
				curl_setopt($curlinit, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curlinit, CURLOPT_SSL_VERIFYPEER, false);
				$result = curl_exec($curlinit);
				if(curl_errno($curlinit)) {
						$error = curl_error($curlinit);
						return array(
								$error,
						);
				}
				curl_close($curlinit);
		}
		return (int) $result;
}
/**
 * Generate server level config files
 *
 * @return boolean
 */
function ossn_generate_server_config_setup($type): bool {
		if($type == 'apache') {
				$path = str_replace('installation/', '', ossn_installation_paths()->root);
				$file = ossn_installation_paths()->root . 'configs/htaccess.dist';
				
				//[B] Apache config being rewritten if modified by cpanel #2179
				$comapreFunc = function($file){
						$file = fopen($file, 'r');
						$line = fgets($file);
						fclose($file);
						$line = preg_replace('/\s+/','', trim($line));
						return str_replace('#', '', $line);
				};
				
				//[E] Stop rewriting .htaccess every time page loads during installation #2091
				if(file_exists($path . '.htaccess')) {
						$actual_check_sum = $comapreFunc($path . '.htaccess');
						$org_check_sum    = $comapreFunc($file);
						if($org_check_sum == $actual_check_sum) {
								return true;
						}
				}
				return file_put_contents($path . '.htaccess', file_get_contents($file));
		} elseif($type == 'php_user_ini') {
				$path = str_replace('installation/', '', ossn_installation_paths()->root);
				$file = ossn_installation_paths()->root . 'configs/user.ini.dist';
				$file = file_get_contents($file);

				if(file_exists($path . '.user.ini')) {
						$actual_check_sum = md5(file_get_contents($path . '.user.ini'));
						$org_check_sum    = md5($file);
						if($org_check_sum == $actual_check_sum) {
								return true;
						}
				}
				return file_put_contents($path . '.user.ini', $file);
		}
		return false;
}
