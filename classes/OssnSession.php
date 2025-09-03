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
//Use a stdClass as base instead of using AllowDynamicProperties attributes #2238
class OssnSession extends stdClass {
		/**
		 * Start session
		 *
		 * @return void
		 */
		public static function start() {
				session_start();
		}
		/**
		 * Assign value to session
		 *
		 * @param string $name A session ID
		 * @param string $value A value
		 *
		 * @return void
		 */
		public static function assign($name = '', $value = '') {
				if(!empty($value)) {
						$_SESSION[$name] = $value;
				}
		}
		/**
		 * Remove session
		 *
		 * @param string $name A session ID
		 *
		 * @return void
		 */
		public static function unassign($name = '') {
				if(isset($_SESSION[$name])) {
						unset($_SESSION[$name]);
				}
		}
		/**
		 * Check if the session exists or not
		 *
		 * @param string $name A session ID
		 *
		 * @return boolean
		 */
		public static function isSession($name = '') {
				if(isset($_SESSION[$name])) {
						return true;
				}
				return false;
		}
		/**
		 * Get the session value
		 *
		 * @param string $name A session ID
		 *
		 * @return mixed
		 */
		public static function getSession($name = '') {
				if(OssnSession::isSession($name)) {
						return $_SESSION[$name];
				}
				return false;
		}	
} //class
