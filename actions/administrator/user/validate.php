<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$user = ossn_user_by_guid(input('guid'));
if(!$user){
	ossn_trigger_message(ossn_print('admin:user:validate:error'), 'error');
	redirect(REF);
}
$code = $user->activation;
if($user->ValidateRegistration($code)){
	ossn_trigger_message(ossn_print('admin:user:validated'));
} else {
	ossn_trigger_message(ossn_print('admin:user:validate:error'), 'error');
}
redirect(REF);