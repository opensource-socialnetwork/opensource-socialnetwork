<?php
/**
 *  OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */
class OssnBase {
    /**
     * Get guid.
     *
     * @return false|int;
     */	
	public function getGUID(){
		if(isset($this->guid)){
			return $this->guid;
		}
		return false;
	}
    /**
     * Get Id.
     *
     * @return false|int;
     */	
	public function getID(){
		if(isset($this->id)){
			return $this->id;
		}
		return false;
	}
    /**
     * Get a parameter from object
     *
     * @params = parameter
     * @param string $param
     *
     * @return string;
     */
    public function getParam($param) {
        if (isset($this->$param)) {
            return $this->$param;
        }
        return false;
    }	
}//CLASS
