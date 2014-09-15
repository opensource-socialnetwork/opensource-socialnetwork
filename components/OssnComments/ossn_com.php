<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence 
 * @link      http://www.opensource-socialnetwork.org/licence
 */
define('__OSSN_COMMENTS__', ossn_route()->com.'OssnComments/');
require_once(__OSSN_COMMENTS__.'classes/OssnComments.php');
/**
* Initialize Comments Component
*
* @return void;
* @access private
*/
function ossn_comments(){
 if(ossn_isLoggedin()){	
  ossn_register_action('post/comment', __OSSN_COMMENTS__.'actions/post/comment.php');
  ossn_register_action('post/entity/comment', __OSSN_COMMENTS__.'actions/post/entity/comment.php');
  ossn_register_action('delete/comment', __OSSN_COMMENTS__.'actions/comment/delete.php');
 }
  ossn_add_hook('post', 'comments', 'ossn_post_comments');
  ossn_add_hook('post', 'comments:entity', 'ossn_post_comments_entity');
  ossn_register_callback('comment', 'load', 'ossn_comment_menu');
  
  ossn_extend_view('js/opensource.socialnetwork', 'components/OssnComments/js/OssnComments');
  ossn_extend_view('css/ossn.default', 'components/OssnComments/css/comments');

  ossn_register_callback('post', 'delete', 'ossn_post_comments_delete');

}
/**
* View comments bar on wall posts
*
* @return mix data;
* @access private
*/
function ossn_post_comments($hook, $type, $return, $params){
 return ossn_view('components/OssnComments/post/comments', $params);	
}
/**
* View comments bar on entity
*
* @return mix data;
* @access private
*/
function ossn_post_comments_entity($hook, $type, $return, $params){
 return ossn_view('components/OssnComments/post/comments_entity', $params);	
}
/**
* Delete post comments
*
* @return voud;
* @access private
*/
function ossn_post_comments_delete($event, $type, $params){
	$delete = new OssnComments;
	$delete->commentsDeleteAll($params);
}
function ossn_comment_menu($name, $type, $params){
	ossn_unregister_menu('delete', 'comments'); 	

    $OssnComment = new OssnComments; 
    $comment = $OssnComment->getComment($params['id']);  
    if($comment->type == 'comments:post'){
	   if(com_is_active('OssnWall')){
	   $ossnwall = new OssnWall;
	   $post = $ossnwall->GetPost($comment->subject_guid);
         if(ossn_loggedin_user()->guid == $post->owner_guid){
		   ossn_register_menu_link('delete', ossn_print('comment:delete'), array(
	          'href' => ossn_site_url("action/delete/comment?comment={$params['id']}"),
	         'class' => 'ossn-delete-comment',
	       ), 'comments');		   
	     }
	   }
   } 
   if((ossn_loggedin_user()->guid == $params['owner_guid']) || ossn_isAdminLoggedin()){	
	   ossn_register_menu_link('delete', ossn_print('comment:delete'), array(
	      'href' => ossn_site_url("action/delete/comment?comment={$params['id']}"),
	      'class' => 'ossn-delete-comment',
	      ), 'comments');		
   } 
}
ossn_register_callback('ossn', 'init', 'ossn_comments');
