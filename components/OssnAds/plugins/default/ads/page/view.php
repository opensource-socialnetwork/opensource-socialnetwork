<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$ads = new OssnAds;
$ads = $ads->getAds();
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
       