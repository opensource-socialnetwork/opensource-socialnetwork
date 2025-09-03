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
ossn_register_callback('ossn', 'init', 'ossn_css');
/**
 * Initialize the css library
 *
 * @return void
 */
function ossn_css() {
		ossn_register_page('css', 'ossn_css_pagehandler');
		ossn_add_hook('css', 'register', 'ossn_css_trigger');
		ossn_extend_view('ossn/site/head', 'ossn_css_site');
		ossn_extend_view('ossn/admin/head', 'ossn_css_admin');			
}

/**
 * Add css page handler
 *
 * @return false|null
 */
function ossn_css_pagehandler($css) {
		if(ossn_site_settings('cache') == 1) {
				return false;
		}
		header("Content-type: text/css");
		$page = $css[0];
		if(empty($css[1])) {
				header('Content-Type: text/html; charset=utf-8');
				ossn_error_page();
		}
		if(empty($page)) {
				$page = 'view';
		}
		switch($page) {
				case 'view':
						if(ossn_site_settings('cache') == 1) {
								return false;
						}
						if(ossn_is_hook('css', "register")) {
								echo ossn_call_hook('css', "register", $css);
						}
						break;
				default:
						header('Content-Type: text/html; charset=utf-8');
						ossn_error_page();
						break;
						
		}
}

/**
 * Register a new css to system
 *
 * @param string $name The name of the css
 *               $file  path to css file
 *
 * @return void
 */
function ossn_new_css($name, $file) {
		global $Ossn;
		$Ossn->css[$name] = $file;
}

/**
 * Remove a css from system
 *
 * This will not remove css file it will just unregister it
 * @param string $name The name of the css
 *
 * @return void
 */
function ossn_unlink_new_css($name, $file) {
		global $Ossn;
		if(isset($Ossn->css[$name])) {
				unset($Ossn->css[$name]);
		}
}

/**
 * Get a tag for inserting css
 *
 * @params array $args array()
 *
 * @return string
 */
function ossn_html_css($args) {
		if(!is_array($args)) {
				return false;
		}
		$default = array(
				'rel' => 'stylesheet',
				'type' => 'text/css'
		);
		$args    = array_merge($default, $args);
		return "\r\n<link " . ossn_args($args) . " />";
}

/**
 * Load css to system
 *
 * @params string $name =  name of css
 *                $type   site or admin
 *
 * @return void
 */
function ossn_load_css($name, $type = 'site') {
		global $Ossn;
		//make sure it is set
		if(isset($Ossn->css[$name])){
			$Ossn->csshead[$type][] = $name;
		}
}
/**
 * Ossn system unloads css from head
 *
 * @param string $name The name of the css
 *
 * @return void
 */
function ossn_unload_css($name, $type = 'site') {
		global $Ossn;
		$css = array_search($name, $Ossn->csshead[$type]);
		if($css !== false) {
				unset($Ossn->csshead[$type][$css]);
		}
}
/**
 * Load registered css to system for site
 *
 * @return html.tag
 */
function ossn_css_site() {
		global $Ossn;
		$Ossn->cssheadExternalLoaded = array();
		$Ossn->cssheadLoaded = array();
		$Ossn->cssheadExternalLoaded['site'] = array();	
		$Ossn->cssheadLoaded['site'] = array();	
		
		$url      = ossn_site_url();
		//load external css
		if(isset($Ossn->cssheadExternal['site']) && !empty($Ossn->cssheadExternal['site'])) {
				$external = $Ossn->cssheadExternal['site'];
				foreach($external as $item) {
					if(!isset($Ossn->cssheadExternalLoaded['site'][$item]) && isset($Ossn->cssExternal[$item])){ 
						$Ossn->cssheadExternalLoaded['site'][$item] = true;
						echo ossn_html_css(array(
								'href' => $Ossn->cssExternal[$item]
						));
					}
				}
		}
		
		//load internal css
		if(isset($Ossn->csshead['site'])) {
				foreach($Ossn->csshead['site'] as $css) {
					if(!isset($Ossn->cssheadLoaded['site'][$css])){
						$href = "{$url}css/view/{$css}.css";
						if(ossn_site_settings('cache') == 1) {
								$cache = ossn_site_settings('last_cache');
								$href  = "{$url}cache/css/{$cache}/view/{$css}.css";
						}
						$Ossn->cssheadLoaded['site'][$css] = true;
						echo ossn_html_css(array(
								'href' => $href
						));
					}
				}
		}
		
}

