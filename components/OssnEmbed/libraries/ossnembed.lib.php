<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 
/**
 * Library modifed for Ossn, Original code is from Cash Costello.
 * Embed Video Library
 * Functions to parse flash video urls and create the flash embed object
 *
 * @package Embed Video Library
 * @license http://www.gnu.org/licenses/gpl.html GNU Public License version 2
 * @author Cash Costello
 * @copyright Cash Costello 2009-2011
 *
 *
 * Current video sites supported:
 *
 * youtube/youtu.be
 * vimeo
 * metacafe
 * dailymotion
 * hulu
 */


/**
 * Public API for library
 *
 * @param string $url either the url or embed code
 * @param integer $guid unique identifier of the widget
 * @param integer $videowidth override the admin set default width
 * @return string html video div with object embed code or error message
 */
function ossn_embed_create_embed_object($url, $guid, $videowidth=0) {

	if (!isset($url)) {
		return false;
	}
	if (strpos($url, 'youtube.com') != false) {
		//m.youtube.com not being parsed by embed component #1132
		$url = str_replace('m.youtube.com', 'www.youtube.com', $url);
 		return ossn_embed_youtube_handler($url, $guid, $videowidth);
	} else if(strpos($url, 'm.youtube.com') != false) {
		return ossn_embed_youtube_handler($url, $guid, $videowidth);		
	} else if (strpos($url, 'youtu.be') != false) {
		return ossn_embed_youtube_shortener_parse_url($url, $guid, $videowidth);
	} else if (strpos($url, 'vimeo.com') != false) {
		return ossn_embed_vimeo_handler($url, $guid, $videowidth);
	} else if (strpos($url, 'metacafe.com') != false) {
		return ossn_embed_metacafe_handler($url, $guid, $videowidth);
	} else if (strpos($url, 'dailymotion.com') != false) {
		return ossn_embed_dm_handler($url, $guid, $videowidth);
	} else if (strpos($url, 'hulu.com') != false) {
		return ossn_embed_hulu_handler($url, $guid, $videowidth);
	} else {
		return false;
	}
}

/**
 * generic css insert
 *
 * @param integer $guid unique identifier of the widget
 * @param integer/string $width
 * @param integer/string $height
 * @return string style code for video div
 */
function ossn_embed_add_css($guid, $width, $height) {
	// compatibility hack to work with ReadMore component
	// first, close still open post-text <div> here, otherwise video will become a part of collapsible area
	$videocss = "";
	$vars = array(
		'guid' => $guid,
		'width' => $width,
		'height' => $height
	);
	return ossn_call_hook('embed', 'video:css', $vars, $videocss);
}

/**
 * generic <object> creator
 *
 * @param string $type
 * @param string $url
 * @param integer $guid unique identifier of the widget
 * @param integer/string $width
 * @param integer/string $height
 * @return string <object> code
 */
function ossn_embed_add_object($type, $url, $guid, $width, $height) {
	$videodiv = "<span id=\"ossnembed{$guid}\" class=\"ossn_embed_video embed-responsive embed-responsive-16by9\">";

	// could move these into an array and use sprintf
	switch ($type) {
		case 'youtube':
			//youtube https in ossnembed.lib.php #519
			$videodiv .= "<iframe src=\"https://{$url}\" allowfullscreen></iframe>";
			break;
		case 'vimeo':
			$videodiv .= "<iframe src=\"https://player.vimeo.com/video/{$url}\" allowfullscreen></iframe>";
			break;
		case 'metacafe':
			$videodiv .= "<iframe class='embed-responsive-item' src=\"http://www.metacafe.com/embed/{$url}\" width=\"$width\" height=\"$height\" wmode=\"transparent\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\"></iframe>";
			break;
		case 'dm':
			$videodiv .= "<iframe src=\"//www.dailymotion.com/embed/video/{$url}\" width=\"$width\" height=\"$height\" allowFullScreen></iframe>"; 
			break;
		case 'hulu':
			$videodiv .= "<object class='embed-responsive-item' width=\"{$width}\" height=\"{$height}\"><param name=\"movie\" value=\"http://www.hulu.com/embed/{$url}\"></param><param name=\"allowFullScreen\" value=\"true\"></param><embed src=\"http://www.hulu.com/embed/{$url}\" type=\"application/x-shockwave-flash\" allowFullScreen=\"true\"  width=\"{$width}\" height=\"{$height}\"></embed></object>";
			break;
	}

	$videodiv .= "</span>";
	// re-open post-text again (last closing </div> comes with wall code as before )
	// hmm no need for div post-text without ending tag , removed it from here and removed ending tag from ossn_embed_add_css() 
	// $arsalanshah 12/4/2015
	return $videodiv;
}

