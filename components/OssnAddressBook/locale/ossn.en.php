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
$en = array(
		'ossnaddressbook:menu'               => 'Address Book',
		'ossnaddressbook:title'              => 'Address Book',
		'ossnaddressbook:subtitle:contacts'  => 'contacts',
		'ossnaddressbook:subtitle:favorites' => 'favorites',
		'ossnaddressbook:search:placeholder' => 'Search contacts by name, phone, email, or company...',
		'ossnaddressbook:add'                => 'Add Contact',
		'ossnaddressbook:add:toggle'         => 'New Contact',
		'ossnaddressbook:name:placeholder'   => 'Full Name *',
		'ossnaddressbook:phone:placeholder'  => 'Phone / WhatsApp',
		'ossnaddressbook:email:placeholder'  => 'Email Address',
		'ossnaddressbook:company:placeholder'=> 'Company / Organization',
		'ossnaddressbook:address:placeholder'=> 'Address / City',
		'ossnaddressbook:note:placeholder'   => 'Personal notes (optional)...',
		'ossnaddressbook:category'           => 'Group',
		'ossnaddressbook:category:all'       => 'All',
		'ossnaddressbook:category:favorites' => 'Favorites',
		'ossnaddressbook:category:personal'  => 'Personal',
		'ossnaddressbook:category:work'      => 'Work',
		'ossnaddressbook:category:family'    => 'Family',
		'ossnaddressbook:category:other'     => 'Other',
		'ossnaddressbook:favorite'           => 'Favorite',
		'ossnaddressbook:edit'               => 'Edit',
		'ossnaddressbook:save'               => 'Save',
		'ossnaddressbook:cancel'             => 'Cancel',
		'ossnaddressbook:delete'             => 'Delete',
		'ossnaddressbook:delete:all'         => 'Delete All',
		'ossnaddressbook:delete:all:confirm' => 'Are you sure you want to delete all contacts? This cannot be undone.',
		'ossnaddressbook:empty'              => 'Your address book is empty. Add your first contact above!',
		'ossnaddressbook:add:error'          => 'Cannot add contact. Please enter a name.',
		'ossnaddressbook:edit:error'         => 'Cannot update contact.',
		'ossnaddressbook:delete:error'       => 'Cannot delete contact.',
		'ossnaddressbook:import'         => 'Import',
		'ossnaddressbook:export:csv'     => 'Export CSV',
		'ossnaddressbook:export:vcf'     => 'Export vCard',
		'ossnaddressbook:import:success' => '%s contacts imported successfully.',
		'ossnaddressbook:import:error'   => 'Please select a CSV or vCard (.vcf) file to import.',
		'ossnaddressbook:import:invalid' => 'Unsupported file format. Only .csv and .vcf files are allowed.',
		'ossnaddressbook:import:empty'   => 'No valid contacts were found in the uploaded file.',		
);
ossn_register_languages('en', $en);
