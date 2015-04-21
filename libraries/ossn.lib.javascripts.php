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
    ossn_new_js('ossn.language', 'javascripts/libraries/languages');
	
    ossn_load_js('opensource.socialnetwork');
    ossn_load_js('opensource.socialnetwork', 'admin');
	
	ossn_load_js('ossn.language');
	ossn_load_js('ossn.language', 'admin');
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
    $add = $Ossn->js[$name] = $file;
    return $add;
}
/**
 * Remove a js from system
 *
 * This will not remove js file it will just unregister it
 * @param string $name The name of the js
 *
 * @return void
 */
function ossn_unlink_new_js($name, $file) {
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
    $extend = ossn_args($args);
    return "\r\n<script type='text/javascript' {$extend}></script>";
}

/**
 * Load registered css to system for site
 *
 * @return html.tag
 */
function ossn_load_js($name, $type = 'site') {
    global $Ossn;
    $js = $Ossn->jshead[$type][] = $name;
    return $js;
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
 * Load js for frontend
 *
 * @return html.tags
 */
function ossn_site_js() {
    global $Ossn;
    $url = ossn_site_url();
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
 * Check if the requested css is registered then load css
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
 */
function ossn_jquery_add() {
    echo ossn_html_js(array('src' => ossn_site_url('vendors/jquery/jquery-1.11.1.min.js')));
}

ossn_register_callback('ossn', 'init', 'ossn_javascript');