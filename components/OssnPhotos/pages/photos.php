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
echo '<div class="ossn-photos">';
$albums = new OssnAlbums;
$photos = $albums->GetAlbums($params['user']->guid);

if(is_object($photos)){
foreach($photos as $photo){
if(ossn_access_validate($photo->access, $photo->owner_guid)){
	$images = new OssnPhotos;
	$image = $images->GetPhotos($photo->guid);
	if(isset($image->{0}->value)){
	   $image = str_replace('album/photos/', '', $image->{0}->value);	
	   $image = ossn_site_url()."album/getphoto/{$photo->guid}/{$image}?size=album";

	} else {
		$image = ossn_site_url().'components/OssnPhotos/images/nophoto-album.png';
	}
	
	$view_url = ossn_site_url().'album/view/'.$photo->guid;
   if(ossn_access_validate($photo->access, $photo->owner_guid)){
	echo "<li>
	<a href='{$view_url}'><img src='{$image}' />
	 <div class='ossn-album-name'>{$photo->title}</div></a>
	</li>";	
	}
}
} 
} else {
  echo '<h3>'.ossn_print('no:photos').'</h3>';	
}
?>
</div>