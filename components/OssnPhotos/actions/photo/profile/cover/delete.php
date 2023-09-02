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
		if($delete->deleteProfileCoverPhoto()) {
				$user = ossn_user_by_guid($photo->owner_guid);
				if(isset($user->cover_guid) && $user->cover_guid == $photoid){				
						$user->data->cover_time = time();
						//[E] Default cover picture #1647
						$user->data->cover_guid = false;
						$user->save();
				}				
				ossn_trigger_message(ossn_print('photo:deleted:success'), 'success');
				redirect("album/covers/profile/{$photo->owner_guid}");
		} else {
				ossn_trigger_message(ossn_print('photo:delete:error'), 'error');
				redirect(REF);
		}
} else {
		ossn_trigger_message(ossn_print('photo:delete:error'), 'error');
		redirect(REF);
}