/**
 * calculate the video width and size
 *
 * @param $width
 * @param $height
 * @param $toolbar_height
 */
function ossn_embed_calc_size(&$width, &$height, $aspect_ratio, $toolbar_height) {
	
	// make sure width is a number and greater than zero
	if (!isset($width) || !is_numeric($width) || $width < 0) {
		$width = 500;
	}
	$height = round($width / $aspect_ratio) + $toolbar_height;
}

/**
 * main youtube interface
 *
 * @param string $url
 * @param integer $guid unique identifier of the widget
 * @param integer $videowidth  optional override of admin set width
 * @return string css style, video div, and flash <object>
 */
function ossn_embed_youtube_handler($url, $guid, $videowidth) {
	// this extracts the core part of the url needed for embeding
	$videourl = ossn_embed_youtube_parse_url($url);
	if (!isset($videourl)) {
		return false;
	}

	ossn_embed_calc_size($videowidth, $videoheight, 425/320, 24);

	$embed_object = ossn_embed_add_css($guid, $videowidth, $videoheight);

	$embed_object .= ossn_embed_add_object('youtube', $videourl, $guid, $videowidth, $videoheight);

	return $embed_object;
}

/**
 * parse youtube url
 *
 * @param string $url
 * @return string subdomain.youtube.com/v/hash
 */
function ossn_embed_youtube_parse_url($url) {

	if (strpos($url, 'feature=hd') != false) {
		// this is high def with a different aspect ratio
	}

	// This provides some security against inserting bad content.
	// Divides url into http://, www or localization, domain name, path.
	if (!preg_match('/(https?:\/\/)([a-zA-Z]{2,3}\.)(youtube\.com\/)(.*)/', $url, $matches)) {
		//echo "malformed youtube url";
		return;
	}

	$domain = $matches[2] . $matches[3];
	$path = $matches[4];

	$parts = parse_url($url);
	parse_str($parts['query'], $vars);
	$hash = $vars['v'];

	return $domain . 'embed/' . $hash;
}

/**
 * parse youtu.be url
 *
 * @param string $url
 * @return string youtube.com/v/hash
 */
function ossn_embed_youtube_shortener_parse_url($url) {
	$path = parse_url($url, PHP_URL_PATH);
	$videourl = 'youtube.com/embed' . $path;

	ossn_embed_calc_size($videowidth, $videoheight, 425/320, 24);

	$embed_object = ossn_embed_add_css($guid, $videowidth, $videoheight);

	$embed_object .= ossn_embed_add_object('youtube', $videourl, $guid, $videowidth, $videoheight);

	return $embed_object;
}
/**
 * main vimeo interface
 *
 * @param string $url
 * @param integer $guid unique identifier of the widget
 * @param integer $videowidth  optional override of admin set width
 * @return string css style, video div, and flash <object>
 */
function ossn_embed_vimeo_handler($url, $guid, $videowidth) {
	// this extracts the core part of the url needed for embeding
	$videourl = ossn_embed_vimeo_parse_url($url);
	if (!isset($videourl)) {
		return false;
	}

	// aspect ratio changes based on video - need to investigate
	ossn_embed_calc_size($videowidth, $videoheight, 400/300, 0);

	$embed_object = ossn_embed_add_css($guid, $videowidth, $videoheight);

	$embed_object .= ossn_embed_add_object('vimeo', $videourl, $guid, $videowidth, $videoheight);

	return $embed_object;
}

/**
 * parse vimeo url
 *
 * @param string $url
 * @return string hash
 */
function ossn_embed_vimeo_parse_url($url) {
	// separate parsing embed url
	if (strpos($url, 'object') != false) {
		return ossn_embed_vimeo_parse_embed($url);
	}

	if (strpos($url, 'groups') != false) {
		if (!preg_match('/(https?:\/\/)(www\.)?(vimeo\.com\/groups)(.*)(\/videos\/)([0-9]*)/', $url, $matches)) {
			//echo "malformed vimeo group url";
			return;
		}
		return $matches[6];
	} 
	
	if (preg_match('/(https:\/\/)(www\.)?(vimeo.com\/)([0-9]*)/', $url, $matches)) {
			// this is the "share" link suggested by vimeo 
			return $matches[4];
	}
		
	if (preg_match('/(https:\/\/)(player\.)?(vimeo.com\/video\/)([0-9]*)/', $url, $matches)) {
			// that's the "embed" link suggested by vimeo
			return $matches[4];
	}

}

/**
 * parse vimeo embed code
 *
 * @param string $url
 * @return string hash
 */
