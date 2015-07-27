<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$de = array(
    'groups' => 'Gruppen',
    'add:group' => 'Gruppe gründen',
    'requests' => 'Anfragen',

    'members' => 'Mitglieder',
    'member:add:error' => 'Irgendetwas ist schiefgelaufen - versuche es noch einmal',
    'member:added' => 'Mitgliedschaft bestätigt',

    'member:request:deleted' => 'Mitgliedschaft erfolgreich abgelehnt',
    'member:request:delete:fail' => 'Mitgliedschaft kann nicht abgelehnt werden - versuche es später nochmal',
    'membership:cancel:succes' => 'Mitgliedschaft erfolgreich beendet',
    'membership:cancel:fail' => 'Mitgliedschaft kann nicht beendet werden - versuche es später nochmal',

    'group:added' => 'Die Gruppe wurde erfolgreich angelegt',
    'group:add:fail' => 'Die Gruppe kann nicht angelegt werden',

    'memebership:sent' => 'Die Anfrage wurde erfolgreich verschickt',
    'memebership:sent:fail' => 'Die Anfrage kann nicht verschickt werden',

    'group:updated' => 'Die Gruppe wurde erfolgreich aktualisiert',
    'group:update:fail' => 'Die Gruppe kann nicht aktualisiert werden',

    'group:name' => 'Gruppen-Name',
    'group:desc' => 'Gruppen Beschreibung',
    'privacy:group:public' => 'Jeder kann die Gruppe mit samt der Beiträge sehen, aber nur Mitglieder können auch Beiträge posten',
    'privacy:group:close' => 'Man kann nur die Gruppe - nicht aber die Beiträge sehen. Nur Mitglieder können Beiträge posten',

    'group:memb:remove' => 'Entfernen',
    'leave:group' => 'Die Gruppe verlassen',
    'join:group' => 'Der Gruppe beitreten',
    'total:members' => 'Mitgliederzahl',
    'group:members' => "Mitglieder (%s)",
    'view:all' => 'Alle ansehen',
    'member:requests' => 'Anfragen (%s)',
    'about:group' => 'Über diese Gruppe:',
    'cancel:membership' => 'Mitgliedschaft beenden',

    'no:requests' => 'Keine Anfragen',
    'approve' => 'Aufnehmen',
    'decline' => 'Ablehnen',
    'search:groups' => 'Gruppen',

    'close:group:notice' => 'Werde Mitglied dieser Gruppe, wenn Du Fotos und Kommentare posten möchtest.',
    'closed:group' => 'Geschlossene Gruppe',
    'group:admin' => 'Admin',

	'title:access:private:group' => 'Gruppen Beitrag',
	
	// Gruppen-Beitritts-Anfrage var1 = Benutzer, var2 = Gruppe
	'ossn:notifications:group:joinrequest' => '%s möchte %s beitreten',
	'ossn:group:by' => 'Von:',	
	
	'group:deleted' => 'Die Gruppe und der Inhalt der Gruppe wurde gelöscht.',
	'group:delete:fail' => 'Die Gruppe konnte nicht gelöscht werden.',	
);
ossn_register_languages('de', $de); 