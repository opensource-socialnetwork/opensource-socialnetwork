<?php
/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.com/licence
 */
/**
* Register a menu;
* @params: $name  = name of menu;
* @params:  $text = text for menu;
* @params $link = link for menu;
*
* @last edit: $arsalanshah
* @return void 
*/ 
function ossn_register_menu_link($name , $text, $link , $menutype = 'site'){
	global $Ossn;	
    $Ossn->menu[$menutype][$name][$text] = $link;
}

/**
* Unregister menu from system;
* @params: $menu = menu name
*
* @last edit: $arsalanshah
* @return void;
* 
*/
function ossn_unregister_menu($menu, $menutype = 'site'){
	global $Ossn;
	unset($Ossn->menu[$menutype][$menu]);
}
/**
* View a menu;
* @params: $menu = menu name
* @note This will fetch layout from defualt template that how menu should appear; check menu file for more info;
*
* @last edit: $arsalanshah
* @return: mixed data;
* 
*/
function ossn_view_menu($menu, $custom = false){
	global $Ossn;
	$params['menu'] = $Ossn->menu[$menu];
	if($custom == false){
	    $active_theme = ossn_site_settings('theme'); 
	    $params['menuname'] = $menu;
 	    return ossn_view("themes/{$active_theme}/menus/{$menu}", $params);
	} elseif($custom !== false){
		$params['menuname'] = $menu;
 	    return ossn_view($custom, $params);
	}
}
/**
* Register a section base menu;
* @params: $params array(type, section, url, text, icon, link)
*
* @last edit: $arsalanshah
* @return void 
*/
function ossn_register_sections_menu($menu, $params){
	global $Ossn;	
	$type = $params['type'];
	$link = $params['url'];
	$text = $params['text'];
	$type = $params['type'];
	$icon = $params['icon'];
	$section = $params['section'];
	if(empty($type)){
	 $type = 'frontend';	
	}
    $Ossn->sectionsmenu[$type][$menu][$section][$text] = array($link, $icon, $params['params']);
}
/**
* View section base menu;
* @params: $type = (frontend or backend(
* @note This will fetch layout from defualt template that how menu should appear; check menu file for more info;
*
* @last edit: $arsalanshah
* @return: mixed data;
* 
*/
function ossn_view_sections_menu($menu, $type = 'frontend'){
 global $Ossn;	
  if(isset($menu) && isset($Ossn->sectionsmenu[$type][$menu])){
	$active_theme = ossn_site_settings('theme'); 
	$params['menu'] =  $Ossn->sectionsmenu[$type][$menu];
	$params['menuname'] = $menu;
 	return ossn_view("themes/{$active_theme}/menus/sections/{$menu}", $params);
}	
}