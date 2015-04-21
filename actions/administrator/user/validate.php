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