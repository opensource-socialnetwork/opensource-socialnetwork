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

//update version once done
ossn_generate_server_config('apache');
ossn_version_upgrade('9.7');

if(class_exists('OssnAds')) {
		$ads  = new OssnAds();
		$list = $ads->getAds(array(
				'page_limit' => false,
		));

		if($list) {
				foreach ($list as $item) {
						$save = false;
						if(!isset($item->expired)) {
								$item->data->expired = false;
								$save                = true;
						}
						if(!isset($item->placement)) {
								$item->data->placement = json_encode(array(
										'newsfeed',
										'profile',
										'groups',
										'global',
								));
								$save = true;
						}
						if(!isset($item->gender_target)) {
								$item->data->gender_target = json_encode(array(
										'male',
										'female',
										'other',
								));
								$save = true;
						}
						if($save === true) {
								$item->save();
						}
				}
		}
}
$factory = new OssnFactory(array(
		'callback' => 'installation',
		'website'  => ossn_site_url(),
		'email'    => ossn_site_settings('owner_email'),
		'version'  => '9.7',
));
$factory->connect();
