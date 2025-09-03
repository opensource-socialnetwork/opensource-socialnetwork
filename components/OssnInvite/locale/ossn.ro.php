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
$ro = array(
	'com:ossn:invite' => 'Invita',			
	'com:ossn:invite:friends' => 'Invita Prieteni',
	'com:ossn:invite:friends:note' => 'Ca sa poti invita prietenii in acest network scrie adresa lor de email si un scurt mesaj. ei vor primi un email apoi ce va contine mesajul tau.',
	'com:ossn:invite:emails:note' => 'Adrese de email (separati folosind  virgula intre ele)',
	'com:ossn:invite:emails:placeholder' => 'ion@exemplu.com, maria@exemplu.com',
	'com:ossn:invite:message' => 'Mesaj',
		
    	'com:ossn:invite:mail:subject' => 'Invitatie de inscriere in %s',	
    	'com:ossn:invite:mail:message' => 'Esti invitat sa te inscrii in %s de catre %s. Urmatorul mesaj a fost trimis: 

%s

Ca sa te inscrii click pe urmatorul LInk: 

%s

 Link profil: %s
',	
	'com:ossn:invite:mail:message:default' => 'Buna, vreau sa te invit sa fim impreuna aici pe %s.

Link Profil : %s

Multe Salutari.
%s',
	'com:ossn:invite:sent' => 'Prietenii tai au fost invitati. Invitatiile au fost trimise: %s.',
	'com:ossn:invite:wrong:emails' => 'Aceste adrese de email sunt invalide: %s.',
	'com:ossn:invite:sent:failed' => 'Nu putem trimite invitatie la urmatoarele adrese: %s.',
	'com:ossn:invite:already:members' => 'Aceste adrese de email apartin membrilor deja inscrisi : %s',
	'com:ossn:invite:empty:emails' => 'Adauga cel putin o adresa de email',
);
ossn_register_languages('ro', $ro); 
