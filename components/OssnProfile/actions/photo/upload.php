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
$profile = new OssnProfile();
$file    = new OssnFile();

$user = ossn_loggedin_user();

$file->owner_guid = $user->guid;
$file->type       = 'user';
$file->subtype    = 'profile:photo';

$file->setFile('userphoto');
$file->setPath('profile/photo/');
if(ossn_file_is_cdn_storage_enabled()) {
		$file->setStore('cdn');
}
$file->setExtension(array(
		'jpg',
		'png',
		'jpeg',
		'jfif',
		'gif',
		'webp',
));

if($fileguid = $file->addFile()) {
		//update user icon time, this time has nothing to do with photo entity time
		$user->data->icon_time = time();

		//Default profile picture #1647
		$user->data->icon_guid = $fileguid;
		$user->save();

		//get a all user photo files
		$resize = $file->getFiles();

		//add a wall post for photo update
		$profile->addPhotoWallPost($file->owner_guid, $resize->{0}->guid);

		//resize using original photo
		if(isset($file->file['tmp_name'])) {
				$guid      = $user->guid;
				$file_name = $file->newfilename;

				//create sub photos
				$sizes = ossn_user_image_sizes();
				foreach($sizes as $size => $params) {
						$params  = explode('x', $params);
						$width   = $params[1];
						$height  = $params[0];
						$resized = ossn_resize_image($file->file['tmp_name'], $width, $height, true);

						if(!ossn_file_is_cdn_storage_enabled()) {
								file_put_contents(ossn_get_userdata("user/{$guid}/profile/photo/{$size}_{$file_name}"), $resized);
						} else {
								$dirlocalpath  = "user/{$guid}/profile/photo/";
								$filename      = "{$size}_{$file_name}";
								$cdn           = new \CDNStorage\Controller($dirlocalpath, $fileguid);
								$cdn->mimeType = mime_content_type($file->file['tmp_name']);
								$cdn->upload($resized, $filename, 'public-read', false);
						}
				}
		}
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
