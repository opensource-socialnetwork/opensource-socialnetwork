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
define('__OSSN_COMMENTS__', ossn_route()->com . 'OssnComments/');
require_once __OSSN_COMMENTS__ . 'classes/OssnComments.php';
require_once __OSSN_COMMENTS__ . 'libs/comments.php';
if(!com_is_active('OssnNotifications')) {
		require_once ossn_route()->com . 'OssnNotifications/classes/OssnNotifications.php';
}

/**
 * Initialize Comments Component
 *
 * @return void;
 * @access private
 */
function ossn_comments() {
		if(ossn_isLoggedin()) {
				//here post is not a wallpost
				ossn_register_action('post/comment', __OSSN_COMMENTS__ . 'actions/post/comment.php');
				ossn_register_action('post/entity/comment', __OSSN_COMMENTS__ . 'actions/post/entity/comment.php');
				ossn_register_action('post/object/comment', __OSSN_COMMENTS__ . 'actions/post/object/comment.php');

				ossn_register_action('delete/comment', __OSSN_COMMENTS__ . 'actions/comment/delete.php');
				ossn_register_action('comment/edit', __OSSN_COMMENTS__ . 'actions/comment/edit.php');
				ossn_register_action('comment/embed', __OSSN_COMMENTS__ . 'actions/comment/embed.php');
		}
		ossn_add_hook('post', 'comments', 'ossn_post_comments');
		ossn_add_hook('post', 'comments:entity', 'ossn_post_comments_entity');
		ossn_add_hook('post', 'comments:object', 'ossn_object_comments_entity');

		ossn_extend_view('js/ossn.site', 'js/OssnComments');
		ossn_extend_view('css/ossn.default', 'css/comments');

		ossn_register_page('comment', 'ossn_comment_page');

		if(ossn_isLoggedin()) {
				ossn_register_callback('comment', 'load', 'ossn_comment_menu');
				ossn_register_callback('comment', 'load', 'ossn_comment_edit_menu');

				ossn_register_callback('post', 'delete', 'ossn_post_comments_delete');
				ossn_register_callback('object', 'deleted', 'ossn_object_comments_delete');
				//[E] There should be callback to delete entity likes, comments by default #1877
				ossn_register_callback('delete', 'entity', 'ossn_entity_comments_delete');

				ossn_register_callback('wall', 'load:item', 'ossn_wall_comment_menu');
				ossn_register_callback('entity', 'load:comment:share:like', 'ossn_entity_comment_link');
				ossn_register_callback('object', 'load:comment:share:like', 'ossn_object_comment_link');

				//[B] OssnNotification if poster and owner is same participants hook never run #2053
				ossn_register_callback('notification', 'owner:poster:match', 'ossn_comments_notify_participant');
				ossn_register_callback('notification', 'add', 'ossn_comments_notify_participant');

				ossn_register_callback('comment', 'delete', 'ossn_comment_notifications_delete');
		}
}
/**
 * Notify the comments participants
 *
 * @param string  $callback A callback name
 * @param string  $type A callback type
 * @param array   $vars Option values
 *
 * @return void
 */
