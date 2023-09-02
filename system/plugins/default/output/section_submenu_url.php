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

/**
 * Ossn Url Display
 * Displays an entirely clickable section sub-menu link with leading icon
 *
 * @uses string $params['text']        	The string between the <a><li>...</li></a> tags.
 * @uses string $params['href']        	The unencoded url string
 * @uses bool   $params['action']   	  Is this a link to an action (false)
 */

if(isset($params['href'])){
    $url = $params['href'];
}
$text = '';
if(isset($params['text'])){
    $text = $params['text'];
}
$li_class = '';
if(isset($params['li_class'])){
    $li_class = $params['li_class'];
}
if(isset($params['action']) && $params['action'] == true){
    $url = ossn_add_tokens_to_url($url);
}
if(isset($params['text'])){
    unset($params['text']);
}
if(isset($params['action'])){
    unset($params['action']);
}
if(isset($params['href'])){
    unset($params['href']);
}
if(isset($params['li_class'])){
    unset($params['li_class']);
}
if(isset($url)){
    $params['href'] = $url;
}
if(is_array($params)){
	$attributes = ossn_args($params);
	echo "<a {$attributes}><li class='{$li_class}'>{$text}</li></a>";
}