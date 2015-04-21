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

$user['username'] = input('username');
$user['firstname'] = input('firstname');
$user['lastname'] = input('lastname');
$user['email'] = input('email');
$user['password'] = input('password');
$user['gender'] = input('gender');
$user['type'] = input('type');

$user['bdd'] = input('birthday');
$user['bdm'] = input('birthm');
$user['bdy'] = input('birthy');
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
$user['birthdate'] = "{$user['bdd']}/{$user['bdm']}/{$user['bdy']}";

$add = new OssnUser;
$add->username = $user['username'];
$add->first_name = $user['firstname'];
$add->last_name = $user['lastname'];
$add->email = $user['email'];
$add->password = $user['password'];
$add->gender = $user['gender'];
$add->birthdate = $user['birthdate'];
$add->usertype = $user['type'];

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
