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
		 * @return components ids;
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
		 * @return (int);
		 */
		public function total() {
				return count($this->getComponents());
		}
		
		/**
		 * Get components list
		 *
		 * @return components ids;
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
		 * @requires component package file,
		 *
		 * @return bool;
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
								$archive->extractTo($data_dir);
								
								//make community components works on installer #394
								$validate = $archive->statIndex(0);
								$validate = str_replace('/', '', $validate['name']);
								
								$archive->close();
								
								if(is_dir("{$data_dir}/{$validate}") && is_file("{$data_dir}/{$validate}/ossn_com.php") && is_file("{$data_dir}/{$validate}/ossn_com.xml")) {
										$archive->open($newfile);
										$archive->extractTo(ossn_route()->com);
										$archive->close();
										$this->newCom($validate);
										OssnFile::DeleteDir($data_dir);
										return true;
								}
						}
				}
				return false;
		}
		
		/**
		 * Insert a new component to system
		 *
		 * @return bool;
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
		 * @params $name = component id;
		 *
		 * @return (object) or return false;
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
		public function isOld($element){
			if(empty($element)){
				return false;
			}
			$version = current($element->getNamespaces());
			if(substr($version, -3) == '1.0'){
				return true;
			}
			return false;
		}
		/**
		 * Check component requirments 
		 *
		 * @param xml $element A valid component xml file
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
								$result = array();
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
												
												if(ossn_site_settings('site_version') <= $item->version) {
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
		 * @return bool;
		 */
		public function isActive($id = '') {
				if(empty($id)){
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
		 * @return bool;
		 */
		public function ENABLE($com) {
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
		 * @return bool;
		 */
		public function deletecom($com) {
				if(in_array($com, $this->requiredComponents())) {
						return false;
				}
				$this->statement("DELETE FROM ossn_components WHERE(com_id='{$com}');");
				if($this->execute()) {
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
		 * @return array;
		 */
		public function requiredComponents() {
				return array(
						'OssnAds',
						'OssnComments',
						'OssnLikes',
						'OssnMessages',
						'OssnNotifications',
						'OssnPhotos',
						'OssnProfile',
						'OssnSearch',
						'OssnWall'
				);
		}
		
		/**
		 * Disable component
		 *
		 * @return bool;
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
		 * @return array;
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
						'OssnEmbed'
				), $this->requiredComponents());
		}
		
		/**
		 * Set component settings
		 *
		 * @params $component Component id
		 *         $setting Setting name
		 *         $value Setting value
		 *
		 * @return bool;
		 */
		public function setComSETTINGS($component, $setting, $value) {
				$this->component = self::getComSettings($component);
				if(!isset($this->component->$setting)) {
						if(isset($component)) {
								$this->entity             = new OssnEntities;
								$this->entity->type       = 'component';
								$this->entity->subtype    = $setting;
								$this->entity->owner_guid = self::getComponentGuid($component);
								$this->entity->value      = $value;
								if($this->entity->add()) {
										return true;
								}
						}
				} else {
						$this->entity                 = new OssnEntities;
						$this->entity->type           = 'component';
						$this->entity->owner_guid     = self::getComponentGuid($component);
						$this->entity->data->$setting = $value;
						if($this->entity->save()) {
								return true;
						}
				}
				return false;
		}
		
		/**
		 * Get Component Settings
		 *
		 * @params $component Component id
		 *
		 * @return array;
		 */
		public function getComSettings($component) {
				$this->entity             = new OssnEntities;
				$this->entity->type       = 'component';
				$this->entity->owner_guid = self::getComponentGuid($component);
				$settings                 = $this->entity->get_entities();
				if(is_array($settings) && !empty($settings)) {
						foreach($settings as $setting) {
								$comsettings[$setting->subtype] = $setting->value;
						}
						return arrayObject($comsettings, 'OssnComponents');
				}
				return false;
		}
		
		/**
		 * Get component guid by component id
		 *
		 * @param $component Component id
		 *
		 * @return guid or false;
		 */
		public function getComponentGuid($component) {
				$params = array(
						'from' => 'ossn_components',
						'wheres' => array(
								"com_id='{$component}'"
						)
				);
				$fetch  = $this->select($params);
				if(isset($fetch->id)) {
						return $fetch->id;
				}
				return false;
		}
		
		
} //class
