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
define('__OSSN_SITE_PAGES__', ossn_route()->com . 'OssnSitePages/');
require_once __OSSN_SITE_PAGES__ . 'classes/OssnSitePages.php';

/**
 * Function to initialize site pages
 *
 * This function is used to register various site pages, add CSS for the pages,
 * set up admin actions, and register footer menu links.
 * It is typically called during the OSSN initialization.
 */
function ossn_sitepages() {
		//css
		ossn_extend_view('css/ossn.default', 'css/pages');
		//register pages
		ossn_register_page('site', 'ossn_site_pages');
		//register admin panel page
		ossn_register_com_panel('OssnSitePages', 'settings');
		//actions
		if(ossn_isAdminLoggedin()) {
				ossn_register_action('sitepage/delete', __OSSN_SITE_PAGES__ . 'actions/delete.php');
				ossn_register_action('sitepage/edit', __OSSN_SITE_PAGES__ . 'actions/edit.php');
				ossn_register_action('sitepage/setting', __OSSN_SITE_PAGES__ . 'actions/setting.php');
		}
		//register menu links in footer
		$basic = array(
				'about',
				'terms',
				'privacy',
		);
		foreach ($basic as $type) {
				ossn_register_menu_item('footer', array(
						'name' => $type,
						'text' => ossn_print("site:{$type}"),
						'href' => ossn_site_url("site/{$type}"),
				));
		}
}

/**
 * Function to fetch fallback language for the site pages.
 *
 * This function checks the settings for the component and returns the fallback language
 * if defined, otherwise returns false. This is used when the content for a page is
 * unavailable in the current language.
 */
function ossn_site_pages_fallback_language() {
		$component = new OssnComponents();
		$settings  = $component->getSettings('OssnSitePages');
		if($settings && isset($settings->fallback_language) && !empty($settings->fallback_language)) {
				return $settings->fallback_language;
		}
		return false;
}

/**
 * Function to return valid prefixes for site pages.
 *
 * This function defines the valid page prefixes (like about, terms, privacy)
 * that can be used in the URL to fetch the respective pages.
 */
function ossn_site_pages_valid_pages_prefixes() {
		return ossn_call_hook('sitepages', 'prefixes', false, array(
				'about',
				'terms',
				'privacy',
		));
}

/**
 * Function to display the content for a site page based on its prefix.
 *
 * The page is fetched from the database based on the provided prefix and
 * language. If the page is not available in the requested language, it
 * falls back to the default language (if defined). The content is then
 * displayed using the appropriate layout.
 */
function ossn_site_pages($pages) {
		$page = $pages[0];

		// Redirect if no page is specified
		if(empty($page)) {
				redirect(REF);
		}

		$sitepages = new OssnSitePages();
		$language  = ossn_site_settings('language');

		// Supported pages
		$valid_pages = ossn_site_pages_valid_pages_prefixes();

		// Check if the requested page is valid
		if(!in_array($page, $valid_pages)) {
				ossn_error_page();
				return;
		}

		// Try to fetch the page in the selected language
		$page_data = $sitepages->getPrefix($page, $language);

		// Fallback to the default language if the page is not found
		if(!$page_data) {
				$default_language = ossn_site_pages_fallback_language();
				if($default_language) {
						$page_data = $sitepages->getPrefix($page, $default_language);
				}
		}

		// If no page data found, show error page
		if(!$page_data) {
				ossn_error_page();
				return;
		}

		// Set page content and title
		$params['contents'] = isset($page_data->description) ? html_entity_decode($page_data->description) : '';
		$params['title']    = ossn_print('site:' . $page);

		// Generate the content and display the page
		$contents = array(
				'content' => ossn_plugin_view('sitepages/view', $params),
		);
		$content = ossn_set_page_layout('contents', $contents);
		echo ossn_view_page($params['title'], $content);
}

ossn_register_callback('ossn', 'init', 'ossn_sitepages');