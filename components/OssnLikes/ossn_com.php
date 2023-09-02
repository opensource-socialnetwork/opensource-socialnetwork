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

define('__OSSN_LIKES__', ossn_route()->com . 'OssnLikes/');
require_once __OSSN_LIKES__ . 'classes/OssnLikes.php';
/**
 * Initialize Likes Component
 *
 * @return void;
 * @access private
 */
function ossn_likes(){
		if(ossn_isLoggedin()){
				ossn_register_action('post/like', __OSSN_LIKES__ . 'actions/post/like.php');
				ossn_register_action('post/unlike', __OSSN_LIKES__ . 'actions/post/unlike.php');

				ossn_register_action('annotation/like', __OSSN_LIKES__ . 'actions/annotation/like.php');
				ossn_register_action('annotation/unlike', __OSSN_LIKES__ . 'actions/annotation/unlike.php');
		}
		ossn_extend_view('js/ossn.site', 'js/likes/main');
		//ossn.site is only for loggedin members so move view likes to public js
		ossn_extend_view('js/ossn.site.public', 'js/likes/viewlikes');
		ossn_extend_view('css/ossn.default', 'css/likes');

		ossn_register_callback('post', 'delete', 'ossn_post_like_delete');
		ossn_register_callback('object', 'deleted', 'ossn_object_likes_delete');
		//[E] There should be callback to delete entity likes, comments by default #1877
		ossn_register_callback('delete', 'entity', 'ossn_entity_likes_delete');
		
		ossn_register_callback('comment', 'delete', 'ossn_comment_like_delete');
		ossn_register_callback('annotation', 'delete', 'ossn_comment_like_delete');
		ossn_register_callback('user', 'delete', 'ossn_user_likes_delete');
		ossn_register_callback('wall', 'load:item', 'ossn_wall_like_menu', 1);

		ossn_register_callback('entity', 'load:comment:share:like', 'ossn_entity_like_link', 1);
		ossn_register_callback('object', 'load:comment:share:like', 'ossn_object_like_link', 1);

		ossn_register_page('likes', 'ossn_likesview_page_handler');

		ossn_add_hook('notification:view', 'like:annotation:comments:post', 'ossn_like_annotation');
		ossn_add_hook('notification:view', 'like:annotation:comments:entity', 'ossn_like_annotation');
		ossn_add_hook('post', 'likes', 'ossn_post_likes');

		ossn_add_hook('post', 'likes:entity', 'ossn_post_likes_entity');
		ossn_add_hook('post', 'likes:object', 'ossn_post_likes_object');

		ossn_add_hook('notification:participants', 'like:post', 'ossn_likes_suppress_participants_notifications');
		ossn_add_hook('notification:participants', 'like:annotation', 'ossn_likes_suppress_participants_notifications');
		ossn_add_hook('notification:participants', 'like:post:group:wall', 'ossn_likes_suppress_participants_notifications');
}
/**
 * Add a like menu item in post
 *
 * @return void
 */
function ossn_wall_like_menu($callback, $type, $params){
		$guid = $params['post']->guid;

		ossn_unregister_menu('like', 'postextra');

		if(ossn_loggedin_user() && !empty($guid)){
				$likes = new OssnLikes();
				if(!$likes->isLiked($guid, ossn_loggedin_user()->guid)){
						ossn_register_menu_item('postextra', array(
								'name'          => 'like',
								'href'          => 'javascript:void(0);',
								'id'            => 'ossn-like-' . $guid,
								'data-reaction' => "Ossn.PostLike({$guid}, '<<reaction_type>>');",
								'text'          => ossn_print('ossn:like'),
						));
				} else {
						ossn_register_menu_item('postextra', array(
								'name'    => 'like',
								'href'    => 'javascript:void(0);',
								'id'      => 'ossn-like-' . $guid,
								'onclick' => "Ossn.PostUnlike({$guid});",
								'text'    => ossn_print('ossn:unlike'),
						));
				}
		}
}
/**
 * Add a entity like menu item
 *
 * @return void
 */
function ossn_entity_like_link($callback, $type, $params){
		$guid = $params['entity']->guid;

		ossn_unregister_menu('like', 'entityextra');
		if(isset($params['allow_like']) && $params['allow_like'] == false){
				$guid = false;
				//false will just not execute the likes menu
		}
		if(ossn_loggedin_user() && !empty($guid)){
				$likes = new OssnLikes();
				if(!$likes->isLiked($guid, ossn_loggedin_user()->guid, 'entity')){
						ossn_register_menu_item('entityextra', array(
								'name'          => 'like',
								'href'          => 'javascript:void(0);',
								'id'            => 'ossn-elike-' . $guid,
								'data-reaction' => "Ossn.EntityLike({$guid}, '<<reaction_type>>');",
								'text'          => ossn_print('ossn:like'),
						));
				} else {
						ossn_register_menu_item('entityextra', array(
								'name'    => 'like',
								'href'    => 'javascript:void(0);',
								'id'      => 'ossn-elike-' . $guid,
								'onclick' => "Ossn.EntityUnlike({$guid});",
								'text'    => ossn_print('ossn:unlike'),
						));
				}
		}
}
/**
 * Add a object like menu item
 *
 * @return void
 */
