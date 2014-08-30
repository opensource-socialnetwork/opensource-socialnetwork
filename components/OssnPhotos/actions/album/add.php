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
$add = new OssnAlbums;
if($add->CreateAlbum(ossn_loggedin_user()->guid, input('title'), input('privacy'))){
 redirect(REF);	
} else {
 redirect(REF);	
}