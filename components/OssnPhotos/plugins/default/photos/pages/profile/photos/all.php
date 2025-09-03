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

$albums = new OssnPhotos();
$photos = $albums->GetUserProfilePhotos($params['user']->guid);
$count = $albums->GetUserProfilePhotos($params['user']->guid, ['count' => true]);
echo '<div class="ossn-photos">';
echo '<h2>' . ossn_print('profile:photos') . '</h2>';
if ($photos) {
    foreach ($photos as $photo) {
        $image = $photo->getURL().'?size=larger&type=1';
		//[B] img js ossn_cache cause duplicate requests #1886
		$image = ossn_add_cache_to_url($image);		
        $view_url = ossn_site_url() . 'photos/user/view/' . $photo->guid;
        echo "<li><a href='{$view_url}'><img src='{$image}'  class='pthumb'/></a></li>";
    }
}
echo '</div>';
echo ossn_view_pagination($count, 10, array(
			'offset_name' => 'poffset',											
));
