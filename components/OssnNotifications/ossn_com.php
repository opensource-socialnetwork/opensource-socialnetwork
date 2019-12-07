<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

define('__OSSN_NOTIF__', ossn_route()->com . 'OssnNotifications/');
require_once(__OSSN_NOTIF__ . 'classes/OssnNotifications.php');
/**
 * Initialize Notification Component
 *
 * @return void;
 * @access private
 */
function ossn_notifications() {
		//css
		ossn_extend_view('css/ossn.default', 'css/notifications');
		//js
		ossn_extend_view('js/opensource.socialnetwork', 'js/OssnNotifications');
		ossn_extend_view('ossn/site/head', 'js/notifications-settings');
		
		//pages
		ossn_register_page('notification', 'ossn_notification_page');
		ossn_register_page('notifications', 'ossn_notifications_page');
		
		//callbacks
		ossn_register_callback('like', 'created', 'ossn_notification_like');
		ossn_register_callback('wall', 'post:created', 'ossn_notification_walltag');
		ossn_register_callback('annotations', 'created', 'ossn_notification_annotation');
		ossn_register_callback('user', 'delete', 'ossn_user_notifications_delete');
		
		//Orphan notification after posting/comment has been deleted #609
		ossn_register_callback('post', 'delete', 'ossn_post_notifications_delete');
		ossn_register_callback('like', 'deleted', 'ossn_like_notifications_delete');
		
		//hooks 
		ossn_add_hook('notification:add', 'comments:post', 'ossn_notificaiton_comments_post_hook');
		ossn_add_hook('notification:add', 'like:post', 'ossn_notificaiton_comments_post_hook');
		ossn_add_hook('notification:add', 'like:annotation', 'ossn_notificaiton_like_annotation_hook');
		ossn_add_hook('notification:add', 'comments:entity', 'ossn_notificaiton_comment_entity_hook');
		ossn_add_hook('notification:add', 'like:entity', 'ossn_notificaiton_comment_entity_hook');
		//tag post with a friend, doesn't show in friend's notification #589
		ossn_add_hook('notification:add', 'wall:friends:tag', 'ossn_notificaiton_walltag_hook');
		
		if(ossn_isLoggedin()) {
				ossn_extend_view('ossn/js/head', 'notifications/js/autocheck');
				ossn_register_action('notification/mark/allread', __OSSN_NOTIF__ . 'actions/markread.php');
				if(ossn_isAdminLoggedin()) {
						ossn_register_action('notifications/admin/settings', __OSSN_NOTIF__ . 'actions/notifications/admin/settings.php');
						ossn_register_com_panel('OssnNotifications', 'settings');
				}
		}
		ossn_register_sections_menu('newsfeed', array(
				'name' => 'notifications',
				'text' => ossn_print('notifications'),
				'url' => ossn_site_url('notifications/all'),
				'parent' => 'links',
		));		
}
/**
 * Create a notification for annotation like
 *
 * @return void;
 * @access private
 */
function ossn_notification_annotation($callback, $type, $params) {
		$notification = new OssnNotifications;
		$notification->add($params['type'], $params['owner_guid'], $params['subject_guid'], $params['annotation_guid']);
}
/**
 * Notification Page
 *
 * @return mixed data;
 * @access public
 */
