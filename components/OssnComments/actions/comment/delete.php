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
$comment = input('comment');
$delete = new OssnComments;
if($delete->GetComment($comment)->owner_guid == ossn_loggedin_user()->guid || ossn_isAdminLoggedin()){ 
if($delete->deleteComment($comment)){
   if(ossn_is_xhr()){
	  echo 1;   
   }
   else {
      ossn_trigger_message(ossn_print('comment:deleted'), 'success');	   
	  redirect(REF);   
   }
} else {
  if(ossn_is_xhr()){
	  echo 0;   
   }
   else {
      ossn_trigger_message(ossn_print('comment:delete:error'), 'error');	   
	  redirect(REF);   
   }
}
} else {
 if(ossn_is_xhr()){
	  echo 0;   
   }
   else {
      ossn_trigger_message(ossn_print('comment:delete:error'), 'error');	   
	  redirect(REF);   
   }	
}