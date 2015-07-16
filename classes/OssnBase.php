<?php
/**
 *  Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
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
    /**
     * isParam
     *
     * @param string $param
     *
     * @return string;
     */
    public function isParam($param) {
        if (!empty($param) && isset($this->$param)) {
            return true;
        }
        return false;
    }		
}//CLASS
