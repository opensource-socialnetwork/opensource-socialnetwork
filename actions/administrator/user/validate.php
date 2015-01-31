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