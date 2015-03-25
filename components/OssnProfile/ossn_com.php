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
define('__OSSN_PROFILE__', ossn_route()->com . 'OssnProfile/');
require_once(__OSSN_PROFILE__ . 'classes/OssnProfile.php');
/**
 * Initialize Profile Component
 *
 * @return void;
 * @access private;
 */
function ossn_profile() {
    //pages
    ossn_register_page('u', 'profile_page_handler');
    ossn_register_page('avatar', 'avatar_page_handler');
    ossn_register_page('cover', 'cover_page_handler');
    //css and js
    ossn_extend_view('css/ossn.default', 'components/OssnProfile/css/profile');
    ossn_extend_view('js/opensource.socialnetwork', 'components/OssnProfile/js/OssnProfile');
    //actions
    if (ossn_isLoggedin()) {
        ossn_register_action('profile/photo/upload', __OSSN_PROFILE__ . 'actions/photo/upload.php');
        ossn_register_action('profile/cover/upload', __OSSN_PROFILE__ . 'actions/cover/upload.php');
        ossn_register_action('profile/cover/reposition', __OSSN_PROFILE__ . 'actions/cover/reposition.php');
        ossn_register_action('profile/edit', __OSSN_PROFILE__ . 'actions/edit.php');
    }
    //callback
    ossn_register_callback('page', 'load:search', 'ossn_search_users_link');
    ossn_register_callback('page', 'load:profile', 'ossn_profile_load_event');
	ossn_register_callback('delete', 'profile:photo', 'ossn_profile_delete_photo_wallpost');
	ossn_register_callback('delete', 'profile:cover:photo', 'ossn_profile_delete_photo_wallpost');

    //hooks
    ossn_add_hook('newsfeed', "sidebar:left", 'profile_photo_newsefeed', 1);
    ossn_add_hook('profile', 'subpage', 'profile_user_friends');
    ossn_add_hook('search', 'type:users', 'profile_search_handler');
    ossn_add_hook('profile', 'subpage', 'profile_edit_page');
    ossn_add_hook('profile', 'modules', 'profile_modules');
	ossn_add_hook('wall:template', 'profile:photo', 'ossn_wall_profile_photo');
	ossn_add_hook('wall:template', 'cover:photo', 'ossn_wall_profile_cover_photo');
	
    //notifications
    ossn_add_hook('notification:view', 'like:entity:file:profile:photo', 'ossn_notification_like_profile_photo');
    ossn_add_hook('notification:view', 'comments:entity:file:profile:photo', 'ossn_notification_like_profile_photo');

	//subpages of profile
	ossn_profile_subpage('friends');
	ossn_profile_subpage('edit');
}
/**
 * Add users link in search page
 *
 * @return void;
 * @access private;
 */
function ossn_search_users_link($event, $type, $params) {
    $url = OssnPagination::constructUrlArgs(array('type'));
    ossn_register_menu_link('search:users', 'search:users', "search?type=users{$url}", 'search');
}

if (ossn_isLoggedin()) {
    $user_loggedin = ossn_loggedin_user();
    $icon = ossn_site_url('components/OssnProfile/images/friends.png');
    ossn_register_sections_menu('newsfeed', array(
        'text' => ossn_print('user:friends'),
        'url' => $user_loggedin->profileURL('/friends'),
        'section' => 'links',
        'icon' => $icon
    ));

}
/**
 * Add a timeline, friends tab in profile
 *
 * @return void;
 * @access private;
 */
function ossn_profile_load_event($event, $type, $params) {
    $owner = ossn_user_by_guid(ossn_get_page_owner_guid());
    $url = ossn_site_url();
    ossn_register_menu_link('timeline', 'timeline', $owner->profileURL(), 'user_timeline');
    ossn_register_menu_link('friends', 'friends', $owner->profileURL('/friends'), 'user_timeline');
}
/**
 * Add profile subpage
 *
 * @param string $page Page name
 *
 * @return void;
 */
function ossn_profile_subpage($page) {
    global $VIEW;
    return $VIEW->pagePush[] = $page;
}
/**
 * Check if is in profile sub page
 *
 * @param string $page Page name
 *
 * @return void;
 */
function ossn_is_profile_subapge($page) {
    global $VIEW;
    if (in_array($page, $VIEW->pagePush)) {
        return true;
    }
    return false;
}
/**
 * Add profile friends page
 *
 * @return mixed data
 */
function profile_user_friends($hook, $type, $return, $params) {
    $page = $params['subpage'];
    if ($page == 'friends') {
        $user['user'] = $params['user'];
        $friends = ossn_view('components/OssnProfile/pages/friends', $user);
        echo ossn_set_page_layout('module', array(
                'title' => ossn_print('friends'),
                'content' => $friends,
            ));
    }
}

