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
$file = new OssnFile;
$file->owner_guid = ossn_loggedin_user()->guid;
$file->type = 'user';
$file->subtype = 'profile:photo';
$file->setFile('userphoto');
$file->setPath('profile/photo/');
if($file->addFile()){
	$resize = $file->getFiles();
    if(isset($resize->{0}->value)){	
		$guid =  ossn_loggedin_user()->guid;
	    $datadir = ossn_get_userdata("user/{$guid}/{$resize->{0}->value}");	
		$file_name = str_replace('profile/photo/', '', $resize->{0}->value);
		$sizes = ossn_user_image_sizes();
		foreach($sizes as $size => $params){
		 $params = explode('x', $params);
		 $width = $params[1];
		 $height = $params[0];
		 $resized = ossn_resize_image($datadir, $width, $height, true);
		 file_put_contents(ossn_get_userdata("user/{$guid}/profile/photo/{$size}_{$file_name}"), $resized);
		}	
		
	}
echo 1;
} else {
	 echo 0;
} 