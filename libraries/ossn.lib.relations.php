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

/**
 * Ossn Add Relations
 *
 * @param integer $from Relation from guid
 * @param integer $to Relation to guid
 * @param string  $type Relation type
 *
 * @return boolean
 */
function ossn_add_relation($from, $to, $type) {
		if(!empty($from) && !empty($to) && !empty($type) && $type !== 0) {
				$add             = new OssnDatabase();
				$params['into']  = 'ossn_relationships';
				$params['names'] = array(
						'relation_from',
						'relation_to',
						'type',
						'time',
				);
				$params['values'] = array(
						$from,
						$to,
						$type,
						time(),
				);
				if($add->insert($params)) {
						ossn_trigger_callback('relation', 'add', array(
								'from' => $from,
								'to'   => $to,
								'type' => $type,
						));
						return true;
				}
		}
		return false;
}
/**
 * Ossn relation exists
 *
 * @param integer $from Relation from guid
 * @param integer $to Relation to guid
 * @param string  $type Relation type
 *
 * @return boolean
 */
function ossn_relation_exists($from, $to, $type, $recursive = false) {
		if(!empty($from) && !empty($to) && !empty($type)) {
				$database           = new OssnDatabase();
				$params['from']     = 'ossn_relationships as r';
				$params['wheres']   = array();
				$params['wheres'][] = "r.relation_from='{$from}' AND r.relation_to='{$to}' AND r.type='{$type}'";
				if($recursive) {
						$params['joins'] = array(
								'JOIN ossn_relationships as r2',
						);
						$params['wheres'][] = "r2.relation_from='{$to}' AND r2.relation_to='{$from}' AND r2.type='{$type}'";
				}
				if($database->select($params)) {
						return true;
				}
		}
		return false;
}
/**
 * Ossn get relationships
 *
 * @param array $params A options
 * @Note inverse should only work perfectly one setting only one (to/from) parameter
 *
 * @return objects
 */
function ossn_get_relationships(array $params = array()) {
		$wheres   = array();
		$vars     = array();
		$database = new OssnDatabase();
		if(isset($params['from']) && !empty($params['from'])) {
				if(isset($params['inverse'])) {
						$vars['joins'] = array(
								'JOIN ossn_relationships as r1 ON r1.relation_from=r.relation_to',
						);
						$wheres[] = array(
								'name'       => 'r1.relation_to',
								'comparator' => '=',
								'value'      => $params['from'],
						);
				}
				$wheres[] = array(
						'name'       => 'r.relation_from',
						'comparator' => '=',
						'value'      => $params['from'],
				);
				if(is_array($params['type'])) {
						$wheres[] = array(
								'name'       => 'r.type',
								'comparator' => 'IN',
								'value'      => $params['type'],
						);
						if(isset($params['inverse'])) {
								$wheres[] = array(
										'name'       => 'r1.type',
										'comparator' => 'IN',
										'value'      => $params['type'],
								);
						}
				} else {
						$wheres[] = array(
								'name'       => 'r.type',
								'comparator' => '=',
								'value'      => $params['type'],
						);
						if(isset($params['inverse'])) {
								$wheres[] = array(
										'name'       => 'r1.type',
										'comparator' => 'IN',
										'value'      => $params['type'],
								);
						}
				}
		}
		if(isset($params['to']) && !empty($params['to'])) {
				if(isset($params['inverse'])) {
						$vars['joins'] = array(
								'JOIN ossn_relationships as r1 ON r1.relation_to=r.relation_from',
						);
						$wheres[] = array(
								'name'       => 'r1.relation_from',
								'comparator' => '=',
								'value'      => $params['to'],
						);
				}
				$wheres[] = array(
						'name'       => 'r.relation_to',
						'comparator' => '=',
						'value'      => $params['to'],
				);

				if(is_array($params['type'])) {
						$wheres[] = array(
								'name'       => 'r.type',
								'comparator' => 'IN',
								'value'      => $params['type'],
						);
						if(isset($params['inverse'])) {
								$wheres[] = array(
										'name'       => 'r1.type',
										'comparator' => 'IN',
										'value'      => $params['type'],
								);
						}
				} else {
						$wheres[] = array(
								'name'       => 'r.type',
								'comparator' => '=',
								'value'      => $params['type'],
						);
						if(isset($params['inverse'])) {
								$wheres[] = array(
										'name'       => 'r1.type',
										'comparator' => '=',
										'value'      => $params['type'],
								);
						}
				}
		}
		if(empty($params['type'])) {
				return false;
		}
		if(isset($params['wheres']) && !empty($params['wheres'])) {
				if(!is_array($params['wheres'])) {
						$wheres[] = $params['wheres'];
				} else {
						foreach ($params['wheres'] as $witem) {
								$wheres[] = $witem;
						}
				}
		}
		$default = array(
				'page_limit' => 10,
				'limit'      => false,
				'order_by'   => false,
				'offset'     => input('offset', '', 1),
		);
		$options = array_merge($default, $params);
		//validate offset values
		if(!empty($options['limit']) && !empty($options['page_limit'])) {
				$offset_vals = ceil($options['limit'] / $options['page_limit']);
				$offset_vals = abs($offset_vals);
				$offset_vals = range(1, $offset_vals);
				if(!in_array($options['offset'], $offset_vals)) {
						return false;
				}
		}
		//get only required result, don't bust your server memory
		$getlimit = $database->generateLimit($options['limit'], $options['page_limit'], $options['offset']);
		if($getlimit) {
				$vars['limit'] = $getlimit;
		} else {
				$vars['limit'] = $options['limit'];
		}
		$vars['from']   = 'ossn_relationships as r';
		$vars['wheres'] = array(
				$database->constructWheres($wheres),
		);
		if(isset($params['count']) && $params['count'] === true) {
				unset($vars['params']);
				unset($vars['limit']);
				$count['params'] = array(
						'count(*) as total',
				);
				$count = array_merge($vars, $count);
				return $database->select($count)->total;
		}
		$vars['order_by'] = $options['order_by'];
		$data             = $database->select($vars, true);
		if($data) {
				return $data;
		}
		return false;
}
/**
 * Ossn Delete Relation
 *
 * @param integer $id ID of the relationship
 *
 * @return boolean
 */
