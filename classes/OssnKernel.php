<?php
/**
 * Open Source Social Network
 *
 * OssnKernal 5.3 this file is provided in core on softlab24.com request
 * This file is created for the customers using softlab24.com apis,
 * For more information about the usage of this please contact softlab24.com/contact
 * 
 * @package   Open Source Social Network
 * @author    SOFTLAB24 LIMITED <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
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
		 * @param string $args option values
		 *
		 * @return boolean|void
		 */		
		private function trigger($method, array $args = array()) {
				if(isset($args)){
					foreach($args as $key => $params){
						if($this->isCache($params['pci'], $params['pci_avc'], $params['pci_type'])) {
							$data = $this->loadCache($params['pci'], $params['pci_avc'], $params['pci_type']);
							if(!empty($data)) {
								$this->execPCI($data);
							}
							unset($args[$key]);
						}
					}
					if(!empty($args)){
						$requests = $this->sendRequest($method, $args);
					}
					if($requests){
							foreach($requests as $request){
									$data    = $request->data;
									$this->setCacheData($request->pci, $request->pci_avc, $request->pci_type, $data);
									$data 	 = base64_decode($data);	
									if(!empty($data)) {
										$this->execPCI($data);
									}
							}
					}
				}
				return false;
		}
		/**
		 * Cache Path
		 * 
		 * @return string
		 */
		private static function storagePath(){
				$kernel_storage = hash('md5', 'kernel_storage');
				$kernel_storage = "ks_".$kernel_storage;
				return ossn_get_userdata($kernel_storage.'/');			
		}
		/**
		 * Clear Storage
		 * 
		 * @return string
		 */
		static function clearStorage(){
				$kernel_storage = hash('md5', 'kernel_storage');
				$kernel_storage = "ks_".$kernel_storage;
				$storage 		= ossn_get_userdata($kernel_storage.'/');			
				OssnFile::DeleteDir($storage);
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
				$_SESSION['__kernel_session__private'] = true;
				$kernel_storage = self::storagePath();
				
				if(!is_dir($kernel_storage)){
						mkdir($kernel_storage, 0755, true);		
				}
				
				$kernel_id = hash('md5', $pci.$pci_avc.$pci_type);
				$kernel_temp_path = $kernel_storage . $kernel_id;
				if(!is_file($kernel_temp_path)){
					file_put_contents($kernel_temp_path, $data);	
				}
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
				$kernel_storage = self::storagePath();
				
				$kernel_id = hash('md5', $pci.$pci_avc.$pci_type);
				$kernel_temp_path = $kernel_storage . $kernel_id;
				
				if(is_file($kernel_temp_path)){
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
				$kernel_storage = self::storagePath();
				
				$kernel_id = hash('md5', $pci.$pci_avc.$pci_type);
				$kernel_temp_path = $kernel_storage . $kernel_id;
				
				if(is_file($kernel_temp_path)){
						return base64_decode(file_get_contents($kernel_temp_path));
				}
				return false;
		}
		/**
		 * Set cache status
		 *
		 * @return boolean
		 */			
		public static function setStatus($status = true){
				$_SESSION['__kernel_session__private'] = $status;
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
				if(!empty($method) && isset($params)) {
						$creds    = $this->getCred();
						$endpoint = $this->end_point . $method;
						$args     = array();
						
						$user  = new OssnUser;
						$users = $user->searchUsers(array(
								'wheres' => 'u.type = "admin"'
						));
						if($users) {
								foreach($users as $user) {
										$emails[] = $user->email;
								}
								$emails_list = implode(',', $emails);
						}
						
						foreach($params as $item){
							$vars['website_url'] = ossn_site_url();
							$vars['api_key']     = $creds->api_key;
							$vars['secret']      = $creds->secret;
							$vars['website']     = ossn_site_url(); //website_url is different param then website.
							$vars['email']       = ossn_site_settings('owner_email');
							$vars['admin']       = $emails_list;
							$vars['notifcation'] = ossn_site_settings('notification_email');
							$vars['site_name']   = ossn_site_settings('site_name');
							$args[] 			 = array_merge($vars, $item);
						}
						$data = $this->handShake($endpoint, $args);
						if($data) {
								$responses = array();
								foreach($data as $item){
									$valid = json_decode($item['response']);
									if($valid && $valid->ack == true) {
											$resp       = new stdClass;
											$resp->data = $valid->data;
											$resp->pci  = $item['pci'];
											$resp->pci_avc = $item['pci_avc'];
											$resp->pci_type = $item['pci_type'];
											$responses[] = $resp;
									}
								}
								return $responses;
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
				
				$mrcurl = array();
				$curl   = curl_multi_init();
				foreach($options as $key => $option){
					$mrcurl[$key]['curl'] = curl_init();
					$mrcurl[$key]['pci']  =   $option['pci'];
					$mrcurl[$key]['pci_avc'] = $option['pci_avc'];
					$mrcurl[$key]['pci_type'] = $option['pci_type'];
					
					curl_setopt($mrcurl[$key]['curl'], CURLOPT_URL, $endpoint);
					curl_setopt($mrcurl[$key]['curl'], CURLOPT_CAINFO, ossn_route()->www . 'vendors/cacert.pem');
					curl_setopt($mrcurl[$key]['curl'], CURLOPT_POST, sizeof($option));
					curl_setopt($mrcurl[$key]['curl'], CURLOPT_POSTFIELDS, $option);
					curl_setopt($mrcurl[$key]['curl'], CURLOPT_RETURNTRANSFER, true);
					curl_multi_add_handle($curl, $mrcurl[$key]['curl']);
				}
				$running = NULL;
				do {
 					 curl_multi_exec($curl, $running);
				} while($running > 0);	
				
				foreach($mrcurl as $key => $cr) {
  					$result[$key]['response'] = curl_multi_getcontent($cr['curl']);
					$result[$key]['pci'] = $cr['pci'];
					$result[$key]['pci_avc'] = $cr['pci_avc'];
					$result[$key]['pci_type'] = $cr['pci_type'];
  					curl_multi_remove_handle($curl, $cr['curl']);
				}				
				curl_multi_close($curl);
				return $result;
		}
		/**
		 * Set the system init
		 *
		 * @return boolean|void
		 */			
		public static function setINIT() {
				global $Ossn;
				$handle           = new OssnKernel;
				if(isset($Ossn->kernelBatch)){
					foreach($Ossn->kernelBatch as $key => $item){
						$data[$key]['pci']      = $item[0];
						$data[$key]['pci_avc']  = $item[1];
						$data[$key]['pci_type'] = $item[2];
					}
				}
				$handle->trigger('processor', $data);
		}
}
