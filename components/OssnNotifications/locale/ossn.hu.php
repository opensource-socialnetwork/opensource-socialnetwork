<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$hu = array(
	'ossnnotifications' => 'Értesítések',
    'ossn:notifications:comments:post' => "%s hozzászólt a bejegyzésedhez.",
    'ossn:notifications:like:post' => "%s kedveli a bejegyzésedet.",
    'ossn:notifications:like:annotation' => "%s kedveli a hozzászólásodat.",
    'ossn:notifications:like:entity:file:ossn:aphoto' => "%s kedveli a fotódat.",
    'ossn:notifications:comments:entity:file:ossn:aphoto' => '%s hozzászólt a fotódhoz.',
    'ossn:notifications:wall:friends:tag' => '%s megjelölt téged egy hozzászólásban.',
    'ossn:notification:are:friends' => 'Mostantól barátok vagytok!',
    'ossn:notifications:comments:post:group:wall' => "%s hozzászólt a csoport bejegyzéshez.",
    'ossn:notifications:like:entity:file:profile:photo' => "%s kedveli a profilképed.",
    'ossn:notifications:comments:entity:file:profile:photo' => "%s hozzászólt a profilképedhez.",
    'ossn:notifications:like:entity:file:profile:cover' => "%s kedveli a borítóképed.",
    'ossn:notifications:comments:entity:file:profile:cover' => "%s hozzászólt a borítóképedhez.",

    'ossn:notifications:like:post:group:wall' => '%s kedveli a bejegyzésed.',
	
    'ossn:notification:delete:friend' => 'Barátfelkérés törölve!',
    'notifications' => 'Értesítések',
    'see:all' => 'Összes',
    'friend:requests' => 'Barátfelkérések',
    'ossn:notifications:friendrequest:confirmbutton' => 'Jóváhagyás',
    'ossn:notifications:friendrequest:denybutton' => 'Elútasítás',
	
    'ossn:notification:mark:read:success' => 'Az összes olvasottnak jelölve',
    'ossn:notification:mark:read:error' => 'Nem lehet olvasottnak jelölni',
    
    'ossn:notifications:mark:as:read' => 'Összest olvasottnak jelöl',
    'ossn:notifications:admin:settings:close_anywhere:title' => 'Az értesítési ablakok bezárásához kattintson bárhova',
    'ossn:notifications:admin:settings:close_anywhere:note' => '<i class="fa fa-info-circle"></i> 
bezár minden értesítési ablakot, ha rákattint a page<br><br>',

	'ossn:notifications:comments:entity:file:profile:photo:someone' => "%s megjegyzést fűzött a profilfotóhoz.",
	'ossn:notifications:comments:entity:file:profile:cover:someone' => "%s megjegyzést fűzött a profil borítójához.",
	'ossn:notifications:comments:entity:file:ossn:aphoto:someone' => '%s megjegyzést fűzött a fényképhez.',	
	
	'ossn:notifications:admin:settings:checkintervals:title' => 'Értesítés automatikus ellenőrzési ideje (alapértelmezett 60 másodperc)', 
);
ossn_register_languages('hu', $hu); 
