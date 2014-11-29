<?php
/**
 * OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
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
function ossn_get_entities(array $params){
  if(isset($params['type'])){
	  $entities = new OssnEntities;
	  $entities->owner_guid = $params['owner_guid'];
	  $entities->type = $params['type'];
	  
	  if(isset($params['subtype'])){
		  $entities->type = $params['subtype'];	  
	  }
	  if(isset($params['order_by'])){
		  $entities->order_by = $params['order_by'];	  
	  }	  
	  if(isset($params['limit'])){
		  $entities->limit = $params['limit'];	  
	  }	  	  
	  $entities = $entities->get_entities();
	  if($entities){
		 return $entities; 
	  }
  }
  return false;
}