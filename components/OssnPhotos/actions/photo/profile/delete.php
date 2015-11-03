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

$photoid = input('id');
$delete = ossn_photos();
$delete->photoid = $photoid;
$photo = $delete->GetPhoto($delete->photoid);
if (($photo->owner_guid == ossn_loggedin_user()->guid) || ossn_isAdminLoggedin()) {
    if ($delete->deleteProfilePhoto()) {
		
		$user = ossn_user_by_guid($photo->owner_guid);
		$user->data->icon_time = false;
		$user->save();
		
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
