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
if(!ossn_is_xhr()) {
		//redirect();
}
$guid         = input('guid');
$notification = new OssnNotifications();
$notification = $notification->getbyGUID($guid);
if($notification && ($notification->owner_guid == ossn_loggedin_user()->guid || ossn_loggedin_user()->canModerate())) {
		if($notification->deleteItem()) {
				echo 1;
				exit();
		}
}
echo 0;
exit();