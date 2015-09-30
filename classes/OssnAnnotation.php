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
		}
		/**
		 * Create annotation;
		 *
		 * Requires : $object->(owner_guid, subject_guid, type, subtype, value)
		 *
		 * @return boolean
		 */
		public function addAnnotation() {
				self::initAttributes();
				if(empty($this->owner_guid) || empty($this->subject_guid)) {
						return false;
				}
				$params['into']        = 'ossn_annotations';
				$params['names']       = array(
						'owner_guid',
						'subject_guid',
						'type',
						'time_created'
				);
				$params['values']      = array(
						$this->owner_guid,
						$this->subject_guid,
						$this->type,
						$this->time_created
				);
				$this->annotation_type = $this->type;
				$this->owner_guid_old  = $this->owner_guid;
				if($this->OssnDatabase->insert($params)) {
						$this->annotation_inserted = $this->OssnDatabase->getLastEntry();
						$this->atype               = $this->type;
						$this->type                = 'annotation';
						$this->subtype             = $this->atype;
						$this->owner_guid          = $this->annotation_inserted;
						$this->value               = $this->value;
						$this->add();
						
						$params['subject_guid']    = $this->subject_guid;
						$params['owner_guid']      = $this->owner_guid_old;
						$params['type']            = $this->annotation_type;
						$params['annotation_guid'] = $this->OssnDatabase->getLastEntry();
						ossn_trigger_callback('annotations', 'created', $params);
						
						return true;
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
				if(!isset($this->page_limit)){
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
				if(!isset($this->page_limit)){
						$this->page_limit = false;
				}			
				$params               = array();
				$params['owner_guid'] = $this->subject_guid;
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
				if(!isset($this->page_limit)){
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
		public function deleteAnnotation($annotation) {
				self::initAttributes();
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
				$default = array(
						'search_type' => true,
						'type' => false,
						'owner_guid' => false,
						'annotation_id' => false,
						'subject_guid' => false,
						'limit' => false,
						'order_by' => false,
						'offset' => input('offset', '', 1),
						'page_limit' => ossn_call_hook('pagination', 'page_limit', false, 10), //call hook for page limit
						'count' => false
				);
				$options = array_merge($default, $params);
				$wheres  = array();
				
				//validate offset values
				if($options['limit'] !== false && $options['limit'] !== 0 && $options['page_limit'] !== 0) {
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
				if(!empty($params['type'])) {
						$wheres[] = "a.type='{$options['type']}'";
						$wheres[] = "e.subtype='{$options['type']}'";
				}
				if(!empty($params['owner_guid'])) {
						$wheres[] = "a.owner_guid ='{$options['owner_guid']}'";
				}
				if(!empty($params['subject_guid'])) {
						$wheres[] = "a.subject_guid ='{$options['subject_guid']}'";
				}
				$wheres[] = "e.owner_guid=a.id";
				$wheres[] = "e.type='annotation'";
				$wheres[] = "emd.guid=e.guid";
				//prepare search	
				$params   = array();
				
				$params['from']     = 'ossn_annotations as a, ossn_entities as e , ossn_entities_metadata as emd';
				$params['params']   = array(
						'a.id',
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
} //class
