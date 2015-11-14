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
define('__OSSN_COMMENTS__', ossn_route()->com . 'OssnComments/');
require_once(__OSSN_COMMENTS__ . 'classes/OssnComments.php');
require_once(__OSSN_COMMENTS__ . 'libs/comments.php');

/**
 * Initialize Comments Component
 *
 * @return void;
 * @access private
 */
function ossn_comments() {
    if (ossn_isLoggedin()) {
        ossn_register_action('post/comment', __OSSN_COMMENTS__ . 'actions/post/comment.php');
        ossn_register_action('post/entity/comment', __OSSN_COMMENTS__ . 'actions/post/entity/comment.php');
        ossn_register_action('delete/comment', __OSSN_COMMENTS__ . 'actions/comment/delete.php');
    }
    ossn_add_hook('post', 'comments', 'ossn_post_comments');
    ossn_add_hook('post', 'comments:entity', 'ossn_post_comments_entity');

    ossn_register_callback('comment', 'load', 'ossn_comment_menu');

    ossn_extend_view('js/opensource.socialnetwork', 'js/OssnComments');
    ossn_extend_view('css/ossn.default', 'css/comments');

    ossn_register_page('comment', 'ossn_comment_page');

    ossn_register_callback('post', 'delete', 'ossn_post_comments_delete');
	ossn_register_callback('wall', 'load:item', 'ossn_wall_comment_menu');
	ossn_register_callback('entity', 'load:comment:share:like', 'ossn_entity_comment_link');
}
function ossn_entity_comment_link($callback, $type, $params){
	$guid = $params['entity']->guid;
	ossn_unregister_menu('comment', 'entityextra'); 
	
	if(!empty($guid) && ossn_isLoggedIn()){
		ossn_register_menu_item('entityextra', array(
				'name' => 'comment', 
				'class' => "comment-post",
				'href' => "javascript::void(0)",
				'data-guid' => $guid,
				'text' => ossn_print('comment:comment'),
		));	
	}	
}
/**
 * Add a comment menu item in post
 *
 * @return void
 */
function ossn_wall_comment_menu($callback, $type, $params){
	$guid = $params['post']->guid;
	
	ossn_unregister_menu('comment', 'postextra'); 
	ossn_unregister_menu('commentall', 'postextra'); 
	
	if(!empty($guid)){
		$comment = new OssnComments;
		ossn_register_menu_item('postextra', array(
				'name' => 'comment', 
				'class' => "comment-post",
				'href' => "javascript::void(0)",
				'data-guid' => $guid,
				'text' => ossn_print('comment:comment'),
		));	
		if ($comment->countComments($guid) > 5) {
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
    $delete = new OssnComments;
    $delete->commentsDeleteAll($params);
}

/**
 * Delete comment menu
 *
 * @return voud;
 * @access private
 */
function ossn_comment_menu($name, $type, $params) {
	//unset previous comment menu item
	//Post owner can not delete others comments #607
	//Pull request #601 , refactoring
	ossn_unregister_menu('delete', 'comments');	
	$user = ossn_loggedin_user();
	
    $OssnComment = new OssnComments;
    if (is_object($params)) {
        $params = get_object_vars($params);
    }
    $comment = $OssnComment->getComment($params['id']);
    if ($comment->type == 'comments:post') {
        if (com_is_active('OssnWall')) {
            $ossnwall = new OssnWall;
            $post = $ossnwall->GetPost($comment->subject_guid);
			
			//check if type is group
			if($post->type == 'group'){
				$group = ossn_get_group_by_guid($post->owner_guid);
			}
			//group admins must be able to delete ANY comment in their own group #170
			//just show menu if group owner is loggedin 
            if ((ossn_loggedin_user()->guid == $post->owner_guid) || $user->guid == $comment->owner_guid ||(ossn_loggedin_user()->guid == $group->owner_guid)) {
                ossn_unregister_menu('delete', 'comments');
				ossn_register_menu_item('comments', array(
					'name' => 'delete',
                    'href' => ossn_site_url("action/delete/comment?comment={$params['id']}", true),
                    'class' => 'ossn-delete-comment',
					'text' => ossn_print('comment:delete'),
                ));
            }
        }
    }
	//this section is for entity comment only
	if(ossn_isLoggedin() && $comment->type == 'comments:entity'){
	  $entity = ossn_get_entity($comment->subject_guid);  
      if (($user->guid == $params['owner_guid']) || ossn_isAdminLoggedin() 
		|| ($comment->type == 'comments:entity' && $entity->type = 'user' && $user->guid == $entity->owner_guid)) {
		 	ossn_unregister_menu('delete', 'comments');	
			ossn_register_menu_item('comments', array(
			  'name' => 'delete',
              'href' => ossn_site_url("action/delete/comment?comment={$params['id']}", true),
              'class' => 'ossn-delete-comment',
			  'text' => ossn_print('comment:delete'),
          ));
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
    switch ($page) {
        case 'image':
            if (!empty($pages[1]) && !empty($pages[2])) {
                $file = ossn_get_userdata("annotation/{$pages[1]}/comment/photo/{$pages[2]}");
                header('Content-Type: image/jpeg');
                if (is_file($file)) {
                    echo ossn_resize_image($file, 300, 300);
                } else {
                    ossn_error_page();
                }
            } else {
                ossn_error_page();
            }
            break;
        case 'attachment':
            header('Content-Type: application/json');
            if (isset($_FILES['file']['tmp_name']) && ossn_isLoggedin()) {
                $file = $_FILES['file']['tmp_name'];
                $unique = time() . '-' . substr(md5(time()), 0, 6) . '.jpg';
                $newfile = ossn_get_userdata("tmp/photos/{$unique}");
                $dir = ossn_get_userdata("tmp/photos/");
                if (!is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }
                if (move_uploaded_file($file, $newfile)) {
                    $file = base64_encode(ossn_string_encrypt($newfile));
                    echo json_encode(array(
                            'file' => base64_encode($file),
                            'type' => 1,
                        ));
                    exit;
                }
            }
            echo json_encode(array('type' => 0,));
            break;
        case 'staticimage' :
            $image = base64_decode(input('image'));
            if (!empty($image)) {
                $file = ossn_string_decrypt(base64_decode($image));
                header('content-type: image/jpeg');
                $file = rtrim(ossn_validate_filepath($file), '/');
                if (is_file($file)) {
                    echo file_get_contents($file);
                } else {
                    ossn_error_page();
                }
            } else {
                ossn_error_page();
            }
            break;
    }
}
/**
 * Comment view
 * 
 * @param array $vars Options
 * @param string $template Template name
 * @return mixed data
 */
 function ossn_comment_view($params, $template = 'comment'){
	 $vars = ossn_call_hook('comment:view', 'template:params', $params, $params);
	 return  ossn_plugin_view("comments/templates/{$template}", $vars);
 }
ossn_register_callback('ossn', 'init', 'ossn_comments');