<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
class OssnEntities extends OssnDatabase {
		/**
		 * Initialize the objects.
		 *
		 * @return void
		 */
		private function initAttributes() {
				$this->data         = new stdClass;
				$this->time_created = time();
				//OssnDatabaseException' with message 'Incorrect integer value #904
				$this->time_updated = 0;
				$this->active       = 1;
				
				if(empty($this->permission)) {
						$this->permission = OSSN_PUBLIC;
				}
				
				$this->types = ossn_call_hook('entities', 'types', false, array(
						'object' => 'OssnObject',
						'user' => 'OssnUser',
						'annotation' => 'OssnAnnotation',
						'entity' => 'OssnEntities',
						'site' => 'OssnSite',
						'component' => 'OssnComponents'
				));
				//generate entity types from $this->types
				foreach($this->types as $type => $class) {
						$this->entity_types[] = $type;
				}
				
				if(empty($this->order_by)) {
						$this->order_by = '';
				}
				if(empty($this->limit)) {
						$this->limit = false;
				}
				if(empty($this->type)) {
						$this->type = 'entity';
				}
				$this->data = new stdClass;
				
				if(!isset($this->offset)) {
						$this->offset = 1;
				}
				if(!isset($this->page_limit)) {
						//default OssnPagination limit
						$this->page_limit = ossn_call_hook('pagination', 'per_page', false, 10);
				}
				if(!isset($this->count)) {
						$this->count = false;
				}
		}
		
		/**
		 * Add new entity.
		 *
		 * Requires object  $this->type => entity type; (this usually is user, object, annotation, site)
		 *           		$this->subtype => entity subtype;
		 *           		$this->entity_permission => OSSN_ACCESS
		 *           		$this->active = is entity is active or not
		 *          	 	$this->value = data you want to insert
		 *           		$this->owner_guid = entity owner guid
		 *
		 * @return boolean
		 */
		public function add() {
				self::initAttributes();
				if(!empty($this->owner_guid) && in_array($this->type, $this->entity_types)) {
						$this->params['into']   = 'ossn_entities';
						$this->params['names']  = array(
								'owner_guid',
								'type',
								'subtype',
								'time_created',
								'time_updated',
								'permission',
								'active'
						);
						$this->params['values'] = array(
								$this->owner_guid,
								$this->type,
								$this->subtype,
								$this->time_created,
								$this->time_updated,
								$this->permission,
								$this->active
						);
						if($this->insert($this->params)) {
								//[B] Entities added via single DB connection may result in wrong last_id #1668
								//As this supposed to be return a actual entity ID rather metadata guid
								//so calling getLastEntry() after adding entity only make sense.
								//if we call after metadata entry , it results metadata id not entity.
								$this->inserted_entity_guid	= $this->getLastEntry();
								
								$this->params['into']   = 'ossn_entities_metadata';
								$this->params['names']  = array(
										'guid',
										'value'
								);
								$this->params['values'] = array(
										$this->getLastEntry(),
										$this->value
								);
								$this->insert($this->params);
								
								$args['guid']	      = $this->inserted_entity_guid;
								$args['owner_guid']   = $this->params['values'][0];
								$args['type']         = $this->params['values'][1];
								$args['subtype']      = $this->params['values'][2];
								$args['time_created'] = $this->params['values'][3];
								ossn_trigger_callback('entity', 'created', $args);
								return $this->inserted_entity_guid;
						}
				}
				return false;
		}
		/**
		 * Get Entity.
		 *
		 * Requires object $this->entity_guid Entity guid in database;
		 *
		 * @return object|false
		 */
		public function get_entity() {
				self::initAttributes();
				if(empty($this->entity_guid)) {
						return false;
				}
				$params           = array();
				$params['from']   = 'ossn_entities as e';
				$params['params'] = array(
						'e.guid',
						'e.time_created',
						'e.time_updated',
						'e.permission',
						'e.active',
						'e.owner_guid',
						'emd.value',
						'e.type',
						'e.subtype'
				);
				$params['joins']  = "JOIN ossn_entities_metadata as emd ON e.guid=emd.guid";
				$params['wheres'] = array(
						"e.guid ='{$this->entity_guid}'"
				);
				
				$data = $this->select($params);
				self::destruct();
				if($data) {
						$entity = arrayObject($data, get_class($this));
						return $entity;
				}
		}
		
