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
class OssnObject extends OssnEntities {
		/**
		 * Initialize the objects.
		 *
		 * @return void
		 */
		public function __construct($guid = 0) {
				$this->data = new stdClass();
				//part for v5 added,  shouldn't used before v5 release in any component.
				if(!empty($guid)) {
						$object = ossn_get_object($guid);
						if($object) {
								foreach($object as $item => $val) {
										$this->{$item} = $val;
								}
						} else {
								//OSSN DB exceptions must start with 1<exception code>
								throw new Exception("Failed to load object using {$guid}", 1404);
						}
				}
				//part end for v5 added,  shouldn't used before v5 release in any component.
		}
		/**
		 * Initialize the attributes
		 *
		 * @return void
		 */
		public function initAttributes() {
				$this->time_created = time();
				if(empty($this->subtype)) {
						$this->subtype = null;
				}
				if(empty($this->order_by)) {
						$this->order_by = '';
				}
				if(!isset($this->description)) {
						$this->description = '';
				}
				if(!isset($this->title)) {
						$this->title = '';
				}
		}

		/** requires $object->(owner_guid, type, subtype, title, description)
		 *
		 * @return boolean
		 */
		public function addObject() {
				self::initAttributes();
				if(empty($this->owner_guid) || empty($this->type)) {
						return false;
				}
				$params['into']  = 'ossn_object';
				$params['names'] = array(
						'owner_guid',
						'type',
						'subtype',
						'time_created',
						'title',
						'description',
				);
				$params['values'] = array(
						$this->owner_guid,
						$this->type,
						$this->subtype,
						$this->time_created,
						$this->title,
						$this->description,
				);
				$create = ossn_call_hook(
						'object',
						'create',
						array(
								'params'   => $params,
								'instance' => $this,
						),
						true
				);
				if($create) {
						if($this->insert($params)) {
								$this->createdObject = $this->getLastEntry();
								if(isset($this->data) && is_object($this->data)) {
										foreach($this->data as $name => $value) {
												$this->owner_guid = $this->createdObject;
												$this->type       = 'object';
												$this->subtype    = $name;
												$this->value      = $value;
												$this->add();
										}
								}
								$args['guid']         = $this->createdObject;
								$args['owner_guid']   = $params['values'][0];
								$args['type']         = $params['values'][1];
								$args['subtype']      = $params['values'][2];
								$args['time_created'] = $params['values'][3];
								$args['title']        = $params['values'][4];
								$args['description']  = $params['values'][5];
								ossn_trigger_callback('object', 'created', $args);
								return $this->createdObject;
						}
				}
				return false;
		}

		/**
		 * Get object by object guid;
		 *
		 * Requires : $object->object_guid
		 *
		 * @return object;
		 */
		public function getObjectById(array $options = array()) {
				self::initAttributes();
				if(empty($this->object_guid)) {
						return false;
				}
				$params['from']   = 'ossn_object as o';
				$params['params'] = array(
						'o.guid',
						'o.time_created',
						'o.owner_guid',
						'o.description',
						'o.title',
						'o.type',
						'o.subtype',
				);
				//Allow to set searchObject result params #1436
				if(isset($options['params']) && is_array($options['params']) && !empty($options['params'])) {
						$params['params'] = $options['params'];
				}
				if(isset($options['unset_params']) && is_array($options['unset_params'])) {
						foreach($options['unset_params'] as $item) {
								if(($key = array_search($item, $params['params'])) !== false) {
										unset($params['params'][$key]);
								}
						}
				}
				$params['wheres'] = array(
						"o.guid='{$this->object_guid}'",
				);
				//there is no need to order as its will fetch only one record
				//$params['order_by'] = $this->order_by;
				unset($this->order_by);

				$object = $this->select($params);
				if($object) {
						$this->owner_guid = $object->guid;
						$this->subtype    = '';
						$this->type       = 'object';
						$entities         = $this->get_entities();

						if($entities) {
								$fileds = array();
								foreach($entities as $entity) {
										$fields[$entity->subtype] = $entity->value;
								}
								$object_array = get_object_vars($object);
								if(is_array($object_array)) {
										$data = array_merge($object_array, $fields);
								}
								if(!empty($fields)) {
										return arrayObject($data, get_class($this));
								}
						}
						return arrayObject($object, get_class($this));
				}
				return false;
		}

		/**
		 * Get newly created object
		 *
		 * @return void|integer
		 */
		public function getObjectId() {
				if(isset($this->createdObject)) {
						return $this->createdObject;
				}
		}

