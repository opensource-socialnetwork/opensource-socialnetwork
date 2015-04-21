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
 
/**
 * Ossn get object
 *
 * @param int $guid Guid of object
 *
 * @return object
 */
function ossn_get_object($guid){
	if(!empty($guid)){
		$object = new OssnObject;
		$object->object_guid = $guid;
		$object = $object->getObjectById();
		if($object){
			return $object;
		}
	}
	return false;
}
/**
 * Get entities of object
 *
 * @param object $object Must be valid object
 * @param array $params Options
 *
 * @return object
 */
function ossn_get_object_entities($object, $params = array()){
	if(isset($object->guid)){
		$vars['owner_guid'] = $object->guid;
		$vars['type'] = 'object';
		$vars = array_merge($vars, $params);
		
		return ossn_get_entities($vars);	
	}
	return false;
}
/**
 * Get objects
 *
 * @param array $params Options
 * @param int $params['owner_guid'] object owner guid
 * @param string $params['type'] object type
 * @param string $params['subtype'] object subtype
 * @param string $params['limit'] limit of fetch data
 * @param string $params['order_by'] order fetch data
 *
 * @return object
 */
function ossn_get_objects(array $params){
	if(isset($params['owner_guid']) && !empty($params['owner_guid'])){
		
		$object = new OssnObject;
		$object->owner_guid = $params['owner_guid'];
		
		if(isset($params['type']) && !empty($params['type'])){
			$object->type = $params['type'];
		}
		if(isset($params['subtype']) && !empty($params['subtype'])){
			$object->subtype = $params['subtype'];
		}
		if(isset($params['limit']) && !empty($params['limit'])){
			$object->limit = $params['limit'];
		}
		if(isset($params['order_by']) && !empty($params['order_by'])){
			$object->order_by = $params['order_by'];
		}
		
		$objects = $object->getObjectByOwner();
		if($objects){
			return $objects;
		}
	}
	return false;
}
/**
 * Get objects by type
 *
 * @param array $params Options
 * @param string $params['type'] object type
 * @param string $params['subtype'] object subtype
 * @param string $params['limit'] limit of fetch data
 * @param string $params['order_by'] order fetch data
 *
 * @return object
 */
function ossn_get_objects_by_type(array $params){
	if(isset($params['type']) && !empty($params['type'])){
		
		$object = new OssnObject;
		$object->type = $params['type'];

		if(isset($params['subtype']) && !empty($params['subtype'])){
			$object->subtype = $params['subtype'];
		}
		if(isset($params['limit']) && !empty($params['limit'])){
			$object->limit = $params['limit'];
		}
		if(isset($params['order_by']) && !empty($params['order_by'])){
			$object->order_by = $params['order_by'];
		}
		
		$objects = $object->getObjectsByTypes();
		if($objects){
			return $objects;
		}
	}
	return false;
}