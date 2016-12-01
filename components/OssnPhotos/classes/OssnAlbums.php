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
class OssnAlbums extends OssnObject {
		/**
		 * Create a photo album
		 *
		 * @param integer $owner_id User guid who is creating album
		 * @param string $name Album name
		 * @param constant $access Album access
		 * @param string $type Album type (user, group, page etc)
		 *
		 * @return boolean
		 */
		public function CreateAlbum($owner_id, $name, $access = OSSN_PUBLIC, $type = 'user') {
				//check if acess type is valid else set public
				if(!in_array($access, ossn_access_types())) {
						$access = OSSN_PUBLIC;
				}
				//check if owner is valid user
				if(!empty($owner_id) && !empty($name) && $owner_id > 0) {
						$this->owner_guid   = $owner_id;
						$this->type         = $type;
						$this->subtype      = 'ossn:album';
						$this->data->access = $access;
						$this->title        = strip_tags($name);
						
						//add ablum
						if($this->addObject()) {
								$this->getObjectId = $this->getObjectId();
								return true;
						}
						return false;
				}
		}
		
		/**
		 * Get newly created album guid
		 *
		 * @return bool;
		 */
		public function GetAlbumGuid() {
				if(isset($this->getObjectId)) {
						return $this->getObjectId;
				}
				return false;
		}
		
		/**
		 * Get albums by owner id and owner type
		 *
		 * @param integer $owner_id User guid who is creating album
		 * @param string $type Album type (user, group, page etc)
		 *
		 * @return object
		 */
		public function GetAlbums($owner_id, $type = 'user') {
				if(!empty($owner_id)) {
						$this->owner_guid = $owner_id;
						$this->type       = $type;
						$this->subtype    = 'ossn:album';
						return $this->getObjectByOwner();
				}
		}
		
		/**
		 * Get album by id
		 *
		 * @param integer $album_id Id of album
		 *
		 * @return void|object;
		 */
		public function GetAlbum($album_id) {
				if(!empty($album_id)) {
						$this->object_guid = $album_id;
						$this->album       = $this->getObjectbyId();
						if(!empty($this->album)) {
								$this->photos             = new OssnPhotos;
								//Photos limit issue, only 10 displays #523
								$this->photos->page_limit = false;
								$this->album              = array(
										'album' => $this->album,
										'photos' => $this->photos->GetPhotos($album_id)
								);
								return arrayObject($this->album, get_class($this));
						}
				}
		}
		
		/**
		 * Get user profile photos album
		 *
		 * @param integer $user User guid
		 *
		 * @return object
		 */
		public function GetUserProfilePhotos($user) {
				$photos             = new OssnFile;
				$photos->owner_guid = $user;
				$photos->type       = 'user';
				$photos->subtype    = 'profile:photo';
				$photos->order_by   = 'guid DESC';
				return $photos->getFiles();
		}
		/**
		 * Get user cover photos album
		 *
		 * @param integer $user User guid
		 *
		 * @return object
		 */
		public function GetUserCoverPhotos($user) {
				$photos             = new OssnFile;
				$photos->owner_guid = $user;
				$photos->type       = 'user';
				$photos->subtype    = 'profile:cover';
				$photos->order_by   = 'guid DESC';
				return $photos->getFiles();
		}
		/**
		 * Delete Album
		 *
		 * @param integer $guid Album Guid
		 *
		 * @return boolean
		 */
		public function deleteAlbum($guid) {
				if(!empty($guid)) {
						$album = $this->GetAlbum($guid);
						if($album->album->owner_guid == ossn_loggedin_user()->guid || ossn_isAdminLoggedin()) {
								$photos = new OssnPhotos;
								if($album->photos) {
										foreach($album->photos as $photo) {
												$photos->photoid = $photo->guid;
												$photos->deleteAlbumPhoto();
										}
								}
								if($album->album->deleteObject()) {
										return true;
								}
						}
				}
				return false;
		}
		
}
