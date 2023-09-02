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
$file             = new OssnFile();
$user             = ossn_loggedin_user();
$user             = ossn_user_by_guid($user->guid);
$file->owner_guid = $user->guid;

$file->type    = 'user';
$file->subtype = 'profile:cover';
if(ossn_file_is_cdn_storage_enabled()) {
		$file->setStore('cdn');
}
$file->setFile('coverphoto');
$file->setPath('profile/cover/');
$file->setExtension(array(
		'jpg',
		'png',
		'jpeg',
		'jfif',
		'gif',
		'webp',
));
if($fileguid = $file->addFile()) {
		//update user cover time, this time has nothing to do with photo entity time
		$user->data->cover_time = time();
		//default cover photo #1647
		$user->data->cover_guid = $fileguid;

		$user->save();

		$newcover    = $file->getFiles();
		$ossnprofile = new OssnProfile();
		$ossnprofile->ResetCoverPostition($file->owner_guid);
		$ossnprofile->addPhotoWallPost($file->owner_guid, $newcover->{0}->guid, 'cover:photo');
		echo json_encode(array(
				'success' => 1,
		));
		exit();
} else {
		echo json_encode(array(
				'success' => 0,
				'error' => $file->getFileUploadError($file->error)
		));
		exit();
}