		/**
		 * Update Entity in database.
		 *
		 * Requires $object->data
		 *
		 * @return boolean
		 */
		public function save() {
				if(!empty($this->owner_guid)) {
						$this->datavars   = $this->get_data_vars();
						$this->page_limit = false;
						$entities         = $this->get_entities();
						if($entities) {
								foreach($entities as $entity) {
										if(isset($this->datavars[$entity->subtype])) {
												$params['table']  = 'ossn_entities_metadata';
												$params['names']  = array(
														'value'
												);
												$params['values'] = array(
														$this->datavars[$entity->subtype]
												);
												$params['wheres'] = array(
														"guid='{$entity->guid}'"
												);
												if($this->update($params)) {
														$params['table']  = 'ossn_entities';
														$params['names']  = array(
																'time_updated'
														);
														$params['values'] = array(
																time()
														);
														$params['wheres'] = array(
																"guid='{$entity->guid}'"
														);
														$this->update($params);
												}
										}
								}
						}
						// i don't think we need to add new data on save $arsalanshah; v1.x to 2.x
						// added again in v3.0 $arsalanshah
						//code re arrange 1st July 2015 $arsalanshah
						if(!empty($this->datavars)) {
								$data_dbvars = $this->get_data_dbvars();
								foreach($this->datavars as $vars => $value) {
										if(!in_array($vars, $data_dbvars)) {
												$this->subtype = $vars;
												$this->value   = $value;
												$this->add();
										}
								}
						}
						self::destruct();
						return true;
				}
				return false;
		}
		
		/**
		 * Get data object.
		 *
		 * Requires $object->data
		 *
		 * @return false|arrray;
		 */
		private function get_data_vars() {
				if(!$this->data) {
						return false;
				}
				foreach($this->data as $name => $value) {
						$vars[$name] = $value;
				}
				return $vars;
		}
		
		/**
		 * Get entities.
		 *
		 * Requires object 	$this->type => entity type;
		 *           		$this->subtype => entity subtype;
		 *           		$this->owner_guid => guid of entity owner
		 *           		$this->order_by =  to sort the data in a recordset
		 *
		 * @return object
		 */
		public function get_entities() {
				self::initAttributes();
				$options = array(
						'subtype' => $this->subtype,
						'type' => $this->type,
						'owner_guid' => $this->owner_guid,
						'offset' => $this->offset,
						'order_by' => $this->order_by,
						'page_limit' => false,
						'count' => $this->count,
						'limit' => $this->limit
				);
				return $this->searchEntities($options);
		}
		
		/**
		 * Get newly added entity guid.
		 *
		 * @return integer
		 */
		public function AddedEntityGuid() {
				return $this->inserted_entity_guid;
		}
		
		/**
		 * Update entity metadata only.
		 *
		 * @return bool;
		 */
		public function updateEntity() {
				if(!empty($this->guid)) {
						
						$params['table']  = 'ossn_entities_metadata';
						$params['names']  = array(
								'value'
						);
						$params['values'] = array(
								$this->value
						);
						$params['wheres'] = array(
								"guid='{$this->guid}'"
						);
						
						if($this->update($params)) {
								
								$params['table']  = 'ossn_entities';
								$params['names']  = array(
										'time_updated'
								);
								$params['values'] = array(
										time()
								);
								$params['wheres'] = array(
										"guid='{$this->guid}'"
								);
								
								$this->update($params);
								return true;
						}
				}
				return false;
		}
		
		/**
		 * Delete all entities related to owner guid.
		 *
		 * @param integer $guid Entity guid in database
		 * @param  string $type Entity type
		 *
		 * @todo why not there is subtype?
		 * @return boolean
		 */
		public function deleteByOwnerGuid($guid, $type) {
				
				$params['from']   = 'ossn_entities';
				$params['wheres'] = array(
						"owner_guid='{$guid}' AND type='{$type}'"
				);
				
				$ids = $this->select($params, true);
				if(!$ids) {
						return false;
				}
				foreach($ids as $entity) {
						$this->deleteEntity($entity->guid);
				}
				return true;
		}
		
