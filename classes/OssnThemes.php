<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
class OssnThemes extends OssnSite {
		/**
		 * Get theme details
		 *
		 * @param string $name Theme id;
		 *
		 * @return object|false;
		 */
		public static function getTheme($name) {
				$name = trim($name);
				if(!preg_match('/\s/', $name)) {
						$dir   = ossn_route()->themes;
						$theme = $dir . $name;
						if(is_file("{$theme}/ossn_theme.xml")) {
								$theme_path = simplexml_load_file("{$theme}/ossn_theme.xml");
								return $theme_path;
						}
				}
				return false;
		}
		
		/**
		 * Get active theme
		 *
		 * @return string;
		 */
		public function getActive() {
				return $this->getSettings('theme');
		}
		
		/**
		 * Get total themes
		 *
		 * @return integer
		 */
		public function total() {
				return count($this->getThemes());
		}
		
		/**
		 * Get components list
		 *
		 * @return components ids;
		 */
		public function getThemes() {
				$dir       = ossn_route()->themes;
				$theme_ids = array();
				$handle    = opendir($dir);
				
				if($handle) {
						while($theme_id = readdir($handle)) {
								if(substr($theme_id, 0, 1) !== '.' && is_dir($dir . $theme_id) && !preg_match('/\s/', $theme_id) && is_file("{$dir}{$theme_id}/ossn_theme.php") && is_file("{$dir}{$theme_id}/ossn_theme.xml")) {
										$theme_ids[] = $theme_id;
								}
						}
				}
				
				sort($theme_ids);
				return $theme_ids;
		}
		
		/**
		 * Upload component
		 *
		 * Requires component package file,
		 *
		 * @return boolean
		 */
		public function upload() {
				$archive  = new ZipArchive;
				$data_dir = ossn_get_userdata('tmp/themes');
				if(!is_dir($data_dir)) {
						mkdir($data_dir, 0755, true);
				}
				$file = new OssnFile;
				$file->setFile('theme_file');
				$file->setExtension(array(
						'zip'
				));
				$zip     = $file->file;
				$newfile = "{$data_dir}/{$zip['name']}";
				if(move_uploaded_file($zip['tmp_name'], $newfile)) {
						if($archive->open($newfile) === TRUE) {
								$translit = OssnTranslit::urlize($zip['name']);
								
								$archive->extractTo($data_dir . '/' . $translit);
								$dirctory = scandir($data_dir . '/' . $translit, 1);
								$dirctory = $dirctory[0];
								$files    = $data_dir . '/' . $translit . '/' . $dirctory . '/';
								
								$archive->close();
								
								if(is_dir($files) && is_file("{$files}ossn_theme.php") && is_file("{$files}ossn_theme.xml")) {
										$ossn_theme_xml = simplexml_load_file("{$files}ossn_theme.xml");
										//need to check id , since ossn v3.x
										if(isset($ossn_theme_xml->id) && !empty($ossn_theme_xml->id)) {
												//move to components directory
												if(OssnFile::moveFiles($files, ossn_route()->themes . $ossn_theme_xml->id . '/')) {
														//why it shows success even if the component is not updated #510
														OssnFile::DeleteDir($data_dir);
														return true;
												}
										}
								}
						}
				}
				return false;
		}
		
		/**
		 * Get active theme startup file
		 *
		 * @return string
		 */
		public function getActivePath() {
				$path = ossn_route()->themes;
				return "{$path}{$this->getSettings('theme')}/ossn_theme.php";
		}
		/**
		 * Get active theme startup file
		 *
		 * @return string
		 */
		public function loadActive() {
				$path = ossn_route()->themes;
				if(is_file("{$path}{$this->getSettings('theme')}/ossn_theme.php")) {
						$lang      = ossn_site_settings('language');
						$lang_file = "{$path}{$this->getSettings('theme')}/locale/ossn.{$lang}.php";
						if(is_file($lang_file)) {
								//feature request: multilanguage themes #281
								include_once($lang_file);
						}
						require_once("{$path}{$this->getSettings('theme')}/ossn_theme.php");
				}
		}
		/**
		 * Enable Theme
		 *
		 * @params string $name Theme id;
		 *
		 * @return boolean
		 */
		public function Enable($theme) {
				if(!empty($theme)) {
						if($this->UpdateSettings(array(
								'value'
						), array(
								$theme
						), array(
								"setting_id='1'"
						))) {
								return true;
						}
				}
				return false;
		}
		
		/**
		 * Delete theme
		 *
		 * @return boolean
		 */
		public function deletetheme($theme) {
				if(OssnFile::DeleteDir(ossn_route()->themes . "{$theme}/")) {
						return true;
				}
				return false;
		}
		/**
		 * Check if theme is older than 3.x
		 *
		 * @param string $element Component xml string.
		 *
		 * @return boolean
		 */
		public function isOld($element) {
				if(empty($element)) {
						return false;
				}
				$version = current($element->getNamespaces());
				if(substr($version, -3) == '1.0') {
						return true;
				}
				return false;
		}
		/**
		 * Check theme requirments 
		 *
		 * @param string $element A valid theme xml file
		 *
		 * @return false|array
		 */
		public static function checkRequirments($element) {
				if(empty($element)) {
						return false;
				}
				$types = array(
						'ossn_version',
						'php_extension',
						'php_version',
						'php_function'
				);
				if(isset($element->name)) {
						if(isset($element->requires)) {
								$result   = array();
								$requires = $element->requires;
								foreach($requires as $item) {
										if(!in_array($item->type, $types)) {
												continue;
										}
										$requirments = array();
										//version checks
										if($item->type == 'ossn_version') {
												
												$requirments['type']         = ossn_print('ossn:version');
												$requirments['value']        = (string) $item->version;
												$requirments['availability'] = 0;
												$site_version                = (int) ossn_site_settings('site_version');
												
												if(($site_version <= $item->version) && ($site_version == (int)$item->version) || (float)$item->version == 3.0) {
														$requirments['availability'] = 1;
												}
												
										}
										//check php extension
										if($item->type == 'php_extension') {
												
												$requirments['type']         = ossn_print('php:extension');
												$requirments['value']        = (string) $item->name;
												$requirments['availability'] = 0;
												
												if(extension_loaded($item->name)) {
														$requirments['availability'] = 1;
												}
										}
										//check php version
										if($item->type == 'php_version') {
												
												$requirments['type']         = ossn_print('php:version');
												$requirments['value']        = (string) $item->version;
												$requirments['availability'] = 0;
												
												$phpversion = substr(PHP_VERSION, 0, 6);
												if($phpversion >= $item->version) {
														$requirments['availability'] = 1;
												}
										}
										//check php function
										if($item->type == 'php_function') {
												
												$requirments['type']         = ossn_print('php:function');
												$requirments['value']        = (string) $item->name;
												$requirments['availability'] = 0;
												
												if(function_exists($item->name)) {
														$requirments['availability'] = 1;
												}
										}
										$result[] = $requirments;
								} //loop
								return $result;
						}
				}
				return false;
		} //func
		
} //class
