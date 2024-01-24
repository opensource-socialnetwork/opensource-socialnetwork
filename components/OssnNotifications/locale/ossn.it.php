<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$en = array(
	'ossnnotifications' => 'Notifiche',
    'ossn:notifications:comments:post' => "%s ha lasciato un commento.",
    'ossn:notifications:like:post' => "a %s è piaciuto il tuo post.",
    'ossn:notifications:like:annotation' => "a %s è piaciuto il tuo commento.",
    'ossn:notifications:like:entity:file:ossn:aphoto' => "a %s è piaciuta la tua foto.",
    'ossn:notifications:comments:entity:file:ossn:aphoto' => '%s ha commentato la tua foto.',
    'ossn:notifications:wall:friends:tag' => '%s ti ha tggato in un post.',
    'ossn:notification:are:friends' => 'Ora siete amici!',
    'ossn:notifications:comments:post:group:wall' => "%s ha commentato il post di gruppo.",
    'ossn:notifications:like:entity:file:profile:photo' => "a %s è piaciuta la tua foto profilo.",
    'ossn:notifications:comments:entity:file:profile:photo' => "%s ha commentato la tua foto profilo.",
    'ossn:notifications:like:entity:file:profile:cover' => "a %s è piaciuta la tua immagine copertina.",
    'ossn:notifications:comments:entity:file:profile:cover' => "%s ha commentato la tua immagine copertina.",

    'ossn:notifications:like:post:group:wall' => 'a %s è piaciuto il tuo post.',
	
    'ossn:notification:delete:friend' => 'Richiesta amicizia cancellata!',
    'notifications' => 'Notifiche',
    'see:all' => 'Vedi tutti',
    'friend:requests' => 'Richieste di amicizia',
    'ossn:notifications:friendrequest:confirmbutton' => 'Conferma',
    'ossn:notifications:friendrequest:denybutton' => 'Nega',
	
    'ossn:notification:mark:read:success' => 'Contrassegnati tutti come letti correttamente',
    'ossn:notification:mark:read:error' => 'Impossibile contrassegnare tutti come letti',
    
    'ossn:notifications:mark:as:read' => 'Segna tutti come da leggere',
	'ossn:notifications:admin:settings:close_anywhere:title' => 'Chiudi le finestre di notifica facendo clic ovunque',
	'ossn:notifications:admin:settings:close_anywhere:note' => '<i class="fa fa-info-circle"></i> chiude qualsiasi finestra di notifica facendo clic in qualsiasi punto della pagina<br><br>',
	
	'ossn:notifications:comments:entity:file:profile:photo:someone' => "%s ha commentato la foto del profilo.",	
    'ossn:notifications:comments:entity:file:profile:cover:someone' => "%s ha commentato la copertina del profilo.",	
	'ossn:notifications:comments:entity:file:ossn:aphoto:someone' => '%s ha commentato la foto.',	

	'ossn:notifications:admin:settings:checkintervals:title' => 'Tempo di controllo automatico delle notifiche (predefinito 60 secondi)', 
);
ossn_register_languages('it', $en); 
