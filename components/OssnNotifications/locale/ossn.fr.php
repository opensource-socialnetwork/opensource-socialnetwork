<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright (C) OpenTeknik LLC
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */

$fr = array(
	'ossnnotifications' => 'Notifications',
    'ossn:notifications:comments:post' => "%s a commenté le message.",
    'ossn:notifications:like:post' => "%s aime votre message.",
    'ossn:notifications:like:annotation' => "%s aime votre commentaire.",
    'ossn:notifications:like:entity:file:ossn:aphoto' => "%s aime votre photo.",
    'ossn:notifications:comments:entity:file:ossn:aphoto' => '%s a commenté votre photo.',
    'ossn:notifications:wall:friends:tag' => '%s vous a tagué sur un message.',
    'ossn:notification:are:friends' => 'Vous êtes maintenant amis!',
    'ossn:notifications:comments:post:group:wall' => "%s a commenté un post de groupe.",
    'ossn:notifications:like:entity:file:profile:photo' => "%s aime la photo de profil.",
    'ossn:notifications:comments:entity:file:profile:photo' => "%s a commenté la photo de profil.",
    'ossn:notifications:like:entity:file:profile:cover' => "%s aime la photo de couverture.",
    'ossn:notifications:comments:entity:file:profile:cover' => "%s a commenté la photo de couverture.",

    'ossn:notifications:like:post:group:wall' => '%s aime votre message.',
	
    'ossn:notification:delete:friend' => 'Demdande d\'amis supprimé!',
    'notifications' => 'Notifications',
    'see:all' => 'Voir tout',
    'friend:requests' => 'Demande d\'ami',
    'ossn:notifications:friendrequest:confirmbutton' => 'Accepter',
    'ossn:notifications:friendrequest:denybutton' => 'Refuser',
	
	'ossn:notification:mark:read:success' => "Marqué toutes lues avec succès",
	'ossn:notification:mark:read:error' => 'Ne peut pas les marquer toutes lues',

    'ossn:notifications:mark:as:read' => 'Marquer toutes lues',		
	'ossn:notifications:admin:settings:close_anywhere:title' => "Fermez les fenêtres de notification en cliquant n'importe où",
	'ossn:notifications:admin:settings:close_anywhere:note' => "<i class='fa fa-info-circle'></i> ferme toute fenêtre de notification en cliquant n'importe où sur la page<br><br>",

	'ossn:notifications:comments:entity:file:profile:photo:someone' => "%s a commenté la photo de profil.",	
    'ossn:notifications:comments:entity:file:profile:cover:someone' => "%s a commenté la couverture du profil.",
	'ossn:notifications:comments:entity:file:ossn:aphoto:someone' => '%s a commenté la photo.',

	'ossn:notifications:admin:settings:checkintervals:title' => 'Temps de vérification automatique des notifications (60 secondes par défaut)', 	
);
ossn_register_languages('fr', $fr);
