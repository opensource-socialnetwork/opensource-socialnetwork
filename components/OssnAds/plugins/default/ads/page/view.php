<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$ads = new OssnAds;
$ads = $ads->getAds(
	array (
		'offset' => 1
	)
);
if ($ads) {
	echo '<div class="ossn-ads">';
        foreach ($ads as $ad) {
          	$items[] = ossn_plugin_view('ads/item', array(
			'item' => $ad, 
		 ));
        }
	echo ossn_plugin_view('widget/view', array(
			'title' => ossn_print('sponsored'),
			'contents' => implode('', $items),
	));	
	echo '</div>';
}
?>   
       
