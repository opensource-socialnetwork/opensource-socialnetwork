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