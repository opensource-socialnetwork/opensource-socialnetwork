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
 
$name = input('groupname');
$desc = input('groupdesc');
$memb = input('membership');

$group = ossn_get_group_by_guid(input('group'));
if($group->owner_guid !== ossn_loggedin_user()->guid){
     ossn_trigger_message(ossn_print('membership:cancel:succes'), 'success');	  		 
	 redirect(REF);  
}

$edit = new OssnGroup;
$access = array(OSSN_PUBLIC, OSSN_PRIVATE);

if(in_array($memb, $access)){
   $edit->data->membership = $memb;
}

if($edit->updateGroup($name, $desc, $group->guid)){
 ossn_trigger_message(ossn_print('group:updated'), 'success');	  		  
 redirect(REF);
} else {
 ossn_trigger_message(ossn_print('group:update:fail'), 'success');	  		  	
  redirect(REF);	
}