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
$photos = $albums->GetAlbum($params['album']);
echo '<div class="ossn-photos">';
echo '<h2>' . $photos->album->title . '</h2>';
if ($photos->photos) {
    foreach ($photos->photos as $photo) {
        $image = str_replace('album/photos/', '', $photo->value);
        $image = ossn_site_url() . "album/getphoto/{$params['album']}/{$image}?size=album";
        $view_url = ossn_site_url() . 'photos/view/' . $photo->guid;
        echo "<li><a href='{$view_url}'><img src='{$image}'  class='pthumb'/></a></li>";
    }
}
echo '</div>';
