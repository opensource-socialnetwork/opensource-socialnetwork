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
$it = array(
		'ossnaddressbook:menu'               => 'Rubrica',
		'ossnaddressbook:title'              => 'Rubrica',
		'ossnaddressbook:subtitle:contacts'  => 'contatti',
		'ossnaddressbook:subtitle:favorites' => 'preferiti',
		'ossnaddressbook:search:placeholder' => 'Cerca contatti per nome, telefono, email o azienda...',
		'ossnaddressbook:add'                => 'Aggiungi Contatto',
		'ossnaddressbook:add:toggle'         => 'Nuovo Contatto',
		'ossnaddressbook:name:placeholder'   => 'Nome completo *',
		'ossnaddressbook:phone:placeholder'  => 'Telefono / WhatsApp',
		'ossnaddressbook:email:placeholder'  => 'Indirizzo email',
		'ossnaddressbook:company:placeholder' => 'Azienda / Organizzazione',
		'ossnaddressbook:address:placeholder' => 'Indirizzo / Città',
		'ossnaddressbook:note:placeholder'   => 'Note personali (facoltativo)...',
		'ossnaddressbook:category'           => 'Gruppo',
		'ossnaddressbook:category:all'       => 'Tutti',
		'ossnaddressbook:category:favorites' => 'Preferiti',
		'ossnaddressbook:category:personal'  => 'Personali',
		'ossnaddressbook:category:work'      => 'Lavoro',
		'ossnaddressbook:category:family'    => 'Famiglia',
		'ossnaddressbook:category:other'     => 'Altro',
		'ossnaddressbook:favorite'           => 'Preferito',
		'ossnaddressbook:edit'               => 'Modifica',
		'ossnaddressbook:save'               => 'Salva',
		'ossnaddressbook:cancel'             => 'Annulla',
		'ossnaddressbook:delete'             => 'Elimina',
		'ossnaddressbook:delete:all'         => 'Elimina Tutti',
		'ossnaddressbook:delete:all:confirm' => 'Sei sicuro di voler eliminare tutti i contatti? Questa azione non può essere annullata.',
		'ossnaddressbook:empty'              => 'La tua rubrica è vuota. Aggiungi il tuo primo contatto qui sopra!',
		'ossnaddressbook:add:error'          => 'Impossibile aggiungere il contatto. Inserisci un nome.',
		'ossnaddressbook:edit:error'         => 'Impossibile aggiornare il contatto.',
		'ossnaddressbook:delete:error'       => 'Impossibile eliminare il contatto.',
		'ossnaddressbook:import'             => 'Importa',
		'ossnaddressbook:export:csv'         => 'Esporta CSV',
		'ossnaddressbook:export:vcf'         => 'Esporta vCard',
		'ossnaddressbook:import:success'     => '%s contatti importati con successo.',
		'ossnaddressbook:import:error'       => 'Seleziona un file CSV o vCard (.vcf) da importare.',
		'ossnaddressbook:import:invalid'     => 'Formato file non supportato. Sono consentiti solo file .csv e .vcf.',
		'ossnaddressbook:import:empty'       => 'Nessun contatto valido trovato nel file caricato.',
);
ossn_register_languages('it', $it);
