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
$it = array(
	'ossnads'                       => 'Gestione Inserzioni',
	'fields:required'               => 'Tutti i campi sono obbligatori!',
	'ad:created'                    => 'L\'annuncio è stato creato con successo!',
	'ad:create:fail'                => 'Impossibile creare l\'annuncio!',
	'ad:title'                      => 'Titolo',
	'ad:site:url'                   => 'URL del sito',
	'ad:desc'                       => 'Descrizione',
	'ad:browse'                     => 'Sfoglia',
	'ad:clicks'                     => 'Click',
	'sponsored'                     => 'SPONSORIZZATO',
	'ad:deleted'                    => "L'annuncio con il titolo '%s' è stato eliminato con successo.",
	'ad:delete:fail'                => 'Impossibile eliminare l\'annuncio! Si prega di riprovare più tardi.',
	'ad:edited'                     => 'Annuncio modificato con successo.',
	'ad:edit:fail'                  => 'Impossibile modificare l\'annuncio! Si prega di riprovare più tardi.',
	'ads:manager'                   => 'Gestore Pubblicità',
	'ads:boost:community'           => 'Dai una spinta alla tua community. Crea una nuova campagna pubblicitaria o gestisci quelle esistenti.',
	'ads:create'                    => 'Crea Annuncio',

	'ad:placement'                  => 'Posizionamenti di Visualizzazione',
	'ad:gender:target'              => 'Targetizzazione Demografica per Genere',
	'ad:end:date'                   => 'Data di Scadenza della Campagna (Opzionale)',
	'ad:photo'                      => 'Immagine Creativa del Banner',
	'add'                           => 'Crea Campagna',

	'ad:placement:newsfeed'         => 'Feed delle Attività / Newsfeed (Barra Laterale)',
	'ad:placement:profile'          => 'Profili Utente (Barra Laterale)',
	'ad:placement:groups'           => 'Pagine dei Gruppi (Barra Laterale)',
	'ad:placement:global'           => 'Tutte le altre barre laterali del tema (Globale)',

	'ad:file:choose'                => 'Scegli o trascina qui l\'immagine dell\'annuncio...',
	'ad:file:restriction'           => 'Sono consentiti solo file immagine (PNG, JPG, WebP)',
	'ad:file:remove'                => 'Rimuovi Immagine',
	'ad:char:left'                  => '%s rimanenti',
	'ad:status:expired'             => 'Scaduto',
	'ad:status:active'              => 'Attivo',
	'ad:views'                      => 'Visualizzazioni',
	'ad:status'                     => 'Stato',
	'ad:end:date:infinity'          => 'Mai',

	//cron
	'ossn:adscron:title'            => 'Configurazione Richiesta: Automatizza la Scadenza degli Annunci',
	'ossn:adscron:last:run'         => 'Ultima Esecuzione Cron:',
	'ossn:adscron:never'            => 'Mai',
	'ossn:adscron:configure'        => 'Configura',
	'ossn:adscron:description'      => 'Per modificare automaticamente lo stato degli annunci in %s, è necessario configurare un cron job di sistema che venga eseguito una volta al giorno a mezzogiorno (12:00 PM).',
	'ossn:adscron:expired'          => 'Scaduto',
	'ossn:adscron:command:label'    => 'Comando Crontab',
	'ossn:adscron:path:placeholder' => 'PERCORSO_PHP_DEL_TUO_SERVER',
	'ossn:adscron:warning:title'    => 'Avviso Importante:',
	'ossn:adscron:warning:text'     => 'Una volta che un annuncio è scaduto, esso %s. Gli inserzionisti dovranno creare un nuovo annuncio da zero.',
	'ossn:adscron:cannot:edit'      => 'non può essere modificato o rinnovato',
);
ossn_register_languages('it', $it);