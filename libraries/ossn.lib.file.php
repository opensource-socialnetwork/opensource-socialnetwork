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

/**
 * Get file
 * 
 * @param integer $guid A file guid
 * 
 * @return object|boolean
 */
function ossn_get_file($guid) {
		$file       = new OssnFile;
		$file->guid = $guid;
		$file       = $file->getFile();
		if($file) {
				return $file;
		}
		return false;
}