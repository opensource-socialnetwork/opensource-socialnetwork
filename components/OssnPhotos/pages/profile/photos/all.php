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

$albums = new OssnAlbums;
$photos = $albums->GetUserProfilePhotos($params['user']->guid);
echo '<div class="ossn-photos">';
echo '<h2>'.ossn_print('profile:photos').'</h2>';
foreach($photos as $photo){
	$imagefile = str_replace('profile/photo/', '', $photo->value);
	$image = ossn_site_url()."album/getphoto/{$params['user']->guid}/{$imagefile}?size=larger&type=1";
	$view_url = ossn_site_url().'photos/user/view/'.$photo->guid;
	echo "<li><a href='{$view_url}'><img src='{$image}'  class='pthumb'/></a></li>";	
}
echo '</div>';
