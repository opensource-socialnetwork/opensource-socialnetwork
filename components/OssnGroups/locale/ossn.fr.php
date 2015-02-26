<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$fr = array(
    'groups' => 'Groupes',
    'add:group' => 'Ajouter un groupe',
    'requests' => 'Requêtes',

    'members' => 'Membres',
    'member:add:error' => 'Quelque chose s\'est mal passé! S\'il vous plaît réessayer plus tard.',
    'member:added' => 'Demande d\'adhésion approuvé!',

    'member:request:deleted' => 'Demande d\'adhésion refusé!',
    'member:request:delete:fail' => 'Vous ne pouvez pas refuser la demande d\'adhésion! S\'il vous plaît réessayer plus tard.',
    'membership:cancel:succes' => 'Demande d\'adhésion annulée!',
    'membership:cancel:fail' => 'Vous ne pouvez pas annuler la demande d\'adhésion! S\'il vous plaît réessayer plus tard.',

    'group:added' => 'Groupe crée avec succès!',
    'group:add:fail' => 'Vous ne pouvez pas créer de groupe! S\'il vous plaît réessayer plus tard.',

    'memebership:sent' => 'Demande envoyé avec succès!',
    'memebership:sent:fail' => 'Vous ne pouvez pas envoyer de demande! S\'il vous plaît réessayer plus tard.',

    'group:updated' => 'Le groupe a été mis à jour!',
    'group:update:fail' => 'Vous ne pouvez pas mettre à jour le groupe! S\'il vous plaît réessayer plus tard.',

    'group:name' => 'Nom du groupe',
    'group:desc' => 'Description du groupe',
    'privacy:group:public' => 'Tout le monde peut voir ce groupe et ses messages. Seuls les membres peuvent poster dans ce groupe.',
    'privacy:group:close' => 'Tout le monde peut voir ce groupe. Seuls les membres peuvent poster et voir les messages.',

    'group:memb:remove' => 'Supprimer',
    'leave:group' => 'Quitter le groupe',
    'join:group' => 'Rejoindre le groupe',
    'total:members' => 'Nombre de Membres',
    'group:members' => "Membres (%s)",
    'view:all' => 'Voir tout',
    'member:requests' => 'DEMANDES (%s)',
    'about:group' => 'A propos du groupet',
    'cancel:membership' => 'Adhésion annulée',

    'no:requests' => 'Aucune demande',
    'approve' => 'Approuver',
    'decline' => 'Refuser',
    'search:groups' => 'Recherche Groupes',

    'close:group:notice' => 'Rejoignez ce groupe pour voir les messages, photos et commentaires.',
    'closed:group' => 'Groupes privé',
    'group:admin' => 'Admin',
	
	'title:access:private:group' => 'Message du groupe',

	// #186 group join request message var1 = user, var2 = name of group
	'ossn:notifications:group:joinrequest' => '%s a demandé à rejoindre %s',
);
ossn_register_languages('fr', $fr); 
