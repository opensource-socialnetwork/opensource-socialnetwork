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
 * Ossn get annotation
 *
 * @param int $guid Guid of annotation
 *
 * @return object
 */
function ossn_get_annotation($id){
	if(!empty($id)){
		$annotation = new OssnAnnotation;
		$annotation->annotation_id = $id;
		$annotation = $annotation->getAnnotationById();
		if($annotation){
			return $annotation;
		}
	}
	return false;
} 
/**
 * Get entities of annotation
 *
 * @param object $annotation Must be valid annotation object
 * @param array $params Options
 *
 * @return object
 */
function ossn_get_annotation_entities($annotation, $params = array()){
	if(isset($annotation->id)){
		$vars['owner_guid'] = $annotation->id;
		$vars['type'] = 'annotation';
		$vars = array_merge($vars, $params);
		
		return ossn_get_entities($vars);	
	}
	return false;
}
/**
 * Get Annotations
 *
 * @param array $params Options
 * @param int $params['owner_guid'] annotation owner guid
 * @param string $params['type'] annotation type
 * @param string $params['subtype'] annotation subtype
 * @param string $params['limit'] limit of fetch data
 * @param string $params['order_by'] order fetch data
 *
 * @return object
 */
function ossn_get_annotations(array $params){
	if(isset($params['owner_guid']) && !empty($params['owner_guid'])){
		
		$annotation = new OssnAnnotation;
		$annotation->owner_guid = $params['owner_guid'];
		
		if(isset($params['type']) && !empty($params['type'])){
			$annotation->type = $params['type'];
		}
		if(isset($params['subtype']) && !empty($params['subtype'])){
			$annotation->subtype = $params['subtype'];
		}
		if(isset($params['limit']) && !empty($params['limit'])){
			$annotation->limit = $params['limit'];
		}
		if(isset($params['order_by']) && !empty($params['order_by'])){
			$annotation->order_by = $params['order_by'];
		}
		
		$annotations = $annotation->getAnnotationsByOwner();
		if($annotations){
			return $annotations;
		}
	}
	return false;
}
/**
 * Get annotations by types
 *
 * @param array $params Options
 * @param string $params['type'] object type
 * @param string $params['subtype'] object subtype
 * @param string $params['limit'] limit of fetch data
 * @param string $params['order_by'] order fetch data
 *
 * @return object
 */
function ossn_get_annotations_by_type(array $params){
	if(isset($params['type']) && !empty($params['type'])){
		
		$annotation = new OssnAnnotation;
		$annotation->type = $params['type'];

		if(isset($params['limit']) && !empty($params['limit'])){
			$annotation->limit = $params['limit'];
		}
		if(isset($params['order_by']) && !empty($params['order_by'])){
			$annotation->order_by = $params['order_by'];
		}
		
		$annotations = $annotation->getAnnotationsByType();
		if($annotations){
			return $annotations;
		}
	}
	return false;
}