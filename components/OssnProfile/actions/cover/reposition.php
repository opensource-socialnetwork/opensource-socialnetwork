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
header('Content-Type: application/json'); 
$pos = new OssProfile;
if($pos->repositionCOVER(ossn_loggedin_user()->guid, input('top'), input('left'))){
$params = $pos->coverParameters(ossn_loggedin_user()->guid);
 echo json_encode(array(
				  'top' => $params[0],
				  'left' => $params[1]
				  ));
}
