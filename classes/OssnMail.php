<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
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
				//Emails should be validated before sending emails #1080
				if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
					error_log('Can not send email to empty email address', 0);
				}
				$this->setFrom(ossn_site_settings('notification_email'), ossn_site_settings('site_name'));
				$this->addAddress($email);
				
				$this->Subject = $subject;
				$this->Body    = $body;
				$this->CharSet = "UTF-8";
			
				try {	
						$send = ossn_call_hook('email', 'send:policy', true, $this);
						if($send) {
								if($this->send()){
									return true;
								}
						} else {
							//allow system to intract with mail
							return ossn_call_hook('email', 'send', false, $this);
						}
				}
				catch(phpmailerException $e) {
						error_log("Cannot send email " . $e->errorMessage(), 0);
				}
				return false;
		}
		
} //class
