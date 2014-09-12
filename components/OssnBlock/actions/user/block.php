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
$block = new OssnBlock;
$user = input('user');
if($block->addBlock(ossn_loggedin_user()->guid, $user)){
    ossn_trigger_message(ossn_print('user:blocked'), 'success');
	redirect(REF);	
} else {
    ossn_trigger_message(ossn_print('user:block:error'), 'error');
	redirect(REF);	   
}