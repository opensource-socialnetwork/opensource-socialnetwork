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
$el = array(
	'ossnads'                       => 'Διαχειριστής Διαφημίσεων',
	'fields:required'               => 'Όλα τα πεδία είναι υποχρεωτικά!',
	'ad:created'                    => 'Η διαφήμιση δημιουργήθηκε επιτυχώς!',
	'ad:create:fail'                => 'Αδυναμία δημιουργίας διαφήμισης!',
	'ad:title'                      => 'Τίτλος',
	'ad:site:url'                   => 'URL Ιστοτόπου',
	'ad:desc'                       => 'Περιγραφή',
	'ad:browse'                     => 'Αναζήτηση',
	'ad:clicks'                     => 'Κλικς',
	'sponsored'                     => 'ΧΟΡΗΓΟΥΜΕΝΟ',
	'ad:deleted'                    => "Η διαφήμιση με τον τίτλο '%s' διαγράφηκε επιτυχώς.",
	'ad:delete:fail'                => 'Αδυναμία διαγραφής διαφήμισης! Παρακαλούμε δοκιμάστε ξανά αργότερα.',
	'ad:edited'                     => 'Η διαφήμιση τροποποιήθηκε επιτυχώς.',
	'ad:edit:fail'                  => 'Αδυναμία επεξεργασίας διαφήμισης! Παρακαλούμε δοκιμάστε ξανά αργότερα.',
	'ads:manager'                   => 'Διαχείριση Διαφημίσεων',
	'ads:boost:community'           => 'Ενισχύστε την κοινότητά σας. Δημιουργήστε μια νέα διαφημιστική εκστρατεία ή διαχειριστείτε τις υπάρχουσες.',
	'ads:create'                    => 'Δημιουργία Διαφήμισης',

	'ad:placement'                  => 'Περιοχές Τοποθέτησης Διαφημίσεων',
	'ad:gender:target'              => 'Δημογραφική Στόχευση Φύλου',
	'ad:end:date'                   => 'Ημερομηνία Λήξης Εκστρατείας (Προαιρετικό)',
	'ad:photo'                      => 'Εικόνα Δημιουργικού Banner',
	'add'                           => 'Δημιουργία Εκστρατείας',

	'ad:placement:newsfeed'         => 'Ροή Δραστηριοτήτων / Newsfeed (Πλευρική Στήλη)',
	'ad:placement:profile'          => 'Προφίλ Χρηστών (Πλευρική Στήλη)',
	'ad:placement:groups'           => 'Σελίδες Ομάδων (Πλευρική Στήλη)',
	'ad:placement:global'           => 'Όλες οι άλλες πλευρικές στήλες θεμάτων (Καθολικά)',

	'ad:file:choose'                => 'Επιλέξτε ή σύρετε την εικόνα της διαφήμισης εδώ...',
	'ad:file:restriction'           => 'Επιτρέπονται αποκλειστικά αρχεία εικόνας (PNG, JPG, WebP)',
	'ad:file:remove'                => 'Αφαίρεση Εικόνας',
	'ad:char:left'                  => 'απομένουν %s χαρακτήρες',
	'ad:status:expired'             => 'Έχει λήξει',
	'ad:status:active'              => 'Ενεργή',
	'ad:views'                      => 'Προβολές',
	'ad:status'                     => 'Κατάσταση',
	'ad:end:date:infinity'          => 'Ποτέ',

	//cron
	'ossn:adscron:title'            => 'Απαιτούμενη Ρύθμιση: Αυτοματοποίηση Λήξης Διαφημίσεων',
	'ossn:adscron:last:run'         => 'Τελευταία Εκτέλεση Cron:',
	'ossn:adscron:never'            => 'Ποτέ',
	'ossn:adscron:configure'        => 'Διαμόρφωση',
	'ossn:adscron:description'      => 'Για να αλλάζει αυτόματα η κατάσταση των διαφημίσεων σε %s, πρέπει να ρυθμίσετε μια εργασία cron (cron job) συστήματος που να εκτελείται μία φορά την ημέρα το μεσημέρι (12:00 μ.μ.).',
	'ossn:adscron:expired'          => 'Έχει λήξει',
	'ossn:adscron:command:label'    => 'Εντολή Crontab',
	'ossn:adscron:path:placeholder' => 'YOUR_SERVER_PHP_PATH',
	'ossn:adscron:warning:title'    => 'Σημαντική Σημείωση:',
	'ossn:adscron:warning:text'     => 'Μόλις μια διαφήμιση λήξει, αυτή %s. Οι διαφημιστές πρέπει να δημιουργήσουν μια νέα διαφήμιση από την αρχή.',
	'ossn:adscron:cannot:edit'      => 'δεν μπορεί να επεξεργαστεί ή να ανανεωθεί',
);
ossn_register_languages('el', $el);