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
$user = input('user');
$code = input('c');
$password = input('password');
if(empty($password)){
 	 ossn_trigger_message(ossn_print('password:error'), 'error');   
	 redirect(REF);      	
}
if(!empty($user) && !empty($code)){
   $user = ossn_user_by_username($user);
   if($code == $user->getParam('login:reset:code')){
	   if($user->resetPassword($password)){
		     $user->deleteResetCode();
		     ossn_trigger_message(ossn_print('passord:reset:success'), 'success');   
	         redirect();   
	   } else {
			 ossn_trigger_message(ossn_print('passord:reset:fail'), 'error');   
	         redirect(REF);     
	   }
   } else {
 	     	 ossn_trigger_message(ossn_print('passord:reset:fail'), 'error');   
	         redirect(REF);      
   }
} 
else {
	         ossn_trigger_message(ossn_print('passord:reset:fail'), 'error');   
	         redirect(REF);   	
}