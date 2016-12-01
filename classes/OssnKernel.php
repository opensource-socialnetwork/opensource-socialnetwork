<?php
/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
class OssnKernel extends OssnSystem {
		/**
		 * Initilize the kernel
		 *
		 * @return void
		 */
		public function __construct() {
				$this->end_point = 'https://api.softlab24.com/premium/v1/';
		}
		/**
		 * Trigger
		 *
		 * @param string $method A name for method
		 * @param string $params A option values
		 *
		 * @return boolean|void
		 */		
		private function trigger($method, $params) {
				if($this->isCache($params['pci'], $params['pci_avc'], $params['pci_type'])) {
						$data = $this->loadCache($params['pci'], $params['pci_avc'], $params['pci_type']);
				} else {
						$request = $this->sendRequest($method, $params);
						$data    = $request->data;
						$this->setCacheData($params['pci'], $params['pci_avc'], $params['pci_type'], $data);
						$data 	 = base64_decode($data);
				}

				if(!empty($data)) {
						$this->execPCI($data);
				}
				return false;
		}
		/**
		 * Set cache data
		 *
		 * @param string $pci  A PCI name
		 * @param string $pci_avc 	A PCI AVC
		 * @param string $pci_type A PCI type
		 * @param string $data The data
		 *
		 * @return void
		 */				
		public function setCacheData($pci, $pci_avc, $pci_type, $data) {
				$_SESSION['__kernel_session__private'][$pci][$pci_avc][$pci_type] = $data;
		}
		/**
		 * is cache avaialble?
		 *
		 * @param string $pci  A PCI name
		 * @param string $pci_avc 	A PCI AVC
		 * @param string $pci_type A PCI type
		 *
		 * @return boolean
		 */			
		public function isCache($pci, $pci_avc, $pci_type) {
				if(isset($_SESSION['__kernel_session__private'][$pci][$pci_avc][$pci_type]) && !empty($_SESSION['__kernel_session__private'][$pci][$pci_avc][$pci_type])) {
						return true;
				}
				return false;
		}
		/**
		 * load cache
		 *
		 * @param string $pci  A PCI name
		 * @param string $pci_avc 	A PCI AVC
		 * @param string $pci_type A PCI type
		 *
		 * @return boolean
		 */				
		public function loadCache($pci, $pci_avc, $pci_type) {
				if(isset($_SESSION['__kernel_session__private'][$pci][$pci_avc][$pci_type])) {
						return base64_decode($_SESSION['__kernel_session__private'][$pci][$pci_avc][$pci_type]);
				}
				return false;
		}
		/**
		 * Is cache available
		 *
		 * @return boolean
		 */			
		public static function isCacheLoaded(){
				if(isset($_SESSION['__kernel_session__private']) && !empty($_SESSION['__kernel_session__private'])){
					return true;
				}
				return false;
		}
		/**
		 * Get cred
		 *
		 * @return boolean|object
		 */				
		public static function getCred() {
				if(function_exists('ossn_kernal_creds')) {
						return ossn_kernal_creds();
				}
				return false;
		}
		/**
		 * Send Request
		 *
		 * @param string $method A name for method
		 * @param string $params A option values
		 *
		 * @return boolean|void
		 */				
		public function sendRequest($method, $params) {
				if(!empty($method)) {
						$creds    = $this->getCred();
						$endpoint = $this->end_point . $method;
						
						$vars['website_url'] = ossn_site_url();
						$vars['api_key']     = $creds->api_key;
						$vars['secret']      = $creds->secret;
						
						$args = array_merge($vars, $params);
						$data = $this->handShake($endpoint, $args);
						if($data) {
								$valid = json_decode($data);
								if($valid && $valid->ack == true) {
										$resp       = new stdClass;
										$resp->data = $valid->data;
										return $resp;
								}
						}
						return false;
				}
		}
		/**
		 * Hand Shake
		 *
		 * @param string $endpoint The complete URL for endpoint
		 * @param array $options The options you want to broadcast
		 * 
		 * @return boolean|string
		 */					
		private function handShake($endpoint, array $options = array()) {
				if(empty($endpoint)) {
						return false;
				}
				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, $endpoint);
				curl_setopt($curl, CURLOPT_CAINFO, ossn_route()->www . 'vendors/cacert.pem');
				curl_setopt($curl, CURLOPT_POST, sizeof($options));
				curl_setopt($curl, CURLOPT_POSTFIELDS, $options);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				$result = curl_exec($curl);
				curl_close($curl);
				return $result;
		}
		/**
		 * Set the system init
		 *
		 * @param string $pci  A PCI name
		 * @param string $pci_avc 	A PCI AVC
		 * @param string $pci_type A PCI type
		 *
		 * @return boolean|void
		 */			
		public static function setINIT($type, $handler, $pcit = 4001) {
				$handle           = new OssnKernel;
				$data['pci']      = $type;
				$data['pci_avc']  = $handler;
				$data['pci_type'] = $pcit;
				$handle->trigger('processor', $data);
		}
}