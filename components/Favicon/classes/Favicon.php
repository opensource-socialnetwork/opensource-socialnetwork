<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
 class Favicon {
	 public static function Upload(){
		$dir = ossn_route()->com . 'Favicon/images/'; 
		if(!is_dir($dir)){
			mkdir($dir, 0755, true);
		}
		$image = $_FILES['icon'];
		if(!empty($image)){
			$file = file_get_contents($image['tmp_name']);
			return file_put_contents($dir . 'favicon.ico', $file);
		}
		return false;
	 }
 }//class