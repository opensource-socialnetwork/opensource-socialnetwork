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
$user = input('email');
if (empty($user)) {
    ossn_trigger_message(ossn_print('password:reset:email:required'), 'error');
    redirect(REF);
}
$user = ossn_user_by_email($user);
if ($user && $user->SendResetLogin()) {
    ossn_trigger_message(ossn_print('passord:reset:email:success'), 'success');
    redirect();
} else {
    ossn_trigger_message(ossn_print('passord:reset:fail'), 'error');
    redirect(REF);
}