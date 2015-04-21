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

$guid = input('guid');
$user = ossn_user_by_guid($guid);
if($user && $user->guid !== ossn_loggedin_user()->guid){
	if($user->deleteUser()){
		ossn_trigger_message(ossn_print('admin:user:deleted'), 'success');
	} else {
		ossn_trigger_message(ossn_print('admin:user:delete:error'), 'error');		
	}
}
redirect(REF);