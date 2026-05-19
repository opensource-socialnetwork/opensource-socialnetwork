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
$da = array(
	'ossnads'                       => 'Annonceadministrator',
	'fields:required'               => 'Alle felter skal udfyldes!',
	'ad:created'                    => 'Annoncen er blevet oprettet!',
	'ad:create:fail'                => 'Kan ikke oprette annonce!',
	'ad:title'                      => 'Titel',
	'ad:site:url'                   => 'Webside-URL',
	'ad:desc'                       => 'Beskrivelse',
	'ad:browse'                     => 'Gennemse',
	'ad:clicks'                     => 'Klik',
	'sponsored'                     => 'SPONSORERET',
	'ad:deleted'                    => "Annoncen med titlen '%s' er blevet slettet med succes.",
	'ad:delete:fail'                => 'Kan ikke slette annonce! Prøv igen senere.',
	'ad:edited'                     => 'Annoncen blev ændret med succes.',
	'ad:edit:fail'                  => 'Kan ikke redigere annonce! Prøv igen senere.',
	'ads:manager'                   => 'Annonceadministration',
	'ads:boost:community'           => 'Giv dit fællesskab et boost. Opret en ny annoncekampagne eller administrer eksisterende.',
	'ads:create'                    => 'Opret annonce',

	'ad:placement'                  => 'Placeringsområder for visning',
	'ad:gender:target'              => 'Demografisk målretning efter køn',
	'ad:end:date'                   => 'Kampagnens udløbsdato (Valgfri)',
	'ad:photo'                      => 'Billede til banner',
	'add'                           => 'Opret kampagne',

	'ad:placement:newsfeed'         => 'Aktivitetsnyhedsfeed (Sidebjælke)',
	'ad:placement:profile'          => 'Brugerprofiler (Sidebjælke)',
	'ad:placement:groups'           => 'Gruppesider (Sidebjælke)',
	'ad:placement:global'           => 'Alle andre tema-sidebjælker (Global)',

	'ad:file:choose'                => 'Vælg eller træk annoncebillede hertil...',
	'ad:file:restriction'           => 'Kun billedfiler er tilladt (PNG, JPG, WebP)',
	'ad:file:remove'                => 'Fjern billede',
	'ad:char:left'                  => '%s tegn tilbage',
	'ad:status:expired'             => 'Udløbet',
	'ad:status:active'              => 'Aktiv',
	'ad:views'                      => 'Visninger',
	'ad:status'                     => 'Status',
	'ad:end:date:infinity'          => 'Aldrig',

	//cron
	'ossn:adscron:title'            => 'Nødvendig opsætning: Automatiser udløb af annoncer',
	'ossn:adscron:last:run'         => 'Sidste Cron-kørsel:',
	'ossn:adscron:never'            => 'Aldrig',
	'ossn:adscron:configure'        => 'Konfigurer',
	'ossn:adscron:description'      => 'For automatisk at ændre annoncestatusser til %s, skal du konfigurere et system-cronjob til at køre én gang om dagen ved middagstid (12:00 PM).',
	'ossn:adscron:expired'          => 'Udløbet',
	'ossn:adscron:command:label'    => 'Crontab-kommando',
	'ossn:adscron:path:placeholder' => 'DIN_SERVER_PHP_STI',
	'ossn:adscron:warning:title'    => 'Vigtig meddelelse:',
	'ossn:adscron:warning:text'     => 'Når en annonce udløber, %s. Annoncører skal oprette en helt ny annonce helt fra bunden.',
	'ossn:adscron:cannot:edit'      => 'kan den ikke redigeres eller fornyes',
);
ossn_register_languages('da', $da);