function ossn_notification_page($pages) {
		$page = $pages[0];
		if(empty($page)) {
				ossn_error_page();
		}
		header('Content-Type: application/json');
		switch($page) {
				case 'notification':
						$get                            = new OssnNotifications;
						$unread                         = ossn_call_hook('list', 'notification:unread', array(), true);
						$notifications['notifications'] = $get->get(ossn_loggedin_user()->guid, $unread);
						$notifications['seeall']        = ossn_site_url("notifications/all");
						$clearall                       = ossn_plugin_view('output/url', array(
								'action' => true,
								'href' => ossn_site_url('action/notification/mark/allread'),
								'class' => 'ossn-notification-mark-read',
								'text' => ossn_print('ossn:notifications:mark:as:read')
						));
						if(!empty($notifications['notifications'])) {
								$data = ossn_plugin_view('notifications/pages/notification/notification', $notifications);
								echo json_encode(array(
										'type' => 1,
										'data' => $data,
										'extra' => $clearall
								));
						} else {
								echo json_encode(array(
										'type' => 0,
										'data' => '<div class="ossn-no-notification">' . ossn_print('ossn:notification:no:notification') . '</div>'
								));
						}
						break;
				case 'friends':
						$friends['friends'] = ossn_loggedin_user()->getFriendRequests();
						if(!empty($friends['friends'])) {
								$data = ossn_plugin_view('notifications/pages/notification/friends', $friends);
								echo json_encode(array(
										'type' => 1,
										'data' => $data
								));
						} else {
								echo json_encode(array(
										'type' => 0,
										'data' => '<div class="ossn-no-notification">' . ossn_print('ossn:notification:no:notification') . '</div>'
								));
						}
						break;
				
				case 'messages':
						$OssnMessages     = new OssnMessages;
						$params['recent'] = $OssnMessages->recentChat(ossn_loggedin_user()->guid);
						if(!empty($params['recent'])) {
								$data = ossn_plugin_view('messages/templates/message-with-notifi', $params);
								echo json_encode(array(
										'type' => 1,
										'data' => $data
								));
						} else {
								echo json_encode(array(
										'type' => 0,
										'data' => '<div class="ossn-no-notification">' . ossn_print('ossn:notification:no:notification') . '</div>'
								));
						}
						break;
				case 'read';
						if(!empty($pages[1])) {
								$notification = new OssnNotifications;
								$guid         = $notification->getbyGUID($pages[1]);
								if($guid->owner_guid == ossn_loggedin_user()->guid) {
										$notification->setViewed($pages[1]);
										$url = urldecode(input('notification'));
										header("Location: {$url}");
								} else {
										redirect();
								}
						} else {
								redirect();
						}
						break;
				case 'count':
						if(!ossn_isLoggedIn()) {
								ossn_error_page();
						}
						$notification = new OssnNotifications;
						$count_notif  = $notification->countNotification(ossn_loggedin_user()->guid);
						//Notifications crashing if OssnMessages module is disabled #646
						if(class_exists('OssnMessages')) {
								$messages       = new OssnMessages;
								$count_messages = $messages->countUNREAD(ossn_loggedin_user()->guid);
						}
						if(!$count_notif) {
								$count_notif = 0;
						}
						$friends   = ossn_loggedin_user()->getFriendRequests();
						$friends_c = 0;
						if($friends) {
								$friends_c = count($friends);
						}
						echo json_encode(array(
								'notifications' => $count_notif,
								'messages' => $count_messages,
								'friends' => $friends_c
								
						));
						break;
				default:
						ossn_error_page();
						break;
						
		}
}
/**
 * Notifications page
 *
 * @param (array) $pages Array containg pages
 *
 * @return false|null data;
 * @access public
 */
function ossn_notifications_page($pages) {
		$page = $pages[0];
		if(empty($page)) {
				return false;
		}
		switch($page) {
				case 'all':
						$title    = 'Notifications';
						$contents = array(
								'content' => ossn_plugin_view('notifications/pages/all')
						);
						$content  = ossn_set_page_layout('media', $contents);
						echo ossn_view_page($title, $content);
						
						break;
				default:
						ossn_error_page();
						break;
						
		}
}
/**
 * Create a notification for like created
 *
 * @return void;
 * @access private
 */
function ossn_notification_like($type, $event_type, $params) {
		$notification = new OssnNotifications;
		$notification->add($params['type'], $params['owner_guid'], $params['subject_guid'], $params['subject_guid']);
}
/**
 * Create a notification for wall tag
 *
 * @return void;
 * @access private
 */
function ossn_notification_walltag($type, $ctype, $params) {
		$notification = new OssnNotifications;
		if(isset($params['friends']) && is_array($params['friends'])) {
				foreach($params['friends'] as $friend) {
						//Tagging friend in wall isn't working #1511
						//user object guid instead of itemguid
						if(!empty($params['poster_guid']) && !empty($params['object_guid']) && !empty($friend)) {
								$notification->add('wall:friends:tag', $params['poster_guid'], $params['object_guid'], $params['object_guid'], $friend);						}
				}
		}
}
/**
 * Wall post user tag notification hook
 * 
 * Tag post with a friend, doesn't show in friend's notification #589
 * 
 * @return boolean
 */
