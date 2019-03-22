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
	$text = $params['text'];
	$li_class = $params['li_class'];

	
	if(isset($params['action']) && $params['action'] == true){
		$url = ossn_add_tokens_to_url($url);
	}
	unset($params['text']);
	unset($params['action']);
    unset($params['href']);
	unset($params['li_class']);
	
	$params['href'] = $url;
	$attributes = ossn_args($params);
		
	echo "<a {$attributes}><li class='{$li_class}'>{$text}</li></a>";
