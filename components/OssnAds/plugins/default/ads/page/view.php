<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

if(!isset($params['ads'])) {
		return;
}
$ads = $params['ads'];
if($ads) {
		echo '<div class="ossn-ads">';
		foreach ($ads as $ad) {
				$items[] = ossn_plugin_view('ads/item', array(
						'item' => $ad,
				));
		}
		echo ossn_plugin_view('widget/view', array(
				'title'    => ossn_print('sponsored'),
				'contents' => implode('', $items),
		));
		echo '</div>';
} elseif(ossn_isAdminLoggedin()) {
		echo ossn_plugin_view('widget/view', array(
				'title'    => ossn_print('sponsored'),
				'contents' => ossn_plugin_view('ads/admin_create_sidebar'),
		));
}