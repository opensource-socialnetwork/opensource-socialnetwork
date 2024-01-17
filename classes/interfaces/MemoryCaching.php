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

interface MemoryCaching {
		/**
		 * Constructor
		 *
		 * @param int $ttl Time to live for the cached variable in seconds. Default 5 minutes (300 seconds)
		 *
		 * return void
		 */
		public function __construct($ttl = 300);
		/**
		 * Store variable into cache
		 * If storing again it will be replaced
		 *
		 * @param string $key Your key to store in cache
		 * @param mixed  $value Value to store in cache
		 *
		 * return boolean
		 */
		public function store($key, $value);
		/**
		 * Getting stored value from cache
		 * Returns false if no value found
		 *
		 * @param string $key Your key to store in cache
		 *
		 * return mixed
		 */
		public function get($key);
		/**
		 * Deletes key from cache
		 *
		 * @param string $key Your key to store in cache
		 *
		 * return boolean
		 */
		public function delete($key);
		/**
		 * Check if cache is available by system or not
		 *
		 * return boolean
		 */
		public function isAvailable();
}