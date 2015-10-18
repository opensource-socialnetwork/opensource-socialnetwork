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
 
define('__OSSN_EMBED__', ossn_route()->com . 'OssnEmbed/');
require_once(__OSSN_EMBED__ . 'libraries/ossnembed.lib.php');
require_once(__OSSN_EMBED__ . 'vendors/linkify/linkify.php');

/**
 * Initialize Ossn Embed component
 *
 * @note Please don't call this function directly in your code.
 * 
 * @return void
 * @access private
 */
function ossn_embed_init() {	
 	ossn_add_hook('wall', 'templates:item', 'ossn_embed_wall_template_item');
	ossn_add_hook('comment:view', 'template:params', 'ossn_embed_comments_template_params');
}
/**https://player.vimeo.com/video/15371813
 * Replace videos links and simple url to html url.
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
function ossn_embed_wall_template_item($hook, $type, $return){
	$patterns = array(	'#(((https?://)?)|(^./))(((www.)?)|(^./))youtube\.com/watch[?]v=([^\[\]()<.,\s\n\t\r]+)#i',
						'#(((https?://)?)|(^./))(((www.)?)|(^./))youtu\.be/([^\[\]()<.,\s\n\t\r]+)#i',
						'/(https?:\/\/)(www\.)?(vimeo\.com\/groups)(.*)(\/videos\/)([0-9]*)/',
						'/(https?:\/\/)(www\.)?(vimeo.com\/)([0-9]*)/',
						'/(https?:\/\/)(player\.)?(vimeo.com\/video\/)([0-9]*)/',
						'/(https?:\/\/)(www\.)?(metacafe\.com\/watch\/)([0-9a-zA-Z_-]*)(\/[0-9a-zA-Z_-]*)(\/)/',
						'/(https?:\/\/www\.dailymotion\.com\/.*\/)([0-9a-z]*)/',
						);
	$regex = "/<a[\s]+[^>]*?href[\s]?=[\s\"\']+"."(.*?)[\"\']+.*?>"."([^<]+|.*?)?<\/a>/";
	
	$return['text'] = linkify($return['text']);
	if(preg_match_all($regex, $return['text'], $matches, PREG_SET_ORDER)){
	foreach($matches as $match){
			foreach ($patterns as $pattern){
				if (preg_match($pattern, $match[2]) > 0){
					$return['text'] = str_replace($match[0], ossn_embed_create_embed_object($match[2], uniqid('videos_embed_'), 500), $return['text']);
				}				
			}
		}
	}
	return $return;
}
/**
 * Convert text links from comments into html links
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
function ossn_embed_comments_template_params($hook, $type, $return, $params){
	$return['comment']['comments:post'] = linkify($return['comment']['comments:post']);
	return $return;
}
//initilize ossn wall
ossn_register_callback('ossn', 'init', 'ossn_embed_init');
