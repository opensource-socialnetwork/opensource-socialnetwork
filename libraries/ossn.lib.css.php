<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
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
    if (ossn_site_settings('cache') == 1) {
        return false;
    }
    header("Content-type: text/css");
    $page = $css[0];
    if (empty($css[1])) {
  		header('Content-Type: text/html; charset=utf-8');
           	ossn_error_page();
    }
    if (empty($page)) {
        $page = 'view';
    }
    switch ($page) {
        case 'view':
            if (ossn_site_settings('cache') == 1) {
                return false;
            }
            if (ossn_is_hook('css', "register")) {
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
    if(isset($Ossn->css[$name])){
	   unset($Ossn->css[$name]);	
	}
}

/**
 * Get a tag for inserting css
 *
 * @params string $args   array()
 *
 * @return string
 */
function ossn_html_css($args) {
    return '<link rel="stylesheet" ' . ossn_args($args) . ' type="text/css"/>';
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
    $Ossn->csshead[$type][] = $name;
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
    if($css !== false){
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
    $url = ossn_site_url();
    if (isset($Ossn->csshead['site'])) {
        foreach ($Ossn->csshead['site'] as $css) {
            $href = "{$url}css/view/{$css}.css";
            if (ossn_site_settings('cache') == 1) {
                $href = "{$url}cache/css/view/{$css}.css";
            }
            echo ossn_html_css(array('href' => $href));
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
    $url = ossn_site_url();
    if (isset($Ossn->csshead['admin'])) {
        foreach ($Ossn->csshead['admin'] as $css) {
            $href = "{$url}css/view/{$css}.css";
            if (ossn_site_settings('cache') == 1) {
                $href = "{$url}cache/css/view/{$css}.css";
            }
            echo ossn_html_css(array('href' => $href));
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
    if (isset($params[1]) && substr($params[1], '-4') == '.css') {
        $params[1] = str_replace('.css', '', $params[1]);
        if (isset($Ossn->css[$params[1]])) {
            $file = ossn_view($Ossn->css[$params[1]]);
            $extended = ossn_fetch_extend_views("css/{$params[1]}");
            $data = array(
                $file,
                $extended
            );
            return implode(' ', $data);
        }
    }
    return false;
}

