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
$de = array(
	'ossnads'                       => 'Werbemanager',
	'fields:required'               => 'Alle Felder sind Pflichtfelder!',
	'ad:created'                    => 'Anzeige wurde erfolgreich erstellt!',
	'ad:create:fail'                => 'Anzeige kann nicht erstellt werden!',
	'ad:title'                      => 'Titel',
	'ad:site:url'                   => 'Website-URL',
	'ad:desc'                       => 'Beschreibung',
	'ad:browse'                     => 'Durchsuchen',
	'ad:clicks'                     => 'Klicks',
	'sponsored'                     => 'GESPONSERT',
	'ad:deleted'                    => "Die Anzeige mit dem Titel '%s' wurde erfolgreich gelöscht.",
	'ad:delete:fail'                => 'Anzeige kann nicht gelöscht werden! Bitte versuchen Sie es später noch einmal.',
	'ad:edited'                     => 'Anzeige erfolgreich geändert.',
	'ad:edit:fail'                  => 'Anzeige kann nicht bearbeitet werden! Bitte versuchen Sie es später noch einmal.',
	'ads:manager'                   => 'Anzeigenverwaltung',
	'ads:boost:community'           => 'Kurbeln Sie Ihre Community an. Erstellen Sie eine neue Werbekampagne oder verwalten Sie bestehende.',
	'ads:create'                    => 'Anzeige erstellen',

	'ad:placement'                  => 'Platzierungsbereiche für Anzeigen',
	'ad:gender:target'              => 'Demografisches Targeting nach Geschlecht',
	'ad:end:date'                   => 'Ablaufdatum der Kampagne (Optional)',
	'ad:photo'                      => 'Banner-Designbild',
	'add'                           => 'Kampagne erstellen',

	'ad:placement:newsfeed'         => 'Aktivitäts-Newsfeed (Seitenleiste)',
	'ad:placement:profile'          => 'Benutzerprofile (Seitenleiste)',
	'ad:placement:groups'           => 'Gruppenseiten (Seitenleiste)',
	'ad:placement:global'           => 'Alle anderen Theme-Seitenleisten (Global)',

	'ad:file:choose'                => 'Wählen Sie ein Bild aus oder ziehen Sie es hierher...',
	'ad:file:restriction'           => 'Ausschließlich Bilddateien erlaubt (PNG, JPG, WebP)',
	'ad:file:remove'                => 'Bild entfernen',
	'ad:char:left'                  => '%s Zeichen übrig',
	'ad:status:expired'             => 'Abgelaufen',
	'ad:status:active'              => 'Aktiv',
	'ad:views'                      => 'Aufrufe',
	'ad:status'                     => 'Status',
	'ad:end:date:infinity'          => 'Niemals',

	//cron
	'ossn:adscron:title'            => 'Erforderliche Einrichtung: Anzeigenablauf automatisieren',
	'ossn:adscron:last:run'         => 'Letzter Cron-Durchlauf:',
	'ossn:adscron:never'            => 'Niemals',
	'ossn:adscron:configure'        => 'Konfigurieren',
	'ossn:adscron:description'      => 'Um den Anzeigenstatus automatisch auf %s zu setzen, müssen Sie einen System-Cronjob so konfigurieren, dass er einmal täglich mittags (12:00 Uhr) ausgeführt wird.',
	'ossn:adscron:expired'          => 'Abgelaufen',
	'ossn:adscron:command:label'    => 'Crontab-Befehl',
	'ossn:adscron:path:placeholder' => 'IHR_SERVER_PHP_PFAD',
	'ossn:adscron:warning:title'    => 'Wichtiger Hinweis:',
	'ossn:adscron:warning:text'     => 'Sobald eine Anzeige abgelaufen ist, %s. Werbetreibende müssen eine neue Anzeige von Grund auf neu erstellen.',
	'ossn:adscron:cannot:edit'      => 'kann sie nicht mehr bearbeitet oder verlängert werden',
);
ossn_register_languages('de', $de);