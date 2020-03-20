<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  https://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
/**
 * See licenses/elgg/LICENSE.txt
 */
/**
 * Calculate the parameters for resizing an image
 *
 * @param int $width Width of the original image
 * @param int $height Height of the original image
 * @param array $options See $defaults for the options
 *
 * @return resource or FALSE
 */
function ossn_image_resize_parameters($width, $height, $options) {

    $defaults = array(
        'maxwidth' => 100,
        'maxheight' => 100,

        'square' => FALSE,
        'upscale' => FALSE,

        'x1' => 0,
        'y1' => 0,
        'x2' => 0,
        'y2' => 0,
    );

    $options = array_merge($defaults, $options);

    extract($options);

    // crop image first?
    $crop = TRUE;
    if ($x1 == 0 && $y1 == 0 && $x2 == 0 && $y2 == 0) {
        $crop = FALSE;
    }

    // how large a section of the image has been selected
    if ($crop) {
        $selection_width = $x2 - $x1;
        $selection_height = $y2 - $y1;
    } else {
        // everything selected if no crop parameters
        $selection_width = $width;
        $selection_height = $height;
    }

    // determine cropping offsets
    if ($square) {
        // asking for a square image back

        // detect case where someone is passing crop parameters that are not for a square
        if ($crop == TRUE && $selection_width != $selection_height) {
            return FALSE;
        }

        // size of the new square image
        $new_width = $new_height = min($maxwidth, $maxheight);

        // find largest square that fits within the selected region
        $selection_width = $selection_height = min($selection_width, $selection_height);

        // set offsets for crop
        if ($crop) {
            $widthoffset = $x1;
            $heightoffset = $y1;
            $width = $x2 - $x1;
            $height = $width;
        } else {
            // place square region in the center
            $widthoffset = floor(($width - $selection_width) / 2);
            $heightoffset = floor(($height - $selection_height) / 2);
        }
    } else {
        // non-square new image
        $new_width = $maxwidth;
        $new_height = $maxheight;

        // maintain aspect ratio of original image/crop
        if (($selection_height / (float)$new_height) > ($selection_width / (float)$new_width)) {
            $new_width = floor($new_height * $selection_width / (float)$selection_height);
        } else {
            $new_height = floor($new_width * $selection_height / (float)$selection_width);
        }

        // by default, use entire image
        $widthoffset = 0;
        $heightoffset = 0;

        if ($crop) {
            $widthoffset = $x1;
            $heightoffset = $y1;
        }
    }

    if (!$upscale && ($selection_height < $new_height || $selection_width < $new_width)) {
        // we cannot upscale and selected area is too small so we decrease size of returned image
        if ($square) {
            $new_height = $selection_height;
            $new_width = $selection_width;
        } else {
            if ($selection_height < $new_height && $selection_width < $new_width) {
                $new_height = $selection_height;
                $new_width = $selection_width;
            }
        }
    }

    $params = array(
        'newwidth' => $new_width,
        'newheight' => $new_height,
        'selectionwidth' => $selection_width,
        'selectionheight' => $selection_height,
        'xoffset' => $widthoffset,
        'yoffset' => $heightoffset,
    );

    return $params;
}

/**
 * Gets the jpeg contents of the resized version of an already uploaded image
 * (Returns false if the file was not an image)
 *
 * @param string $input_name The name of the file on the disk
 * @param int $maxwidth The desired width of the resized image
 * @param int $maxheight The desired height of the resized image
 * @param bool $square If set to true, takes the smallest of maxwidth and
 *                             maxheight and use it to set the dimensions on the new image.
 *                           If no crop parameters are set, the largest square that fits
 *                           in the image centered will be used for the resize. If square,
 *                           the crop must be a square region.
 * @param int $x1 x coordinate for top, left corner
 * @param int $y1 y coordinate for top, left corner
 * @param int $x2 x coordinate for bottom, right corner
 * @param int $y2 y coordinate for bottom, right corner
 * @param bool $upscale Resize images smaller than $maxwidth x $maxheight?
 *
 * @return false|string The contents of the resized image, or false on failure
 */
