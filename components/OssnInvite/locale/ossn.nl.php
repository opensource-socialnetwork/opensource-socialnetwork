<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    Dieter <info@marohn.nl>
 * @copyright 2014-2018 OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$nl = array(
	'com:ossn:invite' => 'Uitnodigen',			
	'com:ossn:invite:friends' => 'Vrienden Uitnodigen',
	'com:ossn:invite:friends:note' => 'Om vrienden uit te nodigen om mee te doen op dit netwerk, Nodig ze uit door hun email adres in te vullen. Ze zullen uw uitnodiging per email ontvangen.',
	'com:ossn:invite:emails:note' => 'Email addressen (gescheiden door een komma)',
	'com:ossn:invite:emails:placeholder' => 'sjaak@voorbeeld.com, john@example.com',
	'com:ossn:invite:message' => 'Bericht',
		
    	'com:ossn:invite:mail:subject' => 'Uitnodigen op %s',	
    	'com:ossn:invite:mail:message' => 'U bent uitgenodigd om lid te worden %s door %s. Ze hebben het volgende bericht meegestuurd:
%s
Om lid te worden, klik op de volgende link:
%s
Profile link: %s
',	
	'com:ossn:invite:mail:message:default' => 'Hoi,
Ik wilde je uit nodigen om lid te worden van %s.
Profile link : %s
Met vriendelijke groet.
%s',
	'com:ossn:invite:sent' => 'De uitnodigingen zijn verzonden: %s.',
	'com:ossn:invite:wrong:emails' => 'De volgende adressen zijn niet correct: %s.',
	'com:ossn:invite:sent:failed' => 'Kon de volgende adressen niet uitnodigens: %s.',
	'com:ossn:invite:already:members' => 'De volgende addressen zijn al lid: %s',
	'com:ossn:invite:empty:emails' => 'U dient op zijn minst een email adres toe te voegen',
);
ossn_register_languages('nl', $nl); 
