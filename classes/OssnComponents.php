<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
class OssnComponents extends OssnDatabase {
		/**
		 * Get components from compnents directory
		 *
		 * @return array
		 */
		public function getComponentsDir() {
				$dir     = ossn_route()->com;
				$com_ids = array();
				$handle  = opendir($dir);
				
				if($handle) {
						while($com_id = readdir($handle)) {
								if(substr($com_id, 0, 1) !== '.' && is_dir($dir . $com_id) && !preg_match('/\s/', $com_id) && is_file("{$dir}{$com_id}/ossn_com.php") && is_file("{$dir}{$com_id}/ossn_com.xml")) {
										$com_ids[] = $com_id;
								}
						}
				}
				
				sort($com_ids);
				return $com_ids;
		}
		
		/**
		 * Count total components
		 *
		 * @return integer
		 */
		public function total() {
				return count($this->getComponents());
		}
		
		/**
		 * Get components list
		 *
		 * @return array
		 */
		public function getComponents() {
				$params['from'] = 'ossn_components';
				$this->coms     = $this->select($params, true);
				if(!$this->coms) {
						return false;
				}
				foreach($this->coms as $com_id) {
						$com_ids[] = $com_id->com_id;
				}
				return $com_ids;
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
				$data_dir = ossn_get_userdata('tmp/components');
				if(!is_dir($data_dir)) {
						mkdir($data_dir, 0755, true);
				}
				$zip     = $_FILES['com_file'];
				$newfile = "{$data_dir}/{$zip['name']}";
				if(move_uploaded_file($zip['tmp_name'], $newfile)) {
						if($archive->open($newfile) === TRUE) {
								$translit = OssnTranslit::urlize($zip['name']);
								
								//make community components works on installer #394
								//Component installer problems with certain zip - archives #420
								
								$archive->extractTo($data_dir . '/' . $translit);
								$dirctory = scandir($data_dir . '/' . $translit, 1);
								$dirctory = $dirctory[0];
								
								$files = $data_dir . '/' . $translit . '/' . $dirctory . '/';
								$archive->close();
								
								if(is_dir($files) && is_file("{$files}ossn_com.php") && is_file("{$files}ossn_com.xml")) {
										
										$ossn_com_xml = simplexml_load_file("{$files}ossn_com.xml");
										//need to check id , since ossn v3.x
										if(isset($ossn_com_xml->id) && !empty($ossn_com_xml->id)) {
												//move to components directory
												if(OssnFile::moveFiles($files, ossn_route()->com . $ossn_com_xml->id . '/')) {
														//add new component to system
														$this->newCom($ossn_com_xml->id);
														
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
		 * Insert a new component to system
		 *
		 * @return boolean
		 */
		public function newCom($com) {
				if(!empty($com) && is_dir(ossn_route()->com . $com)) {
						/*
						 * Get a com;
						 * @last edit: $arsalanshah
						 * @Reason: Initial;
						 */
						$this->statement("SELECT * FROM ossn_components
			    						  WHERE (com_id='$com');");
						$this->execute();
						$CHECK = $this->fetch();
						if(!isset($CHECK->active)) {
								/*
								 * Update com  status;
								 * @last edit: $arsalanshah
								 * @Reason: Initial;
								 */
								$this->statement("INSERT INTO `ossn_components`
			 									 (`com_id`, `active`)
		         								  VALUES ('$com', '0')");
								$this->execute();
								return true;
						}
				}
				return false;
		}
		
		/**
		 * Load all active components
		 *
		 * @return false|null startup files;
		 */
		public function loadComs() {
				$coms = $this->getActive();
				$lang = ossn_site_settings('language');
				
				$vars['activated'] = $coms;
				ossn_trigger_callback('components', 'before:load', $vars);
				if(!$coms) {
						return false;
				}
				foreach($coms as $com) {
						$dir  = ossn_route()->com;
						$name = $this->getCom($com->com_id);
						if(!empty($name->name)) {
								ossn_register_plugins_by_path("{$dir}{$com->com_id}/plugins/");
								if(is_file("{$dir}{$com->com_id}/locale/ossn.{$lang}.php")) {
										include("{$dir}{$com->com_id}/locale/ossn.{$lang}.php");
								}
								include_once("{$dir}{$com->com_id}/ossn_com.php");
						}
				}
				ossn_trigger_callback('components', 'after:load', $vars);
		}
		
		/**
		 * Get active components
		 *
		 * @return active components;
		 */
		public function getActive() {
				$params['from']   = 'ossn_components';
				$params['wheres'] = array(
						"active='1'"
				);
				return $this->select($params, true);
		}
		
		/**
		 * Get component details
		 *
		 * @params string $name Component id;
		 *
		 * @return false|object
		 */
		public static function getCom($name) {
				$name = trim($name);
				if(!preg_match('/\s/', $name)) {
						$dir       = ossn_route()->com;
						$component = $dir . $name;
						if(is_file("{$component}/ossn_com.xml")) {
								$component = simplexml_load_file("{$component}/ossn_com.xml");
								return $component;
						}
				}
				return false;
		}
		/**
		 * Check if component is older than 3.x
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
		 * Check component requirments 
		 *
		 * @param string $element A valid component xml file
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
												
												if(($site_version <= $item->version) && ($site_version == (int) $item->version)) {
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
		/**
		 * Check if component is active or not
		 *
		 * @return boolean
		 */
		public function isActive($id = '') {
				if(empty($id)) {
						return false;
				}
				$params['from']   = 'ossn_components';
				$params['wheres'] = array(
						"com_id='{$id}'"
				);
				$this->settings   = $this->select($params);
				if($this->settings->active == 1) {
						return true;
				}
				return false;
		}
		
		/**
		 * Enable Component
		 *
		 * @return boolean
		 */
		public function enable($com) {
				if(!empty($com) && is_dir(ossn_route()->com . $com)) {
						/*
						 * Get a com;
						 * @last edit: $arsalanshah
						 * @Reason: Initial;
						 */
						$this->statement("SELECT * FROM ossn_components
			    WHERE (com_id='$com');");
						$this->execute();
						$CHECK = $this->fetch();
						/*
						 * Update com status;
						 * @last edit: $arsalanshah
						 * @Reason: Initial;
						 */
						if(isset($CHECK->active) && $CHECK->active == 0) {
								$this->statement("UPDATE ossn_components
			    SET active='1'
			    WHERE (com_id='$com');");
								$this->execute();
								return true;
						} elseif(!isset($CHECK->active)) {
								/*
								 * Update com  status;
								 * @last edit: $arsalanshah
								 * @Reason: Initial;
								 */
								$this->statement("INSERT INTO `ossn_components`
			  (`com_id`, `active`)
		          VALUES ('$com', '1')");
								$this->execute();
								return true;
						}
				}
				return false;
		}
		
		/**
		 * Delete component
		 *
		 * @return boolean
		 */
		public function delete($com) {
				if(in_array($com, $this->requiredComponents())) {
						return false;
				}
				$component = $this->getbyName($com);
				if(!$component){
					return false;
				}
				$params           = array();
				$params['from']   = "ossn_components";
				$params['wheres'] = array(
						"com_id='{$com}'"
				);
				if(parent::delete($params)) {
						//Delete component settings upon its deletion #538
						$entities = new OssnEntities;
						$entities->deleteByOwnerGuid($component->id, 'component');
						
						//delete component directory
						OssnFile::DeleteDir(ossn_route()->com . "{$com}/");
						return true;
				}
				return false;
		}
		
		/**
		 * Required Components
		 *
		 * Admin can't disable required components;
		 *
		 * @return array
		 */
		public function requiredComponents() {
				return array(
						'OssnProfile',
				);
		}
		
		/**
		 * Disable component
		 *
		 * @return boolean
		 */
		public function DISABLE($com = NULL) {
				if(in_array($com, $this->requiredComponents())) {
						return false;
				}
				if(!empty($com)) {
						$this->statement("UPDATE ossn_components
			    SET active='0' WHERE (com_id='$com')");
						$this->execute();
						return true;
				}
				return false;
		}
		
		/**
		 * Bundled components
		 *
		 * @return array
		 */
		public function bundledComponents() {
				return array_merge(array(
						'OssnGroups',
						'OssnSitePages',
						'OssnChat',
						'OssnPoke',
						'OssnBlock',
						'OssnSmilies',
						'OssnInvite',
						'OssnEmbed',
						'OssnAds',
						'OssnComments',
						'OssnLikes',
						'OssnMessages',
						'OssnNotifications',
						'OssnPhotos',
						'OssnSearch',
						'OssnWall'						
				), $this->requiredComponents());
		}
		/**
		 * Set component settings
		 *
		 * setSettings should have array() to accept values #434
		 *
		 * @param  string $component Component id
		 * @param  array vars Setting (two-dem array)
		 *
		 * @return boolean
		 */
		public function setSettings($component, array $vars = array()) {
				$settings = self::getComSettings($component);
				$guid     = $this->getbyName($component)->getID();
				$entity   = new OssnEntities;
				if(empty($guid)) {
						return false;
				}
				foreach($vars as $name => $value) {
						if($settings && !$settings->isParam($name)) {
								$entity->owner_guid = $guid;
								$entity->type       = 'component';
								$entity->subtype    = $name;
								$entity->value      = $value;
								$entity->add();
						} else {
								$entity->owner_guid  = $guid;
								$entity->type        = 'component';
								$entity->data->$name = $value;
								$entity->save();
						}
				}
				return true;
		}
		/**
		 * Set component settings
		 *
		 * @param string $component Component id
		 * @param string $setting Setting name
		 * @param string $value Setting value
		 *
		 * @note This method is deprecated and will be removed in Ossn v4.0
		 *
		 * @return boolean
		 */
		public function setComSETTINGS($component, $setting, $value) {
				return $this->setSettings($component, array(
						$setting => $value
				));
		}
		
		/**
		 * Get Component Settings
		 *
		 * @params string $component Component id
		 *
		 * @return false|array;
		 */
		public function getSettings($component) {
				$entity             = new OssnEntities;
				$entity->type       = 'component';
				$entity->owner_guid = $this->getbyName($component)->getGUID();
				$settings           = $entity->get_entities();
				if(is_array($settings) && !empty($settings)) {
						foreach($settings as $setting) {
								$comsettings[$setting->subtype] = $setting->value;
						}
						return arrayObject($comsettings, 'OssnComponents');
				}
				return false;
		}
		/**
		 * Get Component Settings
		 *
		 * @params string $component Component id
		 *
		 * @note This method is deprecated and will be removed in Ossn v4.0
		 *
		 * @return false|array;
		 */
		public function getComSettings($component) {
				return $this->getSettings($component);
		}
		/**
		 * Get component
		 *
		 * @note This id is not a package id 
		 *
		 * @return integer|false;
		 */
		public function getbyName($name) {
				$params          = array();
				$params['from']  = 'ossn_components';
				$params['where'] = array(
						"com_id='{$name}'"
				);
				if($data = $this->select($params)) {
						return arrayObject($data, get_class($this));
				}
				return false;
		}
		
		
} //class
