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
$OssnLikes = new OssnLikes;
$anotation = input('post');
$entity = input('entity');
if(!empty($anotation)){
	 $subject = $anotation;
	 $type = 'post';
}
if(!empty($entity)){
     $subject = $entity;	
	 $type = 'entity';

}
if($OssnLikes->Like($subject, ossn_loggedin_user()->guid, $type)){
   if(!ossn_is_xhr()){
    redirect(REF);	
   } else {
     header('Content-Type: application/json'); 	   
     echo json_encode(array(
							'done' => 1,
							'button' => 'Unike',
							));   
   } 
}
else {
      if(!ossn_is_xhr()){
	    redirect(REF);   
       } else {
	    header('Content-Type: application/json'); 	   
        echo json_encode(array(
							'done' => 0,
							'button' => 'Like',
							));    
       }
}
exit;