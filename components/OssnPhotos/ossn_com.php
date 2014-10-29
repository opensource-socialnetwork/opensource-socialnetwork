<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */

define('__OSSN_PHOTOS__', ossn_route()->com . 'OssnPhotos/');
//include classes
require_once(__OSSN_PHOTOS__ . 'classes/OssnPhotos.php');
require_once(__OSSN_PHOTOS__ . 'classes/OssnAlbums.php');

//inlcude libraries
require_once(__OSSN_PHOTOS__ . 'libraries/ossn.lib.photos.php');
require_once(__OSSN_PHOTOS__ . 'libraries/ossn.lib.albums.php');

/**
 * Initialize Photos Component
 *
 * @return void;
 * @access private;
 */
function ossn_photos_initialize() {
    //css
    ossn_extend_view('css/ossn.default', 'components/OssnPhotos/css/photos');
    //js
    ossn_extend_view('js/opensource.socialnetwork', 'components/OssnPhotos/js/OssnPhotos');

    //hooks
    ossn_add_hook('profile', 'subpage', 'ossn_profile_photos_page');
    ossn_add_hook('profile', 'modules', 'profile_modules_albums');
    ossn_add_hook('notification:view', 'like:entity:file:ossn:aphoto', 'ossn_notification_like_photo');
    ossn_add_hook('notification:view', 'comments:entity:file:ossn:aphoto', 'ossn_notification_like_photo');
    ossn_add_hook('photo:view', 'profile:controls', 'ossn_profile_photo_menu');
    ossn_add_hook('photo:view', 'album:controls', 'ossn_album_photo_menu');

    //actions
    if (ossn_isLoggedin()) {
        ossn_register_action('ossn/album/add', __OSSN_PHOTOS__ . 'actions/album/add.php');
        ossn_register_action('ossn/photos/add', __OSSN_PHOTOS__ . 'actions/photos/add.php');
        ossn_register_action('profile/photo/delete', __OSSN_PHOTOS__ . 'actions/photo/profile/delete.php');
        ossn_register_action('photo/delete', __OSSN_PHOTOS__ . 'actions/photo/delete.php');
    }
    //callbacks
    ossn_register_callback('page', 'load:profile', 'ossn_profile_menu_photos');
    ossn_register_callback('delete', 'profile:photo', 'ossn_photos_likes_comments_delete');
    ossn_register_callback('delete', 'album:photo', 'ossn_photos_likes_comments_delete');

    ossn_profile_subpage('photos');

    ossn_register_page('album', 'ossn_album_page_handler');
    ossn_register_page('photos', 'ossn_photos_page_handler');

    $url = ossn_site_url();
    if (ossn_isLoggedin()) {
        $user_loggedin = ossn_loggedin_user();
        $icon = ossn_site_url('components/OssnPhotos/images/photos-ossn.png');
        ossn_register_sections_menu('newsfeed', array(
            'text' => ossn_print('photos:ossn'),
            'url' => $user_loggedin->profileURL('/photos'),
            'section' => 'links',
            'icon' => $icon
        ));

    }

}

/**
 * Set template for photos like for OssnNotifications
 *
 * @return html;
 * @access private;
 */
function ossn_notification_like_photo($hook, $type, $return, $params) {
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
    $url = ossn_site_url("photos/view/{$notif->subject_guid}");
    $notification_read = "{$baseurl}notification/read/{$notif->guid}?notification=" . urlencode($url);
    return "<a href='{$notification_read}'>
	       <li {$viewed}> {$img} 
		   <div class='notfi-meta'> {$type}
		   <div class='data'>" . ossn_print("ossn:notifications:{$notif->type}", array($user->fullname)) . '</div>
		   </div></li>';
}

/**
 * Add photos link to user timeline
 *
 * @return void;
 * @access private;
 */
function ossn_profile_menu_photos($event, $type, $params) {
    $owner = ossn_user_by_guid(ossn_get_page_owner_guid());
    $url = ossn_site_url();
    ossn_register_menu_link('photos', 'photos', $owner->profileURL('/photos'), 'user_timeline');

}

/**
 * Set photos sizes
 *
 * @return array;
 * @access private;
 */
function ossn_photos_sizes() {
    return array(
        'small' => '100x100',
        'album' => '200x200',
        'large' => '600x600',
        'view' => '700x700',
    );
}

/**
 * Add Albums module to user profile
 *
 * @return html;
 * @access private;
 */
function profile_modules_albums($hook, $type, $module, $params) {
    $user['user'] = $params['user'];
    $content = ossn_view("components/OssnPhotos/modules/profile/albums", $user);
    $module[] = ossn_view_widget('profile/widget', 'ALBUMS', $content);
    return $module;
}

