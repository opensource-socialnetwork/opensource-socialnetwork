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
ossn_version_upgrade('9.0');

$ossn_site_page_update_getpage_5x_8x = function ($page) {
		if(empty($page)) {
				return false;
		}
		$params = array(
				'type'    => 'site',
				'subtype' => "sitepage:{$page}",
		);
		$object   = new OssnObject();
		$sitepage = $object->searchObject($params);
		if($sitepage) {
				return $sitepage[0];
		}
		return false;
};
$pages = array(
		'about',
		'terms',
		'privacy',
);

foreach ($pages as $page) {
		$oldpage = $ossn_site_page_update_getpage_5x_8x($page);
		if($oldpage) {
				if(!empty($oldpage->description)) {
						$content = html_entity_decode(html_entity_decode($oldpage->description));
						ossn_set_input('__site_page_content__', $content);
						$content = input('__site_page_content__');

						$language      = ossn_site_settings('language'); //set language to default language
						$OssnSitePages = new OssnSitePages();
						$OssnSitePages->savePage($page, $content, $language);
				}
				$oldpage->deleteObject();
		}
}

$factory = new OssnFactory(array(
		'callback' => 'installation',
		'website'  => ossn_site_url(),
		'email'    => ossn_site_settings('owner_email'),
		'version'  => '9.0',
));
$factory->connect();