<?php
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$files      = ossn_input_images('ossnphoto');
$add        = new OssnPhotos;
$album_guid = input('album');

if($files) {
		$files_added = array();
		foreach($files as $item) {
				$_FILES['ossnphoto'] = $item;
				if($guid = $add->AddPhoto($album_guid, 'ossnphoto', input('privacy'))) {
						$files_added[] = $guid;
				}
		}
		$args['photo_guids'] = $files_added;
		$args['album']       = $album_guid;
		if($album_guid && count($files_added)) {
				ossn_trigger_callback('ossn:photo', 'add:multiple', $args);
		}
		redirect(REF);
} else {
		redirect(REF);
}
