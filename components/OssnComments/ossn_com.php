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
define('__OSSN_COMMENTS__', ossn_route()->com.'OssnComments/');
require_once(__OSSN_COMMENTS__.'classes/OssnComments.php');
function ossn_comments(){
if(ossn_isLoggedin()){
		
ossn_register_action('post/comment', __OSSN_COMMENTS__.'actions/post/comment.php');
ossn_register_action('post/entity/comment', __OSSN_COMMENTS__.'actions/post/entity/comment.php');

}
ossn_add_hook('post', 'comments', 'ossn_post_comments');
ossn_add_hook('post', 'comments:entity', 'ossn_post_comments_entity');

ossn_extend_view('js/opensource.socialnetwork', 'components/OssnComments/js/OssnComments');

}
function ossn_post_comments($h, $t, $r, $p){
 return ossn_view('components/OssnComments/post/comments', $p);	
}
function ossn_post_comments_entity($h, $t, $r, $p){
 return ossn_view('components/OssnComments/post/comments_entity', $p);	
}
ossn_register_callback('post', 'delete', 'ossn_post_comments_delete');
function ossn_post_comments_delete($event, $type, $params){
	$delete = new OssnComments;
	$delete->commentsDeleteAll($params);
}
ossn_register_callback('ossn', 'init', 'ossn_comments');