function ossn_notificaiton_walltag_hook($hook, $type, $return, $params) {
		if(isset($params['notification_owner'])) {
				$params['owner_guid'] = $params['notification_owner'];
		}
		return $params;
}
/**
 * Delete user notifiactions when user deleted
 *
 * @return void;
 * @access private
 */
function ossn_user_notifications_delete($callback, $type, $params) {
		$delete = new OssnNotifications;
		$delete->deleteUserNotifications($params['entity']);
}
/**
 * Delete wall post notifiactions
 *
 * @param string  $hook Hook name
 * @param string  $type Hook type
 * @param integer $guid Post guid
 *
 * @return void
 */
function ossn_post_notifications_delete($callback, $type, $guid) {
		$delete = new OssnNotifications;
		if(!empty($guid)) {
				$delete->deleteNotification(array(
						'subject_guid' => $guid,
						'type' => array(
								'wall:friends:tag',
								'like:post'
						)
				));
		}
}
/**
 * Delete like notifiactions
 *
 * @param string  $callback A callback name
 * @param string  $type A callback type
 * @param Array   $guid Option values
 *
 * @return void
 */
function ossn_like_notifications_delete($callback, $type, $vars) {
		$delete = new OssnNotifications;
		if(isset($vars['subject_id']) && !empty($vars['subject_id'])) {
				$delete->deleteNotification(array(
						'item_guid' => $vars['subject_id'],
						'type' => array(
								'like:entity:file:profile:photo',
								'like:entity:file:profile:cover',
								'like:entity:file:ossn:aphoto',
								'like:post',
								'like:annotation'
						)
				));
		}
}
/**
 * Wall post comments/likes notification hook
 *
 * @param string $hook Hook name
 * @param string $type Hook type
 * @param array  $params Callback data
 *
 * @return array or false;
 * @access public
 */
function ossn_notificaiton_comments_post_hook($hook, $type, $return, $params) {
		$object              = new OssnObject;
		$object->object_guid = $params['subject_guid'];
		
		$object = $object->getObjectById();
		if($object) {
				$params['owner_guid'] = $object->owner_guid;
				
				if($object->type !== 'user') {
						$params['type'] = "{$params['type']}:{$object->type}:{$object->subtype}";
						return ossn_call_hook('notification:add', $params['type'], $params, false);
				}
				return $params;
		}
		return false;
}
/**
 * Annotations likes notification hook
 *
 * @param string $hook Hook name
 * @param string $type Hook type
 * @param array Callback data
 *
 * @return array or false;
 * @access public
 */
function ossn_notificaiton_like_annotation_hook($hook, $type, $return, $params) {
		$annotation                = new OssnAnnotation;
		$annotation->annotation_id = $params['subject_guid'];
		
		$annotation = $annotation->getAnnotationById();
		if($annotation) {
				$params['owner_guid']   = $annotation->owner_guid;
				$params['subject_guid'] = $annotation->subject_guid;
				return $params;
		}
		return false;
}
/**
 * Entity comments/likes notification hook
 *
 * @param string $hook Hook name
 * @param string $type Hook type
 * @param array Callback data
 *
 * @return array or false;
 * @access public
 */
function ossn_notificaiton_comment_entity_hook($hook, $type, $return, $params) {
		$entity              = new OssnEntities;
		$entity->entity_guid = $params['subject_guid'];
		
		$entity         = $entity->get_entity();
		$params['type'] = "{$params['type']}:{$entity->subtype}";
		
		if($entity) {
				if($entity->type == 'user') {
						$params['owner_guid'] = $entity->owner_guid;
				}
				
				if($entity->type == 'object') {
						$object              = new OssnObject;
						$object->object_guid = $entity->owner_guid;
						$object              = $object->getObjectById();
						if($object) {
								$params['owner_guid'] = $object->owner_guid;
						}
				}
				return $params;
		}
		return false;
}
//initialize notification component
ossn_register_callback('ossn', 'init', 'ossn_notifications');
