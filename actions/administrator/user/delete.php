<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
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