/**
 * Ossn Photos page handler
 * @pages:
 *       view,
 *    user,
 *       add,
 *       viewer
 *
 * @return mixed contents
 */
function ossn_photos_page_handler($album) {
    $page = $album[0];
    if (empty($page)) {
        ossn_error_page();
    }
    switch ($page) {

        case 'view':
            if (isset($album[1])) {

                $title = ossn_print('photos');
                $photo['photo'] = $album[1];

                $view = new OssnPhotos;
                $image = $view->GetPhoto($photo['photo']);
                $photo['entity'] = $image;

                //redirect user to home page if image is empty
                if (empty($image)) {
                    redirect();
                }
                //throw 404 page if there is no album access
                $albumget = ossn_albums();
                $owner = $albumget->GetAlbum($image->owner_guid)->album;
                if ($owner->access == 3) {
                    if (!ossn_validate_access_friends($owner->owner_guid)) {
                        ossn_error_page();
                    }
                }
                //shows widget back button
                $addphotos = array(
                    'text' => ossn_print('back'),
                    'href' => 'javascript::;',
                    'class' => 'button-grey',
                );
                $control = ossn_view('system/templates/link', $addphotos);
                $contents = array(
                    'title' => ossn_print('photos'),
                    'content' => ossn_view('components/OssnPhotos/pages/photo/view', $photo),
                    'controls' => $control,
                );
                //set page layout
                $module['content'] = ossn_set_page_layout('media', $contents);
                $content = ossn_set_page_layout('contents', $module);
                echo ossn_view_page($title, $content);
            }
            break;
        case 'user':
            if (isset($album[1]) && isset($album[2]) && $album[1] == 'view') {

                $title = ossn_print('photos');
                $photo['photo'] = $album[2];
                $type = input('type');

                $view = new OssnPhotos;
                $image = $view->GetPhoto($photo['photo']);
                $photo['entity'] = $image;

                //redirect user if photo is empty
                if (empty($image->value)) {
                    redirect();
                }
                $addphotos = array(
                    'text' => ossn_print('back'),
                    'href' => 'javascript::;',
                    'class' => 'button-grey',
                );
                $control = ossn_view('system/templates/link', $addphotos);
                $contents = array(
                    'title' => 'Photos',
                    'content' => ossn_view('components/OssnPhotos/pages/profile/photos/view', $photo),
                    'controls' => $control,
                );
                //set page layout
                $module['content'] = ossn_set_page_layout('media', $contents);
                $content = ossn_set_page_layout('contents', $module);
                echo ossn_view_page($title, $content);
            }
            break;
        case 'add':
            //add photos (ajax)
            if (!ossn_is_xhr()) {
                ossn_error_page();
            }
            echo ossn_view('system/templates/ossnbox', array(
                'title' => ossn_print('add:photos'),
                'contents' => ossn_view('components/OssnPhotos/pages/photos/add'),
                'callback' => '#ossn-photos-submit',
            ));
            break;
        case 'viewer':
            //ossn image viewer currently works for profile images
            $image = input('user');

            $url = ossn_site_url("avatar/{$image}");
            $media = "<img src='{$url}' />";

            $photo_guid = get_profile_photo_guid(ossn_user_by_username($image)->guid);
            //set viewer sidebar (comments and likes)
            $sidebar = ossn_view('components/OssnPhotos/viewer/comments', array('entity_guid' => $photo_guid));
            echo ossn_view('system/templates/viewer', array(
                    'media' => $media,
                    'sidebar' => $sidebar,
                ));
            break;
        default:
            ossn_error_page();
            break;
    }
}

/**
 * Ossn Albums page handler
 * @pages:
 *       getphoto,
 *    view,
 *       profile,
 *       add
 *
 * @return mixed contents
 */
