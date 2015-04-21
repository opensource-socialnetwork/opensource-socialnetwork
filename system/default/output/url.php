<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
 
/**
 * Ossn Url Display
 * Displays a URL as a link
 *
 * @uses string $params['text']        The string between the <a></a> tags.
 * @uses string $params['href']        The unencoded url string
 * @uses bool   $params['action']   Is this a link to an action (false)
 */
	if(isset($params['href'])){
		$url = $params['href'];
	}
	$text = $params['text'];

	
	if(isset($params['action']) && $params['action'] == true){
		$url = ossn_add_tokens_to_url($url);
	}
	unset($params['text']);
	unset($params['action']);
    unset($params['href']);
	
	$params['href'] = $url;
	$attributes = ossn_args($params);
		
	echo "<a {$attributes}>{$text}</a>";
