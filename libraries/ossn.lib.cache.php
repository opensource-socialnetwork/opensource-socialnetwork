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
 * Generate css cache
 *
 * @return false|null
 */
function ossn_trigger_css_cache($cache = '') {
    global $Ossn;
    require_once(ossn_route()->libs . 'minify/CSS.php');
    $dir = ossn_route()->cache;
    if (!is_dir("{$dir}css/{$cache}/view/")) {
        mkdir("{$dir}css/{$cache}/view/", 0755, true);
    }
    if (!isset($Ossn->css)) {
        return false;
    }
    foreach ($Ossn->css as $name => $file) {
        $cache_file = "{$dir}css/{$cache}/view/{$name}.css";
        $css = Minify_CSS::minify(ossn_plugin_view($file));
        $css .= Minify_CSS::minify(ossn_fetch_extend_views("css/{$name}"));
        file_put_contents($cache_file, $css);
    }
}

/**
 * Generate js cache
 *
 * @return false|null
 */
function ossn_trigger_js_cache($cache = '') {
    global $Ossn;
    require_once(ossn_route()->libs . 'minify/JSMin.php');
    $dir = ossn_route()->cache;
    if (!is_dir("{$dir}js/{$cache}/view/")) {
        mkdir("{$dir}js/{$cache}/view/", 0755, true);
    }
    if (!isset($Ossn->js)) {
        return false;
    }
    foreach ($Ossn->js as $name => $file) {
        $cache_file = "{$dir}js/{$cache}/view/{$name}.js";
        $js = JSMin::minify(ossn_plugin_view($file));
        $js .= JSMin::minify(ossn_fetch_extend_views("js/{$name}"));
        file_put_contents($cache_file, $js);
    }
}
/**
 * Create a cache for plugin paths
 *
 * @return void;
 */
 function ossn_trigger_plugins_cache(){
	global $Ossn;
	if(isset($Ossn->plugins)){
		//we have to also secure paths
		$dir = ossn_get_userdata("system/");
		if(!is_dir($dir)){
			mkdir($dir, 0755, true);
		}
		$encode = json_encode($Ossn->plugins);
		file_put_contents($dir . 'plugins_paths', $encode);
	}
 }
/**
 * Create and Enable site cache
 *
 * @return bool
 */
function ossn_create_cache() {
    $database = new OssnDatabase;
    $params['table'] = 'ossn_site_settings';
    $params['names'] = array('value');
    $params['values'] = array(1);
    $params['wheres'] = array("setting_id='4'");
    if ($database->update($params)) {
		$cache = ossn_update_last_cache();
		if($cache){
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
function ossn_update_last_cache($type = true){
	if($type === true){
		$time =  time();
	} else {
		$time = 0;
	}
    $database = new OssnDatabase;
    $params['table'] = 'ossn_site_settings';
    $params['names'] = array('value');
    $params['values'] = array($time);
    $params['wheres'] = array("name='last_cache'");
    if ($database->update($params)) {
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
    $database = new OssnDatabase;
    $params['table'] = 'ossn_site_settings';
    $params['names'] = array('value');
    $params['values'] = array(0);
    $params['wheres'] = array("setting_id='4'");
    if ($database->update($params)) {
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
function ossn_link_cache_files($cache){
		if(empty($cache)){
			return false;
		}
        ossn_trigger_css_cache($cache);
        ossn_trigger_js_cache($cache);
		ossn_trigger_plugins_cache();   
}
/**
 * Unlink cache files
 *
 * @return void;
 */
function ossn_unlink_cache_files(){
	   OssnFile::DeleteDir(ossn_route()->cache);
	   OssnFile::DeleteDir(ossn_get_userdata("system/"));	   
}