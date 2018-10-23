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
$user = ossn_user_by_guid($guid);
if($user && $user->guid !== ossn_loggedin_user()->guid){
	if($user->deleteUser()){
		ossn_trigger_message(ossn_print('admin:user:deleted'), 'success');
	} else {
		ossn_trigger_message(ossn_print('admin:user:delete:error'), 'error');		
	}
}
redirect(REF);