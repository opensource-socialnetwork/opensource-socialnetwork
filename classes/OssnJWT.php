<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) Engr. Syed Arsalan Hussain Shah
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
class OssnJWT {
		/**
		 * OSSN JWT init uses HS256
		 *
		 * @param array $data Array data
		 * @param string $key Key
		 * @return void
		 */
		public function __construct($data, $key) {
				$require = ossn_route()->www . 'vendors/jwt/autoload.php';
				require_once $require;

				$this->_data    = $data;
				$this->_key     = $key;
				$this->_encType = 'HS256';
				if(empty($this->_data)) {
						throw new Exception('Your data is empty!');
				}
				if(empty($this->_key)) {
						throw new Exception('Your key is empty!');
				}
				if(empty($this->_encType)) {
						throw new Exception('Encryption Type is empty!');
				}
		}
		/**
		 * Return encoded data
		 *
		 * @return string
		 */
		public function encode(): string {
				return Firebase\JWT\JWT::encode($this->_data, $this->_key, $this->_encType);
		}
		/**
		 * Return decoded array as stdClass object
		 *
		 * @return object
		 */
		public function decode(): object {
				$key = new Firebase\JWT\Key($this->_key, $this->_encType);
				return Firebase\JWT\JWT::decode($this->_data, $key);
		}
}