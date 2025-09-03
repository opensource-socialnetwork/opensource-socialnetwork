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
 * Generate css cache
 *
 * @return false|void
 */
function ossn_trigger_css_cache($cache = '') {
		if(empty($cache)) {
				return false;
		}
		global $Ossn;

		require_once ossn_route()->libs . 'minify/Minify.php';
		require_once ossn_route()->libs . 'minify/CSSmin.php';

		$dir = ossn_route()->cache;
		if(!is_dir("{$dir}css/{$cache}/view/")) {
				mkdir("{$dir}css/{$cache}/view/", 0755, true);
		}
		if(!isset($Ossn->css)) {
				return false;
		}
		foreach ($Ossn->css as $name => $file) {
				$cache_file = "{$dir}css/{$cache}/view/{$name}.css";
				$minify     = new CSSmin();
				$minify->add(ossn_plugin_view($file));
				$minify->add(ossn_fetch_extend_views("css/{$name}"));
				$minify->minify($cache_file);
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
		require_once ossn_route()->libs . 'minify/JSMin.php';
		$dir = ossn_route()->cache;
		if(!is_dir("{$dir}js/{$cache}/view/")) {
				mkdir("{$dir}js/{$cache}/view/", 0755, true);
		}
		if(!isset($Ossn->js)) {
				return false;
		}
		header('Content-Type: text/html; charset=utf-8');
		foreach ($Ossn->js as $name => $file) {
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
				$dir = ossn_get_userdata('system/');
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
		$dir                 = ossn_route()->cache;

		$coms    = new OssnComponents();
		$comlist = $coms->getActive();
		$comdir  = ossn_route()->com;

		$system_locale_cache = ossn_get_userdata('system/locales/');
		if(!is_dir($system_locale_cache)) {
				mkdir($system_locale_cache, 0755, true);
		}
		header('Content-Type: application/json; charset=utf-8');
		foreach ($available_languages as $lang) {
				//load all laguages
				foreach ($Ossn->locale[$lang] as $item) {
						if(is_file($item)) {
								include_once $item;
						}
				}
				//load components all languages
				if($comlist) {
						foreach ($comlist as $com) {
								if(is_file("{$comdir}{$com->com_id}/locale/ossn.{$lang}.php")) {
										include_once "{$comdir}{$com->com_id}/locale/ossn.{$lang}.php";
								}
						}
				}
				//load theme locale files
				//[B] Theme language strings not cached #2299
				$theme_path = ossn_default_theme();
				$theme      = ossn_site_settings('theme');
				if($theme) {
						if(is_file("{$theme_path}/locale/ossn.{$lang}.php")) {
								include_once "{$theme_path}/locale/ossn.{$lang}.php";
						}
				}
				if(isset($Ossn->localestr[$lang])) {
						$json = ossn_load_json_locales($lang);
						//private locale cache , Cache the locale files #1321
						$file = $system_locale_cache . "ossn.{$lang}.json";
						file_put_contents($file, $json);

						//public js cache
						$json       = "var OssnLocale = $json";
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
		$database        = new OssnDatabase();
		$params['table'] = 'ossn_site_settings';
		$params['names'] = array(
				'value',
		);
		$params['values'] = array(
				1,
		);
		$params['wheres'] = array(
				"setting_id='4'",
		);
		$time = time();
		ossn_trigger_callback('cache', 'before:create', array(
				'time' => $time,
		));
		if($database->update($params)) {
				global $Ossn;
				$cache = ossn_update_last_cache();
				if($cache) {
						//update last_cache settings on run time
						$Ossn->siteSettings->cache      = 1;
						$Ossn->siteSettings->last_cache = $cache;
						ossn_link_cache_files($cache);

						ossn_trigger_callback('cache', 'created', array(
								'time' => $time,
						));
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
		$database        = new OssnDatabase();
		$params['table'] = 'ossn_site_settings';
		$params['names'] = array(
				'value',
		);
		$params['values'] = array(
				$time,
		);
		$params['wheres'] = array(
				"name='last_cache'",
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
		$database        = new OssnDatabase();
		$params['table'] = 'ossn_site_settings';
		$params['names'] = array(
				'value',
		);
		$params['values'] = array(
				0,
		);
		$params['wheres'] = array(
				"setting_id='4'",
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
		OssnFile::DeleteDir(ossn_get_userdata('system/'));
}
/**
 * Add action tokens to url
 *
 * @param string $url Full complete url
 *
 * @return string
 */
function ossn_add_cache_to_url($url) {
		if(ossn_site_settings('cache') == 0) {
				return $url;
		}
		$params = parse_url($url);

		$query = array();
		if(isset($params['query'])) {
				parse_str($params['query'], $query);
		}
		$tokens['ossn_cache'] = hash('crc32b', ossn_site_settings('last_cache'));
		$tokens               = array_merge($query, $tokens);

		$query = http_build_query($tokens);

		$params['query'] = $query;
		return ossn_build_token_url($params);
}
/**
 * Ossn Dynamic Cache get settings
 *
 * @return aray
 */
function ossn_dynamic_cache_settings() {
		global $Ossn;
		return $Ossn->dynamic_cache_settings;
}
/**
 * Invalidate cache when entity is deleted
 *
 * @return void
 */
ossn_register_callback('ossn', 'init', function () {
		ossn_register_callback('delete', 'entity', function ($callback, $type, $params) {
				if(isset($params['instance']->type) && isset($params['instance']->owner_guid)) {
						$owner_guid = $params['instance']->owner_guid;
						switch ($params['instance']->type) {
						case 'object':
								$cache = new OssnDynamicCaching();
								if($cache->isAvailableEnabled()) {
										$cache->handler()->delete("OssnObject->getObjectById():guid={$owner_guid}");
								}
								break;
						case 'user':
								$cache = new OssnDynamicCaching();
								if($cache->isAvailableEnabled()) {
										$user = ossn_user_by_guid($owner_guid);
										if($user) {
												$cache->handler()->delete("ossn_user_by_username({$user->username})");
												$cache->handler()->delete("ossn_user_by_guid({$user->guid})");
												$cache->handler()->delete("ossn_user_by_email({$user->email})");
												
												//also needs to update session of current user
												if($user->guid == ossn_loggedin_user()->guid){
														$fresh_user = ossn_user_by_guid($owner_guid);
														OssnSession::assign('OSSN_USER', $fresh_user);
												}
										}
								}
								break;
						}
				}
		});
});
