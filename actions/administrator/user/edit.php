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

$user['firstname'] = input('firstname');
$user['lastname'] = input('lastname');
$user['email'] = input('email');
$user['gender'] = input('gender');
$user['type'] = input('type');
$user['username'] = input('username');

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
$password = input('password');

$types = array(
    'normal',
    'admin'
);
if (!in_array($user['type'], $types)) {
    ossn_trigger_message(ossn_print('account:create:error:admin'), 'error', 'admin');
    redirect(REF);
}

$user['birthdate'] = "{$user['bdd']}/{$user['bdm']}/{$user['bdy']}";

$OssnUser = new OssnUser;
$OssnUser->password = $password;
$OssnUser->email = $user['email'];

$OssnDatabase = new OssnDatabase;


$params['table'] = 'ossn_users';
$params['wheres'] = array("guid='{$user_get->guid}'");

$params['names'] = array(
    'first_name',
    'last_name',
    'email',
    'type'
);
$params['values'] = array(
    $user['firstname'],
    $user['lastname'],
    $user['email'],
    $user['type']
);
//check if email is not in user
if($OssnUser->isOssnEmail()){
    ossn_trigger_message(ossn_print('email:inuse'), 'error', 'admin');
    redirect(REF);
}
//check if email is valid email 
if(!$OssnUser->isEmail()){
    ossn_trigger_message(ossn_print('email:invalid'), 'error', 'admin');
    redirect(REF);	
}
//check if password then change password
if (!empty($password)) {
    if (!$OssnUser->isPassword()) {
        ossn_trigger_message(ossn_print('password:error'), 'error', 'admin');
        redirect(REF);
    }
    $salt = $OssnUser->generateSalt();
    $password = $OssnUser->generate_password($password, $salt);
    $params['names'] = array(
        'first_name',
        'last_name',
        'email',
        'type',
        'password',
        'salt'
    );
    $params['values'] = array(
        $user['firstname'],
        $user['lastname'],
        $user['email'],
        $user['type'],
        $password,
        $salt
    );
}

//save
if ($OssnDatabase->update($params)) {
    //update entities
    $guid = $user_get->guid;
    if (!empty($guid)) {
        $user_get->owner_guid = $guid;
        $user_get->type = 'user';
        $user_get->data->gender = $user['gender'];
        $user_get->data->birthdate = $user['birthdate'];
        $user_get->save();
    }
    ossn_trigger_message(ossn_print('user:updated'), 'success', 'admin');
    redirect(REF);
} 