function ossn_delete_relationship_by_id($id) {
		if(!empty($id)) {
				$delete           = new OssnDatabase();
				$params['from']   = 'ossn_relationships';
				$params['wheres'] = array(
						array(
								'name'       => 'relation_id',
								'comparator' => '=',
								'value'      => $id,
						),
				);
				if($delete->delete($params)) {
						return true;
				}
		}
		return false;
}
/**
 * Update relation by id
 * [E] add option to update relation #1692
 *
 * @param integer $id   ID for relationship
 * @param array   $vars Option values (relation_from, relation_to, type, time) optional
 *
 * @return boolean
 */
function ossn_update_relationship_by_id($id, $vars = array()) {
		if(!empty($id) && !empty($vars)) {
				$update           = new OssnDatabase();
				$params['table']  = 'ossn_relationships';
				$params['wheres'] = array(
						array(
								'name'       => 'relation_id',
								'comparator' => '=',
								'value'      => $id,
						),
				);
				if(isset($vars['relation_from']) && !empty($vars['relation_from'])) {
						$params['names'][]  = 'relation_from';
						$params['values'][] = $vars['relation_from'];
				}
				if(isset($vars['relation_to']) && !empty($vars['relation_to'])) {
						$params['names'][]  = 'relation_to';
						$params['values'][] = $vars['relation_to'];
				}
				if(isset($vars['type']) && !empty($vars['type'])) {
						$params['names'][]  = 'type';
						$params['values'][] = $vars['type'];
				}
				if(isset($vars['time']) && !empty($vars['time'])) {
						$params['names'][]  = 'time';
						$params['values'][] = $vars['time'];
				}
				if($update->update($params)) {
						return true;
				}
		}
		return false;
}
/**
 * Ossn Delete Relation
 *
 * @param integer $id ID of the relationship
 *
 * @return boolean
 */
