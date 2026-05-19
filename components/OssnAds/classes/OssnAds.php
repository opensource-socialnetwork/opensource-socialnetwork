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
class OssnAds extends OssnObject {
		/**
		 * Add a new ad in system.
		 *
		 * @return bool;
		 */
		public function adCreate($params) {
				self::initAttributes();

				$this->title          = $params['title'];
				$this->description    = $params['description'];
				$this->data->site_url = $params['siteurl'];

				$this->owner_guid = 1;
				$this->type       = 'site';
				$this->subtype    = 'ossnads';

				if(!isset($params['expiry_date'])) {
						$params['expiry_date'] = false;
				}
				$this->data->views_count   = 0;
				$this->data->clicks_count  = 0;
				$this->data->placement     = json_encode($params['placement']);
				$this->data->gender_target = json_encode($params['gender_target']);
				$this->data->expired       = false;
				$this->data->expire_time   = $params['expiry_date'];

				if(empty($_FILES['ossn_ads']['tmp_name'])) {
						return false;
				}
				if($guid = $this->addObject()) {
						if(isset($_FILES['ossn_ads'])) {
								$this->OssnFile->owner_guid = $guid;
								$this->OssnFile->type       = 'object';
								$this->OssnFile->subtype    = 'ossnads';
								$this->OssnFile->setFile('ossn_ads');
								$this->OssnFile->setExtension(array(
										'jpg',
										'png',
										'jpeg',
										'jfif',
										'gif',
										'webp', //[E] OssnAds add support for webp #2558
								));
								$this->OssnFile->setPath('ossnads/images/');
								if(ossn_file_is_cdn_storage_enabled()) {
										$this->OssnFile->setStore('cdn');
								}
								if(!$this->OssnFile->addFile()) {
										$object = ossn_get_object($guid);
										$object->deleteObject();
										return false;
								}
						}
						ossn_trigger_callback('ad', 'created', array(
								'instance' => $this,
						));
						return true;
				}
				return false;
		}

		/**
		 * Initialize the objects.
		 *
		 * @return void;
		 */
		public function initAttributes() {
				$this->OssnDatabase = new OssnDatabase();
				$this->OssnFile     = new OssnFile();
				$this->data         = new stdClass();
		}

		/**
		 * Get site ads.
		 *
		 * @param array $params option values
		 * @param boolean $random do you wanted to see ads in ramdom order?
		 *
		 * @return array|boolean|integer
		 */
		public function getAds(array $params = array(), $random = true) {
				$options = array(
						'owner_guid' => 1,
						'type'       => 'site',
						'subtype'    => 'ossnads',
						'order_by'   => 'rand()',
				);
				if(!$random) {
						unset($options['order_by']);
				}
				$args = array_merge($options, $params);
				return $this->searchObject($args);
		}
		/**
		 * Get Expired
		 *
		 * @return boolean|object
		 */
		public function getExpired(array $params = array()) {
				$time    = time();
				$options = array(
						'owner_guid'     => 1,
						'type'           => 'site',
						'subtype'        => 'ossnads',
						'entities_pairs' => array(
								array(
										'name'  => 'expired',
										'value' => false,
								),
								array(
										'name'   => 'expire_time',
										'value'  => true,
										'wheres' => "(CAST([this].value AS UNSIGNED) < {$time} AND [this].value !='')",
								),
						),
				);

				$args = array_merge($options, $params);
				return $this->searchObject($args);
		}
		/**
		 * Get site ads by placement area.
		 * This ads gender option itself
		 *
		 * @param array $params option values
		 * @param string $placement Area where for which ads are created (newsfeed, profile, groups, global)
		 * @param boolean $random do you wanted to see ads in ramdom order?
		 *
		 * @return array|boolean|integer
		 */
		public function getByPlacement($placement, array $params = array(), $random = true) {
				if(empty($placement)) {
						return false;
				}
				$options = array(
						array(
								'name'  => 'expired',
								'value' => false,
						),
						array(
								'name'   => 'placement',
								'value'  => true,
								'wheres' => "JSON_CONTAINS(emd1.value, '\"{$placement}\"')",
						),
				);

				if(ossn_isLoggedin()) {
						$gender = ossn_loggedin_user()->gender;
						if(!empty($gender)) {
								$options[] = array(
										'name'   => 'gender_target',
										'value'  => true,
										'wheres' => "JSON_CONTAINS(emd2.value, '\"{$gender}\"')",
								);
						}
				}
				$options = array(
						'owner_guid'     => 1,
						'type'           => 'site',
						'subtype'        => 'ossnads',
						'order_by'       => 'rand()',
						'entities_pairs' => $options,
				);
				if(!$random) {
						unset($options['order_by']);
				}

				$args = array_merge($options, $params);
				return $this->searchObject($args);
		}

