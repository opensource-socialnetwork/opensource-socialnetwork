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
    'about:group' => 'A propos du groupe',
    'cancel:membership' => 'Annuler l\'adhésion',

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
	'ossn:group:by' => 'Par:',
	
	'group:deleted' => 'Groupe et contenu du groupe supprimé',
	'group:delete:fail' => 'Le groupe ne peut pas être supprimé',	

	'group:delete:cover' => 'Supprimer la photo de couverture',
	'group:delete:cover:error' => "Une erreur s'est produite lors de la suppression de l'image de couverture",
	'group:delete:cover:success' => "L'image de couverture a été supprimée avec succès",
	
	//need translation
    'group:memb:make:owner' => 'Make group owner',
    'group:memb:make:owner:confirm' => 'Attention! This action will make >> %s << the new owner of the group and you will lose all of your group admin privileges. Are you sure to proceed?',
    'group:memb:make:owner:admin:confirm' => 'Attention! This action will make >> %s << the new owner of the group and the former owner will lose all of his group admin privileges. Are you sure to proceed?',	
);
ossn_register_languages('fr', $fr); 
