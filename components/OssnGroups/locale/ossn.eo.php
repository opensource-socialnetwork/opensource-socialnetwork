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
$eo = array(
    'groups' => 'Grupoj',
    'add:group' => 'Aldoni grupon',
    'requests' => 'Petoj',

    'members' => 'Membroj',
    'member:add:error' => 'Io eraris! Bonvolu reprovi poste.',
    'member:added' => 'Enmembriĝa peto estas aprobita!',

    'member:request:deleted' => 'Enmembriĝa peto estas malaprobita!',
    'member:request:delete:fail' => 'Ne povas malaprobi enmembriĝan peton! Bonvolu reprovi poste.',
    'membership:cancel:succes' => 'Membreco estas forlasita!',
    'membership:cancel:fail' => 'Ne povas forlasi membrecon! Bonvolu reprovu poste.',

    'group:added' => 'Grupon estas sukcese kreita!',
    'group:add:fail' => 'Ne povas krei grupon! Bonvolu reprovi poste.',

    'memebership:sent' => 'Peto estas sukcese sendita!',
    'memebership:sent:fail' => 'Ne povas sendi peton! Bonvolu reprovi poste.',

    'group:updated' => 'Grupo estas ĝisdatigita!!',
    'group:update:fail' => 'Ne povas ĝisdatigi grupon! Bonvolu reprovi poste.',

    'group:name' => 'Grupa nomo',
    'group:desc' => 'Grupa priskribo',
    'privacy:group:public' => 'Ĉiuj povas vidi ĉi tiun grupon kaj ĝian afiŝojn. Nur membroj povas afiŝi.',
    'privacy:group:close' => 'Ĉiuj povas vidi ĉi tiun grupon. Nur membroj povas afiŝi kaj vidi afiŝojn.',

    'group:memb:remove' => 'Forigi',
    'leave:group' => 'Forlasi grupon',
    'join:group' => 'Membriĝi al grupo',
    'total:members' => 'Ĉiomaj membroj',
    'group:members' => "Membroj (%s)",
    'view:all' => 'Vidi ĉiujn',
    'member:requests' => 'PETOJ (%s)',
    'about:group' => 'Pri grupo',
    'cancel:membership' => 'Nuligi membrecon',

    'no:requests' => 'Neniuj petoj',
    'approve' => 'Aprobi',
    'decline' => 'Malaprobi',
    'search:groups' => 'Serĉi grupojn',

    'close:group:notice' => 'Membriĝu al ĉi tiu grupo por vidi la afiŝojn, fotojn kaj komentojn.',
    'closed:group' => 'Fermita grupo',
    'group:admin' => 'Administranto',
	
	'title:access:private:group' => 'Grupa afiŝo',

	// #186 group join request message var1 = user, var2 = name of group
	'ossn:notifications:group:joinrequest' => '%s petis membriĝi al %s',
	'ossn:group:by' => 'De:',
	
	'group:deleted' => 'Grupo kaj grupaj enhavoj estas forigita',
	'group:delete:fail' => 'Ne povas forigi grupon',	
	
	'group:memb:make:owner' => 'Fari grupan estron',
	'group:memb:make:owner:confirm' => 'Atentu! Per ĉi tiu ago >> %s << fariĝos la novan estron de la grupo kaj vi tute perdos viajn administrajn rajtojn. Ĉu vi vere volas daŭrigu?',
	'group:memb:make:owner:admin:confirm' => 'Atentu! Per ĉi tiu ago >> %s << fariĝos la novan estron de la grupo kaj la estinta estro tute perdos siajn administrajn rajtojn. Ĉu vi vere volas daŭrigu?',
	'group:delete:cover' => 'Forigi kovrilan bildon',
	'group:delete:cover:error' => 'Eraro okazis dum forigo de la kovrila bildo',
	'group:delete:cover:success' => 'La kovrila bildo estas sukcese forigita',	
);
ossn_register_languages('eo', $eo); 
