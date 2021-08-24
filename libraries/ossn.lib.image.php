<?php
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  https://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
/**
 * Gets the jpeg contents of the resized version of an already uploaded image
 * (Returns false if the file was not an image)
 *
 * @param string $input_name The name of the file on the disk
 * @param int    $maxwidth The desired width of the resized image
 * @param int    $maxheight The desired height of the resized image
 * @param bool   $square If it is true it will return a croped image based on w&h
 *
 * @return false|string The contents of the resized image, or false on failure
 */
function ossn_resize_image($input_name, $maxwidth, $maxheight, $square = false){
		// Get the size information from the image
		$imgsizearray = getimagesize($input_name);
		if($imgsizearray == false){
				return false;
		}
		$image = new OssnImage($input_name);

		$accepted_formats = array(
				'image/jpeg'  => 'jpeg',
				'image/pjpeg' => 'jpeg',
				'image/png'   => 'png',
				'image/x-png' => 'png',
				'image/gif'   => 'gif',
		);

		// make sure the function is available
		$load_function = 'imagecreatefrom' . $accepted_formats[$imgsizearray['mime']];
		if(!is_callable($load_function)){
				return false;
		}
		//OssnFile to support animated gif photos #1473
		if($load_function == 'imagecreatefromgif' && ossn_is_hook('ossn', 'image:resize:gif')){
				$image_resize_options = array(
						'max_width'  => $maxwidth,
						'max_height' => $maxheight,
						'file_path'  => $input_name,
				);
				return ossn_call_hook('ossn', 'image:resize:gif', $image_resize_options, false);
		}
		//quality set
		$imagejpeg_quality = ossn_call_hook('ossn', 'image:resize:quality', false, 50);
		if($square === true){
				$image->crop($maxwidth, $maxheight);
		} else {
				$image->resizeToBestFit($maxwidth, $maxheight);
		}
		return $image->getImageAsString(IMAGETYPE_JPEG, $imagejpeg_quality);
}
/**
 * Get image crop sizes for profile picture
 *
 * @return The contents of generate image
 */
function ossn_user_image_sizes(){
		return array(
				'topbar'  => '20x20',
				'small'   => ' 50x50',
				'smaller' => '32x32',
				'large'   => '100x100',
				'larger'  => '170x170',
		);
}
/**
 * Conver multiple images into normalized array
 *
 * @param array $files An array of files
 * @return boolean|array
 */
function ossn_input_images($name){
		$files = $_FILES[$name];
		if(!isset($files)){
				return false;
		}
		$_files       = array();
		$_files_count = count($files['name']);
		$_files_keys  = array_keys($files);
		for($i = 0; $i < $_files_count; $i++){
				foreach ($_files_keys as $key){
						$_files[$i][$key] = $files[$key][$i];
				}
		}
		return $_files;
}
