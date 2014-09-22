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
$OssnLikes = new OssnLikes;
$anotation = input('annotation');
if($OssnLikes->UnLike($anotation, ossn_loggedin_user()->guid, 'annotation')){
   if(!ossn_is_xhr()){
    redirect(REF);	
   } else {
     header('Content-Type: application/json'); 	   
	 echo json_encode(array(
							'done' => 1,
							'button' => 'Like',
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
							'button' => 'Unlike',
							));    
       }
}

exit;