/**
 * Add profile edit page
 *
 * @return mixed data;
 */
function profile_edit_page($hook, $type, $return, $params) {
    $page = $params['subpage'];
    if ($page == 'edit') {
        $user['user'] = $params['user'];
        if ($user['user']->guid !== ossn_loggedin_user()->guid) {
            redirect(REF);
        }
        $params = array(
            'action' => ossn_site_url() . 'action/profile/edit',
            'component' => 'OssnProfile',
            'class' => 'ossn-edit-form',
            'params' => $user,
        );
        $form = ossn_view_form('edit', $params, false);
        echo ossn_set_page_layout('module', array(
                'title' => ossn_print('edit'),
                'content' => $form,
            ));
    }
}
/**
 * Add profile search page handler
 *
 * @return string data;
 */
function profile_search_handler($hook, $type, $return, $params) {
    $Pagination = new OssnPagination;
    $users = new OssnUser;
    $data = $users->searchUsers($params['q']);
    $Pagination->setItem($data);
    $user['users'] = $Pagination->getItem();
    $search = ossn_view('system/templates/output/users', $user);
    $search .= $Pagination->pagination();
    if (empty($data)) {
        return ossn_print('ossn:search:no:result');
    }
    return $search;
}
/**
 * Add modules to profile page
 *
 * @return modules;
 */
function profile_modules($h, $t, $module, $params) {
    $user['user'] = $params['user'];

    // didn't part of initial release , so in next release we will add
    /*$content = ossn_view("components/OssnProfile/modules/about", $user);
    $modules[] = ossn_view_widget('profile/widget', 'ABOUT', $content);*/

    $content = ossn_view("components/OssnProfile/modules/friends", $user);
    $modules[] = ossn_view_widget('profile/widget', strtoupper(ossn_print('friends')), $content);

    return $modules;
}
/**
 * Add user profile picture on sidebar of newsfeed
 *
 * @return mixed data;
 */
function profile_photo_newsefeed($hook, $type, $return) {
    $return[] = ossn_view('components/OssnProfile/newsfeed/info');
    return $return;
}
/**
 * Profile page handler
 *
 * @return false|null data;
 */
function profile_page_handler($page) {
    $user = ossn_user_by_username($page[0]);
    if (empty($user->guid)) {
        ossn_error_page();
    }
    ossn_set_page_owner_guid($user->guid);
    ossn_trigger_callback('page', 'load:profile');

    $params['user'] = $user;
    $params['page'] = $page;
    if (isset($page[1])) {
        $params['subpage'] = $page[1];
    } else {
        $params['subpage'] = '';
    }
    if (!ossn_is_profile_subapge($params['subpage']) && !empty($params['subpage'])) {
        return false;
    }
    $title = $user->fullname;
    $contents['content'] = ossn_view('components/OssnProfile/pages/profile', $params);
    $content = ossn_set_page_layout('contents', $contents);
    echo ossn_view_page($title, $content);
}
/**
 * Get user default profile photo guid
 *
 * @return bool
 */
function get_profile_photo_guid($guid) {
    $photo = new OssnFile;
    $photo->owner_guid = $guid;
    $photo->type = 'user';
    $photo->subtype = 'profile:photo';
    $photos = $photo->getFiles();
    if (isset($photos->{0}->guid)) {
        return $photos->{0}->guid;
    }
    return false;
}
/**
 * Get user profile photo
 *
 * @return mixed data;
 */
function get_profile_photo($guid, $size) {
    $photo = new OssnFile;
    $photo->owner_guid = $guid;
    if (isset($size) && array_key_exists($size, ossn_user_image_sizes())) {
        $isize = "{$size}_";
    }
    $photo->type = 'user';
    $photo->subtype = 'profile:photo';
    $photos = $photo->getFiles();
    if (isset($photos->{0}->value) && !empty($photos->{0}->value)) {
        $datadir = ossn_get_userdata("user/{$guid}/{$photos->{0}->value}");
        if (!empty($size)) {
            $image = str_replace('profile/photo/', '', $photos->{0}->value);
            $datadir = ossn_get_userdata("user/{$guid}/profile/photo/{$isize}{$image}");
        }
        return file_get_contents($datadir);
    } else {
        $datadir = ossn_default_theme() . "images/nopictures/users/{$size}.jpg";
        return file_get_contents($datadir);
    }
    return false;
}
/**
 * Get user default cover photo
 *
 * @return string|null data;
 */
