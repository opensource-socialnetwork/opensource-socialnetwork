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
$save = new OssnSitePages;
$save->pagename = 'terms';
$save->pagebody = input('pagebody');
if($save->SaveSitePage()){
    ossn_trigger_message(ossn_print('page:saved'), 'success', 'admin');
	redirect(REF);	
} else {
    ossn_trigger_message(ossn_print('page:save:error'), 'error', 'admin');
	redirect(REF);	
}

