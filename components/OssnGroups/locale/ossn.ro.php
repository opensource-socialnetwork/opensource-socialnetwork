<?php
/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$ro = array(
    'groups' => 'Grupuri',
    'add:group' => 'Adauga un Grup',
    'requests' => 'Cereri',

    'members' => 'Membrii',
    'member:add:error' => 'Eroare! Incearca mai tarziu.',
    'member:added' => 'Cererea de membru a fost aprobata!',

    'member:request:deleted' => 'Nu puteti fi membru in acest grup!',
    'member:request:delete:fail' => 'Nu putem respinge cererea! Incearca mai tarziu.',
    'membership:cancel:succes' => 'Participarea la grup va este retrasa',
    'membership:cancel:fail' => 'Nu va putem retrage participarea la grup! Incearca mai tarziu.',

    'group:added' => 'Grupul a fost creat cu succes!',
    'group:add:fail' => 'Nu putem crea acest grup! Incearca mai tarziu.',

    'memebership:sent' => 'Cererea a fost trimisa!',
    'memebership:sent:fail' => 'Nu putem trimite cererea! Incearca mai tarziu.',

    'group:updated' => 'Grupul a fost actualizat!',
    'group:update:fail' => 'Grupul nu poate fii actualizat! Incearca mai tarziu.',

    'group:name' => 'Numele Grupului',
    'group:desc' => 'Descrierea Grupului',
    'privacy:group:public' => 'Grupul acesta poate fii vazut de toata lumea. Numai membrii pot posta in acest grup.',
    'privacy:group:close' => 'Toata lumea poate vedea acest grup. Numai membrii pot posta si vedea postarile.',

    'group:memb:remove' => 'Scoate din grup',
    'leave:group' => 'Paraseste Grupul',
    'join:group' => 'Adera la Grup',
    'total:members' => 'Totalul Membrilor',
    'group:members' => "Membrii (%s)",
    'view:all' => 'Vezi pe toti',
    'member:requests' => 'CERERI (%s)',
    'about:group' => 'Despre Grup',
    'cancel:membership' => ' Retrage participarea in grup',

    'no:requests' => 'Nu sant cereri',
    'approve' => 'Aproba',
    'decline' => 'Demite',
    'search:groups' => 'Cauta Grupuri',

    'close:group:notice' => 'Adera la acest Grup sa vezi postari,fotografii si comentarii.',
    'closed:group' => 'Grup inchis',
    'group:admin' => 'Administarator',
	
	'title:access:private:group' => 'Postare de Grup',

	// #186 group join request message var1 = user, var2 = name of group
	'ossn:notifications:group:joinrequest' => '%s a cerut sa adere la Grup %s',
	'ossn:group:by' => 'De:',
	
	'group:deleted' => 'Grupul si continutul a fost sters',
	'group:delete:fail' => 'Grupul nu a putut fii sters',	
);
ossn_register_languages('ro', $ro); 
