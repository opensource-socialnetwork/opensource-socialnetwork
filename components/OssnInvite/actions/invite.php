<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 $invite = new OssnInvite;
 $addresses = input('addresses');
 
 //remove extra spaces from addresses.
 $addresses = trim($addresses);
 
 //show error if no email provided
 if(empty($addresses)){
	 ossn_trigger_message(ossn_print('com:ossn:invite:empty:emails'), 'error');
	 redirect(REF);
 } 
 
 //create arrays
 if (strlen($addresses) > 0) {
	 $emails = explode(',', $addresses);
 }
 //check if only one email then merge it into array
 if(empty($emails)){
	 $emails = array($addresses);
 }

 //init some variables
 $wrong_emails = array();
 $correct_emails = array();
 $failed_emails = array();
 $users_exist = array();
 
 $sent = 0;
 
 $error = false;
 $failed = false;
 $success = false;
 
 //seprate valid and non-valid addresses;
 foreach($emails as $email){
	 $email = trim($email);
	 if(!$invite->isEmail($email)){
		 $wrong_emails[] = $email;
		 $error = true;
	 } else {
		 $correct_emails[] = $email;
	 }
 }
 //invite only valid addresses
 foreach($correct_emails as $email){
 	 $invite = new OssnInvite;
 	 $invite->message = input('message');
	 $invite->address = trim($email);
	 //check if email exist then don't send invitation
	 $user = ossn_user_by_email($email);
	 if(isset($user->guid)){
		 $users_exist[] = $email;
		 continue;
	 }
	 //send message
	 if($invite->sendInvitation()){
		$sent++;
		$success = true;
	 } else {
	 	$failed = true;
		$failed_emails[] = $email;
 	}
 }
 
 //show message on success
 if($success){
	 ossn_trigger_message(ossn_print('com:ossn:invite:sent', array($sent)));
 }
 //show message if user exists
 if(!empty($users_exist)){
	 ossn_trigger_message(ossn_print('com:ossn:invite:already:members', array(implode(',', $users_exist))), 'error');	 
 }
 //show message if emails are wrong
 if($error){
	 ossn_trigger_message(ossn_print('com:ossn:invite:wrong:emails', array(implode(',', $wrong_emails))), 'error');
 }
 //show message if failed to send
 if($failed){
	ossn_trigger_message(ossn_print('com:ossn:invite:sent:failed', array(implode(',', $failed_emails))), 'error');	 
 }
 //redirect user
 redirect(REF);
