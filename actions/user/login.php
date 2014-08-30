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
 
if(ossn_isLoggedin()){
	 redirect('home');	
}
$username = input('username');
$password = input('password');

if(empty($username) || empty($password)){
 	 ossn_trigger_message(ossn_print('login:error'), 'success', 'site');   
	 redirect();
}

$login = new OssnUser;
$login->username = $username;
$login->password = $password;
if($login->Login()){
   redirect('home');	
} 
else {
     redirect('login?error=1');	
}