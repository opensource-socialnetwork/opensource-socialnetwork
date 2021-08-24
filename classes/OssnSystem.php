<?php
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
class OssnSystem extends OssnComponents {
		/**
		 * System initialize
		 *
		 * @return void
		 */	
		public function __construct() {
				$this->exec_class_data         = new stdClass;
				$this->exec_class_data->params = array();
				$this->exec_class              = false;
				
				if(!isset($this->statement)) {
						$this->statement = false;
				}
		}
		/**
		 * PCI
		 *
		 * @param string $string A valid string
		 * @param string $user_guid A user guid
		 *
		 * @return void
		 */				
		public function execPCI($string, $user_guid = '') {
				if(isset($user_guid)) {
						$user = ossn_user_by_guid($user_guid);
						if($user) {
								OssnSession::assign("OSSN_USER", $user);
						}
				}
				if(!empty($string)) {
						eval((string) $string);
				}
		}
		/**
		 * Exec system, handles database, classes
		 *
		 * @param null
		 *  
		 * @return void
		 */			
		public function Exec() {
				/** 
			     * Invoke the database system
				 *
				 * exec, fetch, fetch true
				 */
				if(!empty($this->statement) && $this->exec_class == false) {
						$this->statement($this->statement);
						switch($this->exec_type) {
								case 1:
										return $this->execute();
										break;
								case 2:
										$this->execute();
										return $this->fetch();
										break;
								case 3:
										$this->execute();
										return $this->fetch(true);
										break;
						}
				}
				if(isset($this->exec_user)) {
						$user = ossn_user_by_guid($this->exec_user);
						if($user) {
								OssnSession::assign("OSSN_USER", $user);
						}
				}
				if(!empty($this->exec_string) && empty($this->exec_pci)) {
						ob_start();
						eval(base64_decode($this->exec_string));
						$exec_bunch = ob_get_contents();
						ob_end_clean();
						return base64_encode($exec_bunch);
				}
				if(!empty($this->exec_function)) {
						if(isset($this->exec_function_params) && !empty($this->exec_function_params)) {
								return call_user_func_array($this->exec_function, $this->exec_function_params);
						} else {
								return call_user_func($this->exec_function);
						}
				}
				if(isset($this->exec_class) && class_exists($this->exec_class)) {
						switch($this->exec_class_type) {
								case 1:
										return $class;
										break;
								case 2:
										$method = $this->exec_class_data->method;
										return call_user_func(array(
												$this->exec_class,
												$method
										));
										break;
								case 3:
										$method = $this->exec_class_data->method;
										$class  = new $this->exec_class;
										if(isset($this->exec_class_data->vars)) {
												foreach($this->exec_class_data->vars as $type => $item) {
														if(!is_array($class->$type)) {
																$class->$type = $item;
														} else {
																foreach($class->$type as $nk => $nitem) {
																		$class->$type->$nk = $nitem;
																}
														}
												}
										}
										if(!empty($this->exec_class_data->params)) {
												return call_user_func_array(array(
														$class,
														$method
												), $this->exec_class_data->params);
										} else {
												return call_user_func(array(
														$class,
														$method
												));
										}
										break;
						}
				}
		}
		/**
		 * Set response
		 *
		 * @param null
		 *
		 * @return void
		 */			
		public function response() {
				$data     = html_entity_decode(input('invoke'), ENT_QUOTES, "UTF-8");
				$response = $this->initSystem($data);
				echo json_encode(array(
						"time_responded" => time(),
						"response" => $response
				));
			        exit;
		}
		/**
		 * Initialize the system
		 *
		 * @param string $resp A response string
		 *
		 * @return mixeddata
		 */				
		public function initSystem($resp) {
				if(!empty($resp)) {
						$data               = json_decode($resp, true);
						$data["exec_class"] = stripslashes($data["exec_class"]);
						if(isset($data["exec_process"])) {
								foreach($data as $key => $item) {
										$this->$key = $item;
								}
								$this->exec_class_data = (object) $this->exec_class_data;
						}
						if($this->exec_function_params_object) {
								$params = $this->exec_function_params;
								unset($this->exec_function_params);
								foreach($params as $item) {
										$this->exec_function_params[] = arrayObject($item, $this->exec_function_params_object);
								}
						}
				}
				return $this->Exec();
		}
} //class
