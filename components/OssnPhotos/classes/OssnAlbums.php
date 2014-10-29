<?php

/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */
class OssnAlbums extends OssnObject {
    /**
     * Create a photo album
     *
     * @params = $owner_id User guid who is creating album
     *           $name Album name
     *           $acess Album access
     *           $type Album type (user, group, page etc)
     *
     * @return bool;
     */
    public function CreateAlbum($owner_id, $name, $access = OSSN_PUBLIC, $type = 'user') {
        //check if acess type is valid else set public
        if (!in_array($access, ossn_access_types())) {
            $access = OSSN_PUBLIC;
        }
        //check if owner is valid user
        if (!empty($owner_id) && !empty($name) && $owner_id > 0) {
            $this->owner_guid = $owner_id;
            $this->type = $type;
            $this->subtype = 'ossn:album';
            $this->data->access = $access;
            $this->title = strip_tags($name);

            //add ablum
            if ($this->addObject()) {
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
        if (isset($this->getObjectId)) {
            return $this->getObjectId;
        }
        return false;
    }

    /**
     * Get albums by owner id and owner type
     *
     * @params = $owner_id User guid who is creating album
     *           $type Album type (user, group, page etc)
     *
     * @return object;
     */
    public function GetAlbums($owner_id, $type = 'user') {
        if (!empty($owner_id)) {
            $this->owner_guid = $owner_id;
            $this->type = $type;
            $this->subtype = 'ossn:album';
            return $this->getObjectByOwner();
        }
    }

    /**
     * Get album by id
     *
     * @params = $album_id Id of album
     *
     * @return object->album object->photos;
     */
    public function GetAlbum($album_id) {
        if (!empty($album_id)) {
            $this->object_guid = $album_id;
            $this->album = $this->getObjectbyId();
            if (!empty($this->album)) {
                $this->photos = new OssnPhotos;
                $this->album = array(
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
     * @params = $user User guid
     *
     * @return object;
     */
    public function GetUserProfilePhotos($user) {
        $photos = new OssnFile;
        $photos->owner_guid = $user;
        $photos->type = 'user';
        $photos->subtype = 'profile:photo';
        $photos->order_by = 'guid DESC';
        return $photos->getFiles();
    }

}