<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2016 SOFTLAB24 LIMITED
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

/**
 * Register a menu;
 * @param string $name Name of menu;
 * @param string $text Text for menu;
 * @param string $link Link for menu;
 *
 * @return void
 */
function ossn_register_menu_link($name, $text, $link, $menutype = 'site') {
				ossn_register_menu_item($menutype, array(
								'name' => $name,
								'text' => $text,
								'href' => $link
				));
}
/**
 * Register a menu item
 *
 * @param string $name menu name;
 * @param array  $options A link options;
 * @param string $menutype A menu name
 *
 * @return void
 */
function ossn_register_menu_item($menutype, array $options = array()) {
				$menu = new OssnMenu($menutype, $options);
				$menu->register();
}

/**
 * Unregister menu from system;
 * @param string $menu Menu name
 * @param string  $menutype MenuType
 *
 * @return void;
 *
 */
function ossn_unregister_menu($menu, $menutype = 'site') {
				global $Ossn;
				unset($Ossn->menu[$menutype][$menu]);
}
/**
 * Unregister Type -> Menu -> Menu Item
 *
 * @param string $name Name of Menu Item
 * @param string $menu Name of Menu
 * @param string $menutype The name of menutype
 * 
 * @return void
 */
function ossn_unregister_menu_item($name, $menu, $menutype = 'site') {
				global $Ossn;
				if(isset($Ossn->menu[$menutype][$menu])) {
								foreach($Ossn->menu[$menutype][$menu] as $key => $item) {
												if($item['name'] == $name) {
																unset($Ossn->menu[$menutype][$menu][$key]);
												}
								}
				}
}
/**
 * View a menu
 *
 * @param string $menu Menu name
 * @param boolean $custom if the file path is custom
 *
 * @note This will fetch layout from defualt template that how menu should appear; check menu file for more info;
 *
 * @return string
 */
function ossn_view_menu($menu, $custom = false) {
				global $Ossn;
				if(!isset($Ossn->menu[$menu])) {
								return false;
				}
				$ossnmenu = new OssnMenu;
				$ossnmenu->sortMenu($menu);
				
				$params['menu'] = $Ossn->menu[$menu];
				if($custom == false) {
								$params['menuname'] = $menu;
								return ossn_plugin_view("menus/{$menu}", $params);
				} elseif($custom !== false) {
								$params['menuname'] = $menu;
								return ossn_plugin_view($custom, $params);
				}
}

/**
 * Register a section base menu
 *
 * @param string $menu A name of menu
 * $param array $params A option values
 *
 * @return false|null
 */
function ossn_register_sections_menu($menu, $params) {
				global $Ossn;
				if(!isset($params['type'])) {
								$params['type'] = '';
				}
				if(!isset($params['url']) || !isset($params['text']) || !isset($params['type']) || !isset($params['icon'])) {
								return false;
				}
				if(empty($params['params'])) {
								$params['params'] = array();
				}
				$type    = $params['type'];
				$link    = $params['url'];
				$text    = $params['text'];
				$type    = $params['type'];
				$icon    = $params['icon'];
				$section = $params['section'];
				if(empty($type)) {
								$type = 'frontend';
				}
				$Ossn->sectionsmenu[$type][$menu][$section][$text] = array(
								$link,
								$icon,
								$params['params']
				);
}

/**
 * View section base menu
 *
 * @param string $type (frontend or backend(
 * @param string $menu
 *
 * @note This will fetch layout from defualt template that how menu should appear; check menu file for more info;
 *
 * @return mixed data
 *
 */
function ossn_view_sections_menu($menu, $type = 'frontend') {
				global $Ossn;
				if(isset($menu) && isset($Ossn->sectionsmenu[$type][$menu])) {
								$params['menu']     = $Ossn->sectionsmenu[$type][$menu];
								$params['menuname'] = $menu;
								return ossn_plugin_view("menus/sections/{$menu}", $params);
				}
}
