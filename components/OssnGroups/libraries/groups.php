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
function ossn_get_group_by_guid($guid){
	$group = new OssnGroup;
	return $group->getGroup($guid);
}
function ossn_group_layout($contents){
  $content['content'] = $contents;	
  return ossn_view('components/OssnGroups/page/group', $content);
}

function ossn_get_user_groups($user){
  $groups = new OssnGroup;
  return $groups->getUserGroups($user->guid);
}

function ossn_group_subpage($page){
   global $VIEW;
   return $VIEW->pagePush[] = $page;
}
function ossn_is_group_subapge($page){
 global $VIEW;
 if(in_array($page, $VIEW->pagePush)){
	 return true; 
 }
return false; 
}
function ossn_group_url($group){
  return ossn_site_url("group/{$group}/");	
}