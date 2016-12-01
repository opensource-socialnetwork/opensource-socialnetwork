<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
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
	$annotation = new OssnAnnotation;
	return $annotation->searchAnnotation($params);
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
	$annotation = new OssnAnnotation;
	return $annotation->searchAnnotation($params);
}