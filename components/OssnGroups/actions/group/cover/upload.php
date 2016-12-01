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
header('Content-Type: application/json');
$group = input('group');
$group = ossn_get_group_by_guid($group);
if(ossn_loggedin_user()->guid !== $group->owner_guid && !ossn_isAdminLoggedin()) {
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