/**
 * Load registered css to system for admin
 *
 * @return html.tag
 */
function ossn_css_admin() {
		global $Ossn;
		$Ossn->cssheadExternalLoaded = array();
		$Ossn->cssheadLoaded = array();
		$Ossn->cssheadExternalLoaded['admin'] = array();	
		$Ossn->cssheadLoaded['admin'] = array();
		
		$url      = ossn_site_url();
		//load external css
		if(isset($Ossn->cssheadExternal['admin']) && !empty($Ossn->cssheadExternal['admin'])){
		$external = $Ossn->cssheadExternal['admin'];
				foreach($external as $item) {
					if(!isset($Ossn->cssheadExternalLoaded['admin'][$item]) && isset($Ossn->cssExternal[$item])){ 
						$Ossn->cssheadExternalLoaded['admin'][$item] = true;					
						echo ossn_html_css(array(
								'href' => $Ossn->cssExternal[$item]
						));
					}
				}
		}
		
		//load internal css
		if(isset($Ossn->csshead['admin'])) {
				foreach($Ossn->csshead['admin'] as $css) {
					if(!isset($Ossn->cssheadLoaded['admin'][$css])){					
						$href = "{$url}css/view/{$css}.css";
						if(ossn_site_settings('cache') == 1) {
								$cache = ossn_site_settings('last_cache');
								$href  = "{$url}cache/css/{$cache}/view/{$css}.css";
						}
						$Ossn->cssheadLoaded['admin'][$css] = true;
						echo ossn_html_css(array(
								'href' => $href
						));
					}
				}
		}
}

/**
 * Check if the requested css is registered then load css
 *
 * @return string|false
 */
function ossn_css_trigger($hook, $type, $value, $params) {
		global $Ossn;
		if(isset($params[1]) && substr($params[1], '-4') == '.css') {
				$params[1] = str_replace('.css', '', $params[1]);
				if(isset($Ossn->css[$params[1]])) {
						$file     = ossn_plugin_view($Ossn->css[$params[1]]);
						$extended = ossn_fetch_extend_views("css/{$params[1]}");
						$data     = array(
								$file,
								$extended
						);
						return implode(' ', $data);
				}
		}
		return false;
}
/**
 * Register a new external css to system
 *
 * @param string $name The name of the css
 *               $file  complete url path to css file
 *
 * @return void
 */
function ossn_new_external_css($name, $file, $type = true) {
		global $Ossn;
		if($type) {
				$Ossn->cssExternal[$name] = ossn_site_url($file);
		} else {
				$Ossn->cssExternal[$name] = $file;
		}
}
/**
 * Remove a external css from system
 *
 * @param string $name The name of the css
 *               $file  complete url path to css file
 *
 * @return void
 */
function ossn_unlink_external_css($name) {
		global $Ossn;
		unset($Ossn->cssExternal[$name]);
}
/**
 * Load registered css to system for site
 *
 * @return html.tag
 */
function ossn_load_external_css($name, $type = 'site') {
		global $Ossn;
		$Ossn->cssheadExternal[$type][] = $name;
}
/**
 * Ossn system unloads css from head
 *
 * @param string $name The name of the css
 *
 * @return void
 */
function ossn_unload_external_css($name, $type = 'site') {
		global $Ossn;
		$css = array_search($name, $Ossn->cssheadExternal[$type]);
		if($css !== false) {
				unset($Ossn->cssheadExternal[$type][$css]);
				if(isset($Ossn->cssheadExternalLoaded[$type]) && isset($Ossn->cssheadExternalLoaded[$type][$name])){			
					unset($Ossn->cssheadExternalLoaded[$type][$name]);
				}
		}
}
