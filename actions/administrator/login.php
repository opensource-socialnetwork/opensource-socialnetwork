<?php
/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.com/licence
 */
if(ossn_isAdminLoggedin()){
	 redirect('administrator/dashboard');	
}

$username = input('username');
$password = input('password');
if(ossn_user_by_username($username)->type !== 'admin'){
    ossn_trigger_message(ossn_print('login:error'), 'error', 'admin');
	redirect(REF);		
}
if(empty($username) || empty($password)){
 	ossn_trigger_message(ossn_print('login:error'), 'error', 'admin');
	redirect(REF);	
}

$login = new OssnUser;
$login->username = $username;
$login->password = $password;
if($login->Login()){
	ossn_trigger_message(ossn_print('login:success'), 'success', 'admin');
	redirect(REF);	
} 
else {
    ossn_trigger_message(ossn_print('login:error') , 'error', 'admin');
	redirect(REF);	
}