		/**
		 * Get ad entity
		 *
		 * @param (int) $guid ad guid
		 *
		 * @return object;
		 */
		public function getAd($guid) {
				$this->object_guid = $guid;
				return $this->getObjectById();
		}
		/**
		 * Edit ad set
		 *
		 * @param integer $guid AD GUID
		 * @return boolean
		 */
		public function editAd($params) {
				$empty = false;
				foreach ($params as $key => $item) {
						if($key != 'expiry_date' && empty($key)) {
								$empty = true;
						}
				}
				if($empty) {
						return false;
				}
				$ad = ossn_get_ad($params['guid']);
				//disable expired ad to edit
				if(isset($ad->expired) && $ad->expired == true) {
						return false;
				}

				$ad->title       = $params['title'];
				$ad->description = $params['description'];

				$ad->data->site_url      = $params['siteurl'];
				$ad->data->placement     = json_encode($params['placement']);
				$ad->data->gender_target = json_encode($params['gender_target']);

				if(!isset($params['expiry_date']) || (isset($params['expiry_date']) && empty($params['expiry_date']))) {
						$params['expiry_date'] = false;
				}
				$ad->data->expire_time = $params['expiry_date'];

				$OssnFile = new OssnFile();
				if($ad->save()) {
						if(isset($_FILES['ossn_ads']) && $_FILES['ossn_ads']['size'] !== 0) {
								if($file = $ad->getPhotoFile()) {
										$file->deleteFile();
								}
								$OssnFile->owner_guid = $ad->guid;
								$OssnFile->type       = 'object';
								$OssnFile->subtype    = 'ossnads';
								$OssnFile->setFile('ossn_ads');
								$OssnFile->setExtension(array(
										'jpg',
										'png',
										'jpeg',
										'jfif',
										'gif',
										'webp', //[E] OssnAds add support for webp #2558
								));
								$OssnFile->setPath('ossnads/images/');
								if(ossn_file_is_cdn_storage_enabled()) {
										$OssnFile->setStore('cdn');
								}
								$OssnFile->addFile();
						}
						return true;
				}
				return false;
		}
		/**
		 * Get ads photo URL
		 *
		 * @return string|bool
		 */
		public function getPhotoURL() {
				if(isset($this->{'file:ossnads'})) {
						$image = md5($this->guid) . '.jpg';
						if($this->time_updated == 0) {
								$this->time_updated = $this->time_created;
						}
						return ossn_add_cache_to_url(ossn_site_url("ossnads/photo/{$this->guid}/{$this->time_updated}/{$image}"));
				}
				return false;
		}
		/**
		 * Ad URL
		 *
		 * @return string|bool
		 */
		public function goURL() {
				return ossn_site_url("ossnads/go/{$this->guid}/load.html");
		}
		/**
		 * Increase the increment for clicks
		 *
		 * @return boolean
		 */
		public function incClicks() {
				$this->data->clicks_count = intval($this->clicks_count) + 1;
				return $this->save();
		}
		/**
		 * Increase the increment for views
		 *
		 * @return boolean
		 */
		public function incViews() {
				$this->data->views_count = intval($this->views_count) + 1;
				return $this->save();
		}
		/**
		 * Get ads photo file
		 *
		 * @return string|object
		 */
		public function getPhotoFile() {
				$file   = new OssnFile();
				$search = $file->searchFiles(array(
						'limit'      => 1,
						'owner_guid' => $this->guid,
						'type'       => 'object',
						'subtype'    => 'ossnads',
				));
				if($search) {
						return $search[0];
				}
				return false;
		}
} //class