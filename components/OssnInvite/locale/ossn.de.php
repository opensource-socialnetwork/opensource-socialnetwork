<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$de = array(
	'com:ossn:invite' => 'Abschicken',			
	'com:ossn:invite:friends' => 'Freunde einladen',
	'com:ossn:invite:friends:note' => 'Gib einfach die Email-Adressen aller Freunde ein, die Du gern in dieses Netzwerk einladen möchtest.
    <br>Sie erhalten dann automatisch eine Einladung per Mail.',
	'com:ossn:invite:emails:note' => 'Email Adressen (Komma getrennt)',
	'com:ossn:invite:emails:placeholder' => 'inge@beispiel.de, r.hood@example.com',
	'com:ossn:invite:message' => 'Einladungstext',
		
    'com:ossn:invite:mail:subject' => 'Eine Einladung vom %s',	
    'com:ossn:invite:mail:message' => 'Hallo,
    
hier kommt eine Einladung vom %s. Die Nachricht wurde Dir von %s geschickt:

%s

Wenn Du mitmachen möchtest, klicke einfach auf den folgenden Link:

%s

Direkt zu seinem Profil geht es hier: %s
',	
	'com:ossn:invite:mail:message:default' => 'Hallo,

ich wollte Dich einladen, bei %s mitzumachen.

Direkt zu meinem Profil geht es hier: %s

Viele Grüße.
%s',
	'com:ossn:invite:sent' => 'Deine Freunde haben jetzt eine Einladung bekommen. Verschickte Einladungen: %s.',
	'com:ossn:invite:wrong:emails' => 'Diese Adressen sind ungültig: %s.',
	'com:ossn:invite:sent:failed' => 'Folgende Adressen konnten nicht eingeladen werden: %s.',
	'com:ossn:invite:already:members' => 'Diese Adressen sind bereits bei uns registriert: %s',
	'com:ossn:invite:empty:emails' => 'Bitte gib zumindest eine Adresse an',
);
ossn_register_languages('de', $de); 
