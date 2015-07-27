<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */


$guid = input('guid');
$group = ossn_get_group_by_guid($guid);
if ($group->owner_guid !== ossn_loggedin_user()->guid) {
	ossn_trigger_message(ossn_print('group:delete:fail'), 'error');
    redirect(REF);	
}

if(($group->owner_guid !== ossn_loggedin_user()->guid) || ossn_isAdminLoggedin()){
	if ($group->deleteGroup($group->guid)) {
    	ossn_trigger_message(ossn_print('group:deleted'));
    	redirect();
	} else {
    	ossn_trigger_message(ossn_print('group:delete:fail'), 'error');
    	redirect(REF);
	}
} else {
	ossn_trigger_message(ossn_print('group:delete:fail'), 'error');
    	redirect(REF);	
}