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

$user['username'] = input('username');
$user['firstname'] = input('firstname');
$user['lastname'] = input('lastname');
$user['email'] = input('email');
$user['password'] = input('password');
$user['type'] = input('type');

$fields = ossn_user_fields_names();
if($fields && isset($fields['required'])) {
		foreach($fields['required'] as $field){
				$user[$field] = input($field);
		}
}

if (!empty($user)) {
    foreach ($user as $field => $value) {
        if (empty($value)) {
            ossn_trigger_message(ossn_print('fields:require'), 'error');
            redirect(REF);
        }
    }
}
$types = array(
    'normal',
    'admin'
);
if (!in_array($user['type'], $types)) {
    ossn_trigger_message(ossn_print('account:create:error:admin'), 'error');
    redirect(REF);
}

$add = new OssnUser;
$add->username = $user['username'];
$add->first_name = $user['firstname'];
$add->last_name = $user['lastname'];
$add->email = $user['email'];
$add->password = $user['password'];
$add->usertype = $user['type'];
$add->validated = true;

if($fields) {
		foreach($fields as $items){
				foreach($items as $field){
						$add->{$field} = $user[$field];
				}
		}
}

if (!$add->isUsername($user['username'])) {
    ossn_trigger_message(ossn_print('username:error'), 'error');
    redirect(REF);
}
if (!$add->isPassword()) {
    ossn_trigger_message(ossn_print('password:error'), 'error');
    redirect(REF);
}
if($add->isOssnUsername()){
    ossn_trigger_message(ossn_print('username:inuse'), 'error');
    redirect(REF);
}
if($add->isOssnEmail()){
    ossn_trigger_message(ossn_print('email:inuse'), 'error');
    redirect(REF);
}
//check if email is valid email 
if(!$add->isEmail()){
    ossn_trigger_message(ossn_print('email:invalid'), 'error');
    redirect(REF);	
}
if ($add->addUser()) {
    ossn_trigger_message(ossn_print('account:created'), 'success');
    redirect(REF);
} else {
    ossn_trigger_message(ossn_print('account:create:error:admin'), 'error');
    redirect(REF);
}