		/**
		 * Update Object;
		 *
		 * @param array $name Names
		 * @param array $value Values
		 * @param integer $guid Object guid
		 *
		 * @return boolean
		 */
		public function updateObject($name, $value, $guid) {
				self::initAttributes();
				if(empty($guid)) {
						return false;
				}
				$params['table']  = 'ossn_object';
				$params['names']  = $name;
				$params['values'] = $value;
				$params['wheres'] = array(
						"guid='{$guid}'",
				);

				if($this->update($params)) {
						if(isset($this->data)) {
								//[B] Unset properties on Group update #1994
								$owner_self   = false;
								$type_self    = false;
								$subtype_self = false;

								if(isset($this->owner_guid) && !empty($this->owner_guid)) {
										$owner_self = $this->owner_guid;
								}
								if(isset($this->type) && !empty($this->type)) {
										$type_self = $this->type;
								}
								if(isset($this->subtype) && !empty($this->subtype)) {
										$subtype_self = $this->subtype;
								}

								$this->owner_guid = $guid;
								$this->type       = 'object';
								unset($this->subtype);

								parent::save();

								if(!empty($owner_self)) {
										$this->owner_guid = $owner_self;
								}
								if(!empty($type_self)) {
										$this->type = $type_self;
								}
								if(!empty($subtype_self)) {
										$this->subtype = $subtype_self;
								}
						}
						return true;
				}
				return false;
		}

