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

$OssnWall = new OssnWall;

$OssnWall->owner_guid = ossn_loggedin_user()->guid;
$OssnWall->poster_guid = ossn_loggedin_user()->guid;

$owner = input('wallowner');
if(isset($owner) && !empty($owner)){
 $OssnWall->owner_guid = $owner;	
}

$OssnWall->name = 'user'; 

$post = input('post');
$friends = input('friends');
$location = input('location');

if($OssnWall->Post($post, $friends, $location, OSSN_FRIENDS)){
    ossn_trigger_message(ossn_print('post:created'), 'success');	
	redirect(REF);
} else {
	ossn_trigger_message(ossn_print('post:create:error'), 'error');	
	redirect(REF);
}
