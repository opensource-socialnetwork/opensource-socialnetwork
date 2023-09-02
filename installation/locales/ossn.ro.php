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


$romanian = array(
	'site:settings' => 'Setarile Siteului',
	'ossn:installed' => 'Instalat',
	'ossn:installation' => 'Instalare',
	'ossn:check' => 'Validare',
	'ossn:installed' => 'Instalat',
	'ossn:installed:message' => 'Open Source Social Network a fost instalat.',
    'ossn:prerequisites' => 'Date tehnice necesare pentru instalare',
    'ossn:settings' => 'Setarile Serverului',
    'ossn:dbsettings' => 'Baza de Date',
	'ossn:dbuser' => 'Numele folositorului al Bazei de date',
	'ossn:dbpassword' => 'Parola bazei de date',
	'ossn:dbname' => 'Numele bazei de date',
	'ossn:dbhost' => 'Gazada bazei de date',
    'ossn:sitesettings' => 'Website',
    'ossn:websitename' => 'Ce nume Nume Ii dati Website ului',
    'ossn:mainsettings' => 'Calea',
	'ossn:weburl' => 'Adresa websiteului',
	'installation:notes' => 'Directorul care contine informatii ale utilizatorilor. Directorul care contine dosarul de Data trebuie sa fie in afara caii de instalare a OSSN.',
	'ossn:datadir' => 'Directorul dosarului data_ossn',
	'owner_email' => 'Emailul propietarului de site',
	'notification_email' => 'emailul unde se primesc notificari din site (noreply@domain.com)',
	'create:admin:account' => 'Creaaza Contul de Administrator',
	'ossn:setting:account' => 'Setingurile Contului',
	
	'data:directory:invalid' => 'Directorul unde se gaseste dosarul data_ossn este invalid.',	
	'data:directory:outside' => 'Dosarul Data trebuie sa fie in afara directorului principal .',
	'all:files:required' => 'Toate dosarele sint  necesare! Verifica din nou.',
	
	'ossn:install:php' => 'PHP ',
	'ossn:install:old:php' => "Ai o versiune veche de PHP " . PHP_VERSION . " Iti trebuie versiune PHP 8.0 or PHP 8.x",
	
	'ossn:install:mysqli' => 'MYSQLI ENABLED',
	'ossn:install:mysqli:required' => 'MYSQLI PHP EXTENSION REQUIRED',
	
	'ossn:install:apache' => 'APACHE ENABLED',
	'ossn:install:apache:required' => 'APACHE IS REQUIRED',
	
	'ossn:install:modrewrite' => 'MOD_REWRITE',
	'ossn:install:modrewrite:required' => 'MOD_REWRITE REQUIRED',
	
	'ossn:install:curl' => 'PHP CURL',
	'ossn:install:curl:required' => 'PHP CURL REQUIRED',
	
	'ossn:install:gd' => 'PHP GD LIBRARY',
	'ossn:install:gd:required' => 'PHP GD LIBRARY REQUIRED',
	
	'ossn:install:config' => 'CONFIGURATION DIRECTORY WRITEABLE',
	'ossn:install:config:error' => 'CONFIGURATION DIRECTORY IS NOT WRITEABLE',
	
	'ossn:install:next' => 'Urmatorul pas',
    'ossn:install:install' => 'Instaleaza',
    'ossn:install:create' => 'Creaza',
    'ossn:install:finish' => 'Termina',
	
	'fields:require' => 'Toate campurile sunt obligatorii!',
	
	'ossn:install:allowfopenurl' => 'PHP allow_url_fopen ENABLED',
	'ossn:install:allowfopenurl:error' => 'PHP allow_url_fopen is required',
	
	'ossn:install:ziparchive' => 'PHP ZipArchive ENABLED',
	'ossn:install:ziparchive:error' => 'PHP ZipArchive EXTENSION REQUIRED',
	'ossn:install:cachedir:note:failed' => 'Asigurați-vă că fișierele și directoarele dvs. sunt deținute de un utilizator corect apache.',
);

ossn_installation_register_languages($romanian);