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

$da = array(
	'ossnnotifications' => 'Notifikationer',
    'ossn:notifications:comments:post' => "%s kommenterede opslaget.",
    'ossn:notifications:like:post' => "%s synes godt om dit opslag.",
    'ossn:notifications:like:annotation' => "%s synes godt om din kommentar.",
    'ossn:notifications:like:entity:file:ossn:aphoto' => "%s synes godt om dit billede.",
    'ossn:notifications:comments:entity:file:ossn:aphoto' => '%s kommenterede dit billede.',
    'ossn:notifications:wall:friends:tag' => '%s taggede dig i et opslag.',
    'ossn:notification:are:friends' => 'I er nu venner!',
    'ossn:notifications:comments:post:group:wall' => "%s kommenterede gruppeopslaget.",
    'ossn:notifications:like:entity:file:profile:photo' => "%s synes godt om dit profilbillede.",
	'ossn:notifications:comments:entity:file:profile:photo' => "%s kommenterede dit profilbillede.",
    'ossn:notifications:like:entity:file:profile:cover' => "%s synes godt om dit coverbillede.",
    'ossn:notifications:comments:entity:file:profile:cover' => "%s kommenterede dit coverbillede.",

    'ossn:notifications:like:post:group:wall' => '%s synes godt om dit opslag.',
	
    'ossn:notification:delete:friend' => 'Venskabsanmodning slettet!',
    'notifications' => 'Notifikationer',
    'see:all' => 'Se alle',
    'friend:requests' => 'Venskabsanmodninger',
    'ossn:notifications:friendrequest:confirmbutton' => 'Bekræft',
    'ossn:notifications:friendrequest:denybutton' => 'Afvis',
	
    'ossn:notification:mark:read:success' => 'Alle notifikationer er markeret som læst',
    'ossn:notification:mark:read:error' => 'Kunne ikke markere alle som læst',
    
    'ossn:notifications:mark:as:read' => 'Marker alle som læst',
	'ossn:notifications:admin:settings:close_anywhere:title' => 'Luk notifikationsvinduer ved at klikke hvor som helst',
	'ossn:notifications:admin:settings:close_anywhere:note' => '<i class="fa fa-info-circle"></i> lukker alle notifikationsvinduer ved at klikke et vilkårligt sted på siden<br><br>',
	
	'ossn:notifications:comments:entity:file:profile:photo:someone' => "%s kommenterede profilbilledet.",	
    'ossn:notifications:comments:entity:file:profile:cover:someone' => "%s kommenterede coverbilledet.",
	'ossn:notifications:comments:entity:file:ossn:aphoto:someone' => '%s kommenterede billedet.',	
	
	'ossn:notifications:admin:settings:checkintervals:title' => 'Interval for automatisk tjek af notifikationer (Standard 60 sekunder)', 
);
ossn_register_languages('da', $da);