function ossn_embed_vimeo_parse_embed($url) {
	if (!preg_match('/(value="https?:\/\/vimeo\.com\/moogaloop\.swf\?clip_id=)([0-9-]*)(&)(.*" \/)/', $url, $matches)) {
		//echo "malformed embed vimeo url";
		return;
	}

	$hash   = $matches[2];
	//echo $hash;

	return $hash;
}

/**
 * main metacafe interface
 *
 * @param string $url
 * @param integer $guid unique identifier of the widget
 * @param integer $videowidth  optional override of admin set width
 * @return string css style, video div, and flash <object>
 */
function ossn_embed_metacafe_handler($url, $guid, $videowidth) {
	// this extracts the core part of the url needed for embeding
	$videourl = ossn_embed_metacafe_parse_url($url);
	if (!isset($videourl)) {
		return false;
	}

	ossn_embed_calc_size($videowidth, $videoheight, 400/295, 40);

	$embed_object = ossn_embed_add_css($guid, $videowidth, $videoheight);

	$embed_object .= ossn_embed_add_object('metacafe', $videourl, $guid, $videowidth, $videoheight);

	return $embed_object;
}

/**
 * parse metacafe url
 *
 * @param string $url
 * @return string hash
 */
function ossn_embed_metacafe_parse_url($url) {
	// separate parsing embed url
	if (strpos($url, 'embed') != false) {
		return ossn_embed_metacafe_parse_embed($url);
	}

	if (!preg_match('/(https?:\/\/)(www\.)?(metacafe\.com\/watch\/)([0-9a-zA-Z_-]*)(\/[0-9a-zA-Z_-]*)(\/)/', $url, $matches)) {
		//echo "malformed metacafe group url";
		return;
	}

	$hash = $matches[4] . $matches[5];

	//echo $hash;

	return $hash;
}

/**
 * parse metacafe embed code
 *
 * @param string $url
 * @return string hash
 */
function ossn_embed_metacafe_parse_embed($url) {
	if (!preg_match('/(src="https?:\/\/)(www\.)?(metacafe\.com\/embed\/)([0-9]*)(\/[0-9a-zA-Z_-]*)/', $url, $matches)) {
		//echo "malformed embed metacafe url";
		return;
	}

	$hash   = $matches[4] . $matches[5];
	//echo $hash;

	return $hash;
}
/**
 * main dm interface
 *
 * @param string $url
 * @param integer $guid unique identifier of the widget
 * @param integer $videowidth  optional override of admin set width
 * @return string css style, video div, and flash <object>
 */
function ossn_embed_dm_handler($url, $guid, $videowidth) {
	// this extracts the core part of the url needed for embeding
	$videourl = ossn_embed_dm_parse_url($url);
	if (!isset($videourl)) {
		return false;
	}

	ossn_embed_calc_size($videowidth, $videoheight, 420/300, 35);

	$embed_object = ossn_embed_add_css($guid, $videowidth, $videoheight);

	$embed_object .= ossn_embed_add_object('dm', $videourl, $guid, $videowidth, $videoheight);

	return $embed_object;
}

/**
 * parse dm url
 *
 * @param string $url
 * @return string hash
 */
function ossn_embed_dm_parse_url($url) {
	if (strpos($url, 'embed') != false) {
		return false;
	}
	if (!preg_match('/(https:\/\/www\.dailymotion\.com\/(video).*\/)([0-9a-z]*)/', $url, $matches)) {
		//echo "malformed daily motion url";
		return;
	}

	$hash = $matches[3];

	//echo $hash;

	return $hash;
}
/**
 * main hulu interface
 *
 * @param string $url
 * @param integer $guid unique identifier of the widget
 * @param integer $videowidth  optional override of admin set width
 * @return string css style, video div, and flash <object>
 */
function ossn_embed_hulu_handler($url, $guid, $videowidth) {
	// this extracts the core part of the url needed for embeding
	$videourl = ossn_embed_hulu_parse_url($url);
	if (is_numeric($videourl)) {
		return false;
	}

	ossn_embed_calc_size($videowidth, $videoheight, 512/296, 0);

	$embed_object = ossn_embed_add_css($guid, $videowidth, $videoheight);

	$embed_object .= ossn_embed_add_object('hulu', $videourl, $guid, $videowidth, $videoheight);

	return $embed_object;
}

/**
 * parse hulu url
 *
 * @param string $url
 * @return string hash
 */
function ossn_embed_hulu_parse_url($url) {
	// separate parsing embed url
	if (strpos($url, 'embed') === false) {
		return 1;
	}

	if (!preg_match('/(value="https?:\/\/www\.hulu\.com\/embed\/)([a-zA-Z0-9_-]*)"(.*)/', $url, $matches)) {
		//echo "malformed blip.tv url";
		return 2;
	}

	$hash = $matches[2];

	//echo $hash;

	return $hash;
}
