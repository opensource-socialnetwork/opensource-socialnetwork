<?php
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
//get phpmailer autload
require_once(ossn_route()->classes . 'mail/PHPMailerAutoload.php');
class OssnMail extends PHPMailer {
		/**
		 * Send email to user.
		 *
		 * To compltely  ovveride the email you may use
		 * ossn_add_hook('email', 'send:policy', 'ossn_deny_default_mailer', 1); function ossn_deny_default_mailer: return false;
		 * ossn_add_hook('email', 'send', 'ossn_my_custom_email', 1);
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
				//params contain initial params, while return may contain changed values
				$mail = ossn_call_hook('email', 'config', $this, $this); 
				
				$mail->setFrom(ossn_site_settings('notification_email'), ossn_site_settings('site_name'));
				$mail->addAddress($email);
				
				$mail->Subject = $subject;
				$mail->Body    = $body;
				$mail->CharSet = "UTF-8";
				$mail->XMailer = " "; //disable the exposure of x-mailer
				try {	
						$send = ossn_call_hook('email', 'send:policy', true, $mail);
						if($send) {
								if($mail->send()){
									return true;
								}
						} else {
							//allow system to intract with mail
							return ossn_call_hook('email', 'send', false, $mail);
						}
				}
				catch(phpmailerException $e) {
						error_log("Cannot send email " . $e->errorMessage(), 0);
				}
				return false;
		}
		
} //class
