<?php
/**
 * Buddyexpress Framework Core
 *
 * @package   Bframework
 * @author    Buddyexpress Core Team <admin@buddyexpress.net
 * @copyright 2012 BUDDYEXPRESS.
 * @license   Buddyexpress Public License http://www.buddyexpress.net/Licences/bpl/ 
 * @link      http://bserver.buddyexpress.net
 * @Contributors http://www.buddyexpress.net/bframework/contributors.b
 */
/*
* send a mail
* @uses see doc's
*/
function bframework_send_mail($params = ''){
if(is_array($params)){ if(isset($params['to']) && isset($params['email']) && isset($params['message']) && isset($params['subject'])){
        if(mail($params['to'], $params['subject'], $params['message'], 'From: ' . $params['email'])) {
     	echo 'Your email was sent successfully.';
        } else { die('There was a problem sending your email.'); 
        }
		
} else { die('Some thing is missing retry by reloading page');

    }
   }
}
function bframework_send_email_admin($msg, $email, $subject){
if(isset($msg) && isset($email) && isset($subject) && !empty($msg) && !empty($email) && !empty($subject)){
bframework_send_mail(array(
               'to' => bframework_app_admin_email(),
			   'email' => $email, 
			   'message' => $msg, 
			   'subject' => $subject
 ));
  }  
}
