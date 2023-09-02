<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

define('__OSSN_PHOTOS__', ossn_route()->com . 'OssnPhotos/');
//include classes
require_once __OSSN_PHOTOS__ . 'classes/OssnPhotos.php';
require_once __OSSN_PHOTOS__ . 'classes/OssnAlbums.php';

//inlcude libraries
require_once __OSSN_PHOTOS__ . 'libraries/ossn.lib.photos.php';
require_once __OSSN_PHOTOS__ . 'libraries/ossn.lib.albums.php';

/**
 * Initialize Photos Component
 *
 * @return void;
 * @access private;
 */
function ossn_photos_initialize() {
		//css
		ossn_extend_view('css/ossn.default', 'css/photos');
		//js
		ossn_extend_view('js/ossn.site', 'js/OssnPhotos');
		ossn_extend_view('js/ossn.site.public', 'js/photos/public');

		//hooks
		ossn_add_hook('profile', 'subpage', 'ossn_profile_photos_page');
		ossn_add_hook('profile', 'modules', 'profile_modules_albums');

		ossn_add_hook('notification:view', 'like:entity:file:ossn:aphoto', 'ossn_notification_like_photo');
		ossn_add_hook('notification:view', 'comments:entity:file:ossn:aphoto', 'ossn_notification_like_photo');

		ossn_add_hook('photo:view', 'profile:controls', 'ossn_profile_photo_menu');
		ossn_add_hook('photo:view', 'album:controls', 'ossn_album_photo_menu');
		ossn_add_hook('cover:view', 'profile:controls', 'ossn_album_cover_photo_menu');
		ossn_add_hook('wall:template', 'album:photos:wall', 'ossn_photos_wall');

		//[B] Wrong Notifications because of 'notification:participants' #1822
		ossn_add_hook('notification:participants', 'like:entity:file:profile:photo', 'ossn_profile_photo_cover_like_participants_deny');
		ossn_add_hook('notification:participants', 'like:entity:file:profile:cover', 'ossn_profile_photo_cover_like_participants_deny');
		ossn_add_hook('notification:participants', 'like:entity:file:ossn:aphoto', 'ossn_profile_photo_cover_like_participants_deny');

		//ossn_add_hook('notification:participants', 'comments:entity:file:profile:photo', 'ossn_profile_photo_cover_like_participants_deny');
		//ossn_add_hook('notification:participants', 'comments:entity:file:profile:cover', 'ossn_profile_photo_cover_like_participants_deny');
		//ossn_add_hook('notification:participants', 'comments:entity:file:ossn:aphoto', 'ossn_profile_photo_cover_like_participants_deny');

		//actions
		if(ossn_isLoggedin()) {
				ossn_register_action('ossn/album/add', __OSSN_PHOTOS__ . 'actions/album/add.php');
				ossn_register_action('ossn/album/delete', __OSSN_PHOTOS__ . 'actions/album/delete.php');
				ossn_register_action('ossn/album/edit', __OSSN_PHOTOS__ . 'actions/album/edit.php');
				ossn_register_action('ossn/photos/add', __OSSN_PHOTOS__ . 'actions/photos/add.php');
				ossn_register_action('profile/photo/delete', __OSSN_PHOTOS__ . 'actions/photo/profile/delete.php');
				ossn_register_action('profile/cover/photo/delete', __OSSN_PHOTOS__ . 'actions/photo/profile/cover/delete.php');
				ossn_register_action('photo/delete', __OSSN_PHOTOS__ . 'actions/photo/delete.php');
		}
		//callbacks
		ossn_register_callback('page', 'load:profile', 'ossn_profile_menu_photos');
		ossn_register_callback('delete', 'profile:photo', 'ossn_photos_likes_comments_delete');
		ossn_register_callback('delete', 'album:photo', 'ossn_photos_likes_comments_delete');
		ossn_register_callback('user', 'delete', 'ossn_user_photos_delete');
		ossn_register_callback('ossn:photo', 'add:multiple', 'ossn_photos_add_to_wall');

		ossn_profile_subpage('photos');

		ossn_register_page('album', 'ossn_album_page_handler');
		ossn_register_page('photos', 'ossn_photos_page_handler');

		$url = ossn_site_url();
		if(ossn_isLoggedin()) {
				$user_loggedin = ossn_loggedin_user();
				$icon          = ossn_site_url('components/OssnPhotos/images/photos-ossn.png');
				ossn_register_sections_menu('newsfeed', array(
						'name'   => 'photos',
						'text'   => ossn_print('photos:ossn'),
						'url'    => $user_loggedin->profileURL('/photos'),
						'parent' => 'links',
						'icon'   => $icon,
				));
				//Non friend may able to add comment to friend photo only [huntr.dev] #1979
				ossn_register_callback('comment', 'before:created', 'ossn_photos_like_comment_permission_check');
				ossn_register_callback('like', 'before:created', 'ossn_photos_like_comment_permission_check');
		}
		//gallery plugin dist include
		ossn_new_external_js('jquery.fancybox.min.js', '//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', false);
		ossn_new_external_css('jquery.fancybox.min.css', '//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css', false);
}
/**
 * Like & Comment on photos check before like & comment
 *
 * @param string $callback comment
 * @param string $type  before:created
 * @param array  $params option values
 *
 * @access private
 */
