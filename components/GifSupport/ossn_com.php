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

define('GifSupport', ossn_route()->com . 'GifSupport/');
function gif_support_init() {
		ossn_add_hook('ossn', 'image:resize:gif', 'gif_support');
}
function gif_support($hook, $type, $return, $params){
		//include it when required
		require_once(GifSupport . 'classes/Gifresizer.php');
		$file = $params['file_path'];
		
		$resizer = new Gifresizer;
		$path = ossn_get_userdata() . 'gif_resizer/';
		if(!is_dir($path)){
			mkdir($path, 0755, true);
		}
		//we need to make sure it didn't resize the image if it small in size
   	 	list($actual_w, $actual_h)    =   getimagesize($params['file_path']);
		
 		if($actual_w < $params['max_width']){
			$params['max_width'] = $actual_w;
		}
 		if($actual_h < $params['max_height']){
			$params['max_height'] = $actual_h;
		}		
		//this require more conditons if actual_h == max_heigh etc..... and if same don't use resizer etc.
		// temporary layers storage
		$resizer->temp_dir = $path;
		// changed class to return just data if output file is named "stdout"
		$newimage = $resizer->resize($file, "stdout", $params['max_width'], $params['max_height']);
		return $newimage;
}
ossn_register_callback('ossn', 'init', 'gif_support_init');