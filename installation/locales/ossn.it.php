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


$it = array(
	'site:settings' => 'Impostazioni sito',
	'ossn:installed' => 'Installato',
	'ossn:installation' => 'Installazione',
	'ossn:check' => 'Convalida',
	'ossn:installed' => 'Installato',
	'ossn:installed:message' => 'Open Source Social Network è stato installato.',
    'ossn:prerequisites' => 'Prerequisiti per l\'installazione',
    'ossn:settings' => 'Impostazioni server',
    'ossn:dbsettings' => 'Database',
	'ossn:dbuser' => 'Database Utente',
	'ossn:dbpassword' => 'Database Password',
	'ossn:dbname' => 'Nome Database',
	'ossn:dbhost' => 'Database Host',
    'ossn:sitesettings' => 'Sito web',
    'ossn:websitename' => 'Nome sito web',
    'ossn:mainsettings' => 'Percorsi',
	'ossn:weburl' => 'OssnSite Url',
	'installation:notes' => 'La cartella dati contiene i files degli utenti. La cartella dati si deve trovare al di fuori del percorso di installazione di OSSN.',
	'ossn:datadir' => 'Cartella dati',
	'owner_email' => 'E-mail proprietario del sito',
	'notification_email' => 'E-mail notifiche (noreply@domain.com)',
	'create:admin:account' => 'Crea Account Amministratore',
	'ossn:setting:account' => 'Impostazioni Account',
	
	'data:directory:invalid' => 'Cartella dati non valida oppure la cartella non è scrivibile.',	
	'data:directory:outside' => 'La cartella dati deve trovarsi al di fuori del percorso di installazion.',
	'all:files:required' => 'Tutti i files sono richiesti! Per favore controlla i tuoi files.',
	
	'ossn:install:php' => 'PHP ',
	'ossn:install:old:php' => "Hai una vecchia versione di PHP " . PHP_VERSION . " Ti serve PHP 5.4 o PHP 5.5",
	
	'ossn:install:mysqli' => 'MYSQLI ABILITATO',
	'ossn:install:mysqli:required' => 'MYSQLI PHP ESTENSIONE RICHIESTA',
	
	'ossn:install:apache' => 'APACHE ABILITATO',
	'ossn:install:apache:required' => 'APACHE E\' RICHIESTO',
	
	'ossn:install:modrewrite' => 'MOD_REWRITE',
	'ossn:install:modrewrite:required' => 'MOD_REWRITE RICHIESTO',
	
	'ossn:install:curl' => 'PHP CURL',
	'ossn:install:curl:required' => 'PHP CURL RICHIESTO',
	
	'ossn:install:gd' => 'PHP GD LIBRARY',
	'ossn:install:gd:required' => 'PHP GD LIBRARY RICHIESTA',
	
	'ossn:install:config' => 'CONFIGURAZIONE CARTELLA SCRIVIBILE',
	'ossn:install:config:error' => 'LA CARTELLA DI CONFIGURAZIONE NON E\' SCRIVIBILE',
	
	'ossn:install:next' => 'Prossimo',
    'ossn:install:install' => 'Installa',
    'ossn:install:create' => 'Crea',
    'ossn:install:finish' => 'Finisci',
	
	'fields:require' => 'Tutti i campi sono richiesti!',
	
	'ossn:install:allowfopenurl' => 'PHP allow_url_fopen ABILITATO',
	'ossn:install:allowfopenurl:error' => 'PHP allow_url_fopen è richiesto',
	
	'ossn:install:ziparchive' => 'PHP ZipArchive ABILITATO',
	'ossn:install:ziparchive:error' => 'PHP ZipArchive ESTENSIONE RICHIESTA',
);

ossn_installation_register_languages($it);
