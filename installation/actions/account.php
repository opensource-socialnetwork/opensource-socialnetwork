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

define('OSSN_ALLOW_SYSTEM_START', TRUE);
require_once(dirname(dirname(dirname(__FILE__))) . '/system/start.php');

$user['username'] = input('username');
$user['firstname'] = input('firstname');
$user['lastname'] = input('lastname');
$user['email'] = input('email');
$user['reemail'] = input('email_re');
$user['password'] = input('password');
$user['gender'] = input('gender');

$user['bdd'] = input('birthday');
$user['bdm'] = input('birthm');
$user['bdy'] = input('birthy');

foreach ($user as $field => $value) {
    if (empty($value)) {
        ossn_installation_message(ossn_print('fields:require'), 'fail');
        redirect(REF);
    }
}

if ($user['reemail'] !== $user['email']) {
    ossn_installation_message(ossn_print('emai:match:error'), 'fail');
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
$add->sendactiviation = false;
$add->usertype = 'admin';
$add->validated = true;

if (!$add->isUsername($user['username'])) {
    ossn_installation_message(ossn_print('username:error'), 'fail');
    redirect(REF);
}
if (!$add->isPassword()) {
    ossn_installation_message(ossn_print('password:error'), 'fail');
    redirect(REF);
}

if ($add->addUser()) {
    ossn_installation_message(ossn_print('account:created'), 'success');
    redirect('installation?page=installed');
} else {
    ossn_installation_message(ossn_print('account:create:error:admin'), 'fail');
    redirect(REF);
}