function ossn_album_page_handler($album) {
    $page = $album[0];
    if (empty($page)) {
        return false;
    }
    switch ($page) {
        case 'getphoto':

            $guid = $album[1];
            $picture = $album[2];
            $size = input('size');
            // get image size
            if (empty($size)) {
                $datadir = ossn_get_userdata("object/{$guid}/album/photos/{$picture}");
            } else {
                $datadir = ossn_get_userdata("object/{$guid}/album/photos/{$size}_{$picture}");
            }
            //get image type
            $type = input('type');

            if ($type == '1') {
                if (empty($size)) {
                    $datadir = ossn_get_userdata("user/{$guid}/profile/photo/{$picture}");
                } else {
                    $datadir = ossn_get_userdata("user/{$guid}/profile/photo/{$size}_{$picture}");
                }
            }
            $image = file_get_contents($datadir);
            //get image file else show error page
            if (is_file($datadir)) {
                header('Content-Type: image/jpeg');
                echo $image;
            } else {
                ossn_error_page();
            }
            break;
        case 'view':
            if (isset($album[1])) {
                $title = ossn_print('photos');

                $user['album'] = $album[1];
                $albumget = ossn_albums();
                $owner = $albumget->GetAlbum($album[1])->album;

                if (empty($owner)) {
                    ossn_error_page();
                }

                //throw 404 page if there is no album access
                if ($owner->access == 3) {
                    if (!ossn_validate_access_friends($owner->owner_guid)) {
                        ossn_error_page();
                    }
                }
                //shows add photos if owner is loggedin user
                if (ossn_loggedin_user()->guid == $owner->owner_guid) {
                    $addphotos = array(
                        'text' => ossn_print('add:photos'),
                        'href' => 'javascript::;',
                        'id' => 'ossn-add-photos',
                        'data-url' => '?album=' . $album[1],
                        'class' => 'button-grey',
                    );
                    $control = ossn_view('system/templates/link', $addphotos);
                } else {
                    $control = false;
                }
                //set photos in module
                $contents = array(
                    'title' => ossn_print('photos'),
                    'content' => ossn_view('components/OssnPhotos/pages/albums', $user),
                    'controls' => $control,
                    'module_width' => '850px',
                );
                //set page layout
                $module['content'] = ossn_set_page_layout('module', $contents);
                $content = ossn_set_page_layout('contents', $module);
                echo ossn_view_page($title, $content);
            }
            break;
        case 'profile':
            if (isset($album[1])) {
                $title = ossn_print('profile:photos');

                $user['user'] = ossn_user_by_guid($album[1]);
                if (empty($user['user']->guid)) {
                    ossn_error_page();
                }
                //view profile photos in module layout
                $contents = array(
                    'title' => ossn_print('photos'),
                    'content' => ossn_view('components/OssnPhotos/pages/profile/photos/all', $user),
                    'controls' => false,
                    'module_width' => '850px',
                );
                $module['content'] = ossn_set_page_layout('module', $contents);
                //set page layout
                $content = ossn_set_page_layout('contents', $module);
                echo ossn_view_page($title, $content);
            }
            break;
        case 'add':
            //add photos (ajax)
            echo ossn_view('system/templates/ossnbox', array(
                'title' => ossn_print('add:album'),
                'contents' => ossn_view('components/OssnPhotos/pages/album/add'),
                'success_id' => 'aga',
                'callback' => '#ossn-album-submit',
            ));
            break;

        default:
            ossn_error_page();
            break;
    }
}

/**
 * Register user photos page (profile subpage)
 *
 * @return mix data
 * @access private;
 */
function ossn_profile_photos_page($hook, $type, $return, $params) {
    $page = $params['subpage'];
    if ($page == 'photos') {
        $user['user'] = $params['user'];
        $control = false;
        //show add album if loggedin user is owner
        if (ossn_loggedin_user()->guid == $user['user']->guid) {
            $addalbum = array(
                'text' => ossn_print('add:album'),
                'href' => 'javascript::;',
                'id' => 'ossn-add-album',
                'class' => 'button-grey',
            );
            $control = ossn_view('system/templates/link', $addalbum);
        }
        $friends = ossn_view('components/OssnPhotos/pages/photos', $user);
        echo ossn_set_page_layout('module', array(
            'title' => ossn_print('photo:albums'),
            'content' => $friends,
            'controls' => $control,
        ));
    }
}

/**
 * Show a leftside menu on profile photo view
 *
 * @return mix data
 * @access private;
 */
function ossn_profile_photo_menu($hook, $type, $return, $params) {
    if ($params->owner_guid == ossn_loggedin_user()->guid || ossn_isAdminLoggedin()) {
        return ossn_view('components/OssnPhotos/views/profilephoto/menu', $params);
    }
}

/**
 * Show a leftside menu on album photo view
 *
 * @return mix data
 * @access private;
 */
function ossn_album_photo_menu($hook, $type, $return, $params) {
    $album = ossn_albums()->getAlbum($params->owner_guid);
    if ($album->album->owner_guid == ossn_loggedin_user()->guid || ossn_isAdminLoggedin()) {
        return ossn_view('components/OssnPhotos/views/albumphoto/menu', $params);
    }
}

/**
 * Delete photos like
 *
 * @return voud;
 * @access private
 */
function ossn_photos_likes_comments_delete($name, $type, $params) {
    if (class_exists('OssnLikes')) {
        $likes = new OssnLikes;
        $likes->deleteLikes($params['photo']['guid'], 'entity');

        $comments = new OssnComments;
        $comments->commentsDeleteAll($params['photo']['guid'], 'comments:entity');
    }
}

ossn_register_callback('ossn', 'init', 'ossn_photos_initialize');
