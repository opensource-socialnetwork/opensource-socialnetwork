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
	'site:settings' => 'Paramètres du site',
	'ossn:installed' => 'Installé',
	'ossn:installation' => 'Installation',
	'ossn:check' => 'Valider',
	'ossn:installed' => 'Installé',
	'ossn:installed:message' => 'Open Source Social Network a été installé. Lorsque vous avez terminé, s\'il vous plaît supprimer le répertoire d\'installation.',
    'ossn:prerequisites' => 'Conditions préalables d\'installation',
    'ossn:settings' => 'Réglages du serveur',
    'ossn:dbsettings' => 'Base de donnée',
	'ossn:dbuser' => 'Utilisateur base de donnée',
	'ossn:dbpassword' => 'Mot de passe base de donnée',
	'ossn:dbname' => 'Nom base de donnée',
	'ossn:dbhost' => 'Hôte base de donnée',
    'ossn:sitesettings' => 'Site Web',
    'ossn:websitename' => 'Nom du site web',
    'ossn:mainsettings' => 'Chemins',
	'ossn:weburl' => 'OssnSite Url',
	'installation:notes' => 'Le répertoire de données contient les fichiers des utilisateurs. Le répertoire des données doit être situé en dehors du chemin d\'installation d\'OSSN.',
	'ossn:datadir' => 'Répertoire des données',
	'owner_email' => 'Courriel du propriétaire',
	'notification_email' => 'Courriel de notification (noreply@domain.com)',
	'create:admin:account' => 'Créer un compte Administrateur',
	'ossn:setting:account' => 'Paramètres du compte',
	
	'data:directory:invalid' => 'Répertoire de données non valide ou le répertoire n\'est pas accessible en écriture.',	
	'data:directory:outside' => 'Le répertoire des données doit être en dehors du chemin d\'installation.',
	'all:files:required' => 'Tous les fichiers sont nécessaires! S\'il vous plaît vérifier vos fichiers.',
	
	'ossn:install:php' => 'PHP ',
	'ossn:install:old:php' => "Vous avez une ancienne version de PHP " . PHP_VERSION . " Il faut PHP 8.0 ou PHP 8.x",
	
	'ossn:install:mysqli' => 'MYSQLI Activé',
	'ossn:install:mysqli:required' => 'EXTENSION MYSQLI PHP REQUIS',
	
	'ossn:install:apache' => 'APACHE Activé',
	'ossn:install:apache:required' => 'APACHE EST REQUIS',
	
	'ossn:install:modrewrite' => 'MOD_REWRITE',
	'ossn:install:modrewrite:required' => 'MOD_REWRITE REQUIS',
	
	'ossn:install:curl' => 'PHP CURL',
	'ossn:install:curl:required' => 'PHP CURL REQUIS',
	
	'ossn:install:gd' => 'PHP GD LIBRARY',
	'ossn:install:gd:required' => 'LIBRAIRIE PHP GD REQUISE',
	
	'ossn:install:config' => 'REPERTOIRE DE CONFIGURATION ACCESSIBLE EN ECRITURE',
	'ossn:install:config:error' => 'LE REPERTOIRE DE CONFIGURATION N\'EST ACCESSIBLE EN ECRITURE',
	
	'ossn:install:next' => 'Suivant',
    'ossn:install:install' => 'Installer',
    'ossn:install:create' => 'Créer',
    'ossn:install:finish' => 'Terminer',
	
	'fields:require' => 'Tous les champs sont requis!',
	
	'ossn:install:allowfopenurl' => 'PHP allow_url_fopen Activé',
	'ossn:install:allowfopenurl:error' => 'PHP allow_url_fopen est requis',
	
	'ossn:install:ziparchive' => 'PHP ZipArchive Activé',
	'ossn:install:ziparchive:error' => 'EXTENSION PHP ZipArchive REQUISE',	
	'ossn:install:cachedir:note:failed' => 'Make sure your files and directories are owned by correct apache user.',	
);

ossn_installation_register_languages($fr);
