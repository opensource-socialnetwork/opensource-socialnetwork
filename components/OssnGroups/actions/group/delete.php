<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */


$guid = input('guid');
$group = ossn_get_group_by_guid($guid);

if(($group->owner_guid === ossn_loggedin_user()->guid) || ossn_isAdminLoggedin()){
	if ($group->deleteGroup($group->guid)) {
    	ossn_trigger_message(ossn_print('group:deleted'));
    	redirect();
	} 
}
ossn_trigger_message(ossn_print('group:delete:fail'), 'error');
redirect(REF);	
