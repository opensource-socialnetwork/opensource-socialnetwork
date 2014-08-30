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
$OssnComment = new OssnComments;
if($OssnComment->PostComment(input('post'),  ossn_loggedin_user()->guid, input('comment'))){
  $data['comment']['id'] = $OssnComment->getCommentId();
  $data['comment']['owner_guid'] = ossn_loggedin_user()->guid;
  $data['comment']['value'] = input('comment');
  $data['comment']['time_created'] = time();
  echo ossn_view('components/OssnComments/templates/comment', $data);
  if(!ossn_is_xhr()){
    redirect(REF);	
  }
}