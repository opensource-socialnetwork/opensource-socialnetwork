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
$en = array(
	'com:ossn:invite' => 'Invite',			
	'com:ossn:invite:friends' => 'Invite Friends',
	'com:ossn:invite:friends:note' => 'To invite friends to join you on this network, enter their email addresses and a brief message. They will receive an email containing your invitation.',
	'com:ossn:invite:emails:note' => 'Email addresses (separated by a comma)',
	'com:ossn:invite:emails:placeholder' => 'smith@example.com, john@example.com',
	'com:ossn:invite:message' => 'Message',
		
    	'com:ossn:invite:mail:subject' => 'Invitation to join %s',	
    	'com:ossn:invite:mail:message' => 'You have been invited to join %s by %s. They included the following message:

%s

To join, click the following link:

%s

Profile link: %s
',	
	'com:ossn:invite:mail:message:default' => 'Hi,

I wanted to invite you to join my network here on %s.

Profile link : %s

Best regards.
%s',
	'com:ossn:invite:sent' => 'Your friends were invited. Invites sent: %s.',
	'com:ossn:invite:wrong:emails' => 'The following addresses are not valid: %s.',
	'com:ossn:invite:sent:failed' => 'Cannot invite the following addresses: %s.',
	'com:ossn:invite:already:members' => 'The following addresses are already members: %s',
	'com:ossn:invite:empty:emails' => 'Please add at least one email address',
);
ossn_register_languages('en', $en); 
