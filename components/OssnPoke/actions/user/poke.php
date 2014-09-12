<?php
/**
 * OpenSocialWebsite
 *
 * @package   OpenSocialWebsite
 * @author    Open Social Website Core Team <info@opensocialwebsite.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensocialwebsite.com/licence 
 * @link      http://www.opensocialwebsite.com/licence
 */
$poke = new OssnPoke;
$user = input('user');
if($poke->addPoke(ossn_loggedin_user()->guid, $user)){
    ossn_trigger_message(ossn_print('user:poked'), 'success');
	redirect(REF);	
} else {
    ossn_trigger_message(ossn_print('user:poke:error'), 'error');
	redirect(REF);	   
}