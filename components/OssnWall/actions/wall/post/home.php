<?php
/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.com/licence
 */

//init ossnwall
$OssnWall = new OssnWall;

//poster guid and owner guid is same as user is posting on home page on its own wall
$OssnWall->owner_guid = ossn_loggedin_user()->guid;
$OssnWall->poster_guid = ossn_loggedin_user()->guid;

//check if owner guid is zero then exit
if($OssnWall->owner_guid == 0 || $OssnWall->poster_guid == 0){
    ossn_trigger_message(ossn_print('post:create:error'), 'error');	
	redirect(REF);
}

//getting some inputs that are required for wall post
$post = input('post');
$friends = input('friends');
$location = input('location');
$privacy = input('privacy');

//validate wall privacy 
$privacy = ossn_access_id_str($privacy);
if(!empty($privacy)){
   $access = input('privacy');	
}
if($OssnWall->Post($post, $friends, $location, $access)){
    //no need to show message on success
    //ossn_trigger_message(ossn_print('post:created'), 'success');	
    redirect(REF);
} else {
	ossn_trigger_message(ossn_print('post:create:error'), 'error');	
	redirect(REF);
}