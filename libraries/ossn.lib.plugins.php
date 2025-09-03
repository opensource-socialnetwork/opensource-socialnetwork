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
 * Register a plugins by path
 * This will help us to override components files easily.
 * 
 * @param string $path A valid path;
 * @return boolean
 */
function ossn_register_plugins_by_path($path) {
		global $Ossn;
		
		if(ossn_site_settings('cache') == 1) {
				return false;
		}
		if(!is_dir($path)) {
				//disable error log, will cause a huge log file
				//error_log("Ossn tried to register invalid plugins by path: {$path}");
				return false;
		}
		$path      = str_replace("\\", "/", $path);
		$directory = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
		$iterator  = new RecursiveIteratorIterator($directory);
		if($iterator) {
				foreach($iterator as $file) {
						if(pathinfo($file, PATHINFO_EXTENSION) == "php") {
								$file     = str_replace("\\", "/", $file);
								$location = str_replace(dirname(__FILE__) . '/plugins/', '', $file);
								
								$name = str_replace($path, '', $location);
								$name = substr($name, 0, -4);
								$name = explode('/', $name);
								
								$plugin_type = $name[0];
								unset($name[0]);
								
								$name = implode('/', $name);
								
								$fpath = substr($file, 0, -4);
								$fpath = str_replace(array(
										$name,
										ossn_route()->www
								), '', $fpath);
								
								$Ossn->plugins[$plugin_type][$name] = $fpath;
						}
				}
		}
		return true;
}
/**
 * View a plugin
 * Plugins are registered using ossn_register_plugins_by_path()
 * 
 * @param string $plugin A valid plugin name;
 * @param array|object  $vars A valid arrays or object
 * @return void|mixed
 */
function ossn_plugin_view($plugin = '', $vars = array(), $type = 'default') {
		global $Ossn;
		$args        = array(
				'plugin' => $plugin
		);
		$plugin_type = ossn_call_hook('plugin', 'view:type', $args, $type);
		if(isset($Ossn->plugins[$plugin_type][$plugin])) {
				$extended_views = ossn_fetch_extend_views($plugin, $vars);
				return ossn_view($Ossn->plugins[$plugin_type][$plugin] . $plugin, $vars) . $extended_views;
		}
}
/**
 * Unregister a plugin view
 * We need this if we want to disable a plugin view.
 * 
 * @param string $plugin A valid plugin name;
 * @return void
 */
function ossn_uregister_plugin_view($plugin) {
		global $Ossn;
		if(isset($Ossn->plugins[$plugin])) {
				unset($Ossn->plugins[$plugin]);
		}
}
/**
 * Generate a paths for plugins for cache
 *
 * @return string|false
 */
function ossn_plugins_cache_paths() {
		$file = ossn_get_userdata("system/plugins_paths");
		if(is_file($file) && ossn_site_settings('cache') == 1) {
				$file = file_get_contents($file);
				return json_decode($file, true);
		}
		return false;
}
/**
 * If cache enabled then load paths for cache
 *
 * @return void;
 */
function ossn_plugin_set() {
		$paths = ossn_plugins_cache_paths();
		if($paths) {
				global $Ossn;
				$Ossn->plugins = $paths;
		}
}
ossn_plugin_set();
