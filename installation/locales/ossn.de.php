<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */


$de = array(
    'site:settings' => 'Betriebs-Einstellungen',
    'ossn:installed' => 'Installiert',
    'ossn:installation' => 'Installation',
    'ossn:check' => 'Server Prüfung',
    'ossn:installed' => 'Installiert',
    'ossn:installed:message' => 'Die Opensource Socialnetwork Installation ist damit abgeschlossen.',
    'ossn:prerequisites' => 'Installations-Voraussetzungen',
    'ossn:settings' => 'Server Einstellungen',
    'ossn:dbsettings' => 'Datenbank',
    'ossn:dbuser' => 'Datenbank Benutzername',
    'ossn:dbpassword' => 'Datenbank Passwort',
    'ossn:dbname' => 'Datenbank Name',
    'ossn:dbhost' => "Datenbank Host (meistens 'localhost')",
    'ossn:sitesettings' => 'Webseite',
    'ossn:websitename' => 'Name der Webseite',
    'ossn:mainsettings' => 'Pfad-Angaben',
    'ossn:weburl' => 'Url der Seite',
    'installation:notes' => 'Dieses Verzeichnis enthält von Benutzern hochgeladene Dateien, die ein Sicherheitsrisiko bergen könnten. Es muss daher außerhalb des Installations-Pfades liegen.',
    'ossn:datadir' => 'Daten Verzeichnis',
    'owner_email' => 'Betreiber email-Adresse',
    'notification_email' => 'Absender für Benachrichtigungen (noreply@domain.de)',
    'create:admin:account' => 'Administrator Konto anlegen',
    'ossn:setting:account' => 'Konto-Einstellungen',
    
	'data:directory:invalid' => 'Das Datenverzeichnis existiert nicht oder es hat keine Schreibberechtigung',	
	'data:directory:outside' => 'Das Datenverzeichnis muss außerhalb der OSSN Installation liegen!',
	'all:files:required' => 'Die Installation ist unvollständig - bitte prüfe, ob es beim Hochladen kein Fehler aufgetreten ist.',
	
	'ossn:install:php' => 'PHP ',
	'ossn:install:old:php' => "Auf dem Server läuft die PHP-Version " . PHP_VERSION . " OSSN braucht PHP 5.4 oder PHP 5.5.",
	
	'ossn:install:mysqli' => 'PHP ERWEITERUNG MYSQLI VORHANDEN',
	'ossn:install:mysqli:required' => 'PHP ERWEITERUNG MYSQLI FEHLT',
	
	'ossn:install:apache' => 'APACHE VORHANDEN',
	'ossn:install:apache:required' => 'APACHE FEHLT',
	
	'ossn:install:modrewrite' => 'APACHE MOD_REWRITE ERWEITERUNG VORHANDEN',
	'ossn:install:modrewrite:required' => 'APACHE MOD_REWRITE ERWEITERUNG FEHLT',
	
	'ossn:install:curl' => 'PHP CURL ERWEITERUNG VORHANDEN',
	'ossn:install:curl:required' => 'PHP CURL ERWEITERUNG FEHLT',
	
	'ossn:install:gd' => 'PHP GD BIBLIOTHEK VORHANDEN',
	'ossn:install:gd:required' => 'PHP GD BIBLIOTHEK FEHLT',
	
	'ossn:install:config' => 'KONFIGURATIONS VERZEICHNIS HAT SCHREIBBERECHTIGUNG',
	'ossn:install:config:error' => 'KONFIGURATIONS VERZEICHNIS HAT KEINE SCHREIBBERECHTIGUNG',
	
	'ossn:install:next' => 'Weiter',
    'ossn:install:install' => 'Installieren',
    'ossn:install:create' => 'Anlegen',
    'ossn:install:finish' => 'Fertig',
	'fields:require' => 'Bitte fülle alle Eingabe-Felder aus',	

	'ossn:install:allowfopenurl' => 'PHP allow_url_fopen VORHANDEN',
	'ossn:install:allowfopenurl:error' => 'PHP allow_url_fopen ERWEITERUNG FEHLT',
	
	'ossn:install:ziparchive' => 'PHP ZipArchive VORHANDEN',
	'ossn:install:ziparchive:error' => 'PHP ZipArchive ERWEITERUNG FEHLT',
);

ossn_installation_register_languages($de);
