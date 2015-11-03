<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
echo '<div class="ossn-photos">';
$albums = new OssnAlbums;
$photos = $albums->GetAlbums($params['user']->guid);

$albums->count = true;
$count = $albums->GetAlbums($params['user']->guid);
$profiel_photo = $params['user']->iconURL()->larger;
$pphotos_album = ossn_site_url("album/profile/{$params['user']->guid}");

$profile_covers_url = ossn_site_url("album/covers/profile/{$params['user']->guid}");
$profile_cover = ossn_site_url("cover/{$params['user']->username}/1");
//show profile pictures album
echo "<li>
	<a href='{$pphotos_album}'><img src='{$profiel_photo}' class='pthumb' />
	 <div class='ossn-album-name'>" . ossn_print('profile:photos') . "</div></a>
	</li>";
//show profile cover photos	
echo "<li>
	<a href='{$profile_covers_url}'><img src='{$profile_cover}' class='pthumb' />
	 <div class='ossn-album-name'>" . ossn_print('profile:covers') . "</div></a>
	</li>";	
if ($photos) {
    foreach ($photos as $photo) {
        if (ossn_access_validate($photo->access, $photo->owner_guid)) {
            $images = new OssnPhotos;
            $image = $images->GetPhotos($photo->guid);
            if (isset($image->{0}->value)) {
                $image = str_replace('album/photos/', '', $image->{0}->value);
                $image = ossn_site_url() . "album/getphoto/{$photo->guid}/{$image}?size=album";

            } else {
                $image = ossn_site_url() . 'components/OssnPhotos/images/nophoto-album.png';
            }

            $view_url = ossn_site_url() . 'album/view/' . $photo->guid;
            if (ossn_access_validate($photo->access, $photo->owner_guid)) {
                echo "<li>
	<a href='{$view_url}'><img src='{$image}' class='pthumb' />
	 <div class='ossn-album-name'>{$photo->title}</div></a>
	</li>";
            }
        }
    }
}
?>
</div>
<?php
echo ossn_view_pagination($count);