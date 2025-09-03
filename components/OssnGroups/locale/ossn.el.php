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
    'groups' => 'Ομάδες',
    'add:group' => 'Δημιουργία ομάδας',
    'requests' => 'Αιτήματα',

    'members' => 'Μέλη',
    'member:add:error' => 'Κάτι πήγε στραβά! Παρακαλώ δοκιμάστε ξανά αργότερα.',
    'member:added' => 'Η αίτηση συμμετοχής εγκρίθηκε!',

    'member:request:deleted' => 'Η αίτηση συμμετοχής απορρίφθηκε!',
    'member:request:delete:fail' => 'Δεν μπορείτε να απορρίψετε αίτημα μέλους! Παρακαλώ δοκιμάστε ξανά αργότερα.',
    'membership:cancel:succes' => 'Η αίτηση συμμετοχής ακυρώθηκε!',
    'membership:cancel:fail' => 'Δεν μπορεί να ακυρωθεί η αίτηση μέλους! Παρακαλώ δοκιμάστε ξανά αργότερα.',

    'group:added' => 'Η ομάδα δημιουργήθηκε με επιτυχία!',
    'group:add:fail' => 'Δεν είναι δυνατή η δημιουργία ομάδας! Παρακαλώ δοκιμάστε ξανά αργότερα.',

    'memebership:sent' => 'Το αίτημα εστάλη με επιτυχία!',
    'memebership:sent:fail' => 'Δεν είναι δυνατή η αποστολή αιτήματος! Παρακαλώ δοκιμάστε ξανά αργότερα.',

    'group:updated' => 'Η ομάδα έχει ενημερωθεί!',
    'group:update:fail' => 'Δεν είναι δυνατή η ενημέρωση της ομάδας! Παρακαλώ δοκιμάστε ξανά αργότερα.',

    'group:name' => 'Όνομα ομάδας',
    'group:desc' => 'Περιγραφή ομάδας',
    'privacy:group:public' => 'Ο καθένας μπορεί να δει αυτή την ομάδα και τις αναρτήσεις της. Μόνο τα μέλη μπορούν να αναρτούν σε αυτήν την ομάδα.',
    'privacy:group:close' => 'Όλοι μπορούν να δουν αυτή την ομάδα. Μόνο τα μέλη μπορούν να δημοσιεύουν και να βλέπουν αναρτήσεις.',

    'group:memb:remove' => 'Αφαίρεσει',
    'group:memb:make:owner' => 'Δημιουργία Ιδιοκτήτη',
    'group:memb:make:owner:confirm' => 'Προσοχή! Αυτή η ενέργεια θα κάνει >>% s << τον νέο κάτοχο της ομάδας και θα χάσετε όλα τα προνόμια του διαχειριστή ομάδας. Είστε σίγουροι ότι θα προχωρήσετε;',
    'group:memb:make:owner:admin:confirm' => 'Attention! This action will make >> %s << the new owner of the group and the former owner will lose all of his group admin privileges. Are you sure to proceed?',
    'leave:group' => 'Αποχώρηση απο την ομάδα',
    'join:group' => 'Γίνετε μέλος',
    'total:members' => 'Συνολικά μέλη',
    'group:members' => "Μέλη (%s)",
    'view:all' => 'Προβολή όλων',
    'member:requests' => 'Αιτήματα (%s)',
    'about:group' => 'Group About',
    'cancel:membership' => 'Ακύρωση μέλους',

    'no:requests' => 'Δεν υπάρχουν αιτήσεις',
    'approve' => 'Εγκρίνω',
    'decline' => 'Απορρίπτω',
    'search:groups' => 'Search Groups',

    'close:group:notice' => 'Γίνετε μέλος αυτής της ομάδας για να δείτε τις δημοσιεύσεις, τις φωτογραφίες και τα σχόλια.',
    'closed:group' => 'Κλειστή ομάδα',
    'group:admin' => 'Διαχειριστής',
	
	'title:access:private:group' => 'Δημοσίευση ομάδας',

	// #186 group join request message var1 = user, var2 = name of group
	'ossn:notifications:group:joinrequest' => '%s έχει ζητήσει να συμμετάσχει %s',
	'ossn:group:by' => 'By:',
	
	'group:deleted' => 'Διαγραφή ομάδας και περιεχομένων',
	'group:delete:fail' => 'Δεν ήταν δυνατή η διαγραφή ομάδας',	

	'group:delete:cover' => 'Διαγραφή καλύμματος',
	'group:delete:cover:error' => 'Παρουσιάστηκε σφάλμα κατά τη διαγραφή της εικόνας εξωφύλλου',
	'group:delete:cover:success' => 'Η εικόνα του καλύμματος διαγράφηκε με επιτυχία',
);
ossn_register_languages('el', $el); 