		/**
		 * Delete object;
		 *
		 * @param integer $object Object guid
		 *
		 * @return boolean
		 */
		public function deleteObject($object = '') {
				self::initAttributes();
				if(isset($this->guid)) {
						$object = $this->guid;
				}
				if(empty($object)) {
						return false;
				}
				$vars         = array();
				$vars['guid'] = $object;
				ossn_trigger_callback('object', 'before:delete', $vars);
				//delete entites of (this) object
				if($this->deleteByOwnerGuid($object, 'object')) {
						$data = ossn_get_userdata("object/{$object}/");
						if(is_dir($data)) {
								OssnFile::DeleteDir($data);
						}
				}
				$delete['from']   = 'ossn_object';
				$delete['wheres'] = array(
						"guid='{$object}'",
				);
				if($this->delete($delete)) {
						ossn_trigger_callback('object', 'deleted', $vars);
						return true;
				}
				return false;
		}
		/**
		 * Search object by its title, description etc
		 *
		 * @param array $params A valid options in format:
		 * 	  'search_type' => true(default) to performs matching on a per-character basis
		 *			   false for performs matching on exact value.
		 * 	  'subtype' => Valid object subtype
		 *	  'type' => Valid object type
		 *	  'title' => Valid object title
		 *        'description'	=> Valid object description
		 *        'owner_guid'  	=> A valid owner guid, which results integer value
		 *        'entities_pairs'  => A entities pairs options, must be array
		 *        'count' => True if you wanted to count search items.
		 *        'limit' => Result limit default, Default is 10 values
		 *	  'order_by'=> To show result in sepcific order. Default is Assending
		 *
		 * reutrn array|false;
		 *
		 */
		public function searchObject(array $params = array()) {
				self::initAttributes();
				if(empty($params)) {
						return false;
				}
				//prepare default attributes
				$default = array(
						'params'         => false,
						'search_type'    => true,
						'distinct'       => false,
						'subtype'        => false,
						'type'           => false,
						'owner_guid'     => false,
						'limit'          => false,
						'order_by'       => false,
						'offset'         => input('offset', '', 1),
						'page_limit'     => ossn_call_hook('pagination', 'page_limit', false, 10), //call hook for page limit
						'count'          => false,
						'entities_pairs' => false,
				);

				$options      = array_merge($default, $params);
				$wheres       = array();
				$params       = array();
				$wheres_paris = array();
				//validate offset values
				if($options['limit'] !== false && $options['limit'] != 0 && $options['page_limit'] != 0) {
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

				if(!empty($options['object_guid'])) {
						if(!is_array($options['object_guid'])) {
								$wheres[] = "o.guid='{$options['object_guid']}'";
						} elseif(is_array($options['object_guid']) && !empty($options['object_guid'])) {
								$object_guid_in = implode("','", $options['object_guid']);
								$wheres[]       = "o.guid IN ('{$object_guid_in}')";
						}
				}
				if(!empty($options['subtype'])) {
						if(!is_array($options['subtype'])) {
								$wheres[] = "o.subtype='{$options['subtype']}'";
						} elseif(is_array($options['subtype']) && !empty($options['subtype'])) {
								$subtypes_in = implode("','", $options['subtype']);
								$wheres[]    = "o.subtype IN ('{$subtypes_in}')";
						}
				}
				if(!empty($options['type'])) {
						if(!is_array($options['type'])) {
								$wheres[] = "o.type='{$options['type']}'";
						} elseif(is_array($options['type']) && !empty($options['type'])) {
								$types_in = implode("','", $options['type']);
								$wheres[] = "o.type IN ('{$types_in}')";
						}
				}
				if(!empty($options['owner_guid'])) {
						if(!is_array($options['owner_guid'])) {
								$wheres[] = "o.owner_guid ='{$options['owner_guid']}'";
						} elseif(is_array($options['owner_guid']) && !empty($options['owner_guid'])) {
								$owners_guids_in = implode("','", $options['owner_guid']);
								$wheres[]        = "o.owner_guid IN ('{$owners_guids_in}')";
						}
				}
				//check if developer want to search title or description
				if($options['search_type'] === true) {
						if(!empty($options['title'])) {
								$wheres[] = "o.title LIKE '%{$options['title']}%'";
						}
						if(!empty($options['description'])) {
								$wheres[] = "o.description LIKE '%{$options['description']}%'";
						}
				} elseif($options['search_type'] === false) {
						if(!empty($options['title'])) {
								$wheres[] = "o.title = '{$options['title']}'";
						}
						if(!empty($options['description'])) {
								$wheres[] = "o.description = '{$options['description']}'";
						}
				}
				if(isset($options['entities_pairs']) && is_array($options['entities_pairs'])) {
						foreach($options['entities_pairs'] as $key => $pair) {
								$operand = empty($pair['operand']) ? '=' : $pair['operand'];
								if(!empty($pair['name']) && isset($pair['value']) && !empty($operand)) {
										if(!empty($pair['value'])) {
												$pair['value'] = addslashes($pair['value']);
										}
										$wheres_paris[] = "e{$key}.type='object'";
										$wheres_paris[] = "e{$key}.subtype='{$pair['name']}'";
										if(isset($pair['wheres']) && !empty($pair['wheres'])) {
												$pair['wheres'] = str_replace('[this].', "emd{$key}.", $pair['wheres']);
												$wheres_paris[] = $pair['wheres'];
										} else {
												$wheres_paris[] = "emd{$key}.value {$operand} '{$pair['value']}'";
										}
										$params['joins'][] = "JOIN ossn_entities as e{$key} ON e{$key}.owner_guid=o.guid";
										$params['joins'][] = "JOIN ossn_entities_metadata as emd{$key} ON e{$key}.guid=emd{$key}.guid";
								}
						}
						if(!empty($wheres_paris)) {
								$wheres_entities = '(' . $this->constructWheres($wheres_paris) . ')';
								$wheres[]        = $wheres_entities;
						}
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
				if(isset($options['joins']) && !empty($options['joins']) && is_array($options['joins'])) {
						foreach($options['joins'] as $jitem) {
								$params['joins'][] = $jitem;
						}
				}
				$distinct = '';
				if($options['distinct'] === true) {
						$distinct = 'DISTINCT ';
				}
				//prepare search
				$params['from']   = 'ossn_object as o';
				$params['params'] = array(
						"{$distinct} o.guid, o.time_created",
				);
				$params['wheres'] = array(
						$this->constructWheres($wheres),
				);
				$params['order_by'] = $options['order_by'];
				$params['limit']    = $options['limit'];

				if(!$options['order_by']) {
						$params['order_by'] = 'o.guid ASC';
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
								"count({$distinct}o.guid) as total",
						);
						$count = array_merge($params, $count);
						return $this->select($count)->total;
				}
				//load fetch query after count condition #1316
				$this->get = $this->select($params, true);
				if($this->get) {
						foreach($this->get as $object) {
								$this->object_guid = $object->guid;
								$objects[]         = $this->getObjectById($options);
						}
						return $objects;
				}
				return false;
		}
		/**
		 * A object save function
		 *
		 * Note updateObject does same job but its requires extra parements
		 * updateObject may be removed in v5
		 *
		 * @return boolean
		 */
		public function save() {
				if(!isset($this->guid)) {
						return $this->addObject();
				}
				if(isset($this->guid) && !empty($this->guid)) {
						$names = array(
								'title',
								'description',
								'type',
								'subtype',
								'owner_guid',
						);
						$values = array(
								$this->title,
								$this->description,
								$this->type,
								$this->subtype,
								$this->owner_guid,
						);
						if($this->updateObject($names, $values, $this->guid)) {
								return true;
						}
				}
				return false;
		}
}
