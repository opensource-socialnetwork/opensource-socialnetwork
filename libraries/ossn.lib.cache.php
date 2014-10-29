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

/**
 * Generate css cache
 *
 * @return void
 */
function ossn_trigger_css_cache() {
    global $Ossn;
    require_once(ossn_route()->libs . 'minify/CSS.php');
    $dir = ossn_route()->cache;
    if (!is_dir("{$dir}css/view/")) {
        mkdir("{$dir}css/view/", 0755, true);
    }
    if (!isset($Ossn->css)) {
        return false;
    }
    foreach ($Ossn->css as $name => $file) {
        $cache_file = "{$dir}css/view/{$name}.css";
        $css = Minify_CSS::minify(ossn_view($file));
        $css .= Minify_CSS::minify(ossn_fetch_extend_views("css/{$name}"));
        file_put_contents($cache_file, $css);
    }
}

/**
 * Generate js cache
 *
 * @return void
 */
function ossn_trigger_js_cache() {
    global $Ossn;
    require_once(ossn_route()->libs . 'minify/JSMin.php');
    $dir = ossn_route()->cache;
    if (!is_dir("{$dir}js/view/")) {
        mkdir("{$dir}js/view/", 0755, true);
    }
    if (!isset($Ossn->js)) {
        return false;
    }
    foreach ($Ossn->js as $name => $file) {
        $cache_file = "{$dir}js/view/{$name}.js";
        $js = JSMin::minify(ossn_view($file));
        $js .= JSMin::minify(ossn_fetch_extend_views("js/{$name}"));
        file_put_contents($cache_file, $js);
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
        ossn_trigger_css_cache();
        ossn_trigger_js_cache();
        return true;
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
        OssnFile::DeleteDir(ossn_route()->cache);
        return true;
    }
    return false;
}