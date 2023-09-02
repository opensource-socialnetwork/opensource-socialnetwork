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
$hu = array(
    'groups' => 'Csoport',
    'add:group' => 'Csoport hozzáadása',
    'requests' => 'Kérések',

    'members' => 'Tagok',
    'member:add:error' => 'Valami elromlott! Kérlek, próbáld újra később.',
    'member:added' => 'A tagfelvételi kérelem jóváhagyva!',

    'member:request:deleted' => 'A tagsági kérelem elutasítva!',
    'member:request:delete:fail' => 'A tagsági kérelmet nem lehet elutasítani! Kérlek, próbáld újra később.',
    'membership:cancel:succes' => 'A tagsági kérelem visszavonva!',
    'membership:cancel:fail' => 'A tagsági kérelmet nem lehet törölni! Kérlek, próbáld újra később.',

    'group:added' => 'Sikeresen létrehozta a csoportot!',
    'group:add:fail' => 'Nem lehet csoportot létrehozni! Kérlek, próbáld újra később.',

    'memebership:sent' => 'A kérés sikeresen elküldve!',
    'memebership:sent:fail' => 'Kérést nem lehet elküldeni! Kérlek, próbáld újra később.',

    'group:updated' => 'A csoport frissítve lett!',
    'group:update:fail' => 'A csoport nem frissíthető! Kérlek, próbáld újra később.',

    'group:name' => 'Csoport név',
    'group:desc' => 'Csoport leírás',
    'privacy:group:public' => 'Mindenki láthatja ezt a csoportot és a hozzá tartozó bejegyzéseket. Csak a tagok írhatnak bejegyzéseket ebbe a csoportba.',
    'privacy:group:close' => 'Mindenki láthatja ezt a csoportot. Csak a tagok tehetnek közzé és láthatnak bejegyzéseket.',

    'group:memb:remove' => 'Eltávolít',
    'group:memb:make:owner' => 'Legyen csoport tulajdonos',
    'group:memb:make:owner:confirm' => 'Figyelem! Ezzel a művelettel >> %s << lesz a csoport új tulajdonosa, és elveszíti összes csoportadminisztrátori jogosultságát. Biztosan folytatod?',
    'group:memb:make:owner:admin:confirm' => 'Figyelem! Ezzel a művelettel >> %s << a csoport új tulajdonosa lesz, a korábbi tulajdonos pedig elveszíti összes csoportadminisztrátori jogosultságát. Biztosan folytatod?',
    'leave:group' => 'Kilépés a csoportból',
    'join:group' => 'Csatlakozni a csoporthoz',
    'total:members' => 'Összes tag',
    'group:members' => "Tagok (%s)",
    'view:all' => 'Összes megtekintése',
    'member:requests' => 'KÉRÉSEK (%s)',
    'about:group' => 'Csoport Névjegy',
    'cancel:membership' => 'Tagság megszüntetése',

    'no:requests' => 'Nincsenek kérések',
    'approve' => 'Jóváhagy',
    'decline' => 'Elutasítás',
    'search:groups' => 'Csoportok keresése',

    'close:group:notice' => 'Csatlakozz ehhez a csoporthoz a bejegyzések, fotók és megjegyzések megtekintéséhez.',
    'closed:group' => 'Zárt csoport',
    'group:admin' => 'Admin',
	
	'title:access:private:group' => 'Csoportos bejegyzés',

	// #186 group join request message var1 = user, var2 = name of group
	'ossn:notifications:group:joinrequest' => '%s csatlakozást kért %s',
	'ossn:group:by' => 'Által:',
	
	'group:deleted' => 'A csoport és a csoport tartalma törölve',
	'group:delete:fail' => 'A csoportot nem sikerült törölni',

	'group:delete:cover' => 'Borító törlése',
	'group:delete:cover:error' => 'Hiba történt a borítókép törlése közben',
	'group:delete:cover:success' => 'A borítókép sikeresen törölve',

);
ossn_register_languages('hu', $hu); 
