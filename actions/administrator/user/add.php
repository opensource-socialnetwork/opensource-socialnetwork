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
            ossn_trigger_message(ossn_print('fields:require'), 'error', 'admin');
            redirect(REF);
        }
    }
}
$types = array(
    'normal',
    'admin'
);
if (!in_array($user['type'], $types)) {
    ossn_trigger_message(ossn_print('account:create:error:admin'), 'error', 'admin');
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
    ossn_trigger_message(ossn_print('username:error'), 'error', 'admin');
    redirect(REF);
}
if (!$add->isPassword()) {
    ossn_trigger_message(ossn_print('password:error'), 'error', 'admin');
    redirect(REF);
}

if ($add->addUser()) {
    ossn_trigger_message(ossn_print('account:created'), 'success', 'admin');
    redirect(REF);
} else {
    ossn_trigger_message(ossn_print('account:create:error:admin'), 'error', 'admin');
    redirect(REF);
}