function ossn_photos_like_comment_permission_check($callback, $type, $params) {
		if(isset($params['type']) && $params['type'] == 'entity') {
				if(isset($params['entity']) && isset($params['entity']->subtype) && $params['entity']->subtype == 'file:ossn:aphoto') {
						$album = ossn_get_object($params['entity']->owner_guid);
						if($album && $album->subtype == 'ossn:album') {
								$user          = new OssnUser();
								$loggedin_guid = ossn_loggedin_user()->guid;
								//[B] User can not comment on friend only, own album photo #2039
								if($album->access == OSSN_FRIENDS && $loggedin_guid != $album->owner_guid && !$user->isFriend($album->owner_guid, $loggedin_guid)) {
										if(!ossn_is_xhr()) {
												redirect(REF);
										} else {
												header('Content-Type: application/json');
												if($callback == 'comment') {
														echo json_encode(array(
																'process' => 0,
														));
												}
												if($callback == 'like') {
														echo json_encode(array(
																'done'      => 0,
																'container' => false,
																'button'    => ossn_print('ossn:like'),
														));
												}
												exit();
										}
								}
						}
				}
		}
}
/**
 * Delete user photos
 * OssnPhotos still exists when user delete #1142
 *
 * @param string $callback Name of callback
 * @param string $type Callback type
 * @param array $params Arrays or Objects
 *
 * @return void
 * @access private
 */
function ossn_user_photos_delete($callback, $type, $params) {
		$guid   = $params['entity']->guid;
		$album  = new OssnAlbums();
		$albums = $album->GetAlbums($guid, array(
				'page_limit' => false,
		));
		if($albums) {
				foreach($albums as $item) {
						$album->deleteAlbum($item->guid);
				}
		}
}
/**
 * Add user album photos to wall
 *
 * @param string $callback Name of callback
 * @param string $type Callback type
 * @param array  $params array|object
 *
 * @return void
 * @access private
 */
function ossn_photos_add_to_wall($callback, $type, $params) {
		if(isset($params['album']) && isset($params['photo_guids'])) {
				$wall = new OssnPhotos();
				$wall->addWall($params['album'], $params['photo_guids']);
		}
}
/**
 * Template for wall file
 *
 * @return string
 */
function ossn_photos_wall($hook, $type, $return, $params) {
		return ossn_plugin_view('photos/wall/template', $params);
}
/**
 * Set template for photos like for OssnNotifications
 *
 * @return html;
 * @access private;
 */
function ossn_notification_like_photo($hook, $type, $return, $notification) {
		$user = ossn_user_by_guid($notification->poster_guid);
		//change your/someone photo string
		$entity = ossn_get_entity($notification->subject_guid);
		$album  = ossn_get_object($entity->owner_guid);
		if($album && $album->subtype == 'ossn:album' && ossn_loggedin_user()->guid != $album->owner_guid) {
				$notification->type = $notification->type . ':someone';
		}
		if(preg_match('/like/i', $notification->type)) {
				$iconType = 'like';
		}
		if(preg_match('/comments/i', $notification->type)) {
				$iconType = 'comment';
		}
		$url = ossn_site_url("photos/view/{$notification->subject_guid}");
		return ossn_plugin_view('notifications/template/view', array(
				'iconURL'   => $user->iconURL()->small,
				'guid'      => $notification->guid,
				'type'      => $notification->type,
				'viewed'    => $notification->viewed,
				'url'       => $url,
				'icon_type' => $iconType,
				'fullname'  => $user->fullname,
		));
}

/**
 * Add photos link to user timeline
 *
 * @return void;
 * @access private;
 */
