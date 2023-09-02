<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
echo '<div class="ossn-photos">';
$albums = new OssnAlbums;
$profile = new OssnProfile;

$photos = $albums->GetAlbums($params['user']->guid);
$count = $albums->GetAlbums($params['user']->guid, array(
			'count' => true,														 
));
$offset 	   = input('offset');
$profiel_photo = $params['user']->iconURL()->larger;
$pphotos_album = ossn_site_url("album/profile/{$params['user']->guid}");

$profile_covers_url = ossn_site_url("album/covers/profile/{$params['user']->guid}");
$profile_cover = $profile->getCoverURL($params['user']);
if(!$offset || $offset == 1){
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
}
if ($photos) {
    foreach ($photos as $photo) {
        if (ossn_access_validate($photo->access, $photo->owner_guid)) {
            $images = new OssnPhotos;
            $image = $images->GetPhotos($photo->guid);
            if (isset($image->{0}->guid)) {
                $image = $image->{0}->getURL('album');

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