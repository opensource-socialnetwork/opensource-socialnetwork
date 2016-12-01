<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$file             = new OssnFile;
$user             = ossn_loggedin_user();
$user             = ossn_user_by_guid($user->guid);
$file->owner_guid = $user->guid;

$file->type    = 'user';
$file->subtype = 'profile:cover';
$file->setFile('coverphoto');
$file->setPath('profile/cover/');
$file->setExtension(array(
		'jpg',
		'png',
		'jpeg',
		'gif'
));
if($file->addFile()) {
		//update user cover time, this time has nothing to do with photo entity time
		$user->data->cover_time = time();
		$user->save();
		
		$newcover    = $file->getFiles();
		$ossnprofile = new OssnProfile;
		$ossnprofile->ResetCoverPostition($file->owner_guid);
		$ossnprofile->addPhotoWallPost($file->owner_guid, $newcover->{0}->guid, 'cover:photo');
		echo 1;
} else {
		echo 0;
}