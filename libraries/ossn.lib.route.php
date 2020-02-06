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
 * Ossn Convert arrays to Object
 *
 * @param array $array Arrays
 * @param string $class class name ,else it will be object of stdClass
 *
 * @return object
 */
function arrayObject($array, $class = 'stdClass') {
		$object = new $class;
		if(empty($array)) {
				return false;
		}
		foreach($array as $key => $value) {
				if(strlen($key)) {
						if(is_array($value)) {
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
		if(!is_object($object) && gettype($object) == 'object')
				return ($object = unserialize(serialize($object)));
		return $object;
}

/**
 * Get system directory paths
 *
 * @return object
 */
function ossn_route() {
		$root     = str_replace("\\", "/", dirname(dirname(__FILE__)));
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
				'components' => "$root/components"
		);
		return arrayObject($defaults);
}

/**
 * Get current url
 *
 * @param boolean $uport false in case you wants a port , true if you don't wants a port
 * @param boolean $uport default false
 *
 * @return object
 */
function current_url($uport = false) {
		$protocol = 'http';
		$uri      = $_SERVER['REQUEST_URI'];
		
		//[B] wrong 3rd parm in ossn.lib.route line 93 #1649
		//if($uport == true) {
		//		$uri = substr($uri, 0, $uri); , 3rd arg must be int:length
		//}
		
		if(!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
				$protocol = 'https';
		}
		$port = ':' . $_SERVER["SERVER_PORT"];
		if($port == ':80' || $port == ':443') {
				if($uport == true) {
						$port = '';
				}
		}
		$url = "$protocol://{$_SERVER['SERVER_NAME']}$port{$uri}";
		return $url;
}
/**
 * Register a class for autoloading 
 *
 * @param array $classes A classes list with the path
 * 
 * @return void
 */
function ossn_register_class(array $classes = array()) {
		global $Ossn;
		foreach($classes as $name => $class) {
				if(!empty($name) && file_exists($class)) {
						$Ossn->classes[$name] = $class;
				} else {
						throw new Exception("Unable to register a class `{$name}` with non-existing physical class file at location `{$class}`");
				}
		}
}
/**
 * Auto loading classes
 *
 * @param string $name of the class
 * 
 * @return void
 */
function ossn_autoload_classes($name = '') {
		global $Ossn;
		if(isset($Ossn->classes[$name]) && file_exists($Ossn->classes[$name])) {
				require_once($Ossn->classes[$name]);
		}
}
/**
 * Unregister a class 
 * Unregistering the system classes may result in strange behaviour 
 * 
 * @param array $classes A classes list with the path
 * 
 * @return void
 */
function ossn_unregister_class($name = ''){
		global $Ossn;
		if(isset($Ossn->classes[$name])) {
				unset($Ossn->classes[$name]);
		}	
}
spl_autoload_register('ossn_autoload_classes');
