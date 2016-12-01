<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$albums = new OssnAlbums;
$photos = $albums->GetUserProfilePhotos($params['user']->guid);
echo '<div class="ossn-photos">';
echo '<h2>' . ossn_print('profile:photos') . '</h2>';
if ($photos) {
    foreach ($photos as $photo) {
        $imagefile = str_replace('profile/photo/', '', $photo->value);
        $image = ossn_site_url() . "album/getphoto/{$params['user']->guid}/{$imagefile}?size=larger&type=1";
        $view_url = ossn_site_url() . 'photos/user/view/' . $photo->guid;
        echo "<li><a href='{$view_url}'><img src='{$image}'  class='pthumb'/></a></li>";
    }
}
echo '</div>';
