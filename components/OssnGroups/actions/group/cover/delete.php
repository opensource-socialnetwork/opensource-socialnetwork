<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$group = ossn_get_group_by_guid(input('guid'));
if ($group->owner_guid !== ossn_loggedin_user()->guid && !ossn_isAdminLoggedin()) {
    ossn_trigger_message(ossn_print('group:delete:cover:error'), 'error');
    redirect(REF);
}
$files = $group->groupCovers();
if($files) {
	foreach($files as $file) {
		if($file->isFile()){
			unlink($file->getPath());	
		}
		$file->deleteEntity();
	}
	$group->ResetCoverPostition($group->guid);
}
ossn_trigger_message(ossn_print('group:delete:cover:success'));
redirect(REF);
