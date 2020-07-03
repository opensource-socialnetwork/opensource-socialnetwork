<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
define('RealTimeComments', ossn_route()->com . 'OssnRealTimeComments/');
ossn_register_class(array(
		'RealTimeComments' => RealTimeComments . 'classes/RealTimeComments.php'
));
function rtcomments_init() {		
		ossn_extend_view('js/opensource.socialnetwork', 'js/rtcomments');
		ossn_extend_view('css/ossn.default', 'css/rtcomments');
		
		if(ossn_isLoggedin()){
				ossn_extend_view('comments/post/comments', 'rtcomments/item/js');
				ossn_extend_view('comments/post/comments_entity', 'rtcomments/item/js_entity');
		
				ossn_register_action('rtcomments/status', RealTimeComments . 'actions/status.php');
				ossn_register_action('rtcomments/setstatus', RealTimeComments . 'actions/setstatus.php');
				
				ossn_register_callback('post', 'delete', 'rtcomments_post_delete');
				ossn_register_callback('delete', 'entity', 'rtcomments_entity_delete');
				ossn_register_callback('user', 'delete', 'rtcomments_user_delete');
		}
}
function rtcomments_user_delete($event, $type, $params) {
				if(!empty($params['entity']->guid)){
					$delete           = new OssnDatabase;
					$params['from']   = 'ossn_relationships';
					$params['wheres'] = array(
							"relation_from='{$params['entity']->guid}' AND type IN('rtctypingentity', 'rtctypingpost')",
					);
					if($delete->delete($params)) {
							return true;
					}
				}
}

function rtcomments_entity_delete($event, $type, $params) {
				if(!empty($params['entity'])){
					$delete           = new OssnDatabase;
					$params['from']   = 'ossn_relationships';
					$params['wheres'] = array(
							"relation_to='{$params['entity']}' AND type='rtctypingentity'",
					);
					if($delete->delete($params)) {
							return true;
					}
				}
}
function rtcomments_post_delete($event, $type, $guid) {
				if(!empty($guid)){
					$delete           = new OssnDatabase;
					$params['from']   = 'ossn_relationships';
					$params['wheres'] = array(
							"relation_to='{$guid}' AND type='rtctypingpost'",
					);
					if($delete->delete($params)) {
							return true;
					}
				}
}
ossn_register_callback('ossn', 'init', 'rtcomments_init');
