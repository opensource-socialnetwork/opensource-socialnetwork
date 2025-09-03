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
$eo = array(
	'com:ossn:invite' => 'Inviti',			
	'com:ossn:invite:friends' => 'Inviti amikojn',
	'com:ossn:invite:friends:note' => 'Por inviti amikojn ke aliĝi al ĉi tiu interkona retejo, enskribi iliajn retpoŝtadresojn kaj mallongan mesaĝon. Ili ricevos retpoŝton kiun enhavas vian inviton.',
	'com:ossn:invite:emails:note' => 'Retpoŝtadresoj (disigu perkome)',
	'com:ossn:invite:emails:placeholder' => 'zamenhof@ekzemplo.com, ludoviko@ekzemplo.com',
	'com:ossn:invite:message' => 'Mesaĝo',
		
    	'com:ossn:invite:mail:subject' => 'Invito por aliĝi al %s',	
    	'com:ossn:invite:mail:message' => 'Vi estas invitita por aliĝi al %s de %s. Sube mesaĝo estas inkluzivata:

%s

Por aliĝi, alklaku la ligolon sube:

%s

Profila ligilo: %s
',	
	'com:ossn:invite:mail:message:default' => 'Saluton,

Mi volas inviti vin por aliĝi al ĉi tiu interkona retejo je %s.

Profila ligilo : %s

Plej amike.
%s',
	'com:ossn:invite:sent' => 'Viaj amikoj estas invititaj. Invito alsenda: %s.',
	'com:ossn:invite:wrong:emails' => 'La sekvantaj adresoj ne estas validaj: %s.',
	'com:ossn:invite:sent:failed' => 'Ne povas inviti la sekvantajn adresojn: %s.',
	'com:ossn:invite:already:members' => 'La sekvantaj adresoj estas jam membroj: %s',
	'com:ossn:invite:empty:emails' => 'Bonvolu enskribi almenaŭ unu retpoŝtadreson',
);
ossn_register_languages('eo', $eo); 
