<?php
/**
 * Open Source Social Network
 * 
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 *
 *
 * Database v5.3 #1525
 * Improvements in v5.3, 
 * You can use wheres based on array parameters
 * Example
 *  $db->select(array(
 *		'from' => 'mysqli',
 *		'wheres' => array(
 *		array(
 *			'name' => 'b', 
 *			'comparator' => '=',
 *			'value' => '10', 
 *			'separator' => 'AND',
 *		),
 *		array(
 *			'name' => 'c', 
 *			'comparator' => '=',
 *			'value' => '20', 
 *		)		
 *	),
 * ));
 */
class OssnDatabase extends OssnBase {
		/**
		 * Initialize the database
		 *
		 * return void
		 */
		public function __construct() {
				global $Ossn;
				//Avoid the multiple db connections #1001
				if(!isset($Ossn->dbLINK) || isset($Ossn->dbLINK) && $Ossn->dbLINK == false) {
						$Ossn->dbLINK = $this->Connect();
				}
				//set the sql mode and avoid setting again and again for each request
				if(!isset($Ossn->setSQLMode)) {
						$this->statement("SET SESSION sql_mode=(SELECT REPLACE(@@SESSION.sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
						$this->execute();
						$Ossn->setSQLMode = true;
				}
		}
		/**
		 * Connect to database
		 *
		 * @return boolean
		 */
		public function Connect() {
				$settings = ossn_database_settings();
				$options  = array(
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
						PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
						PDO::ATTR_EMULATE_PREPARES => false,
				);
				$conector = "mysql:host={$settings->host};dbname={$settings->database};port={$settings->port};charset=utf8mb4";
				try {
						$connect = new PDO($conector, $settings->user, $settings->password, $options);
						return $connect;
				}
				catch(PDOException $ex) {
						throw new OssnDatabaseException($ex->getMessage());
				}
		}
		/**
		 * Prepare a query to insert data in database
		 *
		 * @param  array  @param['names']  Names of columns
		 * @param  array  @param['values'] Values that need to be inserted
		 * @param  string @param['into']   Table name
		 *
		 * @return boolean
		 */
		public function insert($params) {
				global $Ossn;
				if(is_array($params)) {
						if(count($params['names']) == count($params['values'])) {
								for($i = 1; $i <= count($params['values']); $i++) {
										$values[] = '?';
								}
								$colums         = "`" . implode("`, `", $params['names']) . '`';
								$values         = implode(", ", $values);
								$actual_values  = array();
								foreach($params['values'] as $val){
										if(!isset($val)){
											$val = '';	
										}
										$actual_values[] = $val;
								}
								// error_log('INSERT: ' . ossn_dump($actual_values));
								// replace single \r\n by real linefeeds (as appearing in comments, sitepages, etc.
								$actual_values = str_replace('\\r\\n', "\r\n", $actual_values);
								// replace double \\r\\n by \r\n (as appearing in json encoded posts)
								$actual_values = str_replace('\\\r\\\n', '\r\n', $actual_values);
								// handle single backslash correctly
								$actual_values = str_replace('\\\\', '\\', $actual_values);
								// same replacements done in db-update
								// error_log('INSERT_2: ' . ossn_dump($actual_values));
								$this->statement("INSERT INTO {$params['into']} ($colums) VALUES ($values);");
								if($this->execute($actual_values)) {
										$this->last_id = intval($this->database->lastInsertId());
										return $this->last_id;
								}
						}
				}
				return false;
		}
		/**
		 * Prepare a database query
		 *
		 * @return boolean
		 */
		public function statement($query) {
				if(!empty($query)) {
						$this->query = $query;
						return true;
				}
				return false;
		}
		/**
		 * Execute a mysqli query and store result in memory
		 *
		 * @param array $values Values
		 *
		 * @return boolean
		 */
		public function execute($values = array()) {
				global $Ossn;
				$this->database = $Ossn->dbLINK;
				if(isset($this->query) && !empty($this->query)) {
						try {
								if(empty($values)) {
										$this->exe = $this->database->query($this->query);
								} else {
										$this->exe = $this->database->prepare($this->query);
										$this->exe->execute($values);
								}
						}
						catch(PDOException $ex) {
								throw new OssnDatabaseException("{$ex->getMessage()} \n {$this->query} ");
						}
						unset($this->query);
						//Using mysqli_close() isn't usually necessary, as non-persistent open links are automatically closed at the end of the script's execution.
						//$this->database->close();
						return true;
				}
				return false;
		}
		/**
		 * Prepare a query to update data in database
		 *
		 * @param  string @param['names']  Names of columns
		 * @param  array  @param['values'] Values that need to be updated
		 * @param  string @param['table']  Table name
		 * @param  array  @param['wheres'] Specify a selection criteria to update required records
		 *
		 * @return boolean
		 */
		public function update($params = array()) {
				if(is_array($params)) {
						if(count($params['names']) == count($params['values']) && !empty($params['table'])) {
								// error_log('UPDATE: ' . ossn_dump($params['values']));
								$params['values'] = str_replace('\\r\\n', "\r\n", $params['values']);
								$params['values'] = str_replace('\\\r\\\n', '\r\n', $params['values']);
								$params['values'] = str_replace('\\\\', '\\', $params['values']);
								// error_log('UPDATE_2: ' . ossn_dump($params['values']));
								$valuec = count($params['names']);
								$i      = 1;
								foreach($params['names'] as $key => $val) {
										$data[$val] = $params['values'][$key];
								}
								
								foreach($data as $keys => $vals) {
										if($i == $valuec) {
												$valyes[] = "`{$keys}` = ?";
										} else {
												$valyes[] = "`{$keys}` = ?,";
										}
										$i++;
								}
								$q = implode('', $valyes);
								//wheres rebuild
								if(!isset($params['wheres'][0]['name'])) {
										$params['wheres'] = implode(' ', $params['wheres']);
										$this->statement("UPDATE {$params['table']} SET {$q} WHERE {$params['wheres']}");
								} else {
										$where_merge   = '';
										$wheres_values = array();
										foreach($params['wheres'] as $where_item) {
												if(!isset($where_item['name']) || !isset($where_item['value'])) {
														continue;
												}
												if(!isset($where_item['separator'])) {
														$where_item['separator'] = '';
												}
												if(!isset($where_item['comparator'])) {
														$where_item['comparator'] = '=';
												}
												$where_merge .= " `{$where_item['name']}` {$where_item['comparator']} ? {$where_item['separator']}";
												$params['values'][] = $where_item['value'];
										}
										$this->statement("UPDATE {$params['table']} SET {$q} WHERE {$where_merge}");
								}
								if($this->execute($params['values'])) {
										return true;
								}
						}
				}
				return false;
		}
		/**
		 * Prepare a query to select data from database
		 *
		 * @param  string @param['from'] Names of table
		 * @param  array  @param['params'] Names of columns which you want to select
		 * @param  array  @param['wheres'] Specify a selection criteria to get required records
		 *
		 * @return boolean
		 */
		public function select($params, $multi = '') {
				if(is_array($params)) {
						if(!isset($params['params'])) {
								$parameters = '*';
						} else {
								$parameters = implode(', ', $params['params']);
						}
						$order_by = '';
						if(!empty($params['order_by'])) {
								$order_by = "ORDER by {$params['order_by']}";
						}
						$group_by = '';
						if(!empty($params['group_by'])) {
								$group_by = "GROUP by {$params['group_by']}";
						}
						$where         = '';
						$wheres_values = false;
						//wheres rebuild
						if(isset($params['wheres']) && !isset($params['wheres'][0]['name']) && is_array($params['wheres'])) {
								$where = implode(' ', $params['wheres']);
						} elseif(isset($params['wheres'])) {
								$where_merge   = '';
								$wheres_values = array();
								foreach($params['wheres'] as $where_item) {
										if(!isset($where_item['name']) || !isset($where_item['value'])) {
												continue;
										}
										if(!isset($where_item['separator'])) {
												$where_item['separator'] = '';
										}
										if(!isset($where_item['comparator'])) {
												$where_item['comparator'] = '=';
										}
										$where_merge .= " `{$where_item['name']}` {$where_item['comparator']} ? {$where_item['separator']}";
										$wheres_values[] = $where_item['value'];
								}
								$where = $where_merge;
						}
						$wheres = '';
						if(!empty($params['wheres'])) {
								$wheres = "WHERE({$where})";
						}
						$limit = '';
						if(!empty($params['limit'])) {
								$limit = "LIMIT {$params['limit']}";
						}
						$joins = '';
						if(!empty($params['joins']) && !is_array($params['joins'])) {
								$joins = $params['joins'];
						} elseif(!empty($params['joins']) && is_array($params['joins'])) {
								$joins = implode(' ', $params['joins']);
						}
						$this->statement("SELECT {$parameters} FROM {$params['from']} {$joins} {$wheres} {$group_by} {$order_by} {$limit};");
						if($this->execute($wheres_values)) {
								return $this->fetch($multi);
						}
				}
				return false;
		}
		/**
		 * Fetch the data from memory that is stored during execution;
		 *
		 * @param boolean $data Ture if you want to fetch all data , or false if only one row
		 *
		 * @return boolean
		 */
		public function fetch($data = false) {
				if(isset($this->exe)) {
						if($data !== true) {
								if($fetch = $this->exe) {
										$this->clearVars();
										return arrayObject($fetch->fetch(PDO::FETCH_ASSOC));
								}
						}
						if($data === true) {
								if($fetch = $this->exe) {
										$all = $fetch->fetchAll();
										if($all){
												$this->clearVars();
												return arrayObject($all);
										}
								}
						}
				}
				return false;
		}
		/**
		 * Prepare a query to delete data from database
		 *
		 * @param  string @param['from']  Names of table
		 * @param  array  @param['wheres'] Specify a selection criteria to get required records
		 *
		 * @return boolean
		 */
		public function delete($params) {
				if(is_array($params)) {
						$wheres_values = false;
						//wheres rebuild
						if(isset($params['wheres']) && !isset($params['wheres'][0]['name']) && is_array($params['wheres'])) {
								$where = implode(' ', $params['wheres']);
						} elseif(isset($params['wheres'])) {
								$where_merge   = '';
								$wheres_values = array();
								foreach($params['wheres'] as $where_item) {
										if(!isset($where_item['name']) || !isset($where_item['value'])) {
												continue;
										}
										if(!isset($where_item['separator'])) {
												$where_item['separator'] = '';
										}
										if(!isset($where_item['comparator'])) {
												$where_item['comparator'] = '=';
										}
										$where_merge .= " `{$where_item['name']}` {$where_item['comparator']} ? {$where_item['separator']}";
										$wheres_values[] = $where_item['value'];
								}
								$where = $where_merge;
						}
						if(!empty($params['wheres'])) {
								$wheres = "WHERE({$where})";
						}
						//don't let any component or query to empty entire table
						if(empty($params['wheres'])) {
								return false;
						}
						$this->statement("DELETE FROM `{$params['from']}` {$wheres};");
						if($this->execute($wheres_values)) {
								return true;
						}
				}
				return false;
		}
		/**
		 * Get a guid of newly create entry
		 *
		 * @return integer
		 */
		public function getLastEntry() {
				if(!empty($this->last_id)) {
						return $this->last_id;
				}
		}
		/**
		 * Create a wheres clause for database
		 *
		 * @param array $array A valid array containg wheres clauses;
		 * @param string $operator AND, OR, LIKE
		 *
		 * @return string
		 */
		public function constructWheres(array $array, $operator = "AND") {
				if(!empty($array) && !empty($operator)) {
						$result = implode(" {$operator} ", $array);
						return $result;
				}
				return false;
		}
		/**
		 * Generate limit from options
		 * 
		 * @param integer $data_limit How much data should be fetched?
		 * @param integer $page_limit Limit of data on one page
		 * @param integer $offset Offset value
		 *
		 * @return string|false
		 */
		public function generateLimit($data_limit = false, $page_limit = false, $offset = false) {
				$limit = $data_limit;
				//get only required result, don't bust your server memory
				if(isset($offset) && $offset !== false && $page_limit !== false) {
						$limitfrom = ($offset - 1) * ($page_limit);
						$limitto   = $page_limit;
						
						$data_limit = "{$limitfrom}, {$limitto}";
						if($offset > 1) {
								if($limit > $limitfrom) {
										$limitto = $limit - $limitfrom;
										if($limitto <= $page_limit) {
												$data_limit = "{$limitfrom}, {$limitto}";
										}
								}
						}
						if(!empty($limit) && $limit < $page_limit) {
								$data_limit = $limit;
						}
						return $data_limit;
				}
				return false;
		}
		/**
		 * Clear variables to avoid passing then in other objects
		 *
		 * @return void
		 */		
		public function clearVars(){
				unset($this->exe);
				unset($this->database);			
		}
		/**
		 * Unset the stuff that is not need once op is finished
		 *
		 * @return void
		 */
		public function __destruct(){
				$this->clearVars();
		}
} //class
