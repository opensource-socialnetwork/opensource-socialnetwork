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
$ro = array(
	'ossnads'                       => 'Manager Anunțuri',
	'fields:required'               => 'Toate câmpurile sunt obligatorii!',
	'ad:created'                    => 'Anunțul a fost creat cu succes!',
	'ad:create:fail'                => 'Nu s-a putut crea anunțul!',
	'ad:title'                      => 'Titlu',
	'ad:site:url'                   => 'URL site',
	'ad:desc'                       => 'Descriere',
	'ad:browse'                     => 'Răsfoiește',
	'ad:clicks'                     => 'Click-uri',
	'sponsored'                     => 'SPONSORIZAT',
	'ad:deleted'                    => "Anunțul cu titlul '%s' a fost șters cu succes.",
	'ad:delete:fail'                => 'Nu s-a putut șterge anunțul! Vă rugăm să încercați din nou mai târziu.',
	'ad:edited'                     => 'Anunțul a fost modificat cu succes.',
	'ad:edit:fail'                  => 'Nu s-a putut edita anunțul! Vă rugăm să încercați din nou mai târziu.',
	'ads:manager'                   => 'Manager Publicitate',
	'ads:boost:community'           => 'Promovează-ți comunitatea. Creează o campanie publicitară nouă sau gestionează-le pe cele existente.',
	'ads:create'                    => 'Creează Anunț',

	'ad:placement'                  => 'Zone de Afișare a Anunțurilor',
	'ad:gender:target'              => 'Targetare Demografică în Funcție de Gen',
	'ad:end:date'                   => 'Data de Expirare a Campaniei (Opțional)',
	'ad:photo'                      => 'Imagine Banner Publicitar',
	'add'                           => 'Creează Campanie',

	'ad:placement:newsfeed'         => 'Flux de Activități / Newsfeed (Secțiunea Laterală)',
	'ad:placement:profile'          => 'Profiluri Utilizatori (Secțiunea Laterală)',
	'ad:placement:groups'           => 'Pagini de Grup (Secțiunea Laterală)',
	'ad:placement:global'           => 'Toate celelalte secțiuni laterale (Global)',

	'ad:file:choose'                => 'Alege sau trage imaginea anunțului aici...',
	'ad:file:restriction'           => 'Sunt permise doar fișiere de tip imagine (PNG, JPG, WebP)',
	'ad:file:remove'                => 'Elimină Imaginea',
	'ad:char:left'                  => '%s rămase',
	'ad:status:expired'             => 'Expirat',
	'ad:status:active'              => 'Activ',
	'ad:views'                      => 'Vizualizări',
	'ad:status'                     => 'Status',
	'ad:end:date:infinity'          => 'Niciodată',

	//cron
	'ossn:adscron:title'            => 'Configurare Obligatorie: Automatizare Expirare Anunțuri',
	'ossn:adscron:last:run'         => 'Ultima Rulare Cron:',
	'ossn:adscron:never'            => 'Niciodată',
	'ossn:adscron:configure'        => 'Configurează',
	'ossn:adscron:description'      => 'Pentru a schimba automat statusul anunțurilor în %s, trebuie să configurați o sarcină cron de sistem (cron job) care să ruleze o dată pe zi, la amiază (12:00 PM).',
	'ossn:adscron:expired'          => 'Expirat',
	'ossn:adscron:command:label'    => 'Comandă Crontab',
	'ossn:adscron:path:placeholder' => 'CALEA_PHP_A_SERVERULUI_TĂU',
	'ossn:adscron:warning:title'    => 'Notă Importantă:',
	'ossn:adscron:warning:text'     => 'Odată ce un anunț expiră, acesta %s. Publicitarii trebuie să creeze un anunț nou de la zero.',
	'ossn:adscron:cannot:edit'      => 'nu mai poate fi editat sau reînnoit',
);
ossn_register_languages('ro', $ro);