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
 * Register a menu;
 * @params string $name Name of menu;
 * @params string $text Text for menu;
 * @params string $link Link for menu;
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
 * @params string $name menu name;
 * @params array  $options A link options;
 * @params string $menutype A menu name
 *
 * @return void
 */
function ossn_register_menu_item($menutype, array $options = array()) {
		global $Ossn;
		if(!empty($options['name'])) {
				$name = $options['name'];
				if(isset($options['parent']) && !empty($options['parent'])) {
						$name = $options['parent'];
				}
				$Ossn->menu[$menutype][$name][] = $options;
				ksort($Ossn->menu[$menutype]);
		}
}

/**
 * Unregister menu from system;
 * @params string $menu Menu name
 * @params string  $menutype MenuType
 *
 * @return void;
 *
 */
function ossn_unregister_menu($menu, $menutype = 'site') {
		global $Ossn;
		unset($Ossn->menu[$menutype][$menu]);
}

/**
 * View a menu;
 * @params string $menu Menu name
 * @note This will fetch layout from defualt template that how menu should appear; check menu file for more info;
 *
 * @return string
 */
function ossn_view_menu($menu, $custom = false) {
		global $Ossn;
		if(!isset($Ossn->menu[$menu])) {
				return false;
		}
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
 * Register a section base menu;
 * @params array $params array(type, section, url, text, icon, link)
 * @param string $menu
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
 * View section base menu;
 * @param string $type (frontend or backend(
 * @param string $menu
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