function ossn_delete_relationship(array $vars = array()) {
		if(empty($vars['from']) || empty($vars['to']) || empty($vars['type'])) {
				return false;
		}
		$wheres = array();
		$delete = new OssnDatabase();

		//[B] ossn_delete_relationship recursive not working #2035
		$from = $vars['from'];
		$to   = $vars['to'];
		$type = $vars['type'];

		// Check if recursive logic is needed
		$is_recursive = isset($vars['recursive']) && $vars['recursive'] === true;

		// Build the array for the primary direction (A -> B)
		$group_direction_1 = array(
				'connector' => 'AND', // Internal Glue: relation_from AND relation_to AND type
				'group'     => array(
						array(
								'name'       => 'relation_from',
								'comparator' => '=',
								'value'      => $from,
						),
						array(
								'name'       => 'relation_to',
								'comparator' => '=',
								'value'      => $to,
						),
						array(
								'name'       => 'type',
								'comparator' => '=',
								'value'      => $type,
						),
				),
		);

		// If recursive is false, we only need the first direction.
		if(!$is_recursive) {
				$wheres = array(
						$group_direction_1,
				);
		} else {
				// If recursive is true, we build the complex OR group.

				// Build the array for the second direction (B -> A)
				$group_direction_2 = array(
						'connector' => 'AND', // Internal Glue: relation_from AND relation_to AND type
						'group'     => array(
								// Values are swapped for the reverse check
								array(
										'name'       => 'relation_from',
										'comparator' => '=',
										'value'      => $to,
								),
								array(
										'name'       => 'relation_to',
										'comparator' => '=',
										'value'      => $from,
								),
								array(
										'name'       => 'type',
										'comparator' => '=',
										'value'      => $type,
								),
						),
				);

				// Assemble the final array:
				// Outer Group uses OR to join the two inner AND groups.
				$wheres = array(
						array(
								'connector' => 'OR', // <-- This explicitly joins Group 1 OR Group 2
								'group'     => array(
										$group_direction_1,
										$group_direction_2,
								),
						),
				);
		}
		$params['from']   = 'ossn_relationships';
		$params['wheres'] = $wheres;
		if($delete->delete($params)) {
				return true;
		}
		return false;
}
/**
 * Delete user relations if user is deleted
 *
 * @param  OssnUser $user Entity of user
 *
 * @return bool
 */
function ossn_delete_user_relations($user) {
		if($user) {
				$user_guid = $user->guid;
				//WHERE ((relation_from=? AND type=?) OR (relation_to=? AND type=?) OR (relation_from=? AND type=?) OR (relation_to=? AND type=?))
				$wheres = array(
						// OUTER GROUP: Uses 'OR' to join the four inner groups
						array(
								'connector' => 'OR',
								'group'     => array(
										// 1. (relation_from = ? AND type = 'friend:request')
										array(
												'connector' => 'AND',
												'group'     => array(
														array(
																'name'       => 'relation_from',
																'comparator' => '=',
																'value'      => $user_guid,
														),
														array(
																'name'       => 'type',
																'comparator' => '=',
																'value'      => 'friend:request',
														),
												),
										),

										// 2. (relation_to = ? AND type = 'friend:request')
										array(
												'connector' => 'AND',
												'group'     => array(
														array(
																'name'       => 'relation_to',
																'comparator' => '=',
																'value'      => $user_guid,
														),
														array(
																'name'       => 'type',
																'comparator' => '=',
																'value'      => 'friend:request',
														),
												),
										),

										// 3. (relation_from = ? AND type = 'group:join')
										array(
												'connector' => 'AND',
												'group'     => array(
														array(
																'name'       => 'relation_from',
																'comparator' => '=',
																'value'      => $user_guid,
														),
														array(
																'name'       => 'type',
																'comparator' => '=',
																'value'      => 'group:join',
														),
												),
										),

										// 4. (relation_to = ? AND type = 'group:join:approve')
										array(
												'connector' => 'AND',
												'group'     => array(
														array(
																'name'       => 'relation_to',
																'comparator' => '=',
																'value'      => $user_guid,
														),
														array(
																'name'       => 'type',
																'comparator' => '=',
																'value'      => 'group:join:approve',
														),
												),
										),
								),
						),
				);

				$delete         = new OssnDatabase();
				$params['from'] = 'ossn_relationships';
				//delete friend requests and group member requests if user deleted
				$params['wheres'] = $wheres;
				if($delete->delete($params)) {
						return true;
				}
		}
		return false;
}
/**
 * Relationship by ID
 *
 * @param integer $id ID of the relationship
 * [E] add a new function ossn_get_relation_by_id() #2034
 *
 * @return boolean|object
 */
function ossn_get_relationship_by_id($id) {
		if(!empty($id)) {
				$select           = new OssnDatabase();
				$params['from']   = 'ossn_relationships';
				$params['wheres'] = array(
						array(
								'name'       => 'relation_id',
								'comparator' => '=',
								'value'      => $id,
						),
				);
				return $select->select($params);
		}
		return false;
}