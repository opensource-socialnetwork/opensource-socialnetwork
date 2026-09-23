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

$OssnWall = new OssnWall();

$OssnWall->poster_guid = ossn_loggedin_user()->guid;

$owner = input('wallowner');
if(isset($owner) && !empty($owner)) {
		$OssnWall->owner_guid = $owner;
}

$group = ossn_get_group_by_guid($owner);

$OssnWall->type = 'group';

$post     = input('post');
$location = input('location');
$friends  = input('friends');

if($friends) {
		$friend_guids = explode(',', $friends);
		$friend_guids = array_unique($friend_guids);
		$friends      = array();
		foreach ($friend_guids as $guid) {
				if($group && $group->isMember($group->guid, $guid)) {
						$friends[] = $guid;
				}
		}
		$friends = implode(',', $friends);
}

if($group && $OssnWall->Post($post, $friends, $location, OSSN_PRIVATE)) {
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