<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
class OssnObject extends OssnEntities {
		
		/**
		 * Initialize the objects.
		 *
		 * @return void
		 */
		public function initAttributes() {
				$this->time_created = time();
				if(empty($this->subtype)) {
						$this->subtype = NULL;
				}
				if(empty($this->order_by)) {
						$this->order_by = '';
				}
		}
		
		/**
		 * Create objects
		 *
		 * requires $object->(owner_guid, type, subtype, title, description)
		 *
		 * @return boolean
		 */
		public function addObject() {
				self::initAttributes();
				if(empty($this->owner_guid) || empty($this->type)) {
						return false;
				}
				$params['into']   = 'ossn_object';
				$params['names']  = array(
						'owner_guid',
						'type',
						'subtype',
						'time_created',
						'title',
						'description'
				);
				$params['values'] = array(
						$this->owner_guid,
						$this->type,
						$this->subtype,
						$this->time_created,
						$this->title,
						$this->description
				);
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
						return true;
				}
				return false;
		}
		/**
		 * Get object by owner guid;
		 *
		 * Requires    $object->owner_guid
		 *             $object->order_by To sort the data in a recordset
		 *
		 * @return object
		 */
		public function getObjectByOwner() {
				if(empty($this->type)) {
						return false;
				}
				$params               = array();
				$params['type']       = $this->type;
				$params['subtype']    = $this->subtype;
				$params['owner_guid'] = $this->owner_guid;
				$params['limit']      = $this->limit;
				$params['order_by']   = $this->order_by;
				$params['count']      = $this->count;
				$params['page_limit'] = $this->page_limit;
				$params['offset']     = $this->offset;
				$objects              = $this->searchObject($params);
				if($objects) {
						return $objects;
				}
				return false;
		}
		
		/**
		 * Get object by types;
		 *
		 * Requires : $object->(type , subtype(optional))
		 *            $object->order_by To sort the data in a recordset
		 *
		 * @return object
		 */
		public function getObjectsByTypes() {
				$params               = array();
				$params['type']       = $this->type;
				$params['subtype']    = $this->subtype;
				$params['owner_guid'] = $this->owner_guid;
				$params['limit']      = $this->limit;
				$params['order_by']   = $this->order_by;
				$params['count']      = $this->count;
				$params['page_limit'] = $this->page_limit;
				$params['offset']     = $this->offset;
				$objects              = $this->searchObject($params);
				if($objects) {
						return $objects;
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
		public function getObjectById() {
				self::initAttributes();
				if(empty($this->object_guid)) {
						return false;
				}
				$params['from']   = 'ossn_object as o';
				$params['wheres'] = array(
						"o.guid='{$this->object_guid}'"
				);
				//there is no need to order as its will fetch only one record
				//$params['order_by'] = $this->order_by;
				unset($this->order_by);
				
				$object = $this->select($params);
				
				$this->owner_guid = $object->guid;
				$this->subtype    = '';
				$this->type       = 'object';
				$this->entities   = $this->get_entities();
				
				if($this->entities && $object) {
						foreach($this->entities as $entity) {
								$fields[$entity->subtype] = $entity->value;
						}
						$object_array = get_object_vars($object);
						if(is_array($object_array)){
							$data = array_merge($object_array, $fields);
						}
						if(!empty($fields)) {
								return arrayObject($data, get_class($this));
						}
				}
				if(empty($fields)) {
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
				$params['table']  = 'ossn_object';
				$params['names']  = $name;
				$params['values'] = $value;
				$params['wheres'] = array(
						"guid='{$guid}'"
				);
				if($this->update($params)) {
						if(isset($this->data)) {
								$this->owner_guid = $guid;
								$this->type       = 'object';
								$this->save();
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
		public function deleteObject($object) {
				self::initAttributes();
				if(isset($this->guid)) {
						$object = $this->guid;
				}
				//delete entites of (this) object
				if($this->deleteByOwnerGuid($object, 'object')) {
						$data = ossn_get_userdata("object/{$object}/");
						if(is_dir($data)) {
								OssnFile::DeleteDir($data);
						}
				}
				$delete['from']   = 'ossn_object';
				$delete['wheres'] = array(
						"guid='{$object}'"
				);
				if($this->delete($delete)) {
						return true;
				}
				return false;
		}
		/**
		 * Search object by its title, description etc
		 *
		 * @param array $params A valid options in format:
		 * 	  'search_type' => true(default) to performs matching on a per-character basis 
		 * 					  false for performs matching on exact value.
		 * 	  'subtype' 	=> Valid object subtype
		 *	  'type' 		=> Valid object type
		 *	  'title'		=> Valid object title
		 *	  'description'		=> Valid object description
		 *    'owner_guid'  => A valid owner guid, which results integer value
		 *    'limit'		=> Result limit default, Default is 20 values
		 *	  'order_by'    => To show result in sepcific order. There is no default order.
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
						'search_type' => true,
						'subtype' => false,
						'type' => false,
						'owner_guid' => false,
						'limit' => false,
						'order_by' => false,
						'offset' => input('offset', '', 1),
						'page_limit' => ossn_call_hook('pagination', 'page_limit', false, 10), //call hook for page limit
						'count' => false
				);
				$options = array_merge($default, $params);
				$wheres  = array();
				
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
						$wheres[] = "o.guid='{$options['object_guid']}'";
				}
				if(!empty($options['subtype'])) {
						$wheres[] = "o.subtype='{$options['subtype']}'";
				}
				if(!empty($params['type'])) {
						$wheres[] = "o.type='{$options['type']}'";
				}
				if(!empty($params['owner_guid'])) {
						$wheres[] = "o.owner_guid ='{$options['owner_guid']}'";
				}
				//check if developer want to search title or description
				if($options['search_type'] === true) {
						if(!empty($params['title'])) {
								$wheres[] = "o.title LIKE '%{$options['title']}%'";
						}
						if(!empty($params['description'])) {
								$wheres[] = "o.description LIKE '%{$options['description']}%'";
						}
				} elseif($options['search_type'] === false) {
						if(!empty($params['title'])) {
								$wheres[] = "o.title = '{$options['title']}'";
						}
						if(!empty($params['description'])) {
								$wheres[] = "o.description = '{$options['description']}'";
						}
				}
				//prepare search
				$params = array();
				
				$params['from']     = 'ossn_object as o';
				$params['params']   = array(
						'o.guid',
						'o.time_created',
						'o.owner_guid',
						'o.description',
						'o.title',
						'o.subtype'
				);
				$params['wheres']   = array(
						$this->constructWheres($wheres)
				);
				$params['order_by'] = $options['order_by'];
				$params['limit']    = $options['limit'];
				
				if(!$options['order_by']){
					$params['order_by'] = "o.guid ASC";				
				}
				$this->get = $this->select($params, true);
				
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
				if($this->get) {
						foreach($this->get as $object) {
								$this->object_guid = $object->guid;
								$objects[]         = $this->getObjectById();
						}
						return $objects;
				}
				return false;
		}
}