function ossn_comments_notify_participant($callback, $type, $vars) {
		$comments = false;
		$entity   = false;
		$object   = false;
		$post     = false;
		if(ossn_call_hook('notification:participants', $vars['notification']['type'], null, true)) {
				if(!empty($vars['notification']['subject_guid']) && com_is_active('OssnNotifications')) {
						$OssnComments = new OssnComments();
						$subject_guid = $vars['notification']['subject_guid'];
						if(str_starts_with($vars['notification']['type'], 'comments:post')) {
								$comments = $OssnComments->getParticipant($subject_guid, 'post');
						}
						if(str_starts_with($vars['notification']['type'], 'comments:entity')) {
								$comments = $OssnComments->getParticipant($subject_guid, 'entity');
						}
						if(str_starts_with($vars['notification']['type'], 'comments:object')) {
								$comments = $OssnComments->getParticipant($subject_guid, 'object');
						}
						$guids = array();
						if($comments) {
								foreach($comments as $list) {
										//do not notify the poster (itself notification) if its guid match in participants
										if($list->owner_guid != $vars['notification']['poster_guid']) {
												array_push($guids, $list->owner_guid);
										}
								}
						}
						if(str_starts_with($vars['notification']['type'], 'comments:entity')) {
								$entity = ossn_get_entity($vars['notification']['subject_guid']);
								if($entity) {
										if($entity->type == 'object') {
												$object = ossn_get_object($entity->owner_guid);
												if($object->type == 'user') {
														$owner_type_guid = $object->owner_guid;
												}
										}
										if($entity->type == 'user') {
												$owner_type_guid = $entity->owner_guid;
										}
								}
						}
						if(str_starts_with($vars['notification']['type'], 'comments:object')) {
								$object = ossn_get_object($vars['notification']['subject_guid']);
								if($object && $object->type == 'user') {
										$owner_type_guid = $object->owner_guid;
								}
						}
						//post notification
						if(str_starts_with($vars['notification']['type'], 'comments:post')) {
								if(com_is_active('OssnWall')) {
										$wall     = new OssnWall();
										$postguid = $subject_guid;
										$post     = $wall->GetPost($postguid);
										if($post) {
												$owner_type_guid = $post->owner_guid;
												//group wall
												if ($post->type == 'group') { 
													$owner_type_guid = $post->poster_guid;
												}	
												//not for groups poster, owner match.
												if($post->type == 'user' && $type == 'owner:poster:match'){
														//means posted on different user	
														//and no one commented then
														if(!in_array($post->poster_guid, $guids)){
															array_push($guids, $post->poster_guid);
														}
												}
												//posted on someone else wall
												//someone commenting on post 
												if($post->type == 'user' && $post->owner_guid != $post->poster_guid){
														//now we need to check again notification poster guid not post poster guid
														//now add to notificaiton list to wall poster guid (not owner) if they are not same
														if($vars['notification']['poster_guid'] != $post->poster_guid && !in_array($post->poster_guid, $guids)){
																array_push($guids, $post->poster_guid);	
														}
												}
										}
								}
						}
						if(!empty($guids) && !empty($owner_type_guid)) {
								foreach($guids as $guid) {
										//no need to notify the object owner again as if its inside comments as
										//its already notified before this callback.
										if(intval($guid) != $owner_type_guid) {
												$notification = new OssnNotifications();
												$args         = ossn_call_hook('notification', 'add:participant', false, array(
														'notification' => $vars['notification'],
														'entity'       => $entity,
														'guid'		   => $guid,
														'object'       => $object,
														'post'         => $post,
												));
												$notification->notifyParticipant($guid, $args['notification']);
										}
								}
						}
				}
		}
}
/**
 * Delete like notifiactions
 *
 * Orphan notification after posting/comment has been deleted #609
 *
 * @param string  $callback A callback name
 * @param string  $type A callback type
 * @param array   $vars Option values
 *
 * @return void
 */
function ossn_comment_notifications_delete($callback, $type, $vars) {
		$delete = new OssnNotifications();
		if(isset($vars['comment']) && !empty($vars['comment'])) {
				//[B] getting orphan notification records of type comments:post:group:wall #2060
				$delete->deleteNotification(array(
						'item_guid' => $vars['comment'],
						'type'      => array(
								'comments:post',
								'like:annotation',
								'like:annotation:comments:post',
								'like:annotation:comments:object',
								'like:annotation:comments:entity',
								'comments:entity:file:profile:photo',
								'comments:entity:file:profile:cover',
								'comments:entity:file:ossn:aphoto',
								'comments:post:group:wall',
						),
				));
		}
}
/**
 * Entity comment link
 *
 * @param string  $callback A callback name
 * @param string  $type A callback type
 * @param array   $params Option values
 *
 * @return void
 */
