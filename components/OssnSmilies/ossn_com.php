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
	ossn_extend_view('css/ossn.default', 'css/smilies/emojii');
	ossn_extend_view('css/ossn.admin.default', 'css/smilies/emojii');
 	ossn_extend_view('js/opensource.socialnetwork', 'js/smilies/emojii');
    ossn_extend_view('ossn/site/head', 'js/smilies/emojii-settings');
    ossn_extend_view('ossn/admin/head', 'js/smilies/emojii-settings');
	ossn_extend_view('comments/attachment/buttons', 'smilies/comment/button');
	
	if (ossn_isLoggedin()) {
		$component = new OssnComponents;
		$settings = $component->getComSettings('OssnSmilies');
		if($settings && $settings->compatibility_mode == 'on'){
			ossn_add_hook('wall', 'templates:item', 'ossn_embed_smiley', 100);
			ossn_add_hook('comment:view', 'template:params', 'ossn_smiley_in_comments', 100);	
			ossn_add_hook('chat', 'message:smilify', 'ossn_embed_smiley_in_chat', 100);	
			ossn_add_hook('messages', 'message:smilify', 'ossn_embed_smiley_in_messages', 100);	
		}

		$emojii_button = array(
				'name' => 'emojii_selector',
				'text' => '<i class="fa fa-smile-o"></i>',
				'href' => 'javascript:void(0);',
		);
	
		ossn_register_menu_item('wall/container/controls/home', $emojii_button);		
		ossn_register_menu_item('wall/container/controls/user', $emojii_button);	
		ossn_register_menu_item('wall/container/controls/group', $emojii_button);
		
		if(ossn_isAdminLoggedin()) {
			ossn_register_action('smilies/admin/settings', __OSSN_SMILIES__ . 'actions/smilies/admin/settings.php');
			ossn_register_com_panel('OssnSmilies', 'settings');
		}
	}
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
	if(isset($return['comment']['comments:post'])){
		$return['comment']['comments:post'] = smilify($return['comment']['comments:post']);
	} elseif(isset($return['comment']['comments:entity'])){
		$return['comment']['comments:entity'] = smilify($return['comment']['comments:entity']);		
	}
	return $return;	
}
function ossn_embed_smiley_in_chat($hook, $type, $return, $params){
	return smilify($return);
}
function ossn_embed_smiley_in_messages($hook, $type, $return, $params){
	return smilify($return);
}
//initilize ossn smilies
ossn_register_callback('ossn', 'init', 'ossn_smiley_embed_init');
