<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 $subject_guid = input('subject_guid'); //with who, the loggedin user typing
 $type		   = input('status');
 if($type == 'yes' || $type == 'no'){
	 $MessageTyping = new MessageTyping;
	 $MessageTyping->setStatus($subject_guid, ossn_loggedin_user()->guid, $type);
	 echo 1;
	 exit;
 }
 echo 0;
 exit;