function ossn_entity_comment_link($callback, $type, $params) {
		$guid = $params['entity']->guid;
		ossn_unregister_menu('comment', 'entityextra');
		if(isset($params['allow_comment']) && $params['allow_comment'] == false) {
				$guid = false;
				//false will just not execute the likes menu
		}
		if(!empty($guid) && ossn_isLoggedIn()) {
				ossn_register_menu_item('entityextra', array(
						'name'      => 'comment',
						'class'     => 'comment-entity',
						'href'      => 'javascript:void(0)',
						'data-guid' => $guid,
						'text'      => ossn_print('comment:comment'),
				));
		}
		ossn_trigger_callback('comment', 'entityextra:menu', $params);
}
/**
 * Object comment link
 *
 * @param string  $callback A callback name
 * @param string  $type A callback type
 * @param array   $params Option values
 *
 * @return void
 */
function ossn_object_comment_link($callback, $type, $params) {
		$guid = $params['object']->guid;
		//[B] Comment object menu not showing comment menu #2168
		ossn_unregister_menu('comment', 'object_extra');
		if(isset($params['allow_comment']) && $params['allow_comment'] == false) {
				$guid = false;
				//false will just not execute the likes menu
		}
		if(!empty($guid) && ossn_isLoggedIn()) {
				ossn_register_menu_item('object_extra', array(
						'name'      => 'comment',
						'class'     => 'comment-object',
						'href'      => 'javascript:void(0)',
						'data-guid' => $guid,
						'text'      => ossn_print('comment:comment'),
				));
		}
		ossn_trigger_callback('comment', 'object:comment:like:menu', $params);
}
/**
 * Add a comment menu item in post
 *
 * @return void
 */
function ossn_wall_comment_menu($callback, $type, $params) {
		$guid = $params['post']->guid;

		ossn_unregister_menu('comment', 'postextra');
		ossn_unregister_menu('commentall', 'postextra');

		if(!empty($guid)) {
				$comment = new OssnComments();
				ossn_register_menu_item('postextra', array(
						'name'      => 'comment',
						'class'     => 'comment-post',
						'href'      => 'javascript:void(0)',
						'data-guid' => $guid,
						'text'      => ossn_print('comment:comment'),
				));
				if($comment->countComments($guid) > 5) {
						ossn_register_menu_item('postextra', array(
								'name' => 'commentall',
								'href' => ossn_site_url("post/view/{$guid}"),
								'text' => ossn_print('comment:view:all'),
						));
				}
		}
}
/**
 * View comments bar on wall posts
 *
 * @return mix data;
 * @access private
 */
function ossn_post_comments($hook, $type, $return, $params) {
		return ossn_plugin_view('comments/post/comments', $params);
}

/**
 * View comments bar on object
 *
 * @return mix data;
 * @access private
 */
function ossn_object_comments_entity($hook, $type, $return, $params) {
		return ossn_plugin_view('comments/post/comments_object', $params);
}
/**
 * View comments bar on entity
 *
 * @return mix data;
 * @access private
 */
function ossn_post_comments_entity($hook, $type, $return, $params) {
		return ossn_plugin_view('comments/post/comments_entity', $params);
}

/**
 * Delete post comments
 *
 * @return void;
 * @access private
 */
function ossn_post_comments_delete($event, $type, $params) {
		$delete = new OssnComments();
		$delete->commentsDeleteAll($params);
}

/**
 * Delete post comments
 *
 * @return void;
 * @access private
 */
function ossn_object_comments_delete($event, $type, $params) {
		if(isset($params['guid'])) {
				$delete = new OssnComments();
				$delete->commentsDeleteAll($params['guid'], 'object');
		}
}
/**
 * Delete entities comments
 *
 * @return void;
 * @access private
 */
function ossn_entity_comments_delete($event, $type, $params) {
		if(isset($params['entity'])) {
				$delete = new OssnComments();
				$delete->commentsDeleteAll($params['entity'], 'entity');
		}
}
/**
 * Delete comment menu
 *
 * @param string $name Name of Callback
 * @param strign $type Callback type
 * @param array  $params A option values
 *
 * @return void
 * @access private
 */
