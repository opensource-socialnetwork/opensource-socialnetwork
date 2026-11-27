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
		'ossnaddressbook:menu'               => 'Βιβλίο Διευθύνσεων',
		'ossnaddressbook:title'              => 'Βιβλίο Διευθύνσεων',
		'ossnaddressbook:subtitle:contacts'  => 'επαφές',
		'ossnaddressbook:subtitle:favorites' => 'αγαπημένα',
		'ossnaddressbook:search:placeholder' => 'Αναζήτηση επαφών με όνομα, τηλέφωνο, email ή εταιρεία...',
		'ossnaddressbook:add'                => 'Προσθήκη Επαφής',
		'ossnaddressbook:add:toggle'         => 'Νέα Επαφή',
		'ossnaddressbook:name:placeholder'   => 'Πλήρες Όνομα *',
		'ossnaddressbook:phone:placeholder'  => 'Τηλέφωνο / WhatsApp',
		'ossnaddressbook:email:placeholder'  => 'Διεύθυνση Email',
		'ossnaddressbook:company:placeholder' => 'Εταιρεία / Οργανισμός',
		'ossnaddressbook:address:placeholder' => 'Διεύθυνση / Πόλη',
		'ossnaddressbook:note:placeholder'   => 'Προσωπικές σημειώσεις (προαιρετικό)...',
		'ossnaddressbook:category'           => 'Ομάδα',
		'ossnaddressbook:category:all'       => 'Όλες',
		'ossnaddressbook:category:favorites' => 'Αγαπημένα',
		'ossnaddressbook:category:personal'  => 'Προσωπικές',
		'ossnaddressbook:category:work'      => 'Εργασία',
		'ossnaddressbook:category:family'    => 'Οικογένεια',
		'ossnaddressbook:category:other'     => 'Άλλες',
		'ossnaddressbook:favorite'           => 'Αγαπημένο',
		'ossnaddressbook:edit'               => 'Επεξεργασία',
		'ossnaddressbook:save'               => 'Αποθήκευση',
		'ossnaddressbook:cancel'             => 'Ακύρωση',
		'ossnaddressbook:delete'             => 'Διαγραφή',
		'ossnaddressbook:delete:all'         => 'Διαγραφή Όλων',
		'ossnaddressbook:delete:all:confirm' => 'Είστε σίγουροι ότι θέλετε να διαγράψετε όλες τις επαφές; Αυτή η ενέργεια δεν μπορεί να αναιρεθεί.',
		'ossnaddressbook:empty'              => 'Το βιβλίο διευθύνσεών σας είναι άδειο. Προσθέστε την πρώτη σας επαφή παραπάνω!',
		'ossnaddressbook:add:error'          => 'Δεν είναι δυνατή η προσθήκη επαφής. Εισαγάγετε ένα όνομα.',
		'ossnaddressbook:edit:error'         => 'Δεν είναι δυνατή η ενημέρωση της επαφής.',
		'ossnaddressbook:delete:error'       => 'Δεν είναι δυνατή η διαγραφή της επαφής.',
		'ossnaddressbook:import'             => 'Εισαγωγή',
		'ossnaddressbook:export:csv'         => 'Εξαγωγή CSV',
		'ossnaddressbook:export:vcf'         => 'Εξαγωγή vCard',
		'ossnaddressbook:import:success'     => 'Εισήχθησαν επιτυχώς %s επαφές.',
		'ossnaddressbook:import:error'       => 'Επιλέξτε ένα αρχείο CSV ή vCard (.vcf) για εισαγωγή.',
		'ossnaddressbook:import:invalid'     => 'Μη υποστηριζόμενη μορφή αρχείου. Επιτρέπονται μόνο αρχεία .csv και .vcf.',
		'ossnaddressbook:import:empty'       => 'Δεν βρέθηκαν έγκυρες επαφές στο αρχείο που μεταφορτώθηκε.',
);
ossn_register_languages('el', $el);
