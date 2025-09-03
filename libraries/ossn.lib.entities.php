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
 * Ossn Get Entity
 *
 * @param int $guid Guid of entity
 *
 * @return bool
 */
function ossn_get_entity($guid){
	if(!empty($guid)){
	 	$entity = new OssnEntities;
		$entity->entity_guid = $guid;
		$entity = $entity->get_entity();
		if($entity){
			return $entity;
		}
	}
		return false;
}
/**
 * Ossn Get Entities
 *
 * @param array $params search data
 * @param string $params['type'] Entity type
 * @param string $params['subtype'] Entity subtype
 * @param string $params['order_by'] Order by (ASC , DESC)
 * @param string $params['limit'] Limit for data that need to be fetched
 * @param string $params['owner_guid'] Owner guid
 *
 * @return bool
 */
function ossn_get_entities(array $params){
	  $entities = new OssnEntities;	  
	  $entities = $entities->searchEntities($params);
	  if($entities){
		 return $entities; 
	  }
  	return false;
}
/**
 * Ossn Add Entity
 *
 * @param array $params search data
 * @param string $params['type'] Entity type
 * @param string $params['subtype'] Entity subtype
 * @param string $params['value'] Entity Value
 * @param string $params['owner_guid'] Owner guid
 * @param string $params['permission'] Permission (access of entity)
 * @param string $params['active'] 1 or 0 Does your entity is active?
 *
 * @return bool
 */
function ossn_add_entity(array $params){
	$entity = new OssnEntities;
	$entity->type = $params['type'];
	$entity->owner_guid = $params['owner_guid'];
	$entity->value = $params['value'];
	
	if(isset($params['subtype'])){
		$entity->subtype = $params['subtype'];
	}	
	if(isset($params['permission'])){
		//ossn.lib.entities.php seems to be not updated #1248
		$entity->permission = $params['value'];
	}
	if(isset($params['active'])){
		$entity->active = $params['active'];
	}
	if($entity->add()){
		return true;
	}
	return false;
}
/**
 * Ossn update entity
 *
 * @param int $guid Entity guid
 * @param string $value Entity new value
 *
 * @return bool
 */
function ossn_update_entity($guid, $value){
	$update = new OssnEntities;
	$update->guid = $guid;
	$update->value = $value;
	
	return $update->updateEntity();
}
