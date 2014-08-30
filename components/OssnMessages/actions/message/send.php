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
$send = new OssnMessages;
$message = input('message');
$to = input('to');
if($send->send(ossn_loggedin_user()->guid, $to, $message)){
   $user = ossn_user_by_guid(ossn_loggedin_user()->guid);
   $message = input('message'); 
   $params['user'] = $user;
   $params['message'] = $message;
   echo ossn_view('components/OssnMessages/templates/message-send', $params);
	
} else {
  echo 0;	
}