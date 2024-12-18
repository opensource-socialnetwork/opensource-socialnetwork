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
$getNewDim = function ($original_file) {
		if(!is_file($original_file)) {
				return false;
		}
		$details = getimagesize($original_file);

		$max_height = 1500;
		$max_width  = 1500;

		$ratio  = $details[1] / $details[0];
		$width  = $max_width;
		$height = $width * $ratio;

		if($height > $max_height) {
				$height = $max_height;
				$width  = (int) round($height / $ratio);
		}
		return array(
				'w' => $width,
				'h' => $height,
		);
};
if(isset($file->file['tmp_name'])) {
		$original_file = $file->file['tmp_name'];

		$dims = $getNewDim($original_file);

		if($dims['w'] < 1200) {
				//use 2000 x 2000
				$file->setImageDim(2000, 2000, false);
		}
}
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
				'error'   => $file->getFileUploadError($file->error),
		));
		exit();
}
