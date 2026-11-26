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

define('__OSSN_TODOS__', ossn_route()->com . 'OssnTodos/');
require_once __OSSN_TODOS__ . 'classes/OssnTodos.php';

/**
 * Initialize the OssnTodos component
 *
 * Registers component CSS/JS views, AJAX actions, newsfeed sidebar menu item,
 * page handler, and user deletion cleanup callback.
 *
 * @return void
 */
function ossn_todos_init() {
		ossn_extend_view('css/ossn.default', 'css/todos');
		ossn_extend_view('js/ossn.site', 'js/todos');

		if(ossn_isLoggedin()) {
				ossn_register_action('todos/add', __OSSN_TODOS__ . 'actions/add.php');
				ossn_register_action('todos/edit', __OSSN_TODOS__ . 'actions/edit.php');
				ossn_register_action('todos/toggle', __OSSN_TODOS__ . 'actions/toggle.php');
				ossn_register_action('todos/delete', __OSSN_TODOS__ . 'actions/delete.php');
				ossn_register_action('todos/delete_all', __OSSN_TODOS__ . 'actions/delete_all.php');

				ossn_register_sections_menu('newsfeed', array(
						'name'    => 'todos',
						'text'    => ossn_print('ossntodos:menu'),
						'url'     => ossn_site_url('todos'),
						'section' => 'links',
						'icon'    => true,
				));
		}

		ossn_register_page('todos', 'ossn_todos_page_handler');
		ossn_register_callback('user', 'delete', 'ossn_todos_user_delete');
}

/**
 * Delete all to-do tasks belonging to a user when their account is deleted
 *
 * @param string $callback Name of the callback ('user')
 * @param string $type     Callback event type ('delete')
 * @param array  $params   Callback parameters containing the deleted user entity
 *
 * @return void
 */
function ossn_todos_user_delete($callback, $type, $params) {
		if(!empty($params['entity']->guid)) {
				$todos = new OssnTodos();
				$todos->deleteAllTodos($params['entity']->guid);
		}
}

/**
 * Page handler for the /todos route
 *
 * Renders the user's personal to-do list workspace inside the contents page layout.
 *
 * @param array $pages URL segments passed to the page handler
 *
 * @return void
 */
function ossn_todos_page_handler($pages) {
		if(!ossn_isLoggedin()) {
				ossn_error_page();
		}
		$title    = ossn_print('ossntodos:title');
		$contents = array(
				'content' => ossn_plugin_view('todos/pages/todos'),
		);
		$content = ossn_set_page_layout('contents', $contents);
		echo ossn_view_page($title, $content);
}

ossn_register_callback('ossn', 'init', 'ossn_todos_init');