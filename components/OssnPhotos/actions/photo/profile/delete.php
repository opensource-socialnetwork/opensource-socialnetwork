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

$photoid         = input('id');
$delete          = ossn_photos();
$delete->photoid = $photoid;
$photo           = $delete->GetPhoto($delete->photoid);
if(($photo->owner_guid == ossn_loggedin_user()->guid) || ossn_isAdminLoggedin()) {
		if($delete->deleteProfilePhoto()) {
				$user = ossn_user_by_guid($photo->owner_guid);
				if(isset($user->icon_guid) && $user->icon_guid == $photoid){				
						$user->data->icon_time = time();
						//[E] Default profile picture #1647
						$user->data->icon_guid = false;
						$user->save();
				}
				ossn_trigger_message(ossn_print('photo:deleted:success'), 'success');
				redirect("album/profile/{$photo->owner_guid}");
		} else {
				ossn_trigger_message(ossn_print('photo:delete:error'), 'error');
				redirect(REF);
		}
} else {
		ossn_trigger_message(ossn_print('photo:delete:error'), 'error');
		redirect(REF);
}
