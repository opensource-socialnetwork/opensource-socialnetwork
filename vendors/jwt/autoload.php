<?php
//JWT CustomAutoLoader Arsalan Shah
class JWTAutoLoader {
		public static function loadClass($className) {
				$path = ossn_route()->www . 'vendors/jwt/' . $className . '.php';
				$path = str_replace('\\', '/', $path);
				if(isset($path) && is_file($path)) {
						require_once $path;
				}
		}
}
spl_autoload_register(array(
		'JWTAutoLoader',
		'loadClass',
));
