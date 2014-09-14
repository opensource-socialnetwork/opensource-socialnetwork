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
$anotation = input('annotation');
if($OssnLikes->Like($anotation, ossn_loggedin_user()->guid, 'annotation')){
  if(!ossn_is_xhr()){
	  redirect(REF);	
  } else {
	 echo 1;  
  }
}
else {
  if(!ossn_is_xhr()){
     redirect(REF);
  } else {
	 echo 0;  
  }
}
