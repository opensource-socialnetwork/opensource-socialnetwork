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
$type = input('cache_server_type');
$host = input('host');
$port = input('port');

$username = input('username');
$password = input('password');

if(empty($host) || empty($port)) {
		echo 0;
		exit();
}
if($type == 'redis') {
		if(!extension_loaded('redis')) {
				echo 0;
				exit();
		}
		$redis = new Redis();
		$redis->connect($host, $port);
		if(!empty($password)) {
				$redis->auth($password);
		}
		if(!$redis->ping()) {
				echo 0;
				exit();
		}
		if($redis->set('_test', 'work', 10)){
				if($redis->get('_test') == 'work'){
						echo 1;
						exit;
				}
		}
}

if($type == 'memcached') {
		if(!extension_loaded('memcached')) {
				echo 0;
				exit();
		}
		$memcached = new Memcached();
		$memcached->addServer($host, $port);
		if(!empty($username) && !empty($password)) {
				if(!method_exists($memcached, 'setSaslAuthData')) {
						echo 0;
						exit();
				}
				$memcached->setSaslAuthData($username, $password);
		}
		$portcheck = fsockopen($host, $port, $error_code, $error_message, 2);
		if(!$portcheck || ($portcheck && $error_code != 0)) {
				echo 0;
				exit();
		}
		if($memcached->set('_test', 'work', 10)) {
				$get = $memcached->get('_test');
				if($memcached->getResultCode() == Memcached::RES_SUCCESS) {
						if($get == 'work'){
							echo 1;
							exit();
						}
				}
		}
		echo 0;
		exit();
}