function ossn_comment_menu($name, $type, $params) {
		//unset previous comment menu item
		//Post owner can not delete others comments #607
		//Pull request #601 , refactoring
		ossn_unregister_menu('delete', 'comments');
		$user = ossn_loggedin_user();

		$OssnComment = new OssnComments();
		if(is_object($params)) {
				$params = get_object_vars($params);
		}
		$comment = $OssnComment->getComment($params['id']);
		if($comment->type == 'comments:post') {
				if(com_is_active('OssnWall')) {
						$ossnwall = new OssnWall();
						$post     = $ossnwall->GetPost($comment->subject_guid);

						//check if type is group
						if($post->type == 'group') {
								$group = ossn_get_group_by_guid($post->owner_guid);
						} else {
								$group = false;
						}
						//group admins must be able to delete ANY comment in their own group #170
						//just show menu if group owner is loggedin
						//21-04-2022 [E] isModerator (for groups) in comments section also. #2025
						if(
								ossn_isAdminLoggedin() ||
								ossn_loggedin_user()->guid == $post->owner_guid ||
								($comment && $user->guid == $comment->owner_guid) ||
								($group && ((ossn_loggedin_user()->guid == $group->owner_guid) || $group->isModerator($user->guid)))
						) {
								ossn_unregister_menu('delete', 'comments');
								ossn_register_menu_item('comments', array(
										'name'     => 'delete',
										'href'     => ossn_site_url("action/delete/comment?comment={$params['id']}", true),
										'class'    => 'dropdown-item ossn-delete-comment',
										'text'     => ossn_print('comment:delete'),
										'priority' => 200,
								));
						}
				}
		}
		//delete object comments
		if($comment->type == 'comments:object') {
				$object = ossn_get_object($comment->subject_guid);
				if($object) {
						if(ossn_isAdminLoggedin() || ($object->type == 'user' && ossn_loggedin_user()->guid == $object->owner_guid) || $user->guid == $comment->owner_guid) {
								ossn_unregister_menu('delete', 'comments');
								ossn_register_menu_item('comments', array(
										'name'     => 'delete',
										'href'     => ossn_site_url("action/delete/comment?comment={$params['id']}", true),
										'class'    => 'dropdown-item ossn-delete-comment',
										'text'     => ossn_print('comment:delete'),
										'priority' => 200,
								));
						}
				}
		}
		//this section is for entity comment only
		if(ossn_isLoggedin() && $comment->type == 'comments:entity') {
				$entity = ossn_get_entity($comment->subject_guid);
				if($user->guid == $params['owner_guid'] || ossn_isAdminLoggedin() || ($comment->type == 'comments:entity' && ($entity->type = 'user' && $user->guid == $entity->owner_guid))) {
						ossn_unregister_menu('delete', 'comments');
						ossn_register_menu_item('comments', array(
								'name'     => 'delete',
								'href'     => ossn_site_url("action/delete/comment?comment={$params['id']}", true),
								'class'    => 'dropdown-item ossn-delete-comment',
								'text'     => ossn_print('comment:delete'),
								'priority' => 200,
						));
				}
		}
}
/**
 * Comment Edit Menu
 *
 * @param string $name Name of Callback
 * @param strign $type Callback type
 * @param array  $params A option values
 *
 * @return void;
 */
function ossn_comment_edit_menu($name, $type, $comment) {
		ossn_unregister_menu('edit', 'comments');
		$user = ossn_loggedin_user();
		if(!empty($comment['id'])) {
				$comment = (object) $comment;
				if(ossn_isLoggedin()) {
						if($user->guid == $comment->owner_guid || $user->canModerate()) {
								ossn_unregister_menu('edit', 'comments');
								ossn_register_menu_item('comments', array(
										'name'      => 'edit',
										'href'      => 'javascript:void(0);',
										'data-guid' => $comment->id,
										'class'     => 'dropdown-item ossn-edit-comment',
										'text'      => ossn_print('edit'),
								));
						}
				}
		}
}

/**
 * Comment page for viewing comment photos
 *
 * @access private;
 */
