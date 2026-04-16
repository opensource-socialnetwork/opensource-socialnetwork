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
$da = array(
    'groups' => 'Grupper',
    'add:group' => 'Tilføj gruppe',
    'requests' => 'Anmodninger',

    'members' => 'Medlemmer',
    'member:add:error' => 'Noget gik galt! Prøv venligst igen senere.',
    'member:added' => 'Anmodning om medlemskab godkendt!',

    'member:request:deleted' => 'Anmodning om medlemskab afvist!',
    'member:request:delete:fail' => 'Kan ikke afvise anmodning om medlemskab! Prøv venligst igen senere.',
    'membership:cancel:succes' => 'Anmodning om medlemskab annulleret!',
    'membership:cancel:fail' => 'Kan ikke annullere anmodning om medlemskab! Prøv venligst igen senere.',

    'group:added' => 'Gruppen er blevet oprettet!',
    'group:add:fail' => 'Kan ikke oprette gruppe! Prøv venligst igen senere.',

    'memebership:sent' => 'Anmodning er blevet sendt!',
    'memebership:sent:fail' => 'Kan ikke sende anmodning! Prøv venligst igen senere.',

    'group:updated' => 'Gruppen er blevet opdateret!',
    'group:update:fail' => 'Kan ikke opdatere gruppen! Prøv venligst igen senere.',

    'group:name' => 'Gruppenavn',
    'group:desc' => 'Gruppebeskrivelse',
    'privacy:group:public' => 'Alle kan se denne gruppe og dens opslag. Kun medlemmer kan slå op i denne gruppe.',
    'privacy:group:close' => 'Alle kan se denne gruppe. Kun medlemmer kan slå op og se opslag.',

    'group:memb:remove' => 'Fjern',
    'group:memb:make:owner' => 'Gør til gruppeejer',
    'group:memb:make:owner:confirm' => 'Bemærk! Denne handling vil gøre >> %s << til den nye ejer af gruppen, og du vil miste alle dine gruppe-administratorrettigheder. Er du sikker på, at du vil fortsætte?',
    'group:memb:make:owner:admin:confirm' => 'Bemærk! Denne handling vil gøre >> %s << til den nye ejer af gruppen, og den tidligere ejer vil miste alle sine gruppe-administratorrettigheder. Er du sikker på, at du vil fortsætte?',
	
    'leave:group' => 'Forlad gruppe',
    'join:group' => 'Bliv medlem',
    'total:members' => 'Antal medlemmer',
    'group:members' => "Medlemmer (%s)",
    'view:all' => 'Vis alle',
    'member:requests' => 'ANMODNINGER (%s)',
    'about:group' => 'Om gruppen',
    'cancel:membership' => 'Annuller medlemskab',

    'no:requests' => 'Ingen anmodninger',
    'approve' => 'Godkend',
    'decline' => 'Afvis',
    'search:groups' => 'Søg i grupper',

    'close:group:notice' => 'Bliv medlem af denne gruppe for at se opslag, billeder og kommentarer.',
    'closed:group' => 'Lukket gruppe',
    'group:admin' => 'Admin',
	
	'title:access:private:group' => 'Gruppeopslag',

	// #186 group join request message var1 = user, var2 = name of group
	'ossn:notifications:group:joinrequest' => '%s har anmodet om at blive medlem af %s',
	'ossn:group:by' => 'Af:',
	
	'group:deleted' => 'Gruppen og dens indhold er slettet',
	'group:delete:fail' => 'Gruppen kunne ikke slettes',

	'group:delete:cover' => 'Slet coverbillede',
	'group:delete:cover:error' => 'Der opstod en fejl under sletning af coverbilledet',
	'group:delete:cover:success' => 'Coverbilledet blev slettet korrekt',
	'group:my' => 'Mine grupper',
);
ossn_register_languages('da', $da);