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

if(ossn_isLoggedin()) {
		redirect('home');
}
$username = input('username');
$password = input('password');

if(empty($username) || empty($password)) {
		ossn_trigger_message(ossn_print('login:error'));
		redirect();
}
$user = ossn_user_by_username($username);

//check if username is email
if(strpos($username, '@') !== false) {
		$user     = ossn_user_by_email($username);
		$username = $user->username;
}

if($user && !$user->isUserVALIDATED()) {
		$user->resendValidationEmail();
		ossn_trigger_message(ossn_print('ossn:user:validation:resend'), 'error');
		redirect(REF);
}
$vars = array(
		'user' => $user
);
ossn_trigger_callback('user', 'before:login', $vars);

$login           = new OssnUser;
$login->username = $username;
$login->password = $password;
if($login->Login()) {
		//One uneeded redirection when login #516
		ossn_trigger_callback('login', 'success', $vars);
		redirect('home');
} else {
		redirect('login?error=1');
}
