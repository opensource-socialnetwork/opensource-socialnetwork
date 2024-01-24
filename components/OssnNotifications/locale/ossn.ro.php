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

$ro = array(
	'ossnnotifications' => 'Notificari',
    'ossn:notifications:comments:post' => "%s a adaugat un comentariu la postarea ta .",
    'ossn:notifications:like:post' => "Lui %s i-a placut postarea ta.",
    'ossn:notifications:like:annotation' => "Lui %s i-a placut comentariul tau.",
    'ossn:notifications:like:entity:file:ossn:aphoto' => "Lui %s i-a placut fotografia ta.",
    'ossn:notifications:comments:entity:file:ossn:aphoto' => '%s a adaugat un comentariu la fotografia ta.',
    'ossn:notifications:wall:friends:tag' => '%s a fost legat de postarea ta.',
    'ossn:notification:are:friends' => 'Acum sunteti prieteni!',
    'ossn:notifications:comments:post:group:wall' => "%s a adaugat un comentariu la postarea de grup.",
    'ossn:notifications:like:entity:file:profile:photo' => "Lui %s i-a placut fotografia ta de profil.",
    'ossn:notifications:comments:entity:file:profile:photo' => "%s a adaugat un comentariu la fotografia ta de profil.",
    'ossn:notifications:like:post:group:wall' => 'Lui %s i-a placut postarea ta.',
    'ossn:notifications:like:entity:file:profile:cover' => "Lui %s i-a placut fotografia ta.",
    'ossn:notifications:comments:entity:file:profile:cover' => "%s a adaugat un comentariu la fotografia ta.",
	
    'ossn:notification:delete:friend' => 'Cererea de prietenie a fost stearsa!',
    'notifications' => 'Notificari',
    'see:all' => 'Vezi pe toate',
    'friend:requests' => 'Cereri de prietenie',
    'ossn:notifications:friendrequest:confirmbutton' => 'Confirma',
    'ossn:notifications:friendrequest:denybutton' => 'Nu accepta',
	
    'ossn:notification:mark:read:success' => 'Toate mesajele au fost citite',
    'ossn:notification:mark:read:error' => 'Nu am putut marca mesajele ca fiind citite',
    
    'ossn:notifications:mark:as:read' => 'Marcheaza mesajele ca fiind citite',
	'ossn:notifications:admin:settings:close_anywhere:title' => 'Închideți ferestrele de notificare făcând clic oriunde',
	'ossn:notifications:admin:settings:close_anywhere:note' => '<i class="fa fa-info-circle"></i> închide orice fereastră de notificare făcând clic oriunde pe pagină<br><br>',

	'ossn:notifications:comments:entity:file:profile:photo:someone' => "%s a comentat fotografia de profil.",	
    'ossn:notifications:comments:entity:file:profile:cover:someone' => "%s a comentat pe coperta profilului.",
	'ossn:notifications:comments:entity:file:ossn:aphoto:someone' => '%s a comentat fotografia.',
	
	'ossn:notifications:admin:settings:checkintervals:title' => 'Timp de verificare automată a notificărilor (implicit 60 de secunde)', 
);
ossn_register_languages('ro', $ro); 
