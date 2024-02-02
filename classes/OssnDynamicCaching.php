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
class OssnDynamicCaching {
		public function __construct() {
				$this->settings = ossn_dynamic_cache_settings();
		}
		public function isAvailableEnabled() {
				if($this->settings['status'] == 'enabled') {
						if($this->settings['type'] == 'memcached') {
								$memcached = new OssnMemcached(300, $this->settings);
								return $memcached->isAvailable();
						}
						if($this->settings['type'] == 'redis') {
								$redis = new OssnRedis(300, $this->settings);
								return $redis->isAvailable();
						}
				}
				return false;
		}
		/**
		 * Constructor
		 *
		 * @param int $ttl Time to live for the cached variable in seconds. Default 5 minutes (300 seconds)
		 *
		 * return void
		 */
		public function handler($ttl = 300) {
				if($this->settings['type'] == 'redis') {
						$handler = new OssnRedis($ttl, $this->settings);
				}
				if($this->settings['type'] == 'memcached') {
						$handler = new OssnMemcached($ttl, $this->settings);
				}
				$default = ossn_call_hook('ossn', 'handler:dynamic:caching', $ttl, $handler);
				return $default;
		}
} //class