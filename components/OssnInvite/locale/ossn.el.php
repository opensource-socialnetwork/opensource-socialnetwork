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
$el = array(
	'com:ossn:invite' => 'Προσκαλέσετε',			
	'com:ossn:invite:friends' => 'Προσκαλέσετε φίλους',
	'com:ossn:invite:friends:note' => 'Προσκαλέσετε τους φίλους να συμμετάσχουν σε αυτό το δίκτυο, εισαγάγετε τις διευθύνσεις Email και ένα σύντομο μήνυμα. Θα λάβουν ένα Email που θα περιέχει την πρόσκλησή σας.',
	'com:ossn:invite:emails:note' => 'Email addresses (διαχωρίστε με κόμμα)',
	'com:ossn:invite:emails:placeholder' => 'smith@example.com, john@example.com',
	'com:ossn:invite:message' => 'Μήνυμα',
		
    	'com:ossn:invite:mail:subject' => 'Πρόσκληση συμμετοχής %s',	
    	'com:ossn:invite:mail:message' => 'Έχετε προσκληθεί να συμμετάσχετε στο %s από %s. Περιέλαβε το ακόλουθο μήνυμα:

%s

Για να συμμετάσχετε, κάντε κλικ στον παρακάτω σύνδεσμο:

%s

Σύνδεσμος προφίλ: %s
',	
	'com:ossn:invite:mail:message:default' => 'Γεια,

	Ήθελα να σας προσκαλέσω να συμμετάσχετε στο %s.

Σύνδεσμος προφίλ : %s

Best regards.
%s',
	'com:ossn:invite:sent' => 'Οι φίλοι σας προσκλήθηκαν. Προσκλήσεις που στάλθηκαν: %s.',
	'com:ossn:invite:wrong:emails' => 'Οι ακόλουθες διευθύνσεις δεν είναι έγκυρες: %s.',
	'com:ossn:invite:sent:failed' => 'Δεν είναι δυνατή η πρόσκληση των ακόλουθων διευθύνσεων: %s.',
	'com:ossn:invite:already:members' => 'Οι ακόλουθες διευθύνσεις είναι ήδη μέλη: %s',
	'com:ossn:invite:empty:emails' => 'Προσθέστε τουλάχιστον μία διεύθυνση ηλεκτρονικού ταχυδρομείου',
);
ossn_register_languages('el', $el); 
