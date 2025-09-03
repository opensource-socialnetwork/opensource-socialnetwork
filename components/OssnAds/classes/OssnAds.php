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
		public function addNewAd($params) {
				self::initAttributes();

				$this->title          = $params['title'];
				$this->description    = $params['description'];
				$this->data->site_url = $params['siteurl'];

				$this->owner_guid = 1;
				$this->type       = 'site';
				$this->subtype    = 'ossnads';
				if(empty($_FILES['ossn_ads']['tmp_name'])) {
						return false;
				}
				if($this->addObject()) {
						if(isset($_FILES['ossn_ads'])) {
								$this->OssnFile->owner_guid = $this->getObjectId();
								$this->OssnFile->type       = 'object';
								$this->OssnFile->subtype    = 'ossnads';
								$this->OssnFile->setFile('ossn_ads');
								$this->OssnFile->setExtension(array(
										'jpg',
										'png',
										'jpeg',
										'jfif',
										'gif',
								));
								$this->OssnFile->setPath('ossnads/images/');
								if(ossn_file_is_cdn_storage_enabled()) {
										$this->OssnFile->setStore('cdn');
								}
								$this->OssnFile->addFile();
						}
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
		 * Delete ad
		 *
		 * @param (int) $ad ad guid
		 *
		 * @return bool;
		 */
		public function deleteAd($ad) {
				if($this->deleteObject($ad)) {
						return true;
				}
				return false;
		}
		/**
		 * Edit
		 *
		 * @param (array) $params Contain title , description and guid of ad
		 *
		 * @return bool;
		 */
		public function EditAd($params) {
				self::initAttributes();
				if(!empty($params['guid']) && !empty($params['title']) && !empty($params['description']) && !empty($params['siteurl'])) {
						$entity = get_ad_entity($params['guid']);
						$fields = array(
								'title',
								'description',
						);
						$data = array(
								$params['title'],
								$params['description'],
						);
						$this->data->site_url 	  = $params['siteurl'];
						$this->data->time_updated = time();
						if($this->updateObject($fields, $data, $entity->guid)) {
								if(isset($_FILES['ossn_ads']) && $_FILES['ossn_ads']['size'] !== 0) {
										if($file = $entity->getPhotoFile()) {
												$file->deleteFile();
										}
										$this->OssnFile->owner_guid = $entity->guid;
										$this->OssnFile->type       = 'object';
										$this->OssnFile->subtype    = 'ossnads';
										$this->OssnFile->setFile('ossn_ads');
										$this->OssnFile->setExtension(array(
												'jpg',
												'png',
												'jpeg',
												'jfif',
												'gif',
										));
										$this->OssnFile->setPath('ossnads/images/');
										if(ossn_file_is_cdn_storage_enabled()) {
												$this->OssnFile->setStore('cdn');
										}
										$this->OssnFile->addFile();
								}
								return true;
						}
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
						if(!isset($this->time_updated)){
							$this->time_updated = $this->time_created;	
						}
						return ossn_add_cache_to_url(ossn_site_url("ossnads/photo/{$this->guid}/{$this->time_updated}/{$image}"));
				}
				return false;
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
