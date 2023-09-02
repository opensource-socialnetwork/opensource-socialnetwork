<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$guid    = input('guid');
$type    = input('type');

$RealTimeComments = new RealTimeComments;
header('Content-Type: application/json');
if($type == 'entity' && !ossn_get_entity($guid)){
			echo json_encode(array(
					'status' => 0,					   
			));		
			exit;
}
if($type == 'post' && !ossn_get_object($guid)){
			echo json_encode(array(
					'status' => 0,					   
			));		
			exit;	
}
if($RealTimeComments->setStatus($guid, $type)){
			echo json_encode(array(
					'status' => 1,					   
			));
			exit;
}	else {
			echo json_encode(array(
					'status' => 0,					   
			));	
			exit;
}
