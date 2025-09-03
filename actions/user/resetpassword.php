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
$user = input('user');
$code = input('c');
$password = input('password');
if (empty($password)) {
    ossn_trigger_message(ossn_print('password:error'), 'error');
    redirect(REF);
}
if (!empty($user) && !empty($code)) {
    $user = ossn_user_by_username($user);
    if ($user && $code == $user->getParam('login:reset:code')) {
        if ($user->resetPassword($password)) {
            $user->deleteResetCode();
            ossn_trigger_message(ossn_print('passord:reset:success'), 'success');
            redirect();
        } else {
            ossn_trigger_message(ossn_print('passord:reset:fail'), 'error');
            redirect(REF);
        }
    } else {
        ossn_trigger_message(ossn_print('passord:reset:fail'), 'error');
        redirect(REF);
    }
} else {
    ossn_trigger_message(ossn_print('passord:reset:fail'), 'error');
    redirect(REF);
}