<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Source Social Network Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$nl = array(
	'ossnads'                       => 'Advertentiebeheer',
	'fields:required'               => 'Alle velden zijn verplicht!',
	'ad:created'                    => 'Advertentie is succesvol aangemaakt!',
	'ad:create:fail'                => 'Kan advertentie niet aanmaken!',
	'ad:title'                      => 'Titel',
	'ad:site:url'                   => 'Website URL',
	'ad:desc'                       => 'Beschrijving',
	'ad:browse'                     => 'Bladeren',
	'ad:clicks'                     => 'Klikken',
	'sponsored'                     => 'GESPONSORD',
	'ad:deleted'                    => "Advertentie met de titel '%s' is succesvol verwijderd.",
	'ad:delete:fail'                => 'Kan advertentie niet verwijderen! Probeer het later opnieuw.',
	'ad:edited'                     => 'Advertentie succesvol gewijzigd.',
	'ad:edit:fail'                  => 'Kan advertentie niet bewerken! Probeer het later opnieuw.',
	'ads:manager'                   => 'Advertentiebeheerder',
	'ads:boost:community'           => 'Geef je community een boost. Maak een nieuwe advertentiecampagne aan of beheer bestaande campagnes.',
	'ads:create'                    => 'Advertentie aanmaken',

	'ad:placement'                  => 'Weergavelocaties',
	'ad:gender:target'              => 'Demografische doelgroepbepaling (Geslacht)',
	'ad:end:date'                   => 'Einddatum campagne (Optioneel)',
	'ad:photo'                      => 'Banner afbeelding',
	'add'                           => 'Campagne aanmaken',

	'ad:placement:newsfeed'         => 'Activiteitenoverzicht / Newsfeed (Zijbalk)',
	'ad:placement:profile'          => 'Gebruikersprofielen (Zijbalk)',
	'ad:placement:groups'           => 'Groepspagina\'s (Zijbalk)',
	'ad:placement:global'           => 'Alle andere thema-zijbalken (Globaal)',

	'ad:file:choose'                => 'Kies een afbeelding of sleep deze hiernaartoe...',
	'ad:file:restriction'           => 'Uitsluitend afbeeldingen toegestaan (PNG, JPG, WebP)',
	'ad:file:remove'                => 'Afbeelding verwijderen',
	'ad:char:left'                  => '%s resterend',
	'ad:status:expired'             => 'Verlopen',
	'ad:status:active'              => 'Actief',
	'ad:views'                      => 'Weergaven',
	'ad:status'                     => 'Status',
	'ad:end:date:infinity'          => 'Nooit',

	//cron
	'ossn:adscron:title'            => 'Vereiste installatie: Automatisch verlopen van advertenties',
	'ossn:adscron:last:run'         => 'Laatste Cron Run:',
	'ossn:adscron:never'            => 'Nooit',
	'ossn:adscron:configure'        => 'Configureren',
	'ossn:adscron:description'      => 'Om advertentiestatussen automatisch te wijzigen naar %s, moet je een systeem cron-job configureren die eenmaal per dag om 12:00 uur \'s middags wordt uitgevoerd.',
	'ossn:adscron:expired'          => 'Verlopen',
	'ossn:adscron:command:label'    => 'Crontab commando',
	'ossn:adscron:path:placeholder' => 'JOUW_SERVER_PHP_PAD',
	'ossn:adscron:warning:title'    => 'Belangrijke mededeling:',
	'ossn:adscron:warning:text'     => 'Zodra een advertentie is verlopen, %s. Adverteerders moeten dan een volledig nieuwe advertentie aanmaken.',
	'ossn:adscron:cannot:edit'      => 'kan deze niet meer worden bewerkt of verlengd',
);
ossn_register_languages('nl', $nl);