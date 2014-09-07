<?php
/**
 * OpenSocialWebsite
 *
 * @package   OpenSocialWebsite
 * @author    Open Social Website Core Team <info@opensocialwebsite.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensocialwebsite.com/licence 
 * @link      http://www.opensocialwebsite.com/licence
 */
 
define('__OSSN_LIKES__', ossn_route()->com.'OssnLikes/');
require_once(__OSSN_LIKES__.'classes/OssnLikes.php');
function ossn_likes(){

  if(ossn_isLoggedin()){
  ossn_register_action('post/like', __OSSN_LIKES__.'actions/post/like.php');
  ossn_register_action('post/unlike', __OSSN_LIKES__.'actions/post/unlike.php'); 

  ossn_register_action('annotation/like', __OSSN_LIKES__.'actions/annotation/like.php');
  ossn_register_action('annotation/unlike', __OSSN_LIKES__.'actions/annotation/unlike.php'); 

  }
  ossn_extend_view('js/opensource.socialnetwork', 'components/OssnLikes/js/OssnLikes');

  ossn_register_callback('post', 'delete', 'ossn_post_like_delete');
  ossn_register_page('likes', 'ossn_likesview_page_handler'); 
 
  ossn_add_hook('notification:view', 'like:annotation', 'ossn_like_annotation');
}
function ossn_post_like_delete($event, $type, $params){
	$delete = new OssnLikes;
	$delete->deleteLikes($params);
}
function ossn_like_annotation($hook, $type, $return, $params){
  	$notif = $params;
    $baseurl = ossn_site_url();
	$user = ossn_user_by_guid($notif->poster_guid);
	$user->fullname = "<strong>{$user->fullname}</strong>"; 
	
	$img = "<div class='notification-image'><img src='{$baseurl}/avatar/{$user->username}/small' /></div>";
	if(preg_match('/like/i', $notif->type)){
	 $type = 'like';
	  $database = new OssnDatabase;
	  $database->statement("SELECT * FROM ossn_entities WHERE(guid='{$notif->subject_guid}')");
	  $database->execute();
	  $result = $database ->fetch();
	 
	   $url = ossn_site_url("post/view/{$notif->subject_guid}#comments-item-{$notif->item_guid}");
	  if($result->subtype == 'file:ossn:aphoto'){
	   $url = ossn_site_url("photos/view/{$notif->subject_guid}#comments-item-{$notif->item_guid}");
	  }
	}
	$type = "<div class='ossn-notification-icon-{$type}'></div>";
	if($notif->viewed !== NULL){
	   $viewed = '';
    }  elseif($notif->viewed == NULL){
	   $viewed = 'class="ossn-notification-unviewed"';
	}
	$notification_read = "{$baseurl}notification/read/{$notif->guid}?notification=".urlencode($url);
	return "<a href='{$notification_read}'>
	       <li {$viewed}> {$img} 
		   <div class='notfi-meta'> {$type}
		   <div class='data'>".ossn_print("ossn:notifications:{$notif->type}", array($user->fullname)).'</div>
		   </div></li>';
}

ossn_add_hook('post', 'likes', 'ossn_post_likes');
ossn_add_hook('post', 'likes:entity', 'ossn_post_likes_entity');
function ossn_post_likes($h, $t, $r, $p){
 return ossn_view('components/OssnLikes/post/likes', $p);	
}
function ossn_post_likes_entity($h, $t, $r, $p){
 return ossn_view('components/OssnLikes/post/likes_entity', $p);	
}
function ossn_likesview_page_handler(){
	  echo ossn_view('system/templates/ossnbox', array(
												 'title' => ossn_print('people:like:this'),
												 'contents' => ossn_view('components/OssnLikes/pages/view'),
												 'control' => false,
									));
}

ossn_register_callback('ossn', 'init', 'ossn_likes');
