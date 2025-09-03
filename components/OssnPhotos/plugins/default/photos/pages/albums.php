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

$albums = new OssnAlbums;
$photos = $albums->GetAlbum($params['album']);
echo '<div class="ossn-photos">';
echo '<h2>' . $photos->album->title . '</h2>';
if ($photos->photos) {
    foreach ($photos->photos as $photo) {
        $image = $photo->getURL('album');
		//[B] img js ossn_cache cause duplicate requests #1886
		$image = ossn_add_cache_to_url($image);
        $view_url = ossn_site_url() . 'photos/view/' . $photo->guid;
        echo "<li><a href='{$view_url}'><img src='{$image}'  class='pthumb'/></a></li>";
    }
}
echo '</div>';
?>
<div class="ossn-photos-album-comments-likes margin-top-20">
<?php
$vars['object'] = ossn_get_album_object($params['album']);
$vars['full_view'] = true;
echo ossn_plugin_view('object/comment/like/share/view', $vars);
?>
</div>
<?php
echo ossn_plugin_view('photos/pages/gallery', array(
		'photos' => $photos->photos,													
));