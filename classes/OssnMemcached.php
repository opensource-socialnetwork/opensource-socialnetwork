<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

class OssnMemcached implements MemoryCaching {
		//dc = dynamic cache
		private $namespace_key = 'dc/memc/';

		/**
		 * Constructor
		 *
		 * @param int $ttl Time to live for the cached variable in seconds. Default 5 minutes (300 seconds)
		 * @param int $settings Settings for cache server
		 *
		 * return void
		 */
		public function __construct($ttl = 300, $settings = array()) {
				$this->ttl = false;
				if(isset($ttl)) {
						$this->ttl = $ttl;
				}
				$this->memcached = new Memcached();
				$this->memcached->addServer($settings['host'], $settings['port']);
				if(!empty($settings['username']) && !empty($settings['password'])) {
						if(method_exists($this->memcached, 'setSaslAuthData')) {
								$this->memcached->setSaslAuthData($settings['username'], $settings['password']);
						}
				}
		}
		/**
		 * Store variable into cache
		 * If storing again it will be replaced
		 *
		 * @param string $key Your key to store in cache
		 * @param mixed  $value Value to store in cache
		 *
		 * return boolean
		 */
		public function store($key, $value) {
				if(empty($key)) {
						return false;
				}
				$key = "{$this->namespace_key}{$key}";
				//we are using apcu_store not add because this will overwrite
				//thus saving us for checking the key and delete it first
				return $this->memcached->set($key, $value, $this->ttl);
		}
		/**
		 * Getting stored value from cache
		 * Returns false if no value found
		 *
		 * @param string $key Your key to store in cache
		 *
		 * return mixed
		 */
		public function get($key) {
				if(empty($key)) {
						return false;
				}
				$key  = "{$this->namespace_key}{$key}";
				$data = $this->memcached->get($key);
				if($this->memcached->getResultCode() == Memcached::RES_SUCCESS) {
						return $data;
				} else {
						throw new OssnDynamicCacheKeyNotExists("Cache key doesn't exists");
				}
				return false;
		}
		/**
		 * Deletes key from cache
		 *
		 * @param string $key Your key to store in cache
		 *
		 * return boolean
		 */
		public function delete($key) {
				if(empty($key)) {
						return false;
				}
				$key = "{$this->namespace_key}{$key}";
				return $this->memcached->delete($key);
		}
		/**
		 * Check if cache is available by system or not
		 *
		 * return boolean
		 */
		public function isAvailable() {
				return extension_loaded('memcached');
		}
}