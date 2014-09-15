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