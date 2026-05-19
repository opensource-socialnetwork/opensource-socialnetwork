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
$fr = array(
	'ossnads'                       => 'Gestionnaire de publicités',
	'fields:required'               => 'Tous les champs sont obligatoires !',
	'ad:created'                    => 'La publicité a été créée avec succès !',
	'ad:create:fail'                => 'Impossible de créer la publicité !',
	'ad:title'                      => 'Titre',
	'ad:site:url'                   => 'URL du site',
	'ad:desc'                       => 'Description',
	'ad:browse'                     => 'Parcourir',
	'ad:clicks'                     => 'Clics',
	'sponsored'                     => 'SPONSORISÉ',
	'ad:deleted'                    => "La publicité intitulée '%s' a été supprimée avec succès.",
	'ad:delete:fail'                => 'Impossible de supprimer la publicité ! Veuillez réessayer plus tard.',
	'ad:edited'                     => 'Publicité modifiée avec succès.',
	'ad:edit:fail'                  => 'Impossible de modifier la publicité ! Veuillez réessayer plus tard.',
	'ads:manager'                   => 'Gestionnaire de publicité',
	'ads:boost:community'           => 'Boostez votre communauté. Créez une nouvelle campagne publicitaire ou gérez celles existantes.',
	'ads:create'                    => 'Créer une publicité',

	'ad:placement'                  => 'Zones d\'affichage des publicités',
	'ad:gender:target'              => 'Criblage démographique par genre',
	'ad:end:date'                   => 'Date d\'expiration de la campagne (Facultatif)',
	'ad:photo'                      => 'Image de la création de la bannière',
	'add'                           => 'Créer la campagne',

	'ad:placement:newsfeed'         => 'Fil d\'actualité des activités (Barre latérale)',
	'ad:placement:profile'          => 'Profils d\'utilisateurs (Barre latérale)',
	'ad:placement:groups'           => 'Pages de groupes (Barre latérale)',
	'ad:placement:global'           => 'Toutes les autres barres latérales du thème (Global)',

	'ad:file:choose'                => 'Choisissez ou glissez l\'image de la publicité ici...',
	'ad:file:restriction'           => 'Uniquement des fichiers image (PNG, JPG, WebP)',
	'ad:file:remove'                => 'Supprimer l\'image',
	'ad:char:left'                  => '%s restants',
	'ad:status:expired'             => 'Expirée',
	'ad:status:active'              => 'Active',
	'ad:views'                      => 'Vues',
	'ad:status'                     => 'Statut',
	'ad:end:date:infinity'          => 'Jamais',

	//cron
	'ossn:adscron:title'            => 'Configuration requise : Automatiser l\'expiration des publicités',
	'ossn:adscron:last:run'         => 'Dernière exécution du Cron :',
	'ossn:adscron:never'            => 'Jamais',
	'ossn:adscron:configure'        => 'Configurer',
	'ossn:adscron:description'      => 'Pour basculer automatiquement le statut des publicités sur %s, vous devez configurer une tâche cron système pour qu\'elle s\'exécute une fois par jour à midi (12:00 PM).',
	'ossn:adscron:expired'          => 'Expirée',
	'ossn:adscron:command:label'    => 'Commande Crontab',
	'ossn:adscron:path:placeholder' => 'CHEMIN_PHP_DE_VOTRE_SERVEUR',
	'ossn:adscron:warning:title'    => 'Avis important :',
	'ossn:adscron:warning:text'     => 'Lorsqu\'une publicité expire, elle %s. Les annonceurs doivent recréer une nouvelle publicité à partir de zéro.',
	'ossn:adscron:cannot:edit'      => 'ne peut plus être modifiée ni renouvelée',
);
ossn_register_languages('fr', $fr);