<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    Dieter <info@marohn.nl>
 * @copyright 2014-2018 OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$nl = array(
    'groups' => 'Groepen',
    'add:group' => 'Groep toevoegen',
    'requests' => 'verzoeken',

    'members' => 'Leden',
    'member:add:error' => 'Er ging iets fout! Probeer het later nog eens',
    'member:added' => 'Verzoek bevestigd!',

    'member:request:deleted' => 'Lidmaadschapsverzoek verwijderd!',
    'member:request:delete:fail' => 'Cannot decline membership request! Please try again later.',
    'membership:cancel:succes' => 'Lidmaadschapsverzoek geannuleerd!',
    'membership:cancel:fail' => 'Cannot cancel membership request! Probeer het later nog eens.',

    'group:added' => 'Groep succesvol aangemaakt!',
    'group:add:fail' => 'Groep kon niet worden gecreeerd',

    'memebership:sent' => 'Het Verzoek is verzonden!',
    'memebership:sent:fail' => 'Kon niet verstuurd worden. Probeer het later nog eens.',

    'group:updated' => 'De groep is geupdate!',
    'group:update:fail' => 'Groep kon niet worden geupdate! Probeer het later nog eens.',

    'group:name' => 'Groepnaam',
    'group:desc' => 'Groep omschrijving',
    'privacy:group:public' => 'Iedereen kan de groep en de posts er in zien. Alleen leden kunnen berichten plaatsen.',
    'privacy:group:close' => 'Iedereen kan de groep zien, Alleen leden zien de berichten er in en kunnen posten.',

    'group:memb:remove' => 'verwijderen',
    'leave:group' => 'Groep verlaten',
    'join:group' => 'Lid worden',
    'total:members' => 'Aantal leden',
    'group:members' => "Leden (%s)",
    'view:all' => 'Bekijk alles',
    'member:requests' => 'VERZOEKEN (%s)',
    'about:group' => 'Over Groep',
    'cancel:membership' => 'lidmaatschap opzeggen',

    'no:requests' => 'Geen verzoeken',
    'approve' => 'Bevestigen',
    'decline' => 'Weigeren',
    'search:groups' => 'Groepen zoeken',

    'close:group:notice' => 'Word lid van de groep om de berichten en foto`s te kunnen bekijken.',
    'closed:group' => 'Gesloten Groep',
    'group:admin' => 'Beheer',
	
	'title:access:private:group' => 'Groep post',

	// #186 group join request message var1 = user, var2 = name of group
	'ossn:notifications:group:joinrequest' => '%s Wil lid worden %s',
	'ossn:group:by' => 'Door:',
	
	'group:deleted' => 'Groep en inhoud verwijderen',
	'group:delete:fail' => 'Groep kon niet worden verwijderd',	

	'group:delete:cover' => 'Coverafbeelding verwijderen',
	'group:delete:cover:error' => 'Er is een fout opgetreden bij het verwijderen van de coverafbeelding',
	'group:delete:cover:success' => 'De coverafbeelding is met succes verwijderd',
	
	//need translation
    'group:memb:make:owner' => 'Make group owner',
    'group:memb:make:owner:confirm' => 'Attention! This action will make >> %s << the new owner of the group and you will lose all of your group admin privileges. Are you sure to proceed?',
    'group:memb:make:owner:admin:confirm' => 'Attention! This action will make >> %s << the new owner of the group and the former owner will lose all of his group admin privileges. Are you sure to proceed?',		
);
ossn_register_languages('nl', $nl); 
