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

//get phpmailer autload
require_once(ossn_route()->classes . 'mail/PHPMailerAutoload.php');

class OssnMail extends PHPMailer {
		/**
		 * Send email to user.
		 *
		 * @param string $email User email address
		 * @param string $subject Email subject
		 * @param string $body Email body
		 *
		 * @return boolean
		 */
		public function NotifiyUser($email, $subject, $body) {
				if(empty($email)){
					error_log('Can not send email to empty email address', 0);
				}
				$this->setFrom(ossn_site_settings('notification_email'), ossn_site_settings('site_name'));
				$this->addAddress($email);
				
				$this->Subject = $subject;
				$this->Body    = $body;
				$this->CharSet = "UTF-8";
				
				try {	
						$send = ossn_call_hook('email', 'send', $this->send(), $this);
						if($send) {
								return true;
						}
				}
				catch(phpmailerException $e) {
						error_log("Cannot send email " . $e->errorMessage(), 0);
				}
				return false;
		}
		
} //class
