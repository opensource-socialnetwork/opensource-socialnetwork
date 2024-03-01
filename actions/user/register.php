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


header('Content-Type: application/json');

$user['username'] = input('username');
$user['firstname'] = input('firstname');
$user['lastname'] = input('lastname');
$user['email'] = input('email');
$user['reemail'] = input('email_re');
$user['password'] = input('password');

$fields = ossn_user_fields_names();
if($fields && isset($fields['required'])) {
		foreach($fields['required'] as $field){
				$user[$field] = input($field);
		}
}

if (!empty($user)) {
    foreach ($user as $field => $value) {
        if (empty($value)) {
            $json['error'] = '1';
        }
    }
}

//[B] input of non_required extra fields in signup form is ignored #2355
if($fields && isset($fields['non_required'])) {
		foreach($fields['non_required'] as $field){
				$user[$field] = input($field);
		}
}

if (isset($json['error']) && !empty($json['error'])) {
    echo json_encode($json);
    exit;
}

if ($user['reemail'] !== $user['email']) {
    $em['dataerr'] = ossn_print('email:error:matching');
    echo json_encode($em);
    exit;
}


$add = new OssnUser;
$add->username = $user['username'];
$add->first_name = $user['firstname'];
$add->last_name = $user['lastname'];
$add->email = $user['email'];
$add->password = $user['password'];
$add->sendactiviation = true;
$add->validated = false;

if($fields) {
		foreach($fields as $items){
				foreach($items as $field){
						$add->{$field} = $user[$field];
				}
		}
}

if (!$add->isUsername()) {
    $em['dataerr'] = ossn_print('username:error');
    echo json_encode($em);
    exit;
}
if (!$add->isPassword()) {
    $em['dataerr'] = ossn_print('password:error');
    echo json_encode($em);
    exit;
}
if($add->isOssnUsername()){
    $em['dataerr'] = ossn_print('username:inuse');
    echo json_encode($em);
    exit;	
}
if($add->isOssnEmail()){
    $em['dataerr'] = ossn_print('email:inuse');
    echo json_encode($em);
    exit;	
}
//check if email is valid email 
if(!$add->isEmail()){
    $em['dataerr'] = ossn_print('email:invalid');
    echo json_encode($em);
    exit;		
}
if ($add->addUser()) {
    $em['success'] = 1;
    $em['datasuccess'] = ossn_print('account:created:email');
    echo json_encode($em);
    exit;
} else {
    $em['dataerr'] = ossn_print('account:create:error:admin');
    echo json_encode($em);
    exit;
}
