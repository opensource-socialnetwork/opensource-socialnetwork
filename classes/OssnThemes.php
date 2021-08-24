<?php
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
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
				$upload_error_messages = array(
						UPLOAD_ERR_OK         => 'php:upload_err_ok',
						UPLOAD_ERR_INI_SIZE   => 'php:upload_err_ini_size',
						UPLOAD_ERR_FORM_SIZE  => 'php:upload_err_form_size',
						UPLOAD_ERR_PARTIAL    => 'php:upload_err_partial',
						UPLOAD_ERR_NO_FILE    => 'php:upload_err_no_file',
						UPLOAD_ERR_NO_TMP_DIR => 'php:upload_err_no_tmp_dir',
						UPLOAD_ERR_CANT_WRITE => 'php:upload_err_cant_write',
						UPLOAD_ERR_EXTENSION  => 'php:upload_err_extension',
				);			
				$archive  = new ZipArchive;
				$data_dir = ossn_get_userdata('tmp/themes');
				if(!is_dir($data_dir)) {
						mkdir($data_dir, 0755, true);
				}
				if(!is_dir($data_dir)) {
						ossn_trigger_message(ossn_print('ossn:theme:installer:create:tmpdir:error'), 'error');
						error_log('Theme Installer Error: Cannot create temporary data directory');
						return;
				}				
				if($_FILES['theme_file']['error'] != UPLOAD_ERR_OK) {
						ossn_trigger_message(ossn_print('ossn:theme:installer:upload:error', array(ossn_print($upload_error_messages[$_FILES['theme_file']['error']])) ), 'error');
						error_log('Theme Installer Error: ' . $upload_error_messages[$_FILES['theme_file']['error']]);
						return;
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
												// asure Ossn compatibility before overwriting an older component release
												$required_version = $ossn_theme_xml->requires->version;
												$installed_version = ossn_site_settings('site_version');
												if($installed_version < $required_version) {
														OssnFile::DeleteDir($data_dir);
														ossn_trigger_message(ossn_print('ossn:theme:installer:version:error', array($required_version)), 'error');
														error_log('Theme Installer Error: Ossn version ' . $required_version . ' requirement not met');
														return;
												}			
												// if the theme is already installed
												// warn the admin to remove it first
												if(is_dir(ossn_route()->themes .  $ossn_theme_xml->id . '/')) {
														OssnFile::DeleteDir($data_dir);
														ossn_trigger_message(ossn_print('ossn:theme:installer:remove:themedir:error'), 'error');
														error_log('Theme Installer Error: Former theme is still in place');
														return;
												}												
												//move to components directory
												if((!is_dir(ossn_route()->themes . $ossn_theme_xml->id)) && (OssnFile::moveFiles($files, ossn_route()->themes . $ossn_theme_xml->id . '/'))) {
														//why it shows success even if the component is not updated #510
														OssnFile::DeleteDir($data_dir);
														ossn_trigger_callback('theme', 'installed', array(
																'theme' => $ossn_theme_xml->id
														));		
														ossn_trigger_message(ossn_print('ossn:theme:installer:theme:installation:success'), 'success');
														return true;
												}
												OssnFile::DeleteDir($data_dir);
												ossn_trigger_message(ossn_print('ossn:theme:installer:create:themedir:error'), 'error');
												error_log('Theme Installer Error: Cannot copy files to themes directory');
												return;												
										}
										OssnFile::DeleteDir($data_dir);
										ossn_trigger_message(ossn_print('ossn:theme:installer:xml:incomplete:error'), 'error');
										error_log('Theme Installer Error: XML file missing or incomplete');
										return;										
								}
								OssnFile::DeleteDir($data_dir);
								ossn_trigger_message(ossn_print('ossn:theme:installer:zip:incomplete:error'), 'error');
								error_log('Theme Installer Error: Zip-archive incomplete');
								return;								
						}
						OssnFile::DeleteDir($data_dir);
						ossn_trigger_message(ossn_print('ossn:theme:installer:open:zip:error'), 'error');
						error_log('Theme Installer Error: Cannot open zip-archive');
						return;						
				}
				OssnFile::DeleteDir($data_dir);
				ossn_trigger_message(ossn_print('ossn:theme:installer:move:uploaded:file:error'), 'error');
				error_log('Theme Installer Error: Cannot open zip-archive');
				return;
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
				if(!empty($theme)){
						$former_theme = ossn_route()->themes . $this->getSettings('theme');
						if(file_exists($former_theme.'/disable.php')){
							include_once($former_theme.'/disable.php');
						}									
						//file is called before theme is enabled
						if(file_exists(ossn_route()->themes . $theme.'/enable.php')){
							include_once(ossn_route()->themes . $theme.'/enable.php');
						}									
						if($this->UpdateSettings(array(
								'value'
						), array(
								$theme
						), array(
								"setting_id='1'"
						))){
								//file is called after theme is enabled
								if(file_exists(ossn_route()->themes . $theme.'/enabled.php')){
									include_once(ossn_route()->themes . $theme.'/enabled.php');
								}									
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
				ossn_trigger_callback('theme', 'before:delete', array(
							'theme' => $theme
				));						
				//file is called before theme is deleted
				if(file_exists(ossn_route()->themes . $theme.'/delete.php')){
						include_once(ossn_route()->themes . $theme.'/delete.php');
				}						
				if(OssnFile::DeleteDir(ossn_route()->themes . "{$theme}/")) {
						ossn_trigger_callback('theme', 'deleted', array(
							'theme' => $theme
						));	
						//file is called after theme is deleted
						if(file_exists(ossn_route()->themes . $theme.'/deleted.php')){
								include_once(ossn_route()->themes . $theme.'/deleted.php');
						}											
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
						'php_function',
						'ossn_component'						
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
												//Ossn Version checking not strict enough when installing components #1000
												$comparator = '>=';
												if(isset($item->comparator) && !empty($item->comparator)) {
														$comparator = $item->comparator;
												}

												$requirments['type']         = ossn_print('ossn:version');
												$requirments['value']        = $comparator . ' ' . (string) $item->version;
												$requirments['availability'] = 0;
												$site_version                = ossn_site_settings('site_version');
												
												if(version_compare($site_version, (string) $item->version, $comparator)) {
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
												$comparator = '>=';
												if(isset($item->comparator) && !empty($item->comparator)) {
														$comparator = $item->comparator;
												}
												$requirments['type']         = ossn_print('php:version');
												$requirments['value']        = $comparator . ' ' . (string) $item->version;
												$requirments['availability'] = 0;
												
												$phpversion = substr(PHP_VERSION, 0, 6);
												if(version_compare($phpversion, (string) $item->version, $comparator)) {
														$requirments['availability'] = 1;
												}
										}
										//check php function
										if($item->type == 'php_function') {
												$comparator = 'available';
												if(isset($item->comparator) && !empty($item->comparator)) {
														$comparator = $item->comparator;
												}
												
												$requirments['type']         = ossn_print('php:function') . ' ' . (string) $item->name;
												$requirments['value']        = $comparator;
												$requirments['availability'] = 0;
												
												if((function_exists($item->name) && $comparator == 'available') || (!function_exists($item->name) && $comparator == 'not available')) {
														$requirments['availability'] = 1;
												}
										}
										if($item->type == 'ossn_component') {
												$comparator = '>=';
												if(isset($item->comparator) && !empty($item->comparator)) {
														$comparator = $item->comparator;
												}
												$requirments['type']         = (string) $item->name . ' ' . ossn_print('component');
												$requirments['value']        = $comparator . ' ' . (string) $item->version;
												$requirments['availability'] = 0;
												
												$OssnComponent = new OssnComponents();
												if($OssnComponent->isActive($item->name)) {
														$requirments['availability'] = 1;
														if(isset($item->version)) {
																$com_load = $OssnComponent->getCom($item->name);
																if($com_load && version_compare($com_load->version, (string) $item->version, $comparator)) {
																		$requirments['availability'] = 1;
																} else {
																		$requirments['availability'] = 0;
																}
														}
														if($comparator == 'disabled') {
																$requirments['availability'] = 0;
														}
												} else {
														if($comparator == 'disabled') {
																$requirments['availability'] = 1;
														}
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
