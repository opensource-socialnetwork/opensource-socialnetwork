<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
 
define('__OSSN_SMILIES__', ossn_route()->com . 'OssnSmilies/');
require_once(__OSSN_SMILIES__ . 'libraries/smilify.lib.php');

/**
 * Initialize Ossn Smilies component
 *
 * @note Please don't call this function directly in your code.
 * 
 * @return void
 * @access private
 */
function ossn_smiley_embed_init() {	
 	ossn_add_hook('wall', 'templates:item', 'ossn_embed_smiley', 100);
	ossn_add_hook('comment:view', 'template:params', 'ossn_smiley_in_comments', 100);	
}
/**
 * Replace certain ascii patterns with ossn emoticons.
 *
 * @note Please don't call this function directly in your code.
 * 
 * @param string $hook Name of hook
 * @param string $type Hook type
 * @param array|object $return Array or Object
 * @params array $params Array contatins params
 *
 * @return array
 * @access private
 */
function ossn_embed_smiley($hook, $type, $return, $params){
	$params['text'] = smilify($return['text']);
	return $params;
}
/**
 * Replace certain ascii patterns with ossn emoticons in comments.
 *
 * @note Please don't call this function directly in your code.
 * 
 * @param string $hook Name of hook
 * @param string $type Hook type
 * @param array|object $return Array or Object
 * @params array $params Array contatins params
 *
 * @return array
 * @access private
 */
function ossn_smiley_in_comments($hook, $type, $return, $params){
	$return['comment']['comments:post'] = smilify($return['comment']['comments:post']);
	return $return;	
}
//initilize ossn smilies
ossn_register_callback('ossn', 'init', 'ossn_smiley_embed_init');
