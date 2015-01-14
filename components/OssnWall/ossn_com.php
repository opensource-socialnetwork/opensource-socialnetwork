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
define('__OSSN_WALL__', ossn_route()->com . 'OssnWall/');
require_once(__OSSN_WALL__ . 'classes/OssnWall.php');

function ossn_wall() {
    //actions
    if (ossn_isLoggedin()) {
        ossn_register_action('wall/post/a', __OSSN_WALL__ . 'actions/wall/post/home.php');
        ossn_register_action('wall/post/u', __OSSN_WALL__ . 'actions/wall/post/user.php');
        ossn_register_action('wall/post/g', __OSSN_WALL__ . 'actions/wall/post/group.php');
        ossn_register_action('wall/post/delete', __OSSN_WALL__ . 'actions/wall/post/delete.php');
    }
    //css and js
    ossn_extend_view('css/ossn.default', 'components/OssnWall/css/wall');
    ossn_extend_view('js/opensource.socialnetwork', 'components/OssnWall/js/ossn_wall');

    //pages
    ossn_register_page('post', 'ossn_post_page');
    ossn_register_page('friendpicker', 'ossn_friend_picker');

    //hooks
    ossn_add_hook('notification:view', 'like:post', 'ossn_likes_post_notifiation');
    ossn_add_hook('notification:view', 'comments:post', 'ossn_likes_post_notifiation');
    ossn_add_hook('notification:view', 'wall:friends:tag', 'ossn_likes_post_notifiation');
    ossn_add_hook('notification:view', 'comments:post:group:wall', 'ossn_group_comment_post');
	ossn_add_hook('notification:view', 'like:post:group:wall', 'ossn_group_comment_post');

    ossn_add_hook('wall', 'post:menu', 'ossn_wall_post_menu');
    
	//templates
	ossn_add_hook('wall:template', 'user', 'ossn_wall_templates');
	ossn_add_hook('wall:template', 'group', 'ossn_wall_templates');
	
   //callbacks
   ossn_register_callback('group', 'delete', 'ossn_group_wall_delete');   
   ossn_register_callback('user', 'delete', 'ossn_user_posts_delete');
}

function ossn_friend_picker() {
    header('Content-Type: application/json');
    if (!ossn_isLoggedin()) {
        exit;
    }
    $user = new OssnUser;
    $friends = $user->getFriends(ossn_loggedin_user()->guid);
    if (!$friends) {
        return false;
    }
    foreach ($friends as $users) {
        $p['first_name'] = $users->first_name;
        $p['last_name'] = $users->last_name;
        $p['imageurl'] = ossn_site_url("avatar/{$users->username}/smaller");
        $p['id'] = $users->guid;
        $usera[] = $p;
    }
    echo json_encode($usera);
}

function ossn_likes_post_notifiation($hook, $type, $return, $params) {
    $notif = $params;
    $baseurl = ossn_site_url();
    $user = ossn_user_by_guid($notif->poster_guid);
    $user->fullname = "<strong>{$user->fullname}</strong>";

    $img = "<div class='notification-image'><img src='{$baseurl}/avatar/{$user->username}/small' /></div>";
    $url = ossn_site_url("post/view/{$notif->subject_guid}");

    if (preg_match('/like/i', $notif->type)) {
        $type = 'like';
    }
    if (preg_match('/tag/i', $notif->type)) {
        $type = 'tag';
    }
    if (preg_match('/comments/i', $notif->type)) {
        $type = 'comment';
        $url = ossn_site_url("post/view/{$notif->subject_guid}#comments-item-{$notif->item_guid}");
    }
    $type = "<div class='ossn-notification-icon-{$type}'></div>";
    if ($notif->viewed !== NULL) {
        $viewed = '';
    } elseif ($notif->viewed == NULL) {
        $viewed = 'class="ossn-notification-unviewed"';
    }
    $notification_read = "{$baseurl}notification/read/{$notif->guid}?notification=" . urlencode($url);
    return "<a href='{$notification_read}'>
	       <li {$viewed}> {$img} 
		   <div class='notfi-meta'> {$type}
		   <div class='data'>" . ossn_print("ossn:notifications:{$notif->type}", array($user->fullname)) . '</div>
		   </div></li>';
}