function ossn_profile_menu_photos($event, $type, $params) {
		$owner = ossn_user_by_guid(ossn_get_page_owner_guid());
		$url   = ossn_site_url();
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
				'view'  => '700x700',
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
		$content      = ossn_plugin_view('photos/modules/profile/albums', $user);
		$title        = ossn_print('photo:albums');

		$module[] = ossn_view_widget(array(
				'title'    => $title,
				'contents' => $content,
		));
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
		if(empty($page)) {
				ossn_error_page();
		}
		switch($page) {
			case 'view':
				if(isset($album[1])) {
						$title          = ossn_print('photos');
						$photo['photo'] = $album[1];

						$view            = new OssnPhotos();
						$image           = $view->GetPhoto($photo['photo']);
						$photo['entity'] = $image;

						//redirect user to home page if image is empty
						if(empty($image)) {
								//redirect();
						}
						//throw 404 page if there is no album access
						$albumget = ossn_albums();
						$owner    = $albumget->GetAlbum($image->owner_guid)->album;
						if($owner->access == 3) {
								if(!ossn_validate_access_friends($owner->owner_guid)) {
										ossn_error_page();
								}
						}
						$contents = array(
								'title'   => ossn_print('photos'),
								'content' => ossn_plugin_view('photos/pages/photo/view', $photo),
						);
						//set page layout
						$content = ossn_set_page_layout('media', $contents);
						echo ossn_view_page($title, $content);
				}
				break;
			case 'user':
				if(isset($album[1]) && isset($album[2]) && $album[1] == 'view') {
						$title          = ossn_print('photos');
						$photo['photo'] = $album[2];
						$type           = input('type');

						$view            = new OssnPhotos();
						$image           = $view->GetPhoto($photo['photo']);
						$photo['entity'] = $image;

						//redirect user if photo is empty
						if(empty($image->value)) {
								redirect();
						}
						$contents = array(
								'title'   => 'Photos',
								'content' => ossn_plugin_view('photos/pages/profile/photos/view', $photo),
						);
						//set page layout
						$content = ossn_set_page_layout('media', $contents);
						echo ossn_view_page($title, $content);
				}
				break;
			case 'cover':
				if(isset($album[1]) && isset($album[2]) && $album[1] == 'view') {
						$title           = ossn_print('cover:view');
						$photo['photo']  = $album[2];
						$type            = input('type');
						$OssnPhotos      = new OssnPhotos();
						$image           = $OssnPhotos->GetPhoto($photo['photo']);
						$photo['entity'] = $image;

						//redirect user if photo is empty
						if(empty($image->value)) {
								redirect();
						}
						//Fixed hardcoded photos of user widget title #1482
						$contents = array(
								'title'   => ossn_print('photos'),
								'content' => ossn_plugin_view('photos/pages/profile/covers/view', $photo),
						);
						//set page layout
						$content = ossn_set_page_layout('media', $contents);
						echo ossn_view_page($title, $content);
				}
				break;
			case 'add':
				//add photos (ajax)
				if(!ossn_is_xhr()) {
						ossn_error_page();
				}
				echo ossn_plugin_view('output/ossnbox', array(
						'title'    => ossn_print('add:photos'),
						'contents' => ossn_plugin_view('photos/pages/photos/add'),
						'callback' => '#ossn-photos-submit',
				));
				break;
			case 'viewer':
				//ossn image viewer currently works for profile images
				$image = input('user');

				$url   = ossn_site_url("avatar/{$image}");
				$media = "<img src='{$url}' />";

				$photo_guid = get_profile_photo_guid(ossn_user_by_username($image)->guid);
				//set viewer sidebar (comments and likes)
				$sidebar = ossn_plugin_view('photos/viewer/comments', array(
						'entity_guid' => $photo_guid,
				));
				echo ossn_plugin_view('output/viewer', array(
						'media'   => $media,
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
 * @return false|null contents
 */
function ossn_album_page_handler($album) {
		$page = $album[0];
		if(empty($page)) {
				return false;
		}
		switch($page) {
			case 'getphoto':
				$guid    = $album[1];
				$picture = $album[2];
				$size    = input('size');
				$type    = input('type');

				$file = ossn_get_file($guid);
				if($file) {
						if(!$size && !$file->isCDN()) {
								$file->output();
						}
						if($size && !$file->isCDN()) {
								$parsed      = explode('/', $file->value);
								$file->value = "album/photos/{$size}_" . end($parsed);
								if($type == 1) {
										$file->value = "profile/photo/{$size}_" . end($parsed);
								}
								$file->output();
						}
						if($file->isCDN()) {
								$manifest = $file->getManifest();
								if(!empty($size)) {
										$size = "{$size}_";
								}
								$url = $manifest['url'] . "{$manifest['path']}{$size}" . $manifest['filename'];
								ob_flush();
								header("Location:{$url}");
								exit();
						}
				}
				break;
			case 'getcover':
				$guid    = $album[1];
				$picture = $album[2];
				$size    = input('size');

				$file = ossn_get_file($guid);
				if($file) {
						$file->output();
				}
				break;
			case 'edit':
				if(!ossn_isLoggedin() || !ossn_is_xhr()) {
						ossn_error_page();
				}
				$album = ossn_get_object($album[1]);
				if(isset($album->guid) && $album->subtype == 'ossn:album' && $album->owner_guid == ossn_loggedin_user()->guid) {
						echo ossn_plugin_view('output/ossnbox', array(
								'title'    => ossn_print('edit'),
								'contents' => ossn_plugin_view('photos/pages/album/edit', array(
										'album' => $album,
								)),
								'callback' => '#ossn-album-edit-submit',
						));
				} else {
						ossn_error_page();
				}
				break;
			case 'view':
				ossn_load_external_css('jquery.fancybox.min.css');
				ossn_load_external_js('jquery.fancybox.min.js');
				if(isset($album[1])) {
						$title = ossn_print('photos');

						$user['album'] = $album[1];
						$albumget      = ossn_albums();
						$owner         = $albumget->GetAlbum($album[1])->album;

						if(empty($owner)) {
								ossn_error_page();
						}

						//throw 404 page if there is no album access
						if($owner->access == 3) {
								if(!ossn_validate_access_friends($owner->owner_guid)) {
										ossn_error_page();
								}
						}
						$gallery_button = array(
								'text'  => "<i class='fa fa-caret-square-right'></i>",
								'href'  => 'javascript:void(0);',
								'class' => 'button-grey',
								'id'    => 'ossn-photos-show-gallery',
						);
						$control_gbutton = ossn_plugin_view('output/url', $gallery_button);
						//shows add photos if owner is loggedin user
						if(ossn_isLoggedin() && ossn_loggedin_user()->guid == $owner->owner_guid) {
								$addphotos = array(
										'text'     => ossn_print('add:photos'),
										'href'     => 'javascript:void(0);',
										'id'       => 'ossn-add-photos',
										'data-url' => '?album=' . $album[1],
										'class'    => 'button-grey',
								);

								$edit_album = array(
										'text'      => ossn_print('edit'),
										'class'     => 'button-grey',
										'data-guid' => $album[1],
										'id'        => 'ossn-photos-edit-album',
								);

								$delete_action = ossn_site_url("action/ossn/album/delete?guid={$album[1]}", true);
								$delete_album  = array(
										'text'  => ossn_print('delete:album'),
										'href'  => $delete_action,
										'class' => 'button-grey ossn-make-sure',
								);
								$control = ossn_plugin_view('output/url', $edit_album);
								$control .= ossn_plugin_view('output/url', $addphotos);
								$control .= ossn_plugin_view('output/url', $delete_album);
						} else {
								$control = false;
						}
						//Missing back button to photos #570
						$owner = ossn_user_by_guid($owner->owner_guid);
						$back  = array(
								'text'  => ossn_print('back'),
								'href'  => ossn_site_url("u/{$owner->username}/photos"),
								'class' => 'button-grey',
						);
						$control .= ossn_plugin_view('output/url', $back);
						//set photos in module
						$contents = array(
								'title'        => ossn_print('photos'),
								'content'      => ossn_plugin_view('photos/pages/albums', $user),
								'controls'     => $control_gbutton . $control,
								'module_width' => '850px',
						);
						//set page layout
						$module['content'] = ossn_set_page_layout('module', $contents);
						$content           = ossn_set_page_layout('contents', $module);
						echo ossn_view_page($title, $content);
				}
				break;
			case 'profile':
				if(isset($album[1])) {
						$title = ossn_print('profile:photos');

						$user['user'] = ossn_user_by_guid($album[1]);
						if(empty($user['user']->guid)) {
								ossn_error_page();
						}
						//Missing back button to photos #570
						$back = array(
								'text'  => ossn_print('back'),
								'href'  => ossn_site_url("u/{$user['user']->username}/photos"),
								'class' => 'button-grey',
						);
						$control = ossn_plugin_view('output/url', $back);
						//view profile photos in module layout
						$contents = array(
								'title'        => ossn_print('photos'),
								'content'      => ossn_plugin_view('photos/pages/profile/photos/all', $user),
								'controls'     => $control,
								'module_width' => '850px',
						);
						$module['content'] = ossn_set_page_layout('module', $contents);
						//set page layout
						$content = ossn_set_page_layout('contents', $module);
						echo ossn_view_page($title, $content);
				}
				break;
			case 'covers':
				if(isset($album[2]) && $album[1] == 'profile') {
						$title = ossn_print('profile:covers');

						$user['user'] = ossn_user_by_guid($album[2]);
						if(empty($user['user']->guid)) {
								ossn_error_page();
						}
						//Missing back button to photos #570
						$back = array(
								'text'  => ossn_print('back'),
								'href'  => ossn_site_url("u/{$user['user']->username}/photos"),
								'class' => 'button-grey',
						);
						$control = ossn_plugin_view('output/url', $back);
						//view profile photos in module layout
						$contents = array(
								'title'        => ossn_print('covers'),
								'content'      => ossn_plugin_view('photos/pages/profile/covers/all', $user),
								'controls'     => $control,
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
				echo ossn_plugin_view('output/ossnbox', array(
						'title'    => ossn_print('add:album'),
						'contents' => ossn_plugin_view('photos/pages/album/add'),
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
		if($page == 'photos') {
				$user['user'] = $params['user'];
				$control      = false;
				//show add album if loggedin user is owner
				if(isset(ossn_loggedin_user()->guid) && ossn_loggedin_user()->guid == $user['user']->guid) {
						$addalbum = array(
								'text'  => ossn_print('add:album'),
								'href'  => 'javascript:void(0);',
								'id'    => 'ossn-add-album',
								'class' => 'button-grey',
						);
						$control = ossn_plugin_view('output/url', $addalbum);
				}
				$friends = ossn_plugin_view('photos/pages/photos', $user);
				echo ossn_set_page_layout('module', array(
						'title'    => ossn_print('photo:albums'),
						'content'  => $friends,
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
		if(isset(ossn_loggedin_user()->guid) && ($params->owner_guid == ossn_loggedin_user()->guid || ossn_isAdminLoggedin())) {
				return ossn_plugin_view('photos/views/profilephoto/menu', $params);
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
		if(isset(ossn_loggedin_user()->guid) && ($album->album->owner_guid == ossn_loggedin_user()->guid || ossn_isAdminLoggedin())) {
				return ossn_plugin_view('photos/views/albumphoto/menu', $params);
		}
}
/**
 * Show a leftside menu on profile cover photo vieww
 *
 * @return mix data
 * @access private;
 */
function ossn_album_cover_photo_menu($hook, $type, $return, $params) {
		if(isset(ossn_loggedin_user()->guid) && ($params->owner_guid == ossn_loggedin_user()->guid || ossn_isAdminLoggedin())) {
				return ossn_plugin_view('photos/views/coverphoto/menu', $params);
		}
}
/**
 * Delete photos like
 *
 * @return voud;
 * @access private
 */
function ossn_photos_likes_comments_delete($name, $type, $params) {
		if(class_exists('OssnLikes')) {
				$likes = new OssnLikes();
				$likes->deleteLikes($params['photo']['guid'], 'entity');

				$comments = new OssnComments();
				//[B] getting orphan like records from comments when deleting a post #1687
				$comments->commentsDeleteAll($params['photo']['guid'], 'entity');
		}
		//[E] delete 'upload image' wall entries automatically if pic is deleted #1667
		if(class_exists('OssnWall')) {
				$photoguid                = $params['photo']['guid'];
				$Wall                     = new OssnWall();
				$vars['subtype']          = 'wall';
				$vars['type']             = 'user';
				$vars['entities_pairs'][] = array(
						'name'  => 'item_type',
						'value' => 'album:photos:wall',
				);
				$vars['entities_pairs'][] = array(
						'name'   => 'photos_guids',
						'value'  => true,
						'wheres' => "(FIND_IN_SET('{$photoguid}', emd1.value) > 0)",
				);

				$List = $Wall->searchObject($vars);
				if($List) {
						$post  = $List[0];
						$guids = explode(',', $post->photos_guids);
						$key   = array_search($photoguid, $guids);
						if(strlen($key) > 0) {
								unset($guids[$key]);
						}
						$total_photos = count($guids);
						if($total_photos < 1) {
								$post->deletePost($post->guid);
						} else {
								$post->data->photos_guids = implode(',', $guids);
								$post->save();
						}
				}
		}
}
function ossn_profile_photo_cover_like_participants_deny() {
		return false;
}
ossn_register_callback('ossn', 'init', 'ossn_photos_initialize');
