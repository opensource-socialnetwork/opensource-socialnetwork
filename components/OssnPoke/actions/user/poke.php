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
$poke = new OssnPoke;
$user = input('user');
if($poke->addPoke(ossn_loggedin_user()->guid, $user)){
    ossn_trigger_message(ossn_print('user:poked'), 'success');
	redirect(REF);	
} else {
    ossn_trigger_message(ossn_print('user:poke:error'), 'error');
	redirect(REF);	   
}