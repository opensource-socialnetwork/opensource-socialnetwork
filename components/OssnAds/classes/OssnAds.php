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
class OssnAds extends OssnObject {
    /**
     * Add a new ad in system.
     *
     * @return bool;
     */
    public function addNewAd($params) {
        self::initAttributes();

        $this->title = $params['title'];
        $this->description = $params['description'];
        $this->data->site_url = $params['siteurl'];

        $this->owner_guid = 1;
        $this->type = 'site';
        $this->subtype = 'ossnads';

        if ($this->addObject()) {
            if (isset($_FILES['ossn_ads'])) {
                $this->OssnFile->owner_guid = $this->getObjectId();
                $this->OssnFile->type = 'object';
                $this->OssnFile->subtype = 'ossnads';
                $this->OssnFile->setFile('ossn_ads');
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
        $this->OssnFile = new OssnFile;
    }

    /**
     * Get site ads.
     *
     * @return object;
     */
    public function getAds() {
        $this->owner_guid = 1;
        $this->type = 'site';
        $this->subtype = 'ossnads';
        return $this->getObjectByOwner();
    }

    public function deleteAd($ad) {
        if ($this->deleteObject($ad)) {
            return true;
        }
        return false;
    }

}//class