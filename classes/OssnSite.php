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
class OssnSite extends OssnDatabase {
		/**
		 * Get site settings;
		 *
		 * @param string $settings settings name
		 * @param string $settings
		 *
		 * @return string
		 */
		public function getSettings($settings) {
				$params['from']   = 'ossn_site_settings';
				$params['wheres'] = array(
						"name='{$settings}'"
				);
				$this->settings   = $this->select($params);
				if(!$this->settings) {
						return false;
				}
				return $this->settings->value;
		}
		
		/**
		 * Get all site settings
		 *
		 * @return object
		 */
		/**
		 * Get all site settings
		 *
		 * @param boolean $reserved Load only reserved names 
		 *
		 * @return object
		 */
		public function getAllSettings($reserved = true) {
				$params['from'] = 'ossn_site_settings as s';
				//[E] thoughts regarding limited usage of ossn_site_settings() #1752
				if($reserved){
					//we only need all settings of reserved / required fields , other settings may not useful to us 
					//as we loading all those in start, it may burden the site.
					$reserved       = $this->reservedNames();
					array_walk($reserved, function(&$value) {
							$value = "'$value'";
					});
					$needed           = implode(',', $reserved);
					$params['wheres'] = array(
							"(s.name IN ($needed))"
					);
				}
				$this->settings = $this->select($params, true);
				foreach($this->settings as $setting) {
						$result[$setting->name] = $setting->value;
				}
				return arrayObject($result, get_class($this));
		}
		/**
		 * Update site settings
		 *
		 * @note use setSetting instead
		 *
		 * @param array $settings array(settings)
		 * @param array $values array(values)
		 * @param array $wheres array(settings id)
		 *
		 * @return boolean
		 */
		public function UpdateSettings($settings, $values, $wheres) {
				$params['table']  = 'ossn_site_settings';
				$params['names']  = $settings;
				$params['values'] = $values;
				$params['wheres'] = $wheres;
				if($this->settings = $this->update($params)) {
						return true;
				}
				return false;
		}
		/**
		 * Reserved site settings names (and avoid them to be deleted)
		 * [E] Improve Site Settings #1747		 
		 *
		 * @return boolean
		 */
		private function reservedNames() {
				return array(
						'theme',
						'site_name',
						'language',
						'cache',
						'owner_email',
						'notification_email',
						'upgrades',
						'display_errors',
						'site_key',
						'last_cache',
						'site_version'
				);
		}
		/**
		 * Delete site setting
		 * E] Improve Site Settings #1747
		 *
		 * @note use setSetting instead
		 *
		 * @param string $name Name of settings
		 *
		 * @return boolean
		 */
		public function deleteSetting($name = '') {
				if(!empty($name)) {
						$settings = $this->getSettings($name);
						if(!$settings) {
								//if no settings then it means deleted.	
								return true;
						}
						$name = trim($name);
						if(in_array($name, $this->reservedNames())) {
								throw new Exception("You can not delete the reserved site settings: {$name}");
								return false;
						}
						$params['from']   = 'ossn_site_settings';
						$params['wheres'] = array(
								"name = '{$name}'"
						);
						return $this->delete($params);
				}
				return false;
		}
		/**
		 * Set site setting
		 * [E] Improve Site Settings #1747
		 *
		 * @param string $name Name of setting
		 * @param string $value Actual value for setting
		 *
		 * @return boolean
		 */
		public function setSetting($name, $value = '') {
				if(empty($name)) {
						return false;
				}
				$name     = trim($name);
				$settings = $this->getSettings($name);
				if($settings !== false && isset($this->settings->setting_id) && !empty($this->settings->setting_id)) {
						$params['table']  = 'ossn_site_settings as s';
						$params['names']  = array(
								'value'
						);
						$params['values'] = array(
								$value
						);
						$params['wheres'] = array(
								"(s.name = '{$name}')"
						);
						return $this->update($params);
				} else {
						$params['into']   = 'ossn_site_settings';
						$params['names']  = array(
								'name',
								'value'
						);
						$params['values'] = array(
								$name,
								$value
						);
						return $this->insert($params);
				}
		}
		
} //CLASS
