<?php
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
if (ossn_isAdminLoggedin()) {
    redirect('administrator/dashboard');
}

$username = input('username');
$password = input('password');

//check if username is email
if (strpos($username, '@') !== false){
	$user = ossn_user_by_email($username);
	$username = $user->username;
}
$checktype = ossn_user_by_username($username);
if ($checktype && $checktype->type !== 'admin') {
    ossn_trigger_message(ossn_print('login:error'), 'error');
    redirect(REF);
}
if (empty($username) || empty($password)) {
    ossn_trigger_message(ossn_print('login:error'), 'error');
    redirect(REF);
}

$login = new OssnUser;
$login->username = $username;
$login->password = $password;
if ($login->Login()) {
    ossn_trigger_message(ossn_print('login:success'), 'success');
    redirect(REF);
} else {
    ossn_trigger_message(ossn_print('login:error'), 'error');
    redirect(REF);
}