		/**
		 * Delete entity.
		 *
		 * @param integer $guid Entity guid in database
		 *
		 * @return boolean
		 */
		public function deleteEntity($guid = '') {
				if(isset($this->guid) && !empty($this->guid) && empty($guid)) {
						$guid = $this->guid;
				}
				if(empty($guid)) {
						return false;
				}
				$params['from']   = 'ossn_entities';
				$params['wheres'] = array(
						"guid = '{$guid}'"
				);
				
				$vars	= array();
				$vars['entity'] = $guid;
				ossn_trigger_callback('entity', 'before:delete', $vars);
				
				if($this->delete($params)) {
						$metadata['from']   = 'ossn_entities_metadata';
						$metadata['wheres'] = array(
								"guid = '{$guid}'"
						);
						$this->delete($metadata);
						
						$vars['entity'] = $guid;
						ossn_trigger_callback('delete', 'entity', $vars);
						return true;
				}
				return false;
		}
		/**
		 * Get subtypes from entites.
		 *
		 * Requires $object->data
		 *
		 * @return array
		 */
		private function get_data_dbvars() {
				$entities = $this->get_entities();
				if($entities) {
						foreach($entities as $entity) {
								$vars[] = $entity->subtype;
						}
						return $vars;
				}
				return false;
		}
		/**
		 * Search entities
		 *
		 * @param array $params A valid options in format:
		 * 	 'search_type' => true(default) to performs matching on a per-character basis 
		 * 					  false for performs matching on exact value.
		 * 	  'subtype' 	=> Valid entity subtype
		 *	  'type' 		=> Valid entity type
		 *	  'value'		=> Value which you want to search
		 *    'owner_guid'  => A valid owner guid, which results integer value
		 *    'limit'		=> Result limit default, Default is 20 values
		 *	  'order_by'    => To show result in sepcific order. There is no default order.
		 * 
		 * reutrn array|false;
		 *
		 */
		public function searchEntities(array $params = array()) {
				self::initAttributes();
				//set default values
				$default = array(
						'search_type' => true,
						'subtype' => false,
						'type' => false,
						'value' => false,
						'owner_guid' => false,
						'limit' => false,
						'order_by' => false,
						'offset' => 1,
						'page_limit' => ossn_call_hook('pagination', 'per_page', false, 10), //call hook for page limit
						'count' => false
				);
				$options = array_merge($default, $params);
				$wheres  = array();
				//prepare limit
				$limit   = $options['limit'];
				
				//validate offset values
				if(!empty($options['limit']) && !empty($options['limit']) && !empty($options['page_limit'])) {
						$offset_vals = ceil($options['limit'] / $options['page_limit']);
						$offset_vals = abs($offset_vals);
						$offset_vals = range(1, $offset_vals);
						if(!in_array($options['offset'], $offset_vals)) {
								return false;
						}
				}
				//get only required result, don't bust your server memory
				$getlimit = $this->generateLimit($options['limit'], $options['page_limit'], $options['offset']);
				if($getlimit) {
						$options['limit'] = $getlimit;
				}
				
				//search entities
				if(!empty($options['subtype'])) {
						$wheres[] = "e.subtype='{$options['subtype']}'";
				}
				if(!empty($options['type'])) {
						$wheres[] = "e.type='{$options['type']}'";
				}
				if(!empty($options['owner_guid'])) {
						$wheres[] = "e.owner_guid ='{$options['owner_guid']}'";
				}
				if(!empty($options['value']) && $options['search_type'] === true) {
						$wheres[] = "emd.value LIKE '%{$options['value']}%'";
				} elseif(!empty($options['value']) && $options['search_type'] === false) {
						$wheres[] = "emd.value = '{$options['value']}'";
				}
				if(isset($options['wheres']) && !empty($options['wheres'])) {
						if(!is_array($options['wheres'])) {
								$wheres[] = $options['wheres'];
						} else {
								foreach($options['wheres'] as $witem) {
										$wheres[] = $witem;
								}
						}
				}
				$params             = array();
				$params['from']     = 'ossn_entities as e';
				$params['params']   = array(
						'e.guid',
						'e.time_created',
						'e.time_updated',
						'e.permission',
						'e.active',
						'e.owner_guid',
						'emd.value',
						'e.type',
						'e.subtype'
				);
				$params['joins']    = "JOIN ossn_entities_metadata as emd ON e.guid=emd.guid";
				$params['wheres']   = array(
						$this->constructWheres($wheres)
				);
				$params['order_by'] = $options['order_by'];
				$params['limit']    = $options['limit'];
				
				if(!$options['order_by']) {
						$params['order_by'] = "e.guid ASC";
				}
				if(isset($options['group_by']) && !empty($options['group_by'])) {
						$params['group_by'] = $options['group_by'];
				}
				//override params
				if(isset($options['params']) && !empty($options['params'])) {
						$params['params'] = $options['params'];
				}
				//prepare count data;
				if($options['count'] === true) {
						unset($params['params']);
						unset($params['limit']);
						$count           = array();
						$count['params'] = array(
								"count(*) as total"
						);
						$count           = array_merge($params, $count);
						return $this->select($count)->total;
				}
				//load data after count condition #1316
				$fetched_entities = $this->select($params, true);
				if($fetched_entities) {
						foreach($fetched_entities as $entity) {
								//prepare entities for display
								$entities[] = arrayObject($entity, $this->types[$this->type]);
						}
						self::destruct();
						return $entities;
				}
				return false;
		}
		/**
		 * Can change
		 * Check if user can change the requested item or not
		 *
		 * @param object $user User
		 * @return boolean
		 */
		public function canChange($user = '') {
				if(empty($user)) {
						$user = ossn_loggedin_user();
				}
				$allowed = false;
				if(isset($user->guid) && $user instanceof OssnUser) {
						if((isset($this->owner_guid) && $this->type == 'user' && $this->owner_guid == $user->guid) || ossn_isAdminLoggedin()) {
								$allowed = true;
						}
				}
				return ossn_call_hook('user', 'can:change', $this, $allowed);
		}
		/**
		 * Manual self destruct
		 *
		 * @return void
		 */
		public function destruct() {
				unset($this->types);
				unset($this->entity_types);
				unset($this->page_limit);
				unset($this->count);
				unset($this->offset);
				unset($this->permission);
				unset($this->last_id);
				unset($this->order_by);
				unset($this->active);
				unset($this->limit);
		}
} //class
