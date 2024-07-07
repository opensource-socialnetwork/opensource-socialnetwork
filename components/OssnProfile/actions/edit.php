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

$user = ossn_user_by_username(input('username'));
if(!$user) {
		redirect(REF);
}

if($user->guid !== ossn_loggedin_user()->guid) {
		redirect('home');
}

$vars['firstname'] = mb_substr(input('firstname'), 0, 30);
$vars['lastname']  = mb_substr(input('lastname'), 0, 30);

//[E] make user email lowercase when adding to db #186
$vars['email']    = strtolower(input('email'));
$vars['username'] = input('username');

$fields = ossn_user_fields_names();
foreach ($fields['required'] as $field) {
		$vars[$field] = input($field);
}
if(!empty($vars)) {
		foreach ($vars as $field => $value) {
				if(empty($value)) {
						ossn_trigger_message(ossn_print('fields:require'), 'error');
						redirect(REF);
				}
		}
}
if(isset($fields['non_required'])) {
		foreach ($fields['non_required'] as $field) {
				$vars[$field] = input($field);
		}
}

//check if email is not in user
if($user->email !== input('email')) {
		$OssnUser        = new OssnUser();
		$OssnUser->email = $vars['email'];

		if($OssnUser->isOssnEmail()) {
				ossn_trigger_message(ossn_print('email:inuse'), 'error');
				redirect(REF);
		}
		//check if email is valid email
		if(!$OssnUser->isEmail()) {
				ossn_trigger_message(ossn_print('email:invalid'), 'error');
				redirect(REF);
		}
}

$password = input('password');

$user->first_name = $vars['firstname'];
$user->last_name  = $vars['lastname'];
$user->email      = $vars['email'];

//check if password then change password
if(!empty($password)) {
		$OssnUser           = new OssnUser();
		$OssnUser->password = $password;

		if(!$OssnUser->isPassword()) {
				ossn_trigger_message(ossn_print('password:error'), 'error');
				redirect(REF);
		}
		$user->new_password = $password;
}
$language = input('language');
$success  = ossn_print('user:updated');

if(!empty($language) && in_array($language, ossn_get_available_languages())) {
		$lang = $language;
} else {
		$lang = 'en';
}

if(!empty($fields)) {
		foreach ($fields as $items) {
				foreach ($items as $field) {
						$user->data->{$field} = $vars[$field];
				}
		}
}
//[B] If not extra fields langauge won't save at all. Profile edit #2385
$user->data->language = $lang;

//save
if($user->save()) {
		ossn_trigger_message($success, 'success');
		redirect(REF);
}
redirect(REF);
