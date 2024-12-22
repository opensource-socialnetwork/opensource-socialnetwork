<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
function ossn_albums() {
		$albums = new OssnAlbums();
		return $albums;
}
function ossn_get_album_object($guid) {
		if(!empty($guid)) {
				$object = ossn_get_object($guid);
				if($object && $object->subtype == 'ossn:album') {
						$object = (array) $object;
						return arrayObject($object, 'OssnAlbums');
				}
		}
		return false;
}