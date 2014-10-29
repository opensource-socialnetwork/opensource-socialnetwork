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
 * Ossn Convert arrays to Object
 *
 * @params $array => arrays
 *         $class => object class ,else it object will be created in stdClass
 *
 * @return object
 */
function arrayObject($array, $class = 'stdClass') {
    $object = new $class;
    if (empty($array)) {
        return false;
    }
    foreach ($array as $key => $value) {
        if (strlen($key)) {
            if (is_array($value)) {
                $object->{$key} = arrayObject($value, $class);
            } else {
                $object->{$key} = $value;
            }
        }
    }
    return $object;
}

/**
 * Force Object
 * Sometimes php can't get object class ,
 * so we need to make sure that object have class name
 *
 * @params $object => object
 *
 * @return object
 */
function forceObject(&$object) {
    if (!is_object($object) && gettype($object) == 'object'
    )
        return ($object = unserialize(serialize($object)));
    return $object;
}

/**
 * Get system directory paths
 *
 * @return object
 */
function ossn_route() {
    $root = str_replace("\\", "/", dirname(dirname(__FILE__)));
    $defaults = array(
        'www' => "$root/",
        'libs' => "$root/libraries/",
        'classes' => "$root/classes/",
        'actions' => "$root/actions/",
        'locale' => "$root/locale/",
        'sys' => "$root/system/",
        'configs' => "$root/configurations/",
        'themes' => "$root/themes/",
        'pages' => "$root/pages/",
        'com' => "$root/components/",
        'admin' => "$root/admin/",
        'forms' => "$root/forms/",
        'upgrade' => "$root/upgrade/",
        'cache' => "{$root}/cache/",
        'js' => "$root/javascripts/",
    );
    return arrayObject($defaults);
}

/**
 * Get current url
 *
 * @params $params => object
 *
 * @return object
 */
function current_url($uport = '') {
    $protocol = 'http';
    $uri = $_SERVER['REQUEST_URI'];
    if ($uport == true) {
        $uri = substr($uri, 0, $uri);
    }
    if (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
        $protocol = 'https';
    }
    $port = ':' . $_SERVER["SERVER_PORT"];
    if ($port == ':80' || $port == ':443') {
        if ($uport == true) {
            $port = '';
        }
    }
    $url = "$protocol://{$_SERVER['SERVER_NAME']}$port{$uri}";
    return $url;
}		