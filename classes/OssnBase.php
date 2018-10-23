<?php
/**
 *  Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
class OssnBase extends OssnSession {
		/**
		 * Get guid.
		 *
		 * @return false|int;
		 */
		public function getGUID() {
				if(isset($this->guid)) {
						return $this->guid;
				}
				return false;
		}
		/**
		 * Get Id.
		 *
		 * @return false|int;
		 */
		public function getID() {
				if(isset($this->id)) {
						return $this->id;
				}
				return false;
		}
		/**
		 * Get a parameter from object
		 *
		 * @param string $param
		 *
		 * @return string;
		 */
		public function getParam($param) {
				if(isset($this->$param)) {
						return $this->$param;
				}
				return false;
		}
		/**
		 * isParam
		 *
		 * @param string $param
		 *
		 * @return string;
		 */
		public function isParam($param) {
				if(!empty($param) && isset($this->$param)) {
						return true;
				}
				return false;
		}
		/**
		 * Allow the method register 
		 *
		 * @note this is for Ossn > v4.4 , and this is in testing phase,
		 * and is not recomended to use for production until you know what is going on.
		 *
		 * @param string $method Name of method
		 * @param array  $args A arguments
		 * 
		 * @return mixed|boolean|string|init|float|resource
		 */
		public function __call($method, $args) {
				$name = get_class($this);
				if(!ossn_is_hook('ossn/class/register/method', "{$name}:{$method}")) {
						throw new exception("Call to undefined method {$name}:{$method}");
				}
				$hooked = ossn_call_hook('ossn/class/register/method', "{$name}:{$method}", $args, $this);
				if($hooked->params == false && !empty($args)) {
						throw new exception("Function expects no arguments, but arguments are supplied {$name}:{$method}({args})");
				}
				return $hooked->return;
		}
} //CLASS
