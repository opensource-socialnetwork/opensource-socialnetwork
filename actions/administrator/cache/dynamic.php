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
$status = input('status');
$type   = input('cache_server_type');
$host   = input('host');
$port   = input('port');

$username = input('username');
$password = input('password');

if($status == 'enabled') {
		if(empty($host) || empty($port)) {
				ossn_trigger_message(ossn_print('admin:dcache:required:field'), 'error');
				redirect(REF);
		}
		if($type == 'redis') {
				if(!extension_loaded('redis')) {
						ossn_trigger_message(ossn_print('php:extension:notfound'), 'error');
						redirect(REF);
				}
				$redis = new Redis();
				$redis->connect($host, $port);
				if(!empty($password)) {
						$redis->auth($password);
				}
				if(!$redis->ping()) {
						ossn_trigger_message(ossn_print('admin:dcache:errorconnection'), 'error');
						redirect(REF);
				}
				if($redis->set('_test', 'work', 10)) {
						if($redis->get('_test') != 'work') {
								ossn_trigger_message(ossn_print('admin:dcache:errorconnection'), 'error');
								redirect(REF);
						}
				}
		}

		if($type == 'memcached') {
				if(!extension_loaded('memcached')) {
						ossn_trigger_message(ossn_print('php:extension:notfound'), 'error');
						redirect(REF);
				}
				$memcached = new Memcached();
				$memcached->addServer($host, $port);
				if(!empty($username) && !empty($password)) {
						if(!method_exists($memcached, 'setSaslAuthData')) {
								ossn_trigger_message(ossn_print('admin:dcache:memcached:authnotsupport'), 'error');
								redirect(REF);
						}
						$memcached->setSaslAuthData($username, $password);
				}
				$portcheck = fsockopen($host, $port, $error_code, $error_message, 2);
				if(!$portcheck || ($portcheck && $error_code != 0)) {
						ossn_trigger_message($error_message, 'error');
						redirect(REF);
				}
				if($memcached->set('_test', 'work', 10)) {
						$get = $memcached->get('_test');
						if($memcached->getResultCode() == Memcached::RES_SUCCESS) {
								if($get != 'work') {
										ossn_trigger_message(ossn_print('admin:dcache:errorconnection'), 'error');
										redirect(REF);
								}
						}
				}
		}
}

$template = '<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$Ossn->dynamic_cache_settings = array(
		"status"   => "'.$status.'",
		"type"     => "'.$type.'",
		"host"     => "'.$host.'",
		"port"     => "'.$port.'",
		"username" => "'.$username.'",
		"password" => "'.$password.'",
);';

if(file_put_contents(ossn_route()->configs . 'ossn.config.dcache.php', $template)){
		ossn_trigger_message(ossn_print('cache:enabled'), 'success');	
} else {
		ossn_trigger_message(ossn_print('cache:disabled'), 'success');	
}
redirect(REF);