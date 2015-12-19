<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
header('Content-Type: application/json');
$group = input('group');
$group = ossn_get_group_by_guid($group);
if(ossn_loggedin_user()->guid !== $group->owner_guid) {
		echo json_encode(array(
				'type' => 0
		));
		exit;
}
if($group->UploadCover()) {
		echo json_encode(array(
				'type' => 1,
				'url' => $group->coverURL()
		));
} else {
		echo json_encode(array(
				'type' => 0
		));
}