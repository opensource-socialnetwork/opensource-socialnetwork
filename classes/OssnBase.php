<?php
/**
 *  Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
class OssnBase extends OssnSession {
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
