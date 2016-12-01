<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

/**
 * Generate css cache
 *
 * @return false|void
 */
function ossn_trigger_css_cache($cache = '') {
		if(empty($cache)) {
				return false;
		}
		global $Ossn;
		
		require_once(ossn_route()->libs . 'minify/CSSmin.php');
		$minify = new CSSmin;
		
		$dir = ossn_route()->cache;
		if(!is_dir("{$dir}css/{$cache}/view/")) {
				mkdir("{$dir}css/{$cache}/view/", 0755, true);
		}
		if(!isset($Ossn->css)) {
				return false;
		}
		foreach($Ossn->css as $name => $file) {
				$cache_file = "{$dir}css/{$cache}/view/{$name}.css";
				$css        = $minify->run(ossn_plugin_view($file));
				$css .= $minify->run(ossn_fetch_extend_views("css/{$name}"));
				file_put_contents($cache_file, $css);
		}
}

/**
 * Generate js cache
 *
 * @return false|void
 */
function ossn_trigger_js_cache($cache = '') {
		if(empty($cache)) {
				return false;
		}
		global $Ossn;
		require_once(ossn_route()->libs . 'minify/JSMin.php');
		$dir = ossn_route()->cache;
		if(!is_dir("{$dir}js/{$cache}/view/")) {
				mkdir("{$dir}js/{$cache}/view/", 0755, true);
		}
		if(!isset($Ossn->js)) {
				return false;
		}
		header('Content-Type: text/html; charset=utf-8');
		foreach($Ossn->js as $name => $file) {
				$cache_file = "{$dir}js/{$cache}/view/{$name}.js";
				$js         = JSMin::minify(ossn_plugin_view($file));
				$js .= JSMin::minify(ossn_fetch_extend_views("js/{$name}"));
				file_put_contents($cache_file, $js);
		}
}
/**
 * Create a cache for plugin paths
 *
 * @return void;
 */
function ossn_trigger_plugins_cache() {
		global $Ossn;
		if(isset($Ossn->plugins)) {
				//we have to also secure paths
				$dir = ossn_get_userdata("system/");
				if(!is_dir($dir)) {
						mkdir($dir, 0755, true);
				}
				$encode = json_encode($Ossn->plugins);
				file_put_contents($dir . 'plugins_paths', $encode);
		}
}
/**
 * Create languages cache
 *
 * @retrun false|void
 */
function ossn_trigger_language_cache($cache) {
		if(empty($cache)) {
				return false;
		}
		global $Ossn;
		$available_languages = ossn_get_available_languages();
		$dir = ossn_route()->cache;
		
		$coms = new OssnComponents;
		$comlist = $coms->getActive();
		$comdir  = ossn_route()->com;	
		
		header('Content-Type: application/json; charset=utf-8');
		foreach($available_languages as $lang) {
				//load all laguages
				foreach($Ossn->locale[$lang] as $item){
					if(is_file($item)){
						include_once($item);
					}
				}
				//load components all languages
				if($comlist){
					foreach($comlist as $com){
								if(is_file("{$comdir}{$com->com_id}/locale/ossn.{$lang}.php")) {
										include_once("{$comdir}{$com->com_id}/locale/ossn.{$lang}.php");
								}						
					}
				}
				if(isset($Ossn->localestr[$lang])) {
						$json = ossn_load_json_locales($lang);
						$json = "var OssnLocale = $json";
						$cache_file = "{$dir}js/{$cache}/view/ossn.{$lang}.language.js";
						file_put_contents($cache_file, "\xEF\xBB\xBF" . $json);
				}
		}
}

/**
 * Create and Enable site cache
 *
 * @return bool
 */
function ossn_create_cache() {
		$database         = new OssnDatabase;
		$params['table']  = 'ossn_site_settings';
		$params['names']  = array(
				'value'
		);
		$params['values'] = array(
				1
		);
		$params['wheres'] = array(
				"setting_id='4'"
		);
		if($database->update($params)) {
				$cache = ossn_update_last_cache();
				if($cache) {
						ossn_link_cache_files($cache);
				}
				return true;
		}
		return false;
}
/**
 * Update last cache time
 *
 * @return integer;
 */
function ossn_update_last_cache($type = true) {
		if($type === true) {
				$time = time();
		} else {
				$time = 0;
		}
		$database         = new OssnDatabase;
		$params['table']  = 'ossn_site_settings';
		$params['names']  = array(
				'value'
		);
		$params['values'] = array(
				$time
		);
		$params['wheres'] = array(
				"name='last_cache'"
		);
		if($database->update($params)) {
				return $time;
		}
		return false;
}
/**
 * Disable cache
 *
 * @return bool
 */
function ossn_disable_cache() {
		$database         = new OssnDatabase;
		$params['table']  = 'ossn_site_settings';
		$params['names']  = array(
				'value'
		);
		$params['values'] = array(
				0
		);
		$params['wheres'] = array(
				"setting_id='4'"
		);
		if($database->update($params)) {
				ossn_update_last_cache(false);
				ossn_unlink_cache_files();
				return true;
		}
		return false;
}
/**
 * Link cache files
 *
 * @return void;
 */
function ossn_link_cache_files($cache) {
		if(empty($cache)) {
				return false;
		}
		ossn_trigger_css_cache($cache);
		ossn_trigger_js_cache($cache);
		ossn_trigger_language_cache($cache);
		ossn_trigger_plugins_cache();
}
/**
 * Unlink cache files
 *
 * @return void;
 */
function ossn_unlink_cache_files() {
		OssnFile::DeleteDir(ossn_route()->cache);
		OssnFile::DeleteDir(ossn_get_userdata("system/"));
}
