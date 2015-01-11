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

$VIEW = new stdClass;
$VIEW->register = array();

/**
 * Include a specific file
 * @params: $file = name of file;
 * @params:  $params = args for file;
 * @last edit: $arsalanshah
 * @Reason: Initial;
 *
 */
function ossn_include($file = '', $params = array()) {
    if (!empty($file) && is_file($file)) {
        ob_start();
        $params = $params;
        include($file);
        $contents = ob_get_clean();
        return $contents;
    }

}

/**
 * Include a specific file
 * @params: $file = name of file;
 * @params:  $params = args for file;
 * @last edit: $arsalanshah
 * @Reason: Initial;
 *
 */
function ossn_view($path = '', $params = array()) {
    global $VIEW;
    if (isset($path) && !empty($path)) {
        //call hook in case to over ride the view
        if (ossn_is_hook('halt', "view:{$path}")) {
            return ossn_call_hook('halt', "view:{$path}", $params);
        }
        $path = ossn_route()->www . $path;
        $file = ossn_include($path . '.php', $params);
        return $file;
    }
}

function ossn_args(array $attrs) {
    $attrs = $attrs;
    $attributes = array();

    foreach ($attrs as $attr => $val) {
        $attr = strtolower($attr);
        if ($val === TRUE) {
            $val = $attr;
        }
        if ($val !== NULL && $val !== false && (is_array($val) || !is_object($val))
        ) {
            if (is_array($val)) {
                $val = implode(' ', $val);
            }
            $val = htmlspecialchars($val, ENT_QUOTES, 'UTF-8', false);
            $attributes[] = "$attr=\"$val\"";
        }
    }
    return implode(' ', $attributes);
}

/**
 * Register a view;
 * @params: $view = path of view;
 * @params: $file = file for view;
 * @param string $views
 * @param string $file
 * @last edit: $arsalanshah
 * @Reason: Initial;
 *
 */
function ossn_extend_view($views, $file) {
    global $VIEW;
    $result = $VIEW->register[$views][] = $file;
    return $result;
}

/**
 * Fetch a register view
 * @params: $layout = name of view;
 * @params:  $params = args for file;
 * @last edit: $arsalanshah
 * @Reason: Initial;
 *
 */
function ossn_fetch_extend_views($layout, $params = array()) {
    global $VIEW;
    if (isset($VIEW->register[$layout]) && !empty($VIEW->register[$layout])) {
        foreach ($VIEW->register[$layout] as $file) {
            if (!function_exists($file)) {
                $fetch[] = ossn_view($file, $params);
            } else {
                $fetch[] = call_user_func($file, ossn_get_context(), $params, current_url());
            }
        }
        return implode('', $fetch);
    }
}

/**
 * Unregister a view from system
 * @params: $layout = name of view;
 * @last edit: $arsalanshah
 * @Reason: Initial;
 *
 */
function ossn_remove_extend_view($layout) {
    global $VIEW;
    unset($VIEW->register[$layout]);
}

/**
 * Add a context to page
 * @params: $cntext = name of context;
 * @param string $context
 * @last edit: $arsalanshah
 * @Reason: Initial;
 *
 */
function ossn_add_context($context) {
    global $VIEW;
    $add = $VIEW->context = $context;
    return $add;
}

/**
 * Check the if are in registered context or not
 * @params: $context = name of context;
 * @last edit: $arsalanshah
 * @Reason: Initial;
 *
 */
function ossn_is_context($context) {
    global $VIEW;
    if (isset($VIEW->context) && $VIEW->context == $context) {
        return true;
    }
    return false;
}

/**
 * Get a current context;
 * @last edit: $arsalanshah
 * @Reason: Initial;
 *
 */
function ossn_get_context() {
    global $VIEW;
    if (isset($VIEW->context)) {
        return $VIEW->context;
    }
    return false;
}

/**
 * Fetch a layout;
 *
 * @last edit: $arsalanshah
 * @Reason: Initial;
 *
 * @param string $layout
 */
function ossn_set_page_layout($layout, $params = array()) {
    if (!empty($layout)) {
        $theme = new OssnThemes;
        $active_theme = $theme->getActive();
        return ossn_view("themes/{$active_theme}/page/layout/{$layout}", $params);
    }
}

/**
 * View page;
 *
 * @params : $title = tile for page;
 * @params : $content = content for page;
 * @last edit: $arsalanshah
 * @Reason: Initial;
 *
 */
function ossn_view_page($title, $content, $page = 'page') {
    $params['title'] = $title;
    $params['contents'] = $content;
    $theme = new OssnThemes;
    $active_theme = $theme->getActive();
    return ossn_view("themes/{$active_theme}/page/{$page}", $params);
}

/**
 * Ossn get default theme path
 *
 * @return string
 */
function ossn_default_theme() {
    $theme = new OssnThemes;
    $active_theme = $theme->getActive();
    return ossn_route()->themes . $theme->getActive() . '/';
}

/**
 * Ossn view form
 *
 * @param string $name
 * @return mix data
 */
function ossn_view_form($name, $args = array(), $type = 'core') {
    $args['name'] = $name;
    $args['type'] = $type;
    return ossn_view("system/templates/form", $args);
}

/**
 * Ossn view widget
 *
 * @param string $name
 * @param string $title
 * @return mix data
 */
function ossn_view_widget($name, $title, $contents) {
    $theme = new OssnThemes;
    $active_theme = $theme->getActive();
    $widget['title'] = $title;
    $widget['contents'] = $contents;
    return ossn_view("themes/{$active_theme}/widgets/{$name}", $widget);
}
/**
 * View a template
 *
 * Use a templates from core (image view, url view etc)
 * 
 * @param string $template A name of template
 * @param array $params
 * 
 * @return mix data
 */
function ossn_view_template($template = '', array $params){
	if(!empty($template)){
		return ossn_view("system/templates/{$template}", $params);
	}
}