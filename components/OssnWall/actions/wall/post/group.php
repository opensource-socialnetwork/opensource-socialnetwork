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

$OssnWall = new OssnWall;

$OssnWall->poster_guid = ossn_loggedin_user()->guid;

$owner = input('wallowner');
if (isset($owner) && !empty($owner)) {
    $OssnWall->owner_guid = $owner;
}

$OssnWall->type = 'group';

$post = input('post');
$friends = false;
$location = input('location');

if ($OssnWall->Post($post, $friends, $location, OSSN_PRIVATE)) {
		if(ossn_is_xhr()) {
				$guid = $OssnWall->getObjectId();
				$get  = $OssnWall->GetPost($guid);
				if($get) {
						$get = ossn_wallpost_to_item($get);
						ossn_set_ajax_data(array(
								'post' => ossn_wall_view_template($get)
						));
				}
		}
		//no need to show message on success.
		//3.x why not? $arsalanshah
		ossn_trigger_message(ossn_print('post:created'));
		redirect(REF);
} else {
    ossn_trigger_message(ossn_print('post:create:error'), 'error');
    redirect(REF);
}
