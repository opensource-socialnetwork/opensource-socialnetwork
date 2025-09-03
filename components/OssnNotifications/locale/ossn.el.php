<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$el = array(
	'ossnnotifications' => 'Ειδοποιήσεις',
    'ossn:notifications:comments:post' => "%s σχολίασε τη δημοσίευση.",
    'ossn:notifications:like:post' => "%s άρεσε η δημοσίευση σας.",
    'ossn:notifications:like:annotation' => "%s άρεσε το σχόλιό σας.",
    'ossn:notifications:like:entity:file:ossn:aphoto' => "%s άρεσε η φωτογραφία σας.",
    'ossn:notifications:comments:entity:file:ossn:aphoto' => '%s σχολίασε τη φωτογραφία σας.',
    'ossn:notifications:wall:friends:tag' => '%s σας επισήμανε σε μια δημοσίευση.',
    'ossn:notification:are:friends' => 'Τώρα είστε φίλοι!',
    'ossn:notifications:comments:post:group:wall' => "%s σχολίασε την δημοσίευση της ομάδας.",
    'ossn:notifications:like:entity:file:profile:photo' => "%s άρεσε η φωτογραφία του προφίλ σας.",
    'ossn:notifications:comments:entity:file:profile:photo' => "%s σχολίασε τη φωτογραφία προφίλ σας.",
    'ossn:notifications:like:entity:file:profile:cover' => "%s άρεσε το cover του προφίλ σας.",
    'ossn:notifications:comments:entity:file:profile:cover' => "%s σχολίασε το εξώφυλλο του προφίλ σας.",

    'ossn:notifications:like:post:group:wall' => '%s άρεσε η δημοσίευση σας.',
	
    'ossn:notification:delete:friend' => 'Το αίτημα φιλίας διαγράφηκε!',
    'notifications' => 'Ειδοποιήσεις',
    'see:all' => 'Δείτε τα όλα',
    'friend:requests' => 'Αιτήματα φιλίας',
    'ossn:notifications:friendrequest:confirmbutton' => 'Επιβεβαίωση',
    'ossn:notifications:friendrequest:denybutton' => 'Διαγραφή',
	
    'ossn:notification:mark:read:success' => 'Επιτυχής επισημανση όλα ως αναγνωσμένα',
    'ossn:notification:mark:read:error' => 'Δεν είναι δυνατή η επισήμανση όλων ως αναγνωσμένων',
    
    'ossn:notifications:mark:as:read' => 'Σημειώστε όλα ως αναγνωσμένα',
	'ossn:notifications:admin:settings:close_anywhere:title' => 'Κλείστε τα παράθυρα ειδοποιήσεων κάνοντας κλικ οπουδήποτε',
	'ossn:notifications:admin:settings:close_anywhere:note' => '<i class="fa fa-info-circle"></i> κλείνει οποιοδήποτε παράθυρο ειδοποίησης κάνοντας κλικ οπουδήποτε στη σελίδα<br><br>',
	
	'ossn:notifications:comments:entity:file:profile:photo:someone' => "%s σχολίασε τη φωτογραφία προφίλ.",	
    'ossn:notifications:comments:entity:file:profile:cover:someone' => "%s σχολίασε το εξώφυλλο του προφίλ.",	
	'ossn:notifications:comments:entity:file:ossn:aphoto:someone' => '%s σχολίασε τη φωτογραφία.',

	'ossn:notifications:admin:settings:checkintervals:title' => 'Χρόνος αυτόματου ελέγχου ειδοποιήσεων (προεπιλογή 60 δευτερόλεπτα)', 	
);
ossn_register_languages('el', $el); 
