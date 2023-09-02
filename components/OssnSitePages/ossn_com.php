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
require_once(__OSSN_SITE_PAGES__ . 'classes/OssnSitePages.php');

function ossn_sitepages() {
    //css
    ossn_extend_view('css/ossn.default', 'css/pages');
    //register pages
    ossn_register_page('site', 'ossn_site_pages');
    //register admin panel page
    ossn_register_com_panel('OssnSitePages', 'settings');
    //actions
	if(ossn_isAdminLoggedin()){
		ossn_register_action('sitepage/edit/terms', __OSSN_SITE_PAGES__ . 'actions/edit/terms.php');
		ossn_register_action('sitepage/edit/about', __OSSN_SITE_PAGES__ . 'actions/edit/about.php');
		ossn_register_action('sitepage/edit/privacy', __OSSN_SITE_PAGES__ . 'actions/edit/privacy.php');
	}
    //register menu links in footer
    ossn_register_menu_link('about', ossn_print('site:about'), ossn_site_url('site/about'), 'footer');
    ossn_register_menu_link('site', ossn_print('site:terms'), ossn_site_url('site/terms'), 'footer');
    ossn_register_menu_link('privacy', ossn_print('site:privacy'), ossn_site_url('site/privacy'), 'footer');
}

function ossn_site_pages($pages) {
    $page = $pages[0];
    if (empty($page)) {
        redirect(REF);
    }
    $OssnSitePages = new OssnSitePages;
    switch ($page) {
        case 'about':
            $OssnSitePages->pagename = 'about';
            $OssnSitePages = $OssnSitePages->getPage();

            if (isset($OssnSitePages->description)) {
                $params['contents'] = html_entity_decode(html_entity_decode($OssnSitePages->description));
            }
            $params['title'] = ossn_print('site:about');
            $title = $params['title'];
            $contents = array('content' => ossn_view('components/OssnSitePages/pages/page', $params),);
            $content = ossn_set_page_layout('contents', $contents);
            echo ossn_view_page($title, $content);
            break;

        case 'terms':
            $OssnSitePages->pagename = 'terms';
            $OssnSitePages = $OssnSitePages->getPage();
            if (isset($OssnSitePages->description)) {
                $params['contents'] = html_entity_decode(html_entity_decode($OssnSitePages->description));
            }
            $params['title'] = ossn_print('site:terms');
            $title = $params['title'];
            $contents = array('content' => ossn_view('components/OssnSitePages/pages/page', $params),);
            $content = ossn_set_page_layout('contents', $contents);
            echo ossn_view_page($title, $content);
            break;

        case 'privacy':
            $OssnSitePages->pagename = 'privacy';
            $OssnSitePages = $OssnSitePages->getPage();

            if (isset($OssnSitePages->description)) {
                $params['contents'] = html_entity_decode(html_entity_decode($OssnSitePages->description));
            }
            $params['title'] = ossn_print('site:privacy');
            $title = $params['title'];
            $contents = array('content' => ossn_view('components/OssnSitePages/pages/page', $params),);
            $content = ossn_set_page_layout('contents', $contents);
            echo ossn_view_page($title, $content);
            break;
        default:
            ossn_error_page();
    }
}

ossn_register_callback('ossn', 'init', 'ossn_sitepages');
