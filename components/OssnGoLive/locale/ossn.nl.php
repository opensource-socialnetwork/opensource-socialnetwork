<?php
/**
 * Open Source Social Network
 *
 * @package   OssnGoLive
 */

$dutch = array(
		'golive'                                        => 'Ga Live',
		'golive:admin:legend'                           => 'Cloudflare Live Streaming Instellingen',
		'golive:admin:account:id'                       => 'Cloudflare Account-ID',
		'golive:admin:account:id:placeholder'           => 'Voer uw 32-tekens account-ID in',
		'golive:admin:api:token'                        => 'Cloudflare API-token',
		'golive:admin:api:token:placeholder'            => 'Plak hier uw aangepaste API-token',
		'golive:admin:api:token:note'                   => 'Gebruik geen globale sleutel. Maak een aangepast token aan met Stream Bewerken/Verwijderen machtigingen.',
		'golive:error:credentials'                      => 'Cloudflare Stream-inloggegevens zijn niet geconfigureerd in het beheerderspaneel.',
		'golive:error:cloudflare'                       => 'Kan geen verbinding maken met de Cloudflare Stream API. Controleer uw inloggegevens.',
		'golive:wall:announcement'                      => 'is nu live! Luister mee om de uitzending te bekijken.',
		'golive:choose'                                 => 'Ga Nu Live',
		'golive:choose:title'                           => 'Ga Live via Browser',
		'golive:choose:subtitle'                        => 'Zend direct uit via uw camera en microfoon zonder enige configuratie.',
		'golive:start:button'                           => 'Ga Nu Live',
		'golive:producer'                               => 'Live Producer',
		'golive:producer:setup'                         => 'Stream Instellen',
		'golive:stream:title'                           => 'Streamtitel (Optioneel)',
		'golive:stream:title:placeholder'               => 'Waar gaat uw livestream over?',
		'golive:select:camera'                          => 'Camera',
		'golive:select:mic'                             => 'Microfoon',
		'golive:go:live'                                => 'Ga Live',
		'golive:end:stream'                             => 'Live Video Beëindigen',
		'golive:error:camera'                           => 'Geen toegang tot camera of microfoon. Geef alstublieft browsermachtigingen.',
		'golive:unauthorized'                           => 'Ongeautoriseerde actie.',
		'golive:ended:success'                          => 'Stream succesvol beëindigd.',
		'golive:ended:error'                            => 'Kan streamsessie niet beëindigen.',
		'golive:error:curl'                             => 'cURL-fout',
		'golive:error:unknown'                          => 'Onbekende foutreactie',
		'golive:error:save'                             => 'Kan streamsessie niet opslaan.',
		'golive:started:livestream'                     => 'is een live-uitzending gestart.',
		'golive:is:live'                                => 'is nu live.',
		'golive:stream:ended'                           => 'Deze livestream is beëindigd.',
		'golive:admin:cloudflare:subdomain'             => 'Live Streaming Subdomein',
		'golive:admin:cloudflare:subdomain:placeholder' => 'live.uwdomein.nl',
		'golive:admin:cloudflare:subdomain:note'        => 'Het aangepaste webadres waar uw live-uitzendingen worden ontvangen en gehost.',
		'ossn:notifications:golive'                     => '%s is een live-uitzending gestart.',
		'golive:admin:notice:webrtc_views'              =>
		'Direct streamen via de browser ondersteunt geen live kijkersaantallen. Kijkerstracering zal beschikbaar zijn in toekomstige releases bij het gebruik van externe software-integratie.',
		// Friendly Guide Strings
		'golive:admin:guide:title'                      => 'Hulp nodig bij het instellen van uw sleutels?',
		'golive:admin:guide:step1'                      => 'Vind uw Account-ID: Log in op uw Cloudflare-dashboard en kopieer de 32-tekens ID aan de rechterkant van uw hoofdaccountpagina.',
		'golive:admin:guide:step2'                      =>
		'Maak een veilig API-token aan: Ga naar uw Cloudflare Profiel > API Tokens > Create Token. Selecteer "Create Custom Token" en geef het machtigingen voor Cloudflare Stream (Edit) en Stream Live Inputs (Edit). Deel of gebruik hier nooit uw globale mastersleutel.',
		'golive:admin:guide:step3'                      =>
		'Stel uw subdomein in: Maak een DNS-record aan op uw domein (zoals live.uwdomein.nl) en zorg ervoor dat dit wordt geproxied via Cloudflare (oranje wolk ingeschakeld) voor veilige videostreaming.',
		'golive:status:offline'                         => 'OFFLINE',
		'golive:status:live'                            => 'LIVE',
		'golive:error:camera:notready'                  => 'Camerastream is nog niet gereed.',
		'golive:starting'                               => 'Stream starten...',
		'golive:error:init'                             => 'Kan livestream niet initialiseren.',
		'golive:active:success'                         => 'Livestream is nu actief!',
		'golive:error:start'                            => 'Er is een fout opgetreden bij het starten van de stream.',
		'golive:ending'                                 => 'Stream beëindigen...',
		'golive:top:title'                              => 'Live Studio',
		'golive:exit'                                   => 'Afsluiten',
		'golive:settings:title'                         => 'Stream-instellingen',
		'golive:settings:modal:title'                   => 'Stream-instellingen',
		'golive:error:settings:missing'                 => 'Cloudflare Account-ID of API-token ontbreekt. Configureer deze in het beheerderspaneel.',
		'golive:error:cloudflare:failed'                => 'Kan geen verbinding maken met Cloudflare Stream. Controleer uw inloggegevens.',
		'golive:error:exception'                        => 'Er is een serverfout opgetreden tijdens de communicatie met Cloudflare',
);
ossn_register_languages('nl', $dutch);