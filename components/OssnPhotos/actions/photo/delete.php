<?php
/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.com/licence
 */
 
$photoid = input('id');

$delete = ossn_photos();
$delete->photoid = $photoid;

$photo  = $delete->GetPhoto($delete->photoid);

$owner = ossn_albums();
$owner = $owner->GetAlbum($photo->owner_guid);

if(($owner->owner_guid == ossn_loggedin_user()->guid) || ossn_isAdminLoggedin()){
    if($delete->deleteAlbumPhoto()){
       ossn_trigger_message(ossn_print('photo:deleted:success'), 'success');
       redirect();	
    } else {
       ossn_trigger_message(ossn_print('photo:delete:error'), 'error');
       redirect();	
   }
} else {
       ossn_trigger_message(ossn_print('photo:delete:error'), 'error');
       redirect();	
}
