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
    // Reset codes expire 1 hour after issuance (issue #2655).
    // The stored code carries its issuance time as a ':<unix>' suffix
    // (see OssnUser::SendResetLogin); legacy codes without the suffix are treated as expired.
    $stored_code = $user ? (string)$user->getParam('login:reset:code') : '';
    $code_parts  = explode(':', $stored_code);
    $code_fresh  = count($code_parts) === 2 && ctype_digit($code_parts[1]) && (time() - (int)$code_parts[1]) <= 3600;
    if ($user && $code_fresh && hash_equals($stored_code, (string)$code)) {
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
