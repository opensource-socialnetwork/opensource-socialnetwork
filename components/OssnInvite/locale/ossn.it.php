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
	'com:ossn:invite' => 'Invita',			
	'com:ossn:invite:friends' => 'Invita Amici',
	'com:ossn:invite:friends:note' => 'Per invitare i tuoi amici a far parte della nostra rete, inserisci i loro indirizzi e-mail ed un breve messaggio. Riceveranno una e-mail contenente il tuo invito.',
	'com:ossn:invite:emails:note' => 'Indirizzi e-mail (separati da una virgola)',
	'com:ossn:invite:emails:placeholder' => 'mario@esempio.com, luigi@esempio.com',
	'com:ossn:invite:message' => 'Messaggio',
		
    	'com:ossn:invite:mail:subject' => 'Invito ad iscriversi a %s',	
    	'com:ossn:invite:mail:message' => 'Hai ricevuto un invito ad iscriverti a %s da parte di %s. Ha incluso il seguente messaggio:

%s

Per iscriverti, premi sul seguente link:

%s

Profile link: %s
',	
	'com:ossn:invite:mail:message:default' => 'Ciao,

Ti volevo invitar ea far parte della mia rete su %s.

Il mio profilo : %s

Saluti.
%s',
	'com:ossn:invite:sent' => 'I tuoi amici sono stati invitati. Inviti inviati: %s.',
	'com:ossn:invite:wrong:emails' => 'I seguenti indirizzi non sono validi: %s.',
	'com:ossn:invite:sent:failed' => 'Non posso invitare i seguenti indirizzi: %s.',
	'com:ossn:invite:already:members' => 'I seguenti indirizzi sono già membri: %s',
	'com:ossn:invite:empty:emails' => 'Per favore, inserisci almeno un indirizzo e-mail',
);
ossn_register_languages('it', $en); 
