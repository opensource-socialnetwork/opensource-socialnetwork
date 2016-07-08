<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014-2016 SOFTLAB24 LIMITED
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
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
