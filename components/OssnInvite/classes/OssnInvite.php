<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
class OssnInvite extends OssnMail {
	/**
     * Check if email is valid or not
     *
     * @return bool;
     */
    public function isEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
	/**
     * Send emails to provided addresses
     *
     * @return bool;
     */	
	public function sendInvitation(){
		$email = $this->address;
		
		$message = strip_tags($this->message);
		$message = html_entity_decode($message, ENT_QUOTES, "UTF-8");
		$message = ossn_restore_new_lines($message);
		
		$user = ossn_loggedin_user();
		if(!isset($user->guid) || empty($email)){
			return false;
		}
		$actual_message = $message;
		$user_fullname 	= html_entity_decode($user->fullname, ENT_QUOTES, "UTF-8");
		
		$site = ossn_site_settings('site_name');
		$site = html_entity_decode($site, ENT_QUOTES, "UTF-8");
		$url = ossn_site_url("?com_invite_friend={$user->guid}");
		
		if(empty($message)){
			$params = array($url, $user->profileURL(), $user_fullname);
			$message = ossn_print('com:ossn:invite:mail:message:default', $params);
		} else {
			$params = array($site, $user_fullname, $message, $url, $user->profileURL());	
			$message = ossn_print("com:ossn:invite:mail:message", $params);			
		}
		
		$subject = ossn_print("com:ossn:invite:mail:subject", array($site));
		
		$args = array(
				'email' => $email,
				'user' => $user,
				'subject' => $subject,
				'message' => $message,
				'actual_message' => $actual_message,
		);
		$vars = ossn_call_hook('invite', 'user:options', $args, $args);
		return $this->NotifiyUser($vars['email'], $vars['subject'], $vars['message']);
	}
}//class
