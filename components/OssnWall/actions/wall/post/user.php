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

header('Content-Type: application/json');

//init ossnwall
$OssnWall = new OssnWall();

//poster guid and owner guid is same as user is posting on its own wall
$OssnWall->owner_guid  = ossn_loggedin_user()->guid;
$OssnWall->poster_guid = ossn_loggedin_user()->guid;

//check if users is not posting on its own wall then change wallowner
$owner = input('wallowner');
if(isset($owner) && !empty($owner)) {
		$OssnWall->owner_guid = $owner;
}

//walltype is user
$OssnWall->name = 'user';

//getting some inputs that are required for wall post
$post     = input('post');
$friends  = input('friends');
$location = input('location');
$privacy  = input('privacy');

//validate wall privacy
$privacy = ossn_access_id_str($privacy);
if(!empty($privacy)) {
		$access = input('privacy');
} else {
		$access = OSSN_FRIENDS;
}

if($OssnWall->Post($post, $friends, $location, $access)) {
		$params = array(
				'success' => true,
		);

		// Append file upload warning/error if present during a successful post
		if(isset($OssnWall->OssnFile) && isset($OssnWall->OssnFile->error)) {
				$params['error'] = $OssnWall->OssnFile->getFileUploadError($OssnWall->OssnFile->error);
		}

		$guid = $OssnWall->getObjectId();
		$get  = $OssnWall->GetPost($guid);
		if($get) {
				$get            = ossn_wallpost_to_item($get);
				$params['post'] = ossn_wall_view_template($get);
		}

		echo json_encode($params);
		exit();
} else {
		$error_msg = ossn_print('post:create:error');
		if(isset($OssnWall->OssnFile) && isset($OssnWall->OssnFile->error)) {
				$error_msg = $OssnWall->OssnFile->getFileUploadError($OssnWall->OssnFile->error);
		}

		echo json_encode(array(
				'error' => $error_msg,
		));
		exit();
}
