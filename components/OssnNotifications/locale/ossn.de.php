<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$de = array(
	'ossnnotifications' => 'Benachrichtigungen',
    'ossn:notifications:comments:post' => "%s hat den Beitrag kommentiert",
    'ossn:notifications:like:post' => "%s gefällt Dein Beitrag",
    'ossn:notifications:like:annotation' => "%s gefällt Dein Kommentar",
    'ossn:notifications:like:entity:file:ossn:aphoto' => "%s gefällt Dein Foto",
    'ossn:notifications:comments:entity:file:ossn:aphoto' => '%s hat Dein Foto kommentiert',
    'ossn:notifications:wall:friends:tag' => '%s hat Dich mit einem Beitrag verbunden',
    'ossn:notification:are:friends' => 'Ihr seid nun Freunde',
    'ossn:notifications:comments:post:group:wall' => "%s hat einen Kommentar zu einem Beitrag abgegeben",
    'ossn:notifications:comments:entity:file:profile:photo' => "%s hat Dein Profil-Foto kommentiert",
    'ossn:notifications:like:entity:file:profile:photo' => "%s gefällt Dein Profil-Foto",
    'ossn:notifications:like:entity:file:profile:cover' => "%s gefällt Dein Titelbild.",
    'ossn:notifications:comments:entity:file:profile:cover' => "%s hat Dein Titelbild kommentiert.",

    'ossn:notifications:like:post:group:wall' => '%s gefällt Dein Beitrag',
	
    'ossn:notification:delete:friend' => 'Die Freundschafts-Anfrage wurde gelöscht',
    'notifications' => 'Benachrichtigungen',
    'see:all' => 'Alle ansehen',
    'friend:requests' => 'Freundschafts-Anfragen',

    'ossn:notifications:friendrequest:confirmbutton' => 'Annehmen',
    'ossn:notifications:friendrequest:denybutton' => 'Ablehnen',  
	
    'ossn:notification:mark:read:success' => 'Alles als gelesen markiert',
    'ossn:notification:mark:read:error' => 'Es kann nicht alles als gelesen markiert werden',
    
    'ossn:notifications:mark:as:read' => 'Alles als gelesen markieren',
	'ossn:notifications:admin:settings:close_anywhere:title' => 'Benachrichtigungs-Fenster schließen durch Klicken auf eine beliebige Stelle',
	'ossn:notifications:admin:settings:close_anywhere:note' => '<i class="fa fa-info-circle"></i> schließt alle Benachrichtigungsfenster, wenn man auf eine beliebige Stelle auf der Seite klickt<br><br>',
);
ossn_register_languages('de', $de); 
