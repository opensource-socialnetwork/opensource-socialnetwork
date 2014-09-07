<?php
/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.com/licence
 */
define('__OSSN_PHOTOS__', ossn_route()->com.'OssnPhotos/');
require_once(__OSSN_PHOTOS__.'classes/OssnPhotos.php');
require_once(__OSSN_PHOTOS__.'classes/OssnAlbums.php');
function ossn_photos(){
  //css
  ossn_extend_view('css/ossn.default', 'components/OssnPhotos/css/photos');
  //js
  ossn_extend_view('js/opensource.socialnetwork', 'components/OssnPhotos/js/OssnPhotos');
 
  //hooks
  ossn_add_hook('profile', 'subpage', 'ossn_profile_photos_page');
  ossn_add_hook('profile', 'modules', 'profile_modules_albums') ;  
  ossn_add_hook('notification:view', 'like:entity:file:ossn:aphoto', 'ossn_notification_like_photo');
  ossn_add_hook('notification:view', 'comments:entity:file:ossn:aphoto', 'ossn_notification_like_photo');
 
  //actions
  if(ossn_isLoggedin()){
  ossn_register_action('ossn/album/add', __OSSN_PHOTOS__.'actions/album/add.php');
  ossn_register_action('ossn/photos/add', __OSSN_PHOTOS__.'actions/photos/add.php'); 
  }
  //callbacks
  ossn_register_callback('page', 'load:profile', 'ossn_profile_menu_photos');
  
  ossn_profile_subpage('photos');
 
  ossn_register_page('album', 'ossn_album_page_handler');
  ossn_register_page('photos', 'ossn_photos_page_handler');  

}
function ossn_notification_like_photo($hook, $type, $return, $params){
  	$notif = $params;
    $baseurl = ossn_site_url();
	$user = ossn_user_by_guid($notif->poster_guid);
	$user->fullname = "<strong>{$user->fullname}</strong>"; 
	
	$img = "<div class='notification-image'><img src='{$baseurl}/avatar/{$user->username}/small' /></div>";
	if(preg_match('/like/i', $notif->type)){
	 $type = 'like';	
	}
    if(preg_match('/comments/i', $notif->type)){
	  $type = 'comment';
	}
	$type = "<div class='ossn-notification-icon-{$type}'></div>";
	if($notif->viewed !== NULL){
	   $viewed = '';
    }  elseif($notif->viewed == NULL){
	   $viewed = 'class="ossn-notification-unviewed"';
	}
	$url = ossn_site_url("photos/view/{$notif->subject_guid}");
	$notification_read = "{$baseurl}notification/read/{$notif->guid}?notification=".urlencode($url);
	return "<a href='{$notification_read}'>
	       <li {$viewed}> {$img} 
		   <div class='notfi-meta'> {$type}
		   <div class='data'>".ossn_print("ossn:notifications:{$notif->type}", array($user->fullname)).'</div>
		   </div></li>';
}

function ossn_profile_menu_photos($event, $type, $params){
	$owner = ossn_user_by_guid(ossn_get_page_owner_guid());
	$url = ossn_site_url();
	ossn_register_menu_link('photos', 'photos', "{$url}u/{$owner->username}/photos", 'user_timeline');

}

$url = ossn_site_url();
if(ossn_isLoggedin()){
 $user_loggedin = ossn_loggedin_user();
 $icon = ossn_site_url('components/OssnPhotos/images/photos-ossn.png');
 ossn_register_sections_menu('newsfeed', array(
								   'text' => ossn_print('photos:ossn'), 
								   'url' => "{$url}u/{$user_loggedin->username}/photos", 
								   'section' => 'links',
								   'icon' => $icon
								   ));	

}


