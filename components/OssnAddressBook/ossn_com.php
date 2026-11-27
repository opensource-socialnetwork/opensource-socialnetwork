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

define('__OSSN_ADDRESSBOOK__', ossn_route()->com . 'OssnAddressBook/');
require_once __OSSN_ADDRESSBOOK__ . 'classes/OssnAddressBook.php';

/**
 * Initialize the OssnAddressBook component
 *
 * Registers component CSS/JS views, AJAX actions, newsfeed sidebar menu item,
 * page handler, and user deletion cleanup callback.
 *
 * @return void
 */
function ossn_addressbook_init() {
		ossn_extend_view('css/ossn.default', 'css/addressbook');
		ossn_extend_view('js/ossn.site', 'js/addressbook');

		if(ossn_isLoggedin()) {
				ossn_register_action('addressbook/add', __OSSN_ADDRESSBOOK__ . 'actions/add.php');
				ossn_register_action('addressbook/edit', __OSSN_ADDRESSBOOK__ . 'actions/edit.php');
				ossn_register_action('addressbook/favorite', __OSSN_ADDRESSBOOK__ . 'actions/favorite.php');
				ossn_register_action('addressbook/delete', __OSSN_ADDRESSBOOK__ . 'actions/delete.php');
				ossn_register_action('addressbook/delete_all', __OSSN_ADDRESSBOOK__ . 'actions/delete_all.php');
				ossn_register_action('addressbook/export', __OSSN_ADDRESSBOOK__ . 'actions/export.php');
				ossn_register_action('addressbook/import', __OSSN_ADDRESSBOOK__ . 'actions/import.php');

				ossn_register_sections_menu('newsfeed', array(
						'name'    => 'addressbook',
						'text'    => ossn_print('ossnaddressbook:menu'),
						'url'     => ossn_site_url('addressbook'),
						'section' => 'links',
						'icon'    => true,
				));
				ossn_register_page('addressbook', 'ossn_addressbook_page_handler');
		}
		ossn_register_callback('user', 'delete', 'ossn_addressbook_user_delete');
}

/**
 * Delete all address book contacts belonging to a user when their account is deleted
 *
 * @param string $callback Name of the callback ('user')
 * @param string $type     Callback event type ('delete')
 * @param array  $params   Callback parameters containing the deleted user entity
 *
 * @return void
 */
function ossn_addressbook_user_delete($callback, $type, $params) {
		if(!empty($params['entity']->guid)) {
				$addressbook = new OssnAddressBook();
				$addressbook->deleteAllContacts($params['entity']->guid);
		}
}

/**
 * Page handler for the /addressbook route
 *
 * Renders the user's personal address book workspace inside the contents page layout.
 *
 * @param array $pages URL segments passed to the page handler
 *
 * @return void
 */
function ossn_addressbook_page_handler($pages) {
		if(!ossn_isLoggedin()) {
				ossn_error_page();
		}
		$title    = ossn_print('ossnaddressbook:title');
		$contents = array(
				'content' => ossn_plugin_view('addressbook/pages/addressbook'),
		);
		$content = ossn_set_page_layout('contents', $contents);
		echo ossn_view_page($title, $content);
}

ossn_register_callback('ossn', 'init', 'ossn_addressbook_init');
