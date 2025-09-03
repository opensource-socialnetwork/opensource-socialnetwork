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

//init ossnwall
$OssnWall = new OssnWall;

//poster guid and owner guid is same as user is posting on home page on its own wall
$OssnWall->owner_guid  = ossn_loggedin_user()->guid;
$OssnWall->poster_guid = ossn_loggedin_user()->guid;

//check if owner guid is zero then exit
if($OssnWall->owner_guid == 0 || $OssnWall->poster_guid == 0) {
		ossn_trigger_message(ossn_print('post:create:error'), 'error');
		redirect(REF);
}

//getting some inputs that are required for wall post
$post     = input('post');
$friends  = input('friends');
$location = input('location');
$privacy  = input('privacy');

//validate wall privacy 
$privacy = ossn_access_id_str($privacy);
$access  = '';
if(!empty($privacy)) {
		$access = input('privacy');
}
if($OssnWall->Post($post, $friends, $location, $access)) {
		if(ossn_is_xhr()) {
				$guid = $OssnWall->getObjectId();
				$get  = $OssnWall->GetPost($guid);
				if($get) {
						$get = ossn_wallpost_to_item($get);
						ossn_set_ajax_data(array(
								'post' => ossn_wall_view_template($get)
						));
				}
		}
		//no need to show message on success.
		//3.x why not? $arsalanshah
		ossn_trigger_message(ossn_print('post:created'));
		if(isset($OssnWall->OssnFile) && isset($OssnWall->OssnFile->error)) {
				ossn_trigger_message($OssnWall->OssnFile->getFileUploadError($OssnWall->OssnFile->error), 'error');
		}
		redirect(REF);
} else {
		if(isset($OssnWall->OssnFile) && isset($OssnWall->OssnFile->error)) {
				ossn_trigger_message($OssnWall->OssnFile->getFileUploadError($OssnWall->OssnFile->error), 'error');
		} else {
				ossn_trigger_message(ossn_print('post:create:error'), 'error');
		}
		redirect(REF);
}
