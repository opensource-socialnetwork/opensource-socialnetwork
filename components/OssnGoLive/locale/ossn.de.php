<?php
/**
 * Open Source Social Network
 *
 * @package   OssnGoLive
 */

$german = array(
		'golive'                                        => 'Live gehen',
		'golive:admin:legend'                           => 'Cloudflare-Live-Streaming-Einrichtung',
		'golive:admin:account:id'                       => 'Cloudflare-Konto-ID',
		'golive:admin:account:id:placeholder'           => 'Geben Sie Ihre 32-stellige Konto-ID ein',
		'golive:admin:api:token'                        => 'Cloudflare-API-Token',
		'golive:admin:api:token:placeholder'            => 'Fügen Sie hier Ihr benutzerdefiniertes API-Token ein',
		'golive:admin:api:token:note'                   => 'Verwenden Sie keinen globalen Schlüssel. Erstellen Sie ein benutzerdefiniertes Token mit Stream-Bearbeitungs-/Löschberechtigungen.',
		'golive:error:credentials'                      => 'Cloudflare Stream-Anmeldedaten sind im Admin-Bereich nicht konfiguriert.',
		'golive:error:cloudflare'                       => 'Fehler beim Verbinden mit der Cloudflare Stream API. Bitte überprüfen Sie Ihre Anmeldedaten.',
		'golive:wall:announcement'                      => 'ist jetzt live! Schalten Sie ein, um die Übertragung zu sehen.',
		'golive:choose'                                 => 'Jetzt live gehen',
		'golive:choose:title'                           => 'Live gehen über den Browser',
		'golive:choose:subtitle'                        => 'Übertragen Sie direkt von Ihrer Kamera und Ihrem Mikrofon sofort und ohne Konfiguration.',
		'golive:start:button'                           => 'Jetzt live gehen',
		'golive:producer'                               => 'Live Producer',
		'golive:producer:setup'                         => 'Stream-Einrichtung',
		'golive:stream:title'                           => 'Stream-Titel (Optional)',
		'golive:stream:title:placeholder'               => 'Worum geht es in Ihrem Livestream?',
		'golive:select:camera'                          => 'Kamera',
		'golive:select:mic'                             => 'Mikrofon',
		'golive:go:live'                                => 'Live gehen',
		'golive:end:stream'                             => 'Live-Video beenden',
		'golive:error:camera'                           => 'Zugriff auf Kamera oder Mikrofon nicht möglich. Bitte erlauben Sie die Browser-Berechtigungen.',
		'golive:unauthorized'                           => 'Unbefugte Aktion.',
		'golive:ended:success'                          => 'Stream erfolgreich beendet.',
		'golive:ended:error'                            => 'Fehler beim Beenden der Streamsitzung.',
		'golive:error:curl'                             => 'cURL-Fehler',
		'golive:error:unknown'                          => 'Unbekannte Fehlerantwort',
		'golive:error:save'                             => 'Fehler beim Speichern der Streamsitzung.',
		'golive:started:livestream'                     => 'hat eine Live-Übertragung gestartet.',
		'golive:is:live'                                => 'ist jetzt live.',
		'golive:stream:ended'                           => 'Dieser Livestream wurde beendet.',
		'golive:admin:cloudflare:subdomain'             => 'Live-Streaming-Subdomain',
		'golive:admin:cloudflare:subdomain:placeholder' => 'live.ihredomain.de',
		'golive:admin:cloudflare:subdomain:note'        => 'Die benutzerdefinierte Webadresse, unter der Ihre Live-Übertragungen empfangen und gehostet werden.',
		'ossn:notifications:golive'                     => '%s hat eine Live-Übertragung gestartet.',
		'golive:admin:notice:webrtc_views'              =>
		'Das direkte Streamen über den Browser unterstützt keine Live-Zuschauerzahlen. Die Zuschauerverfolgung wird in zukünftigen Versionen bei Verwendung externer Softwareintegration verfügbar sein.',
		// Friendly Guide Strings
		'golive:admin:guide:title'                      => 'Benötigen Sie Hilfe beim Einrichten Ihrer Schlüssel?',
		'golive:admin:guide:step1'                      => 'Finden Sie Ihre Konto-ID: Melden Sie sich in Ihrem Cloudflare-Dashboard an und kopieren Sie die 32-stellige ID auf der rechten Seite Ihrer Hauptkontoübersicht.',
		'golive:admin:guide:step2'                      =>
		'Erstellen Sie ein sicheres API-Token: Gehen Sie zu Ihrem Cloudflare-Profil > API-Token > Token erstellen. Wählen Sie „Benutzerdefiniertes Token erstellen“ und erteilen Sie Berechtigungen für Cloudflare Stream (Bearbeiten) und Stream Live Inputs (Bearbeiten). Teilen oder verwenden Sie hier niemals Ihren globalen Master-Schlüssel.',
		'golive:admin:guide:step3'                      =>
		'Richten Sie Ihre Subdomain ein: Erstellen Sie einen DNS-Eintrag für Ihre Domain (wie live.ihredomain.de) und stellen Sie sicher, dass dieser für ein sicheres Video-Streaming über Cloudflare geleitet (oranger Cloud-Status aktiviert) wird.',
		'golive:status:offline'                         => 'OFFLINE',
		'golive:status:live'                            => 'LIVE',
		'golive:error:camera:notready'                  => 'Kamerastream ist noch nicht bereit.',
		'golive:starting'                               => 'Stream wird gestartet...',
		'golive:error:init'                             => 'Fehler beim Initialisieren des Livestreams.',
		'golive:active:success'                         => 'Livestream ist jetzt aktiv!',
		'golive:error:start'                            => 'Beim Starten des Streams ist ein Fehler aufgetreten.',
		'golive:ending'                                 => 'Stream wird beendet...',
		'golive:top:title'                              => 'Live Studio',
		'golive:exit'                                   => 'Beenden',
		'golive:settings:title'                         => 'Stream-Einstellungen',
		'golive:settings:modal:title'                   => 'Stream-Einstellungen',
		'golive:error:settings:missing'                 => 'Cloudflare-Konto-ID oder API-Token fehlt. Bitte konfigurieren Sie diese im Admin-Bereich.',
		'golive:error:cloudflare:failed'                => 'Fehler beim Verbinden mit Cloudflare Stream. Bitte überprüfen Sie Ihre Anmeldedaten.',
		'golive:error:exception'                        => 'Bei der Kommunikation mit Cloudflare ist ein Serverfehler aufgetreten',
);
ossn_register_languages('de', $german);