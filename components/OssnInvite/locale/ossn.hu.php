<?php
/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    Open Source Social Network Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$hu = array(
	'com:ossn:invite' => 'Meghívás',			
	'com:ossn:invite:friends' => 'Barát meghívása',
	'com:ossn:invite:friends:note' => 'A barát meghívásához írd be az e-mail címét (többet is megadhatsz), írj egy rövid üzenetet.',
	'com:ossn:invite:emails:note' => 'Email címek (vesszővel elválasztva)',
	'com:ossn:invite:emails:placeholder' => 'smith@example.com, john@example.com',
	'com:ossn:invite:message' => 'Üzenet',
		
    	'com:ossn:invite:mail:subject' => 'Meghívás a %s közösségébe',	
    	'com:ossn:invite:mail:message' => 'Meghívót kaptál hogy részt vegyél a %s közösségbe, küldte %s. Ezt az üzenetet kaptad:

%s

Hogy regisztrálj, kattints az alábbi linkre:

%s

Profil: %s
',	
	'com:ossn:invite:mail:message:default' => 'Szia,

Szeretném ha csatlakoznál hozzánk: %s.

Profil : %s

Üdv.
%s',
	'com:ossn:invite:sent' => 'A barátaid meghívva. Meghívó küldve: %s.',
	'com:ossn:invite:wrong:emails' => 'A következő e-mail címek érvénytelenek: %s.',
	'com:ossn:invite:sent:failed' => 'Nem küldhető meghívó ezekre a címekre: %s.',
	'com:ossn:invite:already:members' => 'A következő e-mail címek már regisztráltak: %s',
	'com:ossn:invite:empty:emails' => 'Kérünk írj be legalább egy e-mail címet.',
);
ossn_register_languages('hu', $hu);
