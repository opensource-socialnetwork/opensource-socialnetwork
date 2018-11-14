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
										'gif'
								));
								$this->OssnFile->setPath('ossnads/images/');
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
				$this->OssnDatabase = new OssnDatabase;
				$this->OssnFile     = new OssnFile;
				$this->data         = new stdClass;
		}
		
		/**
		 * Get site ads.
		 *
		 * @param array $params option values
		 * @param boolean $random do you wanted to see ads in ramdom order?
		 *
		 * @return array|boolean|integer
		 */
		public function getAds(array $params = array(),  $random = true) {
				$options = array(
						'owner_guid' => 1,
						'type' => 'site',
						'subtype' => 'ossnads',
						'order_by' => 'rand()'
				);
				if(!$random){
						unset($options['order_by']);			
				}
				$args    = array_merge($options, $params);
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
						$entity               = get_ad_entity($params['guid']);
						$fields               = array(
								'title',
								'description'
						);
						$data                 = array(
								$params['title'],
								$params['description']
						);
						$this->data->site_url = $params['siteurl'];
						if($this->updateObject($fields, $data, $entity->guid)) {
								if(isset($_FILES['ossn_ads']) && $_FILES['ossn_ads']['size'] !== 0) {
										$path         = $entity->getParam('file:ossnads');
										$replace_file = ossn_get_userdata("object/{$entity->guid}/{$path}");
										if(!empty($path)) {
												$regen_image = ossn_resize_image($_FILES['ossn_ads']['tmp_name'], 2048, 2048);
												file_put_contents($replace_file, $regen_image);
										}
								}
								return true;
						}
				}
				return false;
		}
		
} //class