function ossn_comment_page($pages) {
		$page = $pages[0];
		switch($page) {
			case 'image':
				$comment = ossn_get_comment($pages[1]);
				if(!empty($pages[1]) && !empty($pages[2])  && $comment) {		
						$file = $comment->getPhotoFile();
						if(!$file){
							ossn_error_page();	
						}
						$file->output();
				} else {
						ossn_error_page();
				}
				break;
			case 'attachment':
				header('Content-Type: application/json');
				$OssnFile = new OssnFile();
				if(!empty($_FILES['file']['tmp_name']) && ($_FILES['file']['error'] == UPLOAD_ERR_OK && $_FILES['file']['size'] !== 0) && ossn_isLoggedin()) {
						if(preg_match('/image/i', $_FILES['file']['type'])) {
								//code of comment picture preview ignores EXIF header #1056
								$OssnFile->resetRotation($_FILES['file']['tmp_name']);
								$file    = $_FILES['file']['tmp_name'];
								$unique  = time() . '-' . substr(md5(time()), 0, 6) . '.jpg';
								$newfile = ossn_get_userdata("tmp/photos/{$unique}");
								$dir     = ossn_get_userdata('tmp/photos/');
								if(!is_dir($dir)) {
										mkdir($dir, 0755, true);
								}
								if(move_uploaded_file($file, $newfile)) {
										//[B] Comment Static photo should have only filename no fullpath #2090
										$file = base64_encode(ossn_string_encrypt($unique));
										echo json_encode(array(
												'file' => base64_encode($file),
												'success' => 1,
										));
										exit();
								}
						} 
				}
				if(empty($_FILES['file']['tmp_name'])) {
						$error = $OssnFile->getFileUploadError($_FILES['file']['error']);
				} else {
						$error = $OssnFile->getFileUploadError(UPLOAD_ERR_EXTENSION);
				}
				$params = array(
						'title' => ossn_print('system:error:title'),
						'contents' => $error,
						'callback' => false,
						'control' => false,
				);
				echo json_encode(array(
						'error' => ossn_plugin_view('output/ossnbox', $params),
						'success' => 0,
				));
				exit();
				break;
			case 'staticimage':
				$image = base64_decode(input('image'));
				if(!empty($image)) {
						$file = ossn_string_decrypt(base64_decode($image));
						header('content-type: image/jpeg');
						$file = rtrim(ossn_validate_filepath($file), '/');
						$tmpphotos = ossn_get_userdata('tmp/photos/');
						$filename  = str_replace($tmpphotos, '', $file);
						$file      = $tmpphotos . $file;
						//avoid slashes in the file.
						if(strpos($filename, '\\') !== false || strpos($filename, '/') !== false) {
								redirect();
						} else {
								if(is_file($file)) {
										echo file_get_contents($file);
								} else {
										redirect();
								}
						}
				} else {
						ossn_error_page();
				}
				break;
			case 'edit':
				$comment = ossn_get_annotation($pages[1]);
				if(!ossn_is_xhr()) {
						ossn_error_page();
				}
				if(!$comment) {
						header('HTTP/1.0 404 Not Found');
				}
				$user = ossn_loggedin_user();
				if($comment->owner_guid == $user->guid || $user->canModerate()) {
						$params = array(
								'title'    => ossn_print('edit'),
								'contents' => ossn_view_form(
										'comment/edit',
										array(
												'action'    => ossn_site_url('action/comment/edit'),
												'component' => 'OssnComments',
												'id'        => 'ossn-comment-edit-form',
												'params'    => array(
														'comment' => $comment,
												),
										),
										false
								),
								'callback' => '#ossn-comment-edit-save',
						);
						echo ossn_plugin_view('output/ossnbox', $params);
				}
				break;
			default:
				ossn_error_page();
		}
}
/**
 * Comment view
 *
 * @param array $vars Options
 * @param string $template Template name
 * @return mixed data
 */
function ossn_comment_view($params, $template = 'comment') {
		$vars = ossn_call_hook('comment:view', 'template:params', $params, $params);
		return ossn_plugin_view("comments/templates/{$template}", $vars);
}
ossn_register_callback('ossn', 'init', 'ossn_comments');
