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
 * Ossn Convert arrays to Object
 *
 * @param array $array Arrays
 * @param string $class class name ,else it will be object of stdClass
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
 * @param object $object Object
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
	'system' => "$root/system/",
	'components' => "$root/components",
    );
    return arrayObject($defaults);
}

/**
 * Get current url
 *
 * @param string  $uport Want port or not? default will be disable
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
