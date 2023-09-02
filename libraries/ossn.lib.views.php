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
global $VIEW;
$VIEW = new stdClass;
$VIEW->register = array();

/**
 * Include a specific file
 *
 * @param string $file Valid file name;
 * @param array $params Options;
 * @last edit: $arsalanshah
 * @return mixed data
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
 * View a file
 *
 * @param string $file valid file name of php file without extension;
 * @param array $params Options;
 * @last edit: $arsalanshah
 * @return mixed data
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
/**
 * ossn_arg
 *
 * @param array $params Options;
 */
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
 *
 * @param string $view Path of view;
 * @param string|callable $file File name for view;
 * @last edit: $arsalanshah
 *
 * @reason: Initial;
 * @returnn mix data
 */
function ossn_extend_view($views, $file) {
    global $VIEW;
    $VIEW->register[$views][] = $file;
	return true;
}

/**
 * Unregister a view;
 *
 * @param string $view Path of view;
 * @param string|callable $file File name for view;
 * @last edit: $arsalanshah
 *
 * @reason: Initial;
 * @returnn mix data
 */
function ossn_unextend_view($views, $file) {
    global $VIEW;
	if(isset($VIEW->register[$views])){	
			foreach($VIEW->register[$views] as $key => $view){
					if($view == $file){
						 	unset($VIEW->register[$views][$key]); 
							return true;
					}
			}
	}
	return false;
}

/**
 * Fetch a register view
 *
 * @param string $layout Name of view;
 * @params  string $params Args for file;
 * @last edit: $arsalanshah
 *
 * @reason: Initial;
 * @return mixed data
 */
function ossn_fetch_extend_views($layout, $params = array()) {
    global $VIEW;
    if (isset($VIEW->register[$layout]) && !empty($VIEW->register[$layout])) {
        foreach ($VIEW->register[$layout] as $file) {
            if (!is_callable($file)) {
                $fetch[] = ossn_plugin_view($file, $params);
            } else {
                $fetch[] = call_user_func($file, ossn_get_context(), $params, current_url());
            }
        }
        return implode('', $fetch);
    }
}

/**
 * Unregister a view from system
 *
 * @param string $layout Name of view;
 *
 * @last edit: $arsalanshah
 * @reason: Initial;
 * @return void
 */
function ossn_remove_extend_view($layout) {
    global $VIEW;
    unset($VIEW->register[$layout]);
}

/**
 * Add a context to page
 *
 * @param string $context Name of context;
 * @last edit: $arsalanshah
 *
 * @Reason: Initial;
 * @return void;
 */
function ossn_add_context($context) {
    global $VIEW;
    $VIEW->context = $context;
	return true;
}

/**
 * Check the if are in registered context or not
 *
 * @param: string $context Name of context;
 * @last edit: $arsalanshah
 * @reason: Initial;
 * @return bool;
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
 *
 * @last edit: $arsalanshah
 * @reason: Initial;
 *
 * @return false|string;
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
        //unused variabled removed below $arsalanshah
		//$theme = new OssnThemes;
        //$active_theme = $theme->getActive();
        return ossn_plugin_view("theme/page/layout/{$layout}", $params);
    }
}

/**
 * View page;
 *
 * @param  string $title Title for page;
 * @param string $content Content for page;
 *
 * @last edit: $arsalanshah
 * @reason Initial;
 * @return mixed data;
 */
function ossn_view_page($title, $content, $page = 'page') {
    $params['title'] = $title;
    $params['contents'] = $content;
    return ossn_plugin_view("theme/page/{$page}", $params);
}

/**
 * Ossn get default theme path
 *
 * @return string
 */
function ossn_default_theme() {
    return ossn_route()->themes . ossn_site_settings('theme') . '/';
}
/**
 * Activated theme URL
 *
 * @param string $extend Extend the theme url with extra url param (path to file etc)
 *
 * @return string
 */
function ossn_theme_url($extend = ''){
	$default = ossn_site_settings('theme');
	return ossn_site_url("themes/{$default}/{$extend}");
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
    return ossn_plugin_view("output/form", $args);
}

/**
 * Ossn view widget
 *
 * @param array $params A options
 *
 * @return string
 */
function ossn_view_widget(array $params = array()) {
    return ossn_plugin_view("widget/view", $params);
}
/**
 * Create a pagiantion using count and page limit
 *
 * @param integer $count total entities/objects
 * @param integer $page_limit Number of entities/objects per page
 * @param array   $args Overwrite the default behaviour of pagination view
 *
 * @return false|mixed data
 */
function ossn_view_pagination($count = false, $page_limit = 10, array $args = array()){
	$page_limit = ossn_call_hook('pagination', 'page_limit', false, $page_limit);
	if(!empty($count) && !empty($page_limit)){
		$pagination = new OssnPagination;
	
		$params = array();
		$params['limit'] = $count;
		$params['page_limit']  = $page_limit;
		
		if(!isset($args['offset_name']) || empty($args['offset_name'])){
				$args['offset_name'] = 'offset';
		}
		$offset = input($args['offset_name']);
		if(empty($offset)){
			ossn_set_input($args['offset_name'], 1);
		}
		$params['options'] = $args;
		return $pagination->pagination($params);
	}
	return false;
}
