<?php
/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$settings = input('settings');
if (empty($settings)) {
    $settings = 'list';
}
switch ($settings) {
    case 'list':
        echo ossn_plugin_view('ads/pages/list');
        break;
    case 'add':
        echo ossn_plugin_view('ads/pages/add');
        break;
    case 'edit':
	    $id = input('id');
		if(!empty($id)){
			$ads = new OssnAds;
			$params['entity'] = $ads->getAd($id);
            echo ossn_plugin_view('ads/pages/edit', $params);
		}
        break;	
	//missing 'view' case - 'Browse' didn't work #233
    case 'view':
	    $id = input('id');
		if(!empty($id)){
			$ads = new OssnAds;
			$params['entity'] = $ads->getAd($id);
            echo ossn_plugin_view('ads/pages/view', $params);
		}
        break;			
    default:
        break;

}
?>
