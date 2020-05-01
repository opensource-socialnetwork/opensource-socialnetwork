<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

/**
 * Initialize the css library
 *
 * @return void
 */
function ossn_javascript() {
    ossn_register_page('js', 'ossn_javascript_pagehandler');
    ossn_add_hook('js', 'register', 'ossn_js_trigger');

    ossn_extend_view('ossn/site/head', 'ossn_site_js');
    ossn_extend_view('ossn/admin/head', 'ossn_admin_js');
	
    ossn_extend_view('ossn/site/head', 'ossn_jquery_add');
    ossn_extend_view('ossn/admin/head', 'ossn_jquery_add');

    ossn_new_js('opensource.socialnetwork', 'javascripts/libraries/core');
	
    ossn_load_js('opensource.socialnetwork');
    ossn_load_js('opensource.socialnetwork', 'admin');
	
	//some internal and external js
	ossn_new_external_js('chart.js', 'vendors/Chartjs/Chart.min.js');
	ossn_new_external_js('chart.legend.js', 'vendors/Chartjs/chart.legend.js');
	ossn_new_external_js('jquery-1.11.1.min.js', 'vendors/jquery/jquery-1.11.1.min.js');
	ossn_new_external_js('tinymce.min', 'vendors/tinymce/tinymce.min.js');
	ossn_new_external_js('jquery-ui.min.js', '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js', false);
	
	ossn_load_external_js('jquery-1.11.1.min.js');
	ossn_load_external_js('jquery-1.11.1.min.js', 'admin');

	ossn_load_external_js('jquery-ui.min.js');
	ossn_load_external_js('jquery-ui.min.js', 'admin');
	
	ossn_load_external_js('tinymce.min', 'admin');
	
	if(ossn_get_context() != 'administrator'){
		ossn_new_external_js('jquery-arhandler-1.1-min.js', 'vendors/jquery/jquery-arhandler-1.1-min.js');
		ossn_load_external_js('jquery-arhandler-1.1-min.js');
	}
}

/**
 * Add css page handler
 *
 * @return bool
 */
