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
$OssnComment = new OssnComments;
if($OssnComment->PostComment(input('entity'),  ossn_loggedin_user()->guid, input('comment'), 'entity')){
  $data['comment']['id'] = $OssnComment->getCommentId();
  $data['comment']['owner_guid'] = ossn_loggedin_user()->guid;
  $data['comment']['value'] = input('comment');
  $data['comment']['time_created'] = time();
  echo ossn_view('components/OssnComments/templates/comment', $data);
  if(!ossn_is_xhr()){
    redirect(REF);	
  } else {
	echo 1;  
  }
} else {
   if(!ossn_is_xhr()){
    redirect(REF);	
   } else {
	echo 0;  
   }	
}