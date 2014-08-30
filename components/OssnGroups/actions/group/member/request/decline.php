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
$add = new OssnGroup;
$group = input('group');
$user = input('user');

if(ossn_get_group_by_guid($group)->owner_guid !== ossn_loggedin_user()->guid){
  ossn_trigger_message(ossn_print('member:add:error'), 'error');	  
  redirect(REF);	
}
if($add->deleteMember($user, $group)){
  ossn_trigger_message(ossn_print('member:request:deleted'), 'success');		
  redirect(REF);
} else {
  ossn_trigger_message(ossn_print('member:request:delete:fail'), 'error');		
  redirect(REF);
}