function ossn_javascript_pagehandler($js) {
    $page = $js[0];
    if (empty($js[1])) {
        echo '404 SWITCH ERROR';
    }
    if (empty($page)) {
        $page = 'view';
    }
    switch ($page) {
        case 'view':
            if (ossn_site_settings('cache') == 1) {
                return false;
            }
            header("Content-type: text/javascript");
            if (ossn_is_hook('js', "register")) {
                echo ossn_call_hook('js', "register", $js);
            }
            break;

        default:
            echo '404 SWITCH ERROR';
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
function ossn_new_js($name, $file) {
    global $Ossn;
    $Ossn->js[$name] = $file;
}
/**
 * Register a new external js to system
 *
 * @param string $name The name of the css
 *               $file  complete url path to css file
 *
 * @return void
 */
function ossn_new_external_js($name, $file, $type = true) {
    global $Ossn;
	if($type){
	    $Ossn->jsExternal[$name] = ossn_site_url($file);
	} else {
	    $Ossn->jsExternal[$name] = $file;		
	}
}
/**
 * Remove a external js from system
 *
 * @param string $name The name of the css
 *               $file  complete url path to css file
 *
 * @return void
 */
function ossn_unlink_external_js($name) {
    global $Ossn;
    unset($Ossn->jsExternal[$name]);
}
/**
 * Remove a js from system
 *
 * This will not remove js file it will just unregister it
 * @param string $name The name of the js
 *
 * @return void
 */
function ossn_unlink_new_js($name) {
    global $Ossn;
    if(isset($Ossn->js[$name])){
	   unset($Ossn->js[$name]);	
	}
}

/**
 * Get a tag for inserting css
 *
 * @params string $args   array()
 *
 * @return string
 */
function ossn_html_js($args) {
	if(!is_array($args)){
		return false;
	}
	$default = array();	
	$args = array_merge($default, $args);
    $extend = ossn_args($args);
    return "\r\n<script {$extend}></script>";
}

/**
 * Load registered js to system for site
 *
 * @return html.tag
 */
function ossn_load_js($name, $type = 'site') {
    global $Ossn;
    $Ossn->jshead[$type][] = $name;
}
/**
 * Ossn system unloads js from head
 *
 * @param string $name The name of the js
 *
 * @return void
 */
function ossn_unload_js($name, $type = 'site') {
    global $Ossn;
	$js = array_search($name, $Ossn->jshead[$type]);
    if($js !== false){
		unset($Ossn->jshead[$type][$js]);
	}
}
/**
 * Load registered js to system for site
 *
 * @return html.tag
 */
function ossn_load_external_js($name, $type = 'site') {
    global $Ossn;
    $Ossn->jsheadExternal[$type][] = $name;
}
/**
 * Ossn system unloads js from head
 *
 * @param string $name The name of the js
 *
 * @return void
 */
function ossn_unload_external_js($name, $type = 'site') {
    global $Ossn;
	$js = array_search($name, $Ossn->jsheadExternal[$type]);
    if($js !== false){
		unset($Ossn->jsheadExternal[$type][$js]);
	}
}

/**
 * Load js for frontend
 *
 * @return html.tags
 */
function ossn_site_js() {
    global $Ossn;
    $url = ossn_site_url();
	
	//load external js	
	$external = $Ossn->jsheadExternal['site'];
	if(!empty($external)){
		foreach($external as $item){
			echo ossn_html_js(array('src' =>  $Ossn->jsExternal[$item]));
		}
	}
	
	//load internal js
    if (isset($Ossn->jshead['site'])) {
        foreach ($Ossn->jshead['site'] as $js) {
            $src = "{$url}js/view/{$js}.js";
            if (ossn_site_settings('cache') == 1) {
				$cache = ossn_site_settings('last_cache');
                $src = "{$url}cache/js/{$cache}/view/{$js}.js";
            }
            echo ossn_html_js(array('src' => $src));
        }
    }
}
/**
 * Load js to backend
 *
 * @return html.tags
 */
function ossn_admin_js() {
    global $Ossn;
    $url = ossn_site_url();
	
	//load external js	
	$external = $Ossn->jsheadExternal['admin'];
	if(!empty($external)){
		foreach($external as $item){
			echo ossn_html_js(array('src' =>  $Ossn->jsExternal[$item]));
		}
	}
	
	//load internal js
    if (isset($Ossn->jshead['admin'])) {
        foreach ($Ossn->jshead['admin'] as $js) {
            $src = "{$url}js/view/{$js}.js";
            if (ossn_site_settings('cache') == 1) {
				$cache = ossn_site_settings('last_cache');
                $src = "{$url}cache/js/{$cache}/view/{$js}.js";
            }
            echo ossn_html_js(array('src' => $src));
        }
    }
}

/**
 * Check if the requested js is registered then load js
 *
 * @return bool
 */
function ossn_js_trigger($hook, $type, $value, $params) {
    global $Ossn;
    if (isset($params[1]) && substr($params[1], '-3') == '.js') {
        $params[1] = str_replace('.js', '', $params[1]);
        if (isset($Ossn->js[$params[1]])) {
            $file = ossn_plugin_view($Ossn->js[$params[1]]);
            $extended = ossn_fetch_extend_views("js/{$params[1]}");
            $data = array(
                $file,
                $extended
            );
            return implode('', $data);
        }
    }
    return false;
}
/**
 * Load jquery framework to system
 *
 * @return js.html.tag
 * @use ossn_new_external_js()
 */
/**
function ossn_jquery_add() {
    echo ossn_html_js(array('src' => ossn_site_url('vendors/jquery/jquery-1.11.1.min.js')));
} **/
function ossn_languages_js(){
	$lang = ossn_site_settings('language');
	$cache = ossn_site_settings('cache');
	$last_cache = ossn_site_settings('last_cache');
	
	if($cache == true){
		$js = "ossn.{$lang}.language";
		$url = "cache/js/{$last_cache}/view/{$js}.js";
		ossn_new_external_js($js, $url);
		
		ossn_load_external_js($js, 'site');
		ossn_load_external_js($js, 'admin');
	} else {
	
		ossn_new_js('ossn.language', 'javascripts/languages');
		
		ossn_load_js('ossn.language');
		ossn_load_js('ossn.language', 'admin');	
	}
}
/**
 * Redirect users to absolute url, if he is on wrong url
 *
 * Many users have issue while registeration, this is due to ossn.ajax works on absolute path
 * Github ticket: https://github.com/opensource-socialnetwork/opensource-socialnetwork/issues/458
 * 
 * @return void;
 */
 function ossn_redirect_absolute_url(){
	$baseurl 	= ossn_site_url();
	$parts		= parse_url($baseurl);
	$iswww		= preg_match('/www./i', $parts['host']);
	$host		= parse_url($_SERVER['HTTP_HOST']);
	$redirect	= false;
	$port 		= "";
	if(!isset($host['host'])){
		$host = array();
		$host['host'] = $_SERVER['HTTP_HOST'];
	}
	
	if(isset($parts['port']) && !empty($parts['port'])){
		$port = ":{$parts['port']}";
		if ($parts['port'] == ':80' || $parts['port'] == ':443'){
			$port = '';
		}
		if($parts['port'] !== (int)$_SERVER['SERVER_PORT']){
			$redirect = true;
		}
	}
	if(isset($_SERVER['HTTP_CF_VISITOR']) && strpos($_SERVER['HTTP_CF_VISITOR'], 'https') !== false) {
		 $_SERVER['HTTPS'] = 'on'; 
	}	
	if(empty($parts['port']) && isset($_SERVER['SERVER_PORT']) && !empty($_SERVER['SERVER_PORT']) 
			&& $_SERVER['SERVER_PORT'] !== '80' && $_SERVER['SERVER_PORT'] !=='443'){
			$redirect = true;
	}
    	if($parts['scheme'] == 'https' && empty($_SERVER["HTTPS"]) 
    		|| (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on" && $parts['scheme'] == 'http')) {
        	$redirect = true;
    	}

	if(($host['host'] !== $parts['host']) || $redirect){
		header("HTTP/1.1 301 Moved Permanently");
		$url = "{$parts['scheme']}://{$parts['host']}{$port}{$_SERVER['REQUEST_URI']}";
		header("Location: {$url}"); 		
	}
 }
ossn_register_callback('ossn', 'init', 'ossn_languages_js');
ossn_register_callback('ossn', 'init', 'ossn_javascript');
ossn_register_callback('ossn', 'init', 'ossn_redirect_absolute_url');
