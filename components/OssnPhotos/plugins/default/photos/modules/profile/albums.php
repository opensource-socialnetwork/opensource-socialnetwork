<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
echo '<div class="ossn-profile-module-albums">';
$albums = new OssnAlbums;
$photos = $albums->GetAlbums($params['user']->guid);
if ($photos) {
    foreach ($photos as $photo) {
        $images = new OssnPhotos;
        $image = $images->GetPhotos($photo->guid);

        if (isset($image->{0}->value)) {
            $image = str_replace('album/photos/', '', $image->{0}->value);
            $image = ossn_site_url() . "album/getphoto/{$photo->guid}/{$image}?size=small";

        } else {
            $image = ossn_site_url() . 'components/OssnPhotos/images/nophoto-album.png';
        }

        $view_url = ossn_site_url() . 'album/view/' . $photo->guid;
        if (ossn_access_validate($photo->access, $photo->owner_guid)) {
            echo "<a href='{$view_url}'><img src='{$image}' /></a>";
        }
    }
} else {
    echo '<h3>' . ossn_print('no:albums') . '</h3>';
}
echo '</div>';