function get_cover_photo($guid, $params = array()) {
    $photo = new OssnFile;
    $photo->owner_guid = $guid;
    $photo->type = 'user';
    $photo->subtype = 'profile:cover';
    $photos = $photo->getFiles();
    if (isset($photos->{0}->value)) {
        if(!empty($params[1]) && $params[1] == 1){
        	$datadir = ossn_get_userdata("user/{$guid}/{$photos->{0}->value}");	
			echo ossn_resize_image($datadir, 170, 170, true);
		} else {
	        $datadir = ossn_get_userdata("user/{$guid}/{$photos->{0}->value}");		
			return file_get_contents($datadir);
		}
    } else {
        redirect('components/OssnProfile/images/transparent.png');
    }
}
/**
 * Cover page handler
 *
 * @return image
 */
function cover_page_handler($cover) {
    if (isset($cover[0])) {
        $user = ossn_user_by_username($cover[0]);
        if (!empty($user->guid)) {
            header('Content-Type: image/jpeg');
            echo get_cover_photo($user->guid, $cover);
        }
    }
}
/**
 * Avatar page handler
 *
 * @return image;
 */
function avatar_page_handler($avatar) {
    if (isset($avatar[0])) {
        if (!isset($avatar[1]) && empty($avatar[1])) {
            $avatar[1] = '';
        }
        $user = ossn_user_by_username($avatar[0]);
        if (!empty($user->guid)) {
            header('Content-Type: image/jpeg');
            echo get_profile_photo($user->guid, $avatar[1]);
        } else {
            ossn_error_page();
        }
    }
}
/**
 * Template for profile photo like/comment
 *
 * @return string data;
 */
function ossn_notification_like_profile_photo($hook, $type, $return, $params) {
    $notif = $params;
    $baseurl = ossn_site_url();
    $user = ossn_user_by_guid($notif->poster_guid);
    $user->fullname = "<strong>{$user->fullname}</strong>";

    $img = "<div class='notification-image'><img src='{$baseurl}/avatar/{$user->username}/small' /></div>";
    if (preg_match('/like/i', $notif->type)) {
        $type = 'like';
    }
    if (preg_match('/comments/i', $notif->type)) {
        $type = 'comment';
    }
    $type = "<div class='ossn-notification-icon-{$type}'></div>";
    if ($notif->viewed !== NULL) {
        $viewed = '';
    } elseif ($notif->viewed == NULL) {
        $viewed = 'class="ossn-notification-unviewed"';
    }
    $url = ossn_site_url("photos/user/view/{$notif->subject_guid}");
    $notification_read = "{$baseurl}notification/read/{$notif->guid}?notification=" . urlencode($url);
    return "<a href='{$notification_read}'>
	       <li {$viewed}> {$img} 
		   <div class='notfi-meta'> {$type}
		   <div class='data'>" . ossn_print("ossn:notifications:{$notif->type}", array($user->fullname)) . '</div>
		   </div></li>';
}
/**
 * Template for profile photo created wallpost
 *
 * @return mixed data;
 */
function ossn_wall_profile_photo($hook, $type, $return, $params){
	return ossn_view("components/OssnProfile/templates/wall/profile/photo", $params);
}
/**
 * Template for profile cover photo created by ossnwall
 *
 * @return mixed data;
 */
function ossn_wall_profile_cover_photo($hook, $type, $return, $params){
	return ossn_view("components/OssnProfile/templates/wall/cover/photo", $params);
}
/**
 * Get profile photo url for wall
 *
 * @return string;
 */
function ossn_profile_photo_wall_url($photo){
	if($photo){
        $imagefile = str_replace(array('profile/photo/'), '', $photo->value);		
	  	$image = ossn_site_url("album/getphoto/{$photo->owner_guid}/{$imagefile}?type=1");	
		return $image;
	}
	return false;
}
/**
 * Get profile photo url for wall
 *
 * @return string;
 */
function ossn_profile_coverphoto_wall_url($photo){
	if($photo){
        $imagefile = str_replace(array('profile/cover/'), '', $photo->value);		
	  	$image = ossn_site_url("album/getcover/{$photo->owner_guid}/{$imagefile}");	
		return $image;
	}
	return false;
}
/**
 * Delete wall post if profile photo is deleted
 *
 * @return void;
 */
function ossn_profile_delete_photo_wallpost($callback, $type, $params){
	$params['photo'] = arrayObject($params['photo']);
	if(isset($params['photo']->guid) && !empty($params['photo']->guid)){
		$profile = new OssnProfile;
		$profile->deletePhotoWallPost($params['photo']->guid);
	}
}
ossn_register_callback('ossn', 'init', 'ossn_profile');