function ossn_photos_sizes(){
	return array(
				 'small' => '100x100',
				 'album' => '200x200',
				 'large' => '600x600',
				 'view' => '700x700',
				 );
}
function profile_modules_albums($h, $t, $module, $params){
	$user['user'] = $params['user'];
	$content = ossn_view("components/OssnPhotos/modules/profile/albums", $user);
	$module[] = ossn_view_widget('profile/widget', 'ALBUMS', $content);
	return $module;
}
function ossn_photos_page_handler($album){
	$page = $album[0];
    if(empty($page)){
		ossn_error_page();
	}
	switch($page){
	
    case 'view':
	if(isset($album[1])){
	  $title = 'Photos';
	  $photo['photo'] = $album[1];
	  $view = new OssnPhotos;
      $image = $view->GetPhoto($photo['photo']);
	  $photo['entity'] = $image;
	  if(empty($image)){
		 redirect();
	    }
	  $addphotos = array(
					  'text' => 'Back',
					  'href' => 'javascript::;',
					  'class' => 'button-grey',
					  );
	  $control = ossn_view('system/templates/link', $addphotos);
	  $contents = array(
						'title' => 'Photos',
						'content' =>  ossn_view('components/OssnPhotos/pages/photo/view', $photo),
						'controls' =>  $control ,
						);
      $module['content'] = ossn_set_page_layout('media', $contents);
	  $content = ossn_set_page_layout('contents', $module);
      echo ossn_view_page($title, $content);   
	}
	break;	
		
    case 'add':
     echo ossn_view('system/templates/ossnbox', array(
												 'title' => 'Add Photos',
												 'contents' => ossn_view('components/OssnPhotos/pages/photos/add'),
												 'callback' => '#ossn-photos-submit',
									));
    break;	
	case 'viewer':
	 $image = input('user');
	 $url = ossn_site_url("avatar/{$image}");
	 $media = "<img src='{$url}' />";
	 
	 $photo_guid = get_profile_photo_guid(ossn_user_by_username($image)->guid);
	 $sidebar = ossn_view('components/OssnPhotos/viewer/comments', array('entity_guid' =>  $photo_guid));
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
function ossn_album_page_handler($album){
	$page = $album[0];
    if(empty($page)){
		return false;
	}
	switch($page){
	case 'getphoto':
	  header('Content-Type: image/jpeg');
	  $guid = $album[1];
	  $picture = $album[2];
	  $size = input('size');
	  if(empty($size)){
	   $datadir = ossn_get_userdata("object/{$guid}/album/photos/{$picture}"); 
	  } else {
		$datadir = ossn_get_userdata("object/{$guid}/album/photos/{$size}_{$picture}");  
	  }
	  echo file_get_contents($datadir);
	break;
	case 'view': 
	if(isset($album[1])){
	  $title = 'Photos';
	  $user['album'] = $album[1];
	  $albumget = new OssnAlbums;
	  $owner = $albumget->GetAlbum($album[1])->album->owner_guid;
	  if(empty($owner)){
			   redirect();
			   }
	  if(ossn_loggedin_user()->guid == $owner){
	  $addphotos = array(
					  'text' => 'Add Photos',
					  'href' => 'javascript::;',
					  'id' => 'ossn-add-photos',
					  'data-url' => '?album='.$album[1],
					  'class' => 'button-grey',
					  );
	  $control = ossn_view('system/templates/link', $addphotos);
	  } else { $control = false; }
	  $contents = array(
						'title' => 'Photos',
						'content' =>  ossn_view('components/OssnPhotos/pages/albums', $user),
						'controls' =>  $control ,
						'module_width' => '850px',
						);
      $module['content'] = ossn_set_page_layout('module', $contents);
	  $content = ossn_set_page_layout('contents', $module);
      echo ossn_view_page($title, $content);   
	}
	break;
    case 'add':
     echo ossn_view('system/templates/ossnbox', array(
												 'title' => 'Add Album',
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
function ossn_profile_photos_page($hook, $type, $return, $params){
  $page = $params['subpage'];
  if($page == 'photos'){
	$user['user'] = $params['user']; 
	$control = false;
	if(ossn_loggedin_user()->guid == $user['user']->guid){
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
ossn_register_callback('ossn', 'init', 'ossn_photos');
