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