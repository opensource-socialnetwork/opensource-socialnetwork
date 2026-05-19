<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$guid = input('guid'); 
$ad = ossn_get_ad($guid);
if($ad){
	$ad->incViews();	
}
if(!ossn_is_xhr()){
	redirect();	
} else {
	echo 1;	
}	
exit();