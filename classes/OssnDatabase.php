<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
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
 * Database OSSN v8.8
 * Supports nested wheres and mixed
 * see https://github.com/opensource-socialnetwork/opensource-socialnetwork/wiki/OSSN-8.8-Database-complex-wheres-using-array
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
				if(!isset($Ossn->dbLINK) || (isset($Ossn->dbLINK) && $Ossn->dbLINK == false)) {
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
						PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
						PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
						PDO::ATTR_EMULATE_PREPARES   => false,
				);
				$conector = "mysql:host={$settings->host};dbname={$settings->database};port={$settings->port};charset=utf8mb4";
				try {
						$connect = new PDO($conector, $settings->user, $settings->password, $options);
						return $connect;
				} catch (PDOException $ex) {
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
								for ($i = 1; $i <= count($params['values']); $i++) {
										$values[] = '?';
								}
								$colums        = '`' . implode('`, `', $params['names']) . '`';
								$values        = implode(', ', $values);
								$actual_values = array();
								foreach ($params['values'] as $val) {
										if(!isset($val)) {
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
						} catch (PDOException $ex) {
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
		 * Recursively builds the content of the WHERE clause (without the 'WHERE (...)').
		 *
		 * This method handles simple conditions, raw strings, and nested groups defined by
		 * the 'group' and 'connector' keys.
		 *
		 * @param array $arg_wheres The array of WHERE conditions.
		 * @param string $default_connector The default logical connector for this level (AND or OR).
		 * @return array Associative array containing 'content' (the WHERE string) and 'values' (the bound values).
		 */
		private function buildWheresContent($arg_wheres, $default_connector = 'AND') {
				$known_seperators = array(
						'AND',
						'OR',
				);
				$in_or_notin = array(
						'IN',
						'NOT IN',
				);

				// Ensure the default connector for this level is valid
				if(!in_array(strtoupper($default_connector), $known_seperators, true)) {
						$default_connector = 'AND';
				}

				$where_content = '';
				$wheres_values = array();

				if(isset($arg_wheres) && is_array($arg_wheres)) {
						foreach ($arg_wheres as $index => $where_item) {
								// By default, the connector used *after* this item is the parent's default.
								$next_connector = $default_connector;

								// --- 1. Handle Explicit Grouping (Recursive Call) ---
								if(is_array($where_item) && isset($where_item['group'])) {
										// Get the connector *internal* to the group
										$group_connector = strtoupper($where_item['connector'] ?? 'AND');
										if(!in_array($group_connector, $known_seperators, true)) {
												$group_connector = 'AND';
										}

										// Recurse, passing the group's internal connector as the new default for the nested items.
										$nested_result = $this->buildWheresContent($where_item['group'], $group_connector);

										// Wrap the inner content in parentheses
										$where_content .= " ({$nested_result['content']}) ";
										$wheres_values = array_merge($wheres_values, $nested_result['values']);

										// If the group item itself has a custom separator, use that to link it to the next sibling.
										if(isset($where_item['separator'])) {
												$next_connector = strtoupper($where_item['separator']);
										}

										// --- 2. Handle Raw String Condition ---
								} elseif(is_string($where_item)) {
										$where_content .= " {$where_item} ";

										// --- 3. Handle Simple/Complex Condition (name/value) ---
								} elseif(isset($where_item['name']) && isset($where_item['value'])) {
										$comparator = strtoupper(trim($where_item['comparator'] ?? '='));
										$column     = trim($where_item['name']);

										// If the item has a custom separator, use it to link to the next sibling.
										$item_separator = strtoupper($where_item['separator'] ?? $default_connector);
										if(in_array($item_separator, $known_seperators, true)) {
												$next_connector = $item_separator;
										}

										// Build the SQL fragment and collect values
										if($comparator === 'LIKE' || $comparator === 'NOT LIKE') {
												$value = $where_item['value'];
												if(strpos($value, '%') === false) {
														$value = "%{$value}%";
												}
												$where_content .= " {$column} {$comparator} ? ";
												$wheres_values[] = $value;
										} elseif(in_array($comparator, $in_or_notin, true)) {
												if(!is_array($where_item['value']) || count($where_item['value']) === 0) {
														// Skip invalid IN/NOT IN
														continue;
												}
												$valueCount   = count($where_item['value']);
												$placeholders = implode(', ', array_fill(0, $valueCount, '?'));
												$where_content .= " {$column} {$comparator} ({$placeholders}) ";
												$wheres_values = array_merge($wheres_values, $where_item['value']);
										} else {
												$where_content .= " {$column} {$comparator} ? ";
												$wheres_values[] = $where_item['value'];
										}
								}

								// Ensure proper logical separators between conditions
								if($index < count($arg_wheres) - 1) {
										// Add the determined connector after the current item
										$where_content .= " {$next_connector} ";
								}
						}
				}

				return array(
						'content' => trim($where_content),
						'values'  => $wheres_values,
				);
		}
		/**
		 * Public method to build the complete WHERE clause string and values array.
		 *
		 * @param array $arg_wheres The array of WHERE conditions.
		 * @param string $default_separator The default logical separator (AND/OR).
		 * @return array Associative array containing 'where' (the full WHERE clause) and 'values' (the bound values).
		 */
		private function buildWheresFromArray($arg_wheres, $default_separator = 'AND') {
				$where = '';

				// Call the recursive method
				$result        = $this->buildWheresContent($arg_wheres, $default_separator);
				$where_content = $result['content'];

				// Only add the WHERE clause if there is content
				if(!empty($where_content)) {
						// Add the final 'WHERE (...)' wrapper
						$where = "WHERE ({$where_content})";
				}
				// Return the final where clause and the values array
				return array(
						'where'  => $where,
						'values' => $result['values'], // Access the values directly from $result
				);
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
						if(!isset($params['names'])) {
								throw new OssnDatabaseException('Col names are not set');
						}
						if(!is_array($params['names'])) {
								throw new OssnDatabaseException('Col are not array');
						}
						if(!isset($params['values'])) {
								throw new OssnDatabaseException('Values are not set');
						}
						if(!is_array($params['values'])) {
								throw new OssnDatabaseException('Values are not array');
						}
						if(count($params['names']) != count($params['values'])) {
								throw new OssnDatabaseException("Cols and values didn't match");
						}
						if(count($params['names']) == count($params['values']) && !empty($params['table'])) {
								$params['values'] = str_replace('\\r\\n', "\r\n", $params['values']);
								$params['values'] = str_replace('\\\r\\\n', '\r\n', $params['values']);
								$params['values'] = str_replace('\\\\', '\\', $params['values']);

								// error_log('UPDATE_2: ' . ossn_dump($params['values']));
								$valuec = count($params['names']);
								$i      = 1;
								foreach ($params['names'] as $key => $val) {
										$data[$val] = $params['values'][$key];
								}

								foreach ($data as $keys => $vals) {
										if($i == $valuec) {
												$valyes[] = "`{$keys}` = ?";
										} else {
												$valyes[] = "`{$keys}` = ?,";
										}
										$i++;
								}
								$q = implode('', $valyes);

								// Get the default separator (use AND if none is specified)
								$default_separator = isset($params['default_separator']) ? strtoupper($params['default_separator']) : 'AND';

								//wheres rebuild
								$build_wheres  = $this->buildWheresFromArray($params['wheres'], $default_separator);
								$where         = $build_wheres['where'];
								$wheres_values = $build_wheres['values'];

								$this->statement("UPDATE {$params['table']} SET {$q} {$where}");
								$prepared_values = array_merge($params['values'], $wheres_values);
								//set=values and wheres values need to pass to execte at once
								if($this->execute($prepared_values)) {
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
						// Define the parameters to be selected (either * or specific fields)
						$parameters = isset($params['params']) ? implode(', ', $params['params']) : '*';

						// Handle optional sorting
						$order_by = !empty($params['order_by']) ? "ORDER BY {$params['order_by']}" : '';

						// Handle grouping
						$group_by = !empty($params['group_by']) ? "GROUP BY {$params['group_by']}" : '';

						// Get the default separator (use AND if none is specified)
						$default_separator = isset($params['default_separator']) ? strtoupper($params['default_separator']) : 'AND';

						//wheres rebuild
						$build_wheres  = $this->buildWheresFromArray($params['wheres'], $default_separator);
						$where         = $build_wheres['where'];
						$wheres_values = $build_wheres['values'];

						// Handle LIMIT
						$limit = !empty($params['limit']) ? "LIMIT {$params['limit']}" : '';

						// Handle JOINS (if any)
						$joins = '';
						if(!empty($params['joins'])) {
								if(is_array($params['joins'])) {
										$joins = implode(' ', $params['joins']);
								} else {
										$joins = $params['joins'];
								}
						}

						// Construct the final SQL query
						$sql = "SELECT {$parameters} FROM {$params['from']} {$joins} {$where} {$group_by} {$order_by} {$limit};";

						// Execute the query
						$this->statement($sql);
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
										if($all) {
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
						// Get the default separator (use AND if none is specified)
						$default_separator = isset($params['default_separator']) ? strtoupper($params['default_separator']) : 'AND';

						//wheres rebuild
						$build_wheres  = $this->buildWheresFromArray($params['wheres'], $default_separator);
						$where         = $build_wheres['where'];
						$wheres_values = $build_wheres['values'];

						// Construct the final SQL query
						$sql = "DELETE FROM {$params['from']} {$where};";

						// Execute the query
						$this->statement($sql);
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
		 * Create a wheres clause for database. Support 1D array only.
		 *
		 * @param array $array A valid array containg wheres clauses;
		 * @param string $operator AND, OR, LIKE
		 *
		 * @return string
		 */
		public function constructWheres(array $array, $operator = 'AND') {
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
						$limitfrom = ($offset - 1) * $page_limit;
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
		 * OssnDatabase Wheres Helper
		 * Creates a structured array for a single WHERE condition.
		 * @param string $name The column name or raw SQL expression (e.g., 'u.guid', 'CONCAT(...)').
		 * @param string $comparator The SQL comparator (e.g., '=', 'LIKE', 'IN', '!=').
		 * @param mixed  $value The value to bind (e.g., 101, 'active', or an array for 'IN').
		 * @param string|null $separator Optional. Overrides the default 'AND' to link this condition to the next (e.g., 'OR').
		 * @return array The structured condition array.
		 */
		public static function wheres(string $name, string $comparator, $value,  ? string $separator = null) : array {
				$condition = array(
						'name'       => $name,
						'comparator' => $comparator,
						'value'      => $value,
				);

				// If a separator is provided, add it to the array
				if($separator !== null) {
						$condition['separator'] = strtoupper($separator); // Ensure it's uppercase (AND/OR)
				}

				return $condition;
		}
		/**
		 * OssnDatabase Wheres Group Helper
		 * Creates a structured array representing a nested WHERE clause group,
		 * which is essential for controlling parentheses and OR logic.
		 * @param string $connector The SQL connector to use *between* items in the $group (e.g., 'AND', 'OR').
		 * @param array $group An array of conditions (created by OssnDatabase::Wheres or other groups).
		 * @param string|null $separator Optional. Overrides the default 'AND' to link this group to the next condition/group.
		 * @return array The structured group array.
		 */
		public static function wheresGroup(string $connector, array $group,  ? string $separator = null) : array {
				$group_array = array(
						'connector' => strtoupper($connector), // Make sure it's 'AND' or 'OR'
						'group'     => $group,
				);

				// If a separator is provided (to link this group to the next), add it
				if($separator !== null) {
						$group_array['separator'] = strtoupper($separator);
				}

				return $group_array;
		}
		/**
		 * Clear variables to avoid passing then in other objects
		 *
		 * @return void
		 */
		public function clearVars() {
				unset($this->exe);
				unset($this->database);
		}
		/**
		 * Unset the stuff that is not need once op is finished
		 *
		 * @return void
		 */
		public function __destruct() {
				$this->clearVars();
		}
} //class