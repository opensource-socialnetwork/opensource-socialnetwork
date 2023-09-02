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
        if (!$this->getPage()) {
            if ($this->addObject()) {
                return true;
            }
        } else {
            $data = array('description');
            $values = array($this->description);
            if ($this->updateObject($data, $values, $this->getPage()->guid)) {
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
		$params = array(
			'type' => 'site',
			'subtype' => "sitepage:{$this->pagename}"
		);
		$sitepage = $this->searchObject($params);
        if($sitepage) {
			return $sitepage[0];
        }
        return false;
    }

}//class
