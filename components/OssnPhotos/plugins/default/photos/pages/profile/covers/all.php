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

$albums = new OssnAlbums;
$photos = $albums->GetUserCoverPhotos($params['user']->guid);
echo '<div class="ossn-photos">';
echo '<h2>' . ossn_print('profile:covers') . '</h2>';
if ($photos) {
    foreach ($photos as $photo) {
        $imagefile = str_replace('profile/cover/', '', $photo->value);
        $image = ossn_site_url() . "album/getcover/{$params['user']->guid}/{$imagefile}?type=1";
        $view_url = ossn_site_url() . 'photos/cover/view/' . $photo->guid;
        echo "<li><a href='{$view_url}'><img src='{$image}'  class='pthumb'/></a></li>";
    }
}
echo '</div>';
