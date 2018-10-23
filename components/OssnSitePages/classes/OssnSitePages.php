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
class OssnSitePages extends OssnObject {
    /**
     * Save site page
     *
     * @params $object->description: Page body
     *
     * @return bool;
     */
    public function SaveSitePage() {
        $this->title = '';
        $this->description = trim(htmlspecialchars($this->pagebody));

        $this->owner_guid = 1;
        $this->type = 'site';
        $this->subtype = "sitepage:{$this->pagename}";
        //check if page exists of not
        $this->pageget = $this->getObjectsByTypes();
        if (!is_array($this->pageget)) {
            if ($this->addObject()) {
                return true;
            }
        } else {
            $data = array('description');
            $values = array($this->description);
            if ($this->updateObject($data, $values, $this->pageget[0]->guid)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get page site page
     *
     * @return object;
     */
    public function getPage() {
        $this->type = 'site';
        $this->subtype = "sitepage:{$this->pagename}";
        $this->pageget = $this->getObjectsByTypes();
        if ($this->pageget) {
            return $this->pageget[0];
        }
        return false;
    }

}//class