function ossn_group_comment_post($hook, $type, $return, $params) {
    $notif = $params;
    $baseurl = ossn_site_url();
    $user = ossn_user_by_guid($notif->poster_guid);
    $user->fullname = "<strong>{$user->fullname}</strong>";

    $img = "<div class='notification-image'><img src='{$baseurl}/avatar/{$user->username}/small' /></div>";
    $url = ossn_site_url("post/view/{$notif->subject_guid}");

    if (preg_match('/like/i', $notif->type)) {
        $type = 'like';
    }
    if (preg_match('/comments/i', $notif->type)) {
        $type = 'comment';
        $url = ossn_site_url("post/view/{$notif->subject_guid}#comments-item-{$notif->item_guid}");
    }
    $type = "<div class='ossn-notification-icon-{$type}'></div>";
    if ($notif->viewed !== NULL) {
        $viewed = '';
    } elseif ($notif->viewed == NULL) {
        $viewed = 'class="ossn-notification-unviewed"';
    }
    $notification_read = "{$baseurl}notification/read/{$notif->guid}?notification=" . urlencode($url);
    return "<a href='{$notification_read}'>
	       <li {$viewed}> {$img} 
		   <div class='notfi-meta'> {$type}
		   <div class='data'>" . ossn_print("ossn:notifications:{$notif->type}", array($user->fullname)) . '</div>
		   </div></li>';
}

function ossn_post_page($pages) {
    $page = $pages[0];
    if (empty($page)) {
        return false;
    }
    switch ($page) {
        case 'view':
            $title = ossn_print('post:view');
            $wall = new OssnWall;
            $post = $pages[1];
            $post = $wall->GetPost($post);
            if (empty($post->guid) || empty($pages[1])) {
                ossn_error_page();
            }
            $params['post'] = $post;

            $contents = array('content' => ossn_view('components/OssnWall/pages/view', $params),);
            $content = ossn_set_page_layout('newsfeed', $contents);
            echo ossn_view_page($title, $content);
            break;
        case 'photo':
            if (isset($pages[1]) && isset($pages[2])) {
                $image = ossn_get_userdata("object/{$pages[1]}/ossnwall/images/{$pages[2]}");
                header('Content-Type: image/jpeg');
                echo file_get_contents($image);
            }

            break;
        case 'privacy':
            if (ossn_is_xhr()) {
                $params = array(
                    'title' => ossn_print('privacy'),
                    'contents' => ossn_view('components/OssnWall/wall/privacy'),
                    'callback' => '#ossn-wall-privacy',
                );
                echo ossn_view('system/templates/ossnbox', $params);
            }
            break;
        case 'refresh_home':
            echo ossn_view('components/OssnWall/wall/siteactivity');
            break;
        default:
            ossn_error_page();
            break;

    }
}

function ossn_wall_post_menu($hook, $type, $return, $params) {
    if ($params['post']->poster_guid == ossn_loggedin_user()->guid || $params['post']->owner_guid == ossn_loggedin_user()->guid || ossn_isAdminLoggedin()
    ) {
		$deleteurl = ossn_site_url("action/wall/post/delete?post={$params['post']->guid}", true);
        ossn_register_menu_link("delete", ossn_print('ossn:post:delete'), array(
            'class' => 'ossn-wall-post-delete',
            'href' => $deleteurl,
            'data-guid' => $params['post']->guid
        ), 'wallpost');
	return ossn_view_menu('wallpost', 'components/OssnWall/menus/post-controls');
    } else {
        ossn_unregister_menu('delete', 'wallpost');
    }
    
}
function ossn_group_wall_delete($callback, $type, $params){
	$wall = new OssnWall;
	$posts = $wall->GetPostByOwner($params['entity']->guid, 'group');
	if($posts){
		foreach($posts as $post){
			$wall->deletePost($post->guid);
		}
	}
}
function ossn_user_posts_delete($callback, $type, $params){
	$wall = new OssnWall;
	$posts = $wall->getUserGroupPostsGuids($params['entity']->guid);
	if($posts){
		foreach($posts as $post){
			//$post is here int
			$wall->deletePost($post);
		}
	}
}
function ossnwall_json_unencaped_unicode($matches) {
   return mb_convert_encoding(
            pack('H*', $matches[1]), 
            'UTF-8', 
            'UTF-16'
            );
}
function ossn_wall_view_template(array $params){
	$type = $params['post']->type;
	if(isset($params['post']->item_type)){ 
 		$type = $params['post']->item_type;
	}
	if (ossn_is_hook('wall:template', $type)) {
		return ossn_call_hook('wall:template', $type, $params);
	}
	return false;
}

function ossn_wall_templates($hook, $type, $return, $params){
	return ossn_view("components/OssnWall/templates/wall/{$type}/item", $params);
}
ossn_register_callback('ossn', 'init', 'ossn_wall');
