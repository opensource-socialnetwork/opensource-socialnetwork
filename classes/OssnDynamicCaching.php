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
		public function isAvailableEnabled(){
					return true;
					$settings = ossn_site_settings('cache.dynmaic.enabled');
					if($settings == 1){
						return true;	
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
				$handler = new OssnMemcached($ttl);
				$default = ossn_call_hook('ossn', 'handler:dynamic:caching', $ttl, $handler);
				return $default;
		}
} //class