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
class OssnAnnotation extends OssnEntities {
		/**
		 * Initialize the objects.
		 *
		 * @return void
		 */
		public function initAttributes() {
				$this->OssnDatabase = new OssnDatabase;
				$this->time_created = time();
				if(empty($this->subtype)) {
						$this->subtype = NULL;
				}
				if(empty($this->permission)) {
						$this->permission = OSSN_PUBLIC;
				}
				if(empty($this->order_by)) {
						$this->order_by = '';
				}
				if(!isset($this->data)) {
						$this->data = new stdClass;
				}
		}
		/**
		 * Create annotation;
		 * 
		 * Requires the owner_guid, subject_guid, and annotation type
		 *
		 * @return boolean
		 */
		public function addAnnotation() {
				self::initAttributes();
				if(empty($this->owner_guid) || empty($this->subject_guid) || empty($this->type)) {
						return false;
				}
				$params['into']   = 'ossn_annotations';
				$params['names']  = array(
						'owner_guid',
						'subject_guid',
						'type',
						'time_created'
				);
				$params['values'] = array(
						$this->owner_guid,
						$this->subject_guid,
						$this->type,
						$this->time_created
				);
				
				$this->annotation_type = $this->type;
				
				$this->data->{$this->type} = $this->value;
				$actual_value              = $this->value;
				$this->owner_guid_old      = $this->owner_guid;
				
				$create = ossn_call_hook('annotation', 'create', array(
						'params' => $params,
						'instance' => $this
				), true);
				if($create) {
						if($this->OssnDatabase->insert($params)) {
								$this->annotation_inserted = $this->OssnDatabase->getLastEntry();
								if(isset($this->data) && is_object($this->data)) {
										foreach($this->data as $name => $value) {
												$this->owner_guid = $this->annotation_inserted;
												$this->type       = 'annotation';
												$this->subtype    = $name;
												$this->value      = $value;
												$this->add();
										}
								}
								$params['value']           = $actual_value;
								$params['subject_guid']    = $this->subject_guid;
								$params['owner_guid']      = $this->owner_guid_old;
								$params['type']            = $this->annotation_type;
								$params['annotation_guid'] = $this->annotation_inserted;
								ossn_trigger_callback('annotations', 'created', $params);
								
								return $this->annotation_inserted;
						}
				}
				return false;
		}
		/**
		 * Get annotation by annotation id;
		 *
		 * Requires : $object->(annotation_id)
		 *
		 * @return object
		 */
		public function getAnnotationById() {
				$params                  = array();
				$params['annotation_id'] = $this->annotation_id;
				
				$data = $this->searchAnnotation($params);
				if($data) {
						return $data[0];
				}
		}
		/**
		 * Get annotations by annotation type
		 *
		 * Requires: $object->(annotation_id)
		 *
		 * @return object;
		 */
		public function getAnnotationsByType() {
				if(!isset($this->limit)) {
						$this->limit = false;
				}
				if(!isset($this->page_limit)) {
						$this->page_limit = false;
				}
				$params             = array();
				$params['type']     = $this->type;
				$params['subtype']  = $this->subtype;
				$params['limit']    = $this->limit;
				$params['order_by'] = $this->order_by;
				
				return $this->searchAnnotation($params);
		}
		/**
		 * Get annotations by owner 
		 *
		 * Requires : $this->owner_guid
		 *
		 * @return object;
		 */
		public function getAnnotationsByOwner() {
				if(!isset($this->limit)) {
						$this->limit = false;
				}
				if(!isset($this->page_limit)) {
						$this->page_limit = false;
				}
				if(empty($this->owner_guid)) {
						return false;
				}
				$params               = array();
				$params['owner_guid'] = $this->owner_guid;
				$params['limit']      = $this->limit;
				$params['order_by']   = $this->order_by;
				$params['page_limit'] = $this->page_limit;
				$params['type']       = $this->type;
				return $this->searchAnnotation($params);
		}
		/**
		 * Delete annotations by subject guid
		 *
		 * @params $subject = subject_guid,
		 *         $type = annotation type
		 * @param string $type
		 *
		 * @return object;
		 */
		public function annon_delete_by_subject($subject, $type) {
				self::initAttributes();
				if(empty($subject)) {
						return false;
				}
				$this->subject_guid = $subject;
				$this->type         = $type;
				$this->limit        = false;
				$this->page_limit   = false;
				$annotations        = $this->getAnnotationBySubject();
				if($annotations) {
						foreach($annotations as $annontation) {
								if(class_exists('OssnLikes')){
									$like = new OssnLikes;
									$like->deleteLikes($annontation->id, 'annotation');
								}
								$this->deleteAnnotation($annontation->id);
						}
						return true;
				}
				return false;
		}
		
