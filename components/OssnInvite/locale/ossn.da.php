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
$da = array(
	'com:ossn:invite' => 'Inviter',			
	'com:ossn:invite:friends' => 'Inviter venner',
	'com:ossn:invite:friends:note' => 'For at invitere venner til at blive en del af dette netværk, skal du indtaste deres e-mailadresser og en kort besked. De vil modtage en e-mail med din invitation.',
	'com:ossn:invite:emails:note' => 'E-mailadresser (separeret af komma)',
	'com:ossn:invite:emails:placeholder' => 'hansen@eksempel.dk, jensen@eksempel.dk',
	'com:ossn:invite:message' => 'Besked',
		
	'com:ossn:invite:mail:subject' => 'Invitation til at blive medlem af %s',	
	'com:ossn:invite:mail:message' => 'Du er blevet inviteret til at blive medlem af %s af %s. De har vedlagt følgende besked:

%s

Klik på følgende link for at blive medlem:

%s

Profil-link: %s
',	
	'com:ossn:invite:mail:message:default' => 'Hej,

Jeg vil gerne invitere dig til mit netværk her på %s.

Profil-link : %s

Med venlig hilsen,
%s',
	'com:ossn:invite:sent' => 'Dine venner er blevet inviteret. Invitationer sendt: %s.',
	'com:ossn:invite:wrong:emails' => 'Følgende adresser er ikke gyldige: %s.',
	'com:ossn:invite:sent:failed' => 'Kunne ikke invitere følgende adresser: %s.',
	'com:ossn:invite:already:members' => 'Følgende adresser er allerede medlemmer: %s',
	'com:ossn:invite:empty:emails' => 'Tilføj venligst mindst én e-mailadresse',
);
ossn_register_languages('da', $da);