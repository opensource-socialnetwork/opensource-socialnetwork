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
$eo = array(
	'ossnads'                       => 'Anonc-Agordilo',
	'fields:required'               => 'Ĉiuj kampoj estas devigaj!',
	'ad:created'                    => 'La anonco estis sukcese kreita!',
	'ad:create:fail'                => 'Ne eblas krei la anoncon!',
	'ad:title'                      => 'Titolo',
	'ad:site:url'                   => 'Reteja URL',
	'ad:desc'                       => 'Priskribo',
	'ad:browse'                     => 'Foliumi',
	'ad:clicks'                     => 'Alklakoj',
	'sponsored'                     => 'SPONSORITA',
	'ad:deleted'                    => "La anonco kun la titolo '%s' estis sukcese forigita.",
	'ad:delete:fail'                => 'Ne eblas forigi la anoncon! Bonvolu provi denove poste.',
	'ad:edited'                     => 'Anonco sukcese modifita.',
	'ad:edit:fail'                  => 'Ne eblas redakti la anoncon! Bonvolu provi denove poste.',
	'ads:manager'                   => 'Reklam-Agordilo',
	'ads:boost:community'           => 'Akcelu vian komunumon. Kreu novan anonckampanjon aŭ administru la ekzistantajn.',
	'ads:create'                    => 'Krei Anoncon',

	'ad:placement'                  => 'Aperlokoj de la Anoncoj',
	'ad:gender:target'              => 'Demografia Celo laŭ Sekso',
	'ad:end:date'                   => 'Limdato de la Kampanjo (Nedeviga)',
	'ad:photo'                      => 'Kreaĵa Bildo de la standardo',
	'add'                           => 'Krei Kampanjon',

	'ad:placement:newsfeed'         => 'Agaddfluo / Novaĵfluo (Flankstango)',
	'ad:placement:profile'          => 'Uzantaj Profiloj (Flankstango)',
	'ad:placement:groups'           => 'Grupaj Paĝoj (Flankstango)',
	'ad:placement:global'           => 'Ĉiuj aliaj etosaj flankstangoj (Tutmonda)',

	'ad:file:choose'                => 'Elektu aŭ trenu anoncbildon ĉi tien...',
	'ad:file:restriction'           => 'Strikte nur bilddosieroj (PNG, JPG, WebP)',
	'ad:file:remove'                => 'Forigi Bildon',
	'ad:char:left'                  => '%s signoj restantaj',
	'ad:status:expired'             => 'Eksvalidiĝinta',
	'ad:status:active'              => 'Aktiva',
	'ad:views'                      => 'Vidoj',
	'ad:status'                     => 'Stato',
	'ad:end:date:infinity'          => 'Neniam',

	//cron
	'ossn:adscron:title'            => 'Deviga Agordo: Aŭtomatigi Eksvalidiĝon de Anoncoj',
	'ossn:adscron:last:run'         => 'Lasta Cron-Rulo:',
	'ossn:adscron:never'            => 'Neniam',
	'ossn:adscron:configure'        => 'Agordi',
	'ossn:adscron:description'      => 'Por aŭtomate ŝanĝi la staton de anoncoj al %s, vi devas agordi sisteman cron-taskon por ruliĝi unufoje tage je tagmezo (12:00 PM).',
	'ossn:adscron:expired'          => 'Eksvalidiĝinta',
	'ossn:adscron:command:label'    => 'Crontab-Komando',
	'ossn:adscron:path:placeholder' => 'PHP_VOJO_DE_VIA_SERVILO',
	'ossn:adscron:warning:title'    => 'Grava Noto:',
	'ossn:adscron:warning:text'     => 'Kiam anonco eksvalidiĝas, ĝi %s. Reklamantoj devas krei novan anoncon de la komenco.',
	'ossn:adscron:cannot:edit'      => 'ne plu povas esti redaktata aŭ renovigata',
);
ossn_register_languages('eo', $eo);