function ossn_resize_image($input_name, $maxwidth, $maxheight, $square = FALSE, $x1 = 0, $y1 = 0, $x2 = 0, $y2 = 0, $upscale = FALSE) {

    // Get the size information from the image
    $imgsizearray = getimagesize($input_name);
    if ($imgsizearray == false) {
        return false;
    }

    $width = $imgsizearray[0];
    $height = $imgsizearray[1];

    $accepted_formats = array(
        'image/jpeg' => 'jpeg',
        'image/pjpeg' => 'jpeg',
        'image/png' => 'png',
        'image/x-png' => 'png',
        'image/gif' => 'gif'
    );

    // make sure the function is available
    $load_function = "imagecreatefrom" . $accepted_formats[$imgsizearray['mime']];
    if (!is_callable($load_function)) {
        return false;
    }

    // get the parameters for resizing the image
    $options = array(
        'maxwidth' => $maxwidth,
        'maxheight' => $maxheight,
        'square' => $square,
        'upscale' => $upscale,
        'x1' => $x1,
        'y1' => $y1,
        'x2' => $x2,
        'y2' => $y2,
    );
    $params = ossn_image_resize_parameters($width, $height, $options);
    if ($params == false) {
        return false;
    }
	//OssnFile to support animated gif photos #1473
	if ($load_function == 'imagecreatefromgif' && ossn_is_hook('ossn','image:resize:gif')) {
			$image_resize_options = array(
					'max_width' => $maxwidth,
					'max_height' => $maxheight,
					'file_path' => $input_name,
			);
			return ossn_call_hook('ossn', 'image:resize:gif', $image_resize_options, false);
	}
    // load original image
    $original_image = call_user_func($load_function, $input_name);
    if (!$original_image) {
        return false;
    }

    // allocate the new image
    $new_image = imagecreatetruecolor($params['newwidth'], $params['newheight']);
    if (!$new_image) {
        return false;
    }

    // color transparencies white (default is black)
    imagefilledrectangle($new_image, 0, 0, $params['newwidth'], $params['newheight'], imagecolorallocate($new_image, 255, 255, 255));

    $rtn_code = imagecopyresampled($new_image, $original_image, 0, 0, $params['xoffset'], $params['yoffset'], $params['newwidth'], $params['newheight'], $params['selectionwidth'], $params['selectionheight']);
    if (!$rtn_code) {
        return false;
    }

    //quality set 
    $imagejpeg_quality = ossn_call_hook('ossn', 'image:resize:quality', false, 90);
	
    // grab a compressed jpeg version of the image
    ob_start();
    imagejpeg($new_image, null, $imagejpeg_quality);
    $jpeg = ob_get_clean();

    imagedestroy($new_image);
    imagedestroy($original_image);

    return $jpeg;
}

/**
 * Convert image to jpeg and compress it
 *
 * @return The contents of generate image
 */
function ossn_save_image($file, $destination) {
    $info = getimagesize($file);
    $image_quality = ossn_call_hook('ossn', 'image:save:quality', false, 90);
	
    if($info['mime'] == 'image/jpeg'){
        $image = imagecreatefromjpeg($file);
    } elseif($info['mime'] == 'image/gif'){
        $image = imagecreatefromgif($file);
    } elseif ($info['mime'] == 'image/png'){
         $image = imagecreatefrompng($file);
    }
    imagejpeg($image, $destination, $image_quality);
}

/**
 * Get image crop sizes for profile picture
 *
 * @return The contents of generate image
 */
function ossn_user_image_sizes() {
    return array(
        'topbar' => '20x20',
        'small' => ' 50x50',
        'smaller' => '32x32',
        'large' => '100x100',
        'larger' => '170x170',
    );
}
/**
 * Conver multiple images into normalized array
 *
 * @param array $files An array of files
 * @return boolean|array
 */
function ossn_input_images($name) {
		$files = $_FILES[$name];
		if(!isset($files)) {
				return false;
		}
		$_files       = array();
		$_files_count = count($files['name']);
		$_files_keys  = array_keys($files);
		for($i = 0; $i < $_files_count; $i++) {
				foreach($_files_keys as $key) {
						$_files[$i][$key] = $files[$key][$i];
				}
		}
		return $_files;
}
