<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$guid = input('guid');
$item = expense_get_item($guid);
if($item && ($item->owner_guid == ossn_loggedin_user()->guid || ossn_isAdminLoggedin())){
		if($item->deleteObject()){
				echo 1;
				exit;
		}
}
echo 0;
exit;