		/**
		 * Get annotation by subject_guid;
		 *
		 * Requires : $object->(subject_guid, types(optional))
		 *
		 * @return object;
		 */
		public function getAnnotationBySubject() {
				if(!isset($this->count)) {
						$this->count = false;
				}
				if(!isset($this->limit)) {
						$this->limit = false;
				}
				if(!isset($this->page_limit)) {
						$this->page_limit = false;
				}
				$params                 = array();
				$params['type']         = $this->type;
				$params['subject_guid'] = $this->subject_guid;
				$params['count']        = $this->count;
				$params['order_by']     = $this->order_by;
				$params['limit']        = $this->limit;
				$params['page_limit']   = $this->page_limit;
				
				return $this->searchAnnotation($params);
		}
		
		/**
		 * Delete Annotation
		 *
		 * @param integer $annotation annotation_id
		 *
		 * @return boolean;
		 */
		public function deleteAnnotation($annotation = 0) {
				self::initAttributes();
				if(isset($this->id)) {
						$annotation = $this->id;
				}
				if(empty($annotation)) {
						return false;
				}
				
				$vars	= array();
				$params['annotation'] = $annotation;
				ossn_trigger_callback('annotation', 'before:delete', $vars);				
				
				if($this->deleteByOwnerGuid($annotation, 'annotation')) {
						$this->statement("DELETE FROM ossn_annotations WHERE(id='{$annotation}')");
						if($this->execute()) {
								$data = ossn_get_userdata("annotation/{$annotation}/");
								if(is_dir($data)) {
										OssnFile::DeleteDir($data);
										// As of v2.0 DeleteDir delete directory also
										//rmdir($data);
								}
								$params['annotation'] = $annotation;
								ossn_trigger_callback('annotation', 'delete', $params);
								return true;
						}
				}
				return false;
		}
		/**
		 * Delete Annotation
		 *
		 * @param integer $annotation annotation_id
		 *
		 * @return boolean
		 */
		public function deleteAnnotationByOwner($ownerguid) {
				self::initAttributes();
				if(empty($ownerguid)) {
						return false;
				}
				$this->owner_guid = $ownerguid;
				$this->type = false;
				$annotations      = $this->getAnnotationsByOwner();
				if($annotations) {
						foreach($annotations as $annotation) {
								$this->deleteAnnotation($annotation->id);
						}
				}
		}
		/**
		 * Get newly create annoation id
		 *
		 * @return integer
		 */
		public function getAnnotationId() {
				return $this->annotation_inserted;
		}
		/**
		 * Search annotation by its type, owner etc
		 *
		 * @param array   $params A valid options in format:
		 * @param string  $params['search_type'] true(default) to performs matching on a per-character basis ,  false to performs matching on exact value.
		 * @param string  $params['type']  Valid annotation type
		 * @param integer $params['subject_guid']  A valid subject guid, which results integer value
		 * @param integer $params['owner_guid'] A valid owner guid, which results integer value
		 * @param integer $params['limit'] Result limit default, Default is 20 values
		 * @param string  $params['order_by']  To show result in sepcific order. There is no default order.
		 * 
		 * reutrn array|false;
		 */
		public function searchAnnotation(array $params = array()) {
				self::initAttributes();
				if(empty($params)) {
						return false;
				}
				//prepare default attributes
				$default      = array(
						'search_type' => true,
						'type' => false,
						'distinct' => false,
						'owner_guid' => false,
						'annotation_id' => false,
						'subject_guid' => false,
						'limit' => false,
						'order_by' => false,
						'offset' => input('offset', '', 1),
						'page_limit' => ossn_call_hook('pagination', 'page_limit', false, 10), //call hook for page limit
						'count' => false
				);
				$options      = array_merge($default, $params);
				$wheres       = array();
				$params       = array();
				$wheres_paris = array();
				//validate offset values
				if($options['limit'] !== false && $options['limit'] !== 0 && $options['page_limit'] !== false && $options['page_limit'] !== 0) {
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
				
				if(!empty($options['annotation_id'])) {
						$wheres[] = "a.id='{$options['annotation_id']}'";
				}
				if(!empty($options['type'])) {
						$wheres[] = "a.type='{$options['type']}'";
						$wheres[] = "e.subtype='{$options['type']}'";
				}
				if(!empty($options['owner_guid'])) {
						$wheres[] = "a.owner_guid ='{$options['owner_guid']}'";
				}
				if(!empty($options['subject_guid'])) {
						$wheres[] = "a.subject_guid ='{$options['subject_guid']}'";
				}
				if(isset($options['entities_pairs']) && is_array($options['entities_pairs'])) {
						foreach($options['entities_pairs'] as $key => $pair) {
								$operand = (empty($pair['operand'])) ? '=' : $pair['operand'];
								if(!empty($pair['name']) && isset($pair['value']) && !empty($operand)) {
										if(!empty($pair['value'])) {
												$pair['value'] = addslashes($pair['value']);
										}
										$wheres_paris[] = "e{$key}.type='annotation'";
										$wheres_paris[] = "e{$key}.subtype='{$pair['name']}'";
										if(isset($pair['wheres']) && !empty($pair['wheres'])) {
												$pair['wheres'] = str_replace('[this].', "emd{$key}.", $pair['wheres']);
												$wheres_paris[] = $pair['wheres'];
										} else {
												$wheres_paris[] = "emd{$key}.value {$operand} '{$pair['value']}'";
												
										}
										$params['joins'][] = "INNER JOIN ossn_entities as e{$key} ON e{$key}.owner_guid=a.id";
										$params['joins'][] = "INNER JOIN ossn_entities_metadata as emd{$key} ON e{$key}.guid=emd{$key}.guid";
								}
						}
						if(!empty($wheres_paris)) {
								$wheres_entities = '(' . $this->constructWheres($wheres_paris) . ')';
								$wheres[]        = $wheres_entities;
						}
				}
				$params['joins'][] = "INNER JOIN ossn_entities as e ON e.owner_guid=a.id";
				$params['joins'][] = "INNER JOIN ossn_entities_metadata as emd ON e.guid=emd.guid";
				
				$wheres[] = "e.type='annotation'";
				$wheres[] = "emd.guid=e.guid";
				
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
						$distinct = "DISTINCT ";
				}
				//prepare search	
				$params['from']     = 'ossn_annotations as a';
				$params['params']   = array(
						"{$distinct}a.id",
						'a.time_created',
						'a.owner_guid',
						'a.subject_guid',
						'a.type',
						'emd.value'
				);
				$params['wheres']   = array(
						$this->constructWheres($wheres)
				);
				$params['order_by'] = $options['order_by'];
				$params['limit']    = $options['limit'];
				
				if(!$options['order_by']) {
						$params['order_by'] = "a.id ASC";
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
								"count({$distinct}a.id) as total"
						);
						$count           = array_merge($params, $count);
						return $this->select($count)->total;
				}
				//load fetch query after count condition #1316
				$this->get = $this->select($params, true);
				
				if($this->get) {
						foreach($this->get as $annotation) {
								$merge = array(
										$annotation->type => $annotation->value
								);
								//unset value
								unset($annotation->value);
								
								//get object vars and then merge into arrays
								$values = get_object_vars($annotation);
								$merge  = array_merge($values, $merge);
								
								$this->owner_guid = $annotation->id;
								$this->type       = 'annotation';
								$this->order_by   = '';
								$entities         = $this->get_entities();
								if(!empty($entities)) {
										foreach($entities as $entity) {
												$entities_data[$entity->subtype] = $entity->value;
										}
										$merge = array_merge($merge, $entities_data);
										unset($entities_data);
								}
								//construct object again
								$annotations[] = arrayObject($merge, get_class($this));
						}
						return $annotations;
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
						if((isset($this->owner_guid) && $this->owner_guid == $user->guid) || ossn_isAdminLoggedin()) {
								$allowed = true;
						}
				}
				return ossn_call_hook('user', 'can:change', $this, $allowed);
		}
		/**
		 * A annotation save method
		 *
		 * @return boolean
		 */
		public function save() {
				if(isset($this->id) && !empty($this->id)) {
						$params['table']  = 'ossn_annotations as a';
						$params['names']  = array(
								'owner_guid',
								'subject_guid'
						);
						$params['values'] = array(
								$this->owner_guid,
								$this->subject_guid
						);
						$params['wheres'] = array(
								"a.id='{$this->id}'"
						);
						if($this->update($params)) {
								if(isset($this->data)) {
										$owner_self = $this->owner_guid;
										$type_self  = $this->type;
										
										$this->type       = 'annotation';
										$this->owner_guid = $this->id;
										parent::save();
										
										$this->owner_guid = $owner_self;
										$this->type       = $type_self;
								}
								return true;
						}
				}
				return false;
		}
} //class