function ossn_object_like_link($callback, $type, $params){
		$guid = $params['object']->guid;

		ossn_unregister_menu('like', 'object_extra');
		if(isset($params['allow_like']) && $params['allow_like'] == false){
				$guid = false;
				//false will just not execute the likes menu
		}
		if(!empty($guid)){
				$likes = new OssnLikes();
				if(!$likes->isLiked($guid, ossn_loggedin_user()->guid, 'object')){
						ossn_register_menu_item('object_extra', array(
								'name'          => 'like',
								'href'          => 'javascript:void(0);',
								'id'            => 'ossn-olike-' . $guid,
								'data-reaction' => "Ossn.ObjectLike({$guid}, '<<reaction_type>>');",
								'text'          => ossn_print('ossn:like'),
						));
				} else {
						ossn_register_menu_item('object_extra', array(
								'name'    => 'like',
								'href'    => 'javascript:void(0);',
								'id'      => 'ossn-olike-' . $guid,
								'onclick' => "Ossn.ObjectUnlike({$guid});",
								'text'    => ossn_print('ossn:unlike'),
						));
				}
		}
}
/**
 * Delete post likes
 *
 * @return voud;
 * @access private
 */
function ossn_post_like_delete($name, $type, $params){
		$delete = new OssnLikes();
		$delete->deleteLikes($params);
}
/**
 * Delete object likes
 *
 * @return voud;
 * @access private
 */
function ossn_object_likes_delete($name, $type, $params){
		if(isset($params['guid'])){
			$delete = new OssnLikes();
			$delete->deleteLikes($params['guid'], 'object');
		}
}
/**
 * Delete object likes
 *
 * @return voud;
 * @access private
 */
function ossn_entity_likes_delete($name, $type, $params){
		if(isset($params['entity'])){
			$delete = new OssnLikes();
			$delete->deleteLikes($params['entity'], 'entity');
		}
}
/**
 * Delete user likes
 *
 * @return voud;
 * @access private
 */
function ossn_user_likes_delete($name, $type, $entity){
		$delete = new OssnLikes();
		$delete->deleteLikesByOwnerGuid($entity['entity']->guid);
}
/**
 * Comment likes delete
 *
 * @return voud;
 * @access private
 */
function ossn_comment_like_delete($name, $type, $params){
		$delete = new OssnLikes();
		if(isset($params['comment'])){
				$delete->deleteLikes($params['comment'], 'annotation');
				if(isset($params['annotation'])){
						$delete->deleteLikes($params['annotation'], 'annotation');
				}
		}
}

/**
 * Notification View for liking annotation
 *
 * @return voud;
 * @access private
 */
function ossn_like_annotation($hook, $type, $return, $params){
		$notif   = $params;
		$user    = ossn_user_by_guid($notif->poster_guid);
		$display = true;
		if(!$user){
			return false;	
		}
		switch($notif->type){
			case 'like:annotation:comments:entity':
				$display  = true;
				$database = new OssnDatabase();
				$database->statement("SELECT * FROM ossn_entities WHERE(guid='{$notif->subject_guid}')");
				$database->execute();
				$result = $database->fetch();
				if($result->subtype == 'file:ossn:aphoto'){
						$url = ossn_site_url("photos/view/{$notif->subject_guid}#comments-item-{$notif->item_guid}");
				}
				if($result->subtype == 'file:profile:photo'){
						$url = ossn_site_url("photos/user/view/{$notif->subject_guid}#comments-item-{$notif->item_guid}");
				}
				if($result->subtype == 'file:profile:cover'){
						$url = ossn_site_url("photos/cover/view/{$notif->subject_guid}#comments-item-{$notif->item_guid}");
				}
				if($result->subtype == 'file:video'){
						$url = ossn_site_url("video/view/{$result->owner_guid}#comments-item-{$notif->item_guid}");
				}
				break;
			case 'like:annotation:comments:post':
				$display = true;
				$url     = ossn_site_url("post/view/{$notif->subject_guid}#comments-item-{$notif->item_guid}");
				break;
		}

		if(!$display){
				return false;
		}
		$iconURL = $user->iconURL()->small;
		return ossn_plugin_view('notifications/template/view', array(
				'iconURL'   => $iconURL,
				'guid'      => $notif->guid,
				'type'      => 'like:annotation',
				'viewed'    => $notif->viewed,
				'url'       => $url,
				'icon_type' => 'like',
				'fullname'  => $user->fullname,
		));
}

/**
 * View like bar for posts
 *
 * @return mix data;
 * @access private
 */
function ossn_post_likes($hook, $type, $return, $params){
		return ossn_plugin_view('likes/post/likes', $params);
}

/**
 * View like bar for entities
 *
 * @return mix data;
 * @access private
 */
function ossn_post_likes_entity($h, $t, $r, $p){
		return ossn_plugin_view('likes/post/likes_entity', $p);
}
/**
 * View like bar for objects
 *
 * @return mix data;
 * @access private
 */
function ossn_post_likes_object($h, $t, $r, $p){
		return ossn_plugin_view('likes/post/likes_object', $p);
}

/**
 * Don't create participants notification records on likes
 *
 * @return false;
 * @access private
 */
function ossn_likes_suppress_participants_notifications($h, $t, $r, $p){
		$notifyParticipants = false;
		return $notifyParticipants;
}

/**
 * View post likes modal box
 *
 * @return mix data;
 * @access public;
 */
function ossn_likesview_page_handler(){
		echo ossn_plugin_view('output/ossnbox', array(
				'title'    => ossn_print('people:like:this'),
				'contents' => ossn_plugin_view('likes/pages/view'),
				'control'  => false,
		));
}
ossn_register_callback('ossn', 'init', 'ossn_likes');
