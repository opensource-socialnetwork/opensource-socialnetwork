<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$en = array(
	'com:ossn:invite' => 'Invite',			
	'com:ossn:invite:friends' => 'Invite Friends',
	'com:ossn:invite:friends:note' => 'To invite friends to join you on this network, enter their email addresses and a message they will receive with your invitation',
	'com:ossn:invite:emails:note' => 'Email addresses (seprated by a comma)',
	'com:ossn:invite:emails:plceholder' => 'smith@example.com, john@example.com',
	'com:ossn:invite:message' => 'Message',
		
    	'com:ossn:invite:mail:subject' => 'Invitation to join %s',	
    	'com:ossn:invite:mail:message' => 'You have been invited to join %s by %s. They included the following message:

%s

To join, click the following link:

%s

Profile link: %s
',	
	'com:ossn:invite:mail:message:default' => 'Hi,

I want to invite you to join my network here on %s.

Profile link : %s',
	'com:ossn:invite:sent' => 'Your friends were invited. Invites sent: %s.',
	'com:ossn:invite:wrong:emails' => 'The following addresses are not valid: %s.',
	'com:ossn:invite:sent:failed' => 'Cannot able invite following addresses: %s.',
	'com:ossn:invite:already:members' => 'The following are already members: %s',
	'com:ossn:invite:empty:emails' => 'Please add at least one email',
);
ossn_register_languages('en', $en); 
