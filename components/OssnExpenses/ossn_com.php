<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
define('OssnExpenses', ossn_route()->com . 'OssnExpenses/');
ossn_register_class(array(
		'OssnExpenses' => OssnExpenses . 'classes/OssnExpenses.php',
));
function em_sved($value) {
		return $value;
}
function expense_management_init() {
		ossn_extend_view('css/ossn.default', 'expensemanagement/css');
		ossn_extend_view('js/opensource.socialnetwork', 'expensemanagement/js');
		if(ossn_isLoggedin()) {
				ossn_register_action('expense/management/add', OssnExpenses . 'actions/add.php');
				ossn_register_action('expense/management/delete', OssnExpenses . 'actions/delete.php');
				ossn_register_page('expensemanagement', 'expensemanagement_page_handler');
				ossn_register_menu_item('newsfeed', array(
						'name' => 'expensemanagement',
						'text' => ossn_print('em:dashboard'),
						'href' => ossn_site_url('expensemanagement/dashboard'),
				));
				ossn_register_menu_item('newsfeed', array(
						'name'   => 'expensemanagement_currentmonth',
						'text'   => ossn_print('em:currentmonth'),
						'href'   => ossn_site_url('expensemanagement/view/' . date('m') . '/' . date('Y')),
						'parent' => 'expensemanagement',
				));
		}
}
function expense_get_item($guid) {
		$object = ossn_get_object($guid);
		if($object && $object->subtype == 'expense:item') {
				return arrayObject((array) $object, 'OssnExpenses');
		}
		return false;
}
function expensemanagement_page_handler($pages) {
		switch ($pages[0]) {
		case 'dashboard':
				$title   = ossn_print('em:dashboard');
				$content = ossn_set_page_layout('newsfeed', array(
						'content' => ossn_plugin_view('expensemanagement/pages/dashboard'),
				));
				echo ossn_view_page($title, $content);
				break;
		case 'view':
				$month = $pages[1];
				$year  = $pages[2];

				if($year > date('Y') || ($year == date('Y') && $month > date('m'))) {
						ossn_trigger_message(ossn_print('em:feature:sheets'), 'error');
						redirect(REF);
				}
				$title = ossn_print('em:add', array(
						$month,
						$year,
				));
				$content = ossn_set_page_layout('contents', array(
						'content' => ossn_plugin_view('expensemanagement/pages/add', array(
								'month' => $month,
								'year'  => $year,
						)),
				));
				echo ossn_view_page($title, $content);
				break;
		case 'print':
				$month = $pages[1];
				$year  = $pages[2];

				if($year > date('Y') || ($year == date('Y') && $month > date('m'))) {
						ossn_trigger_message(ossn_print('em:feature:sheets'), 'error');
						redirect(REF);
				}

				$title = ossn_print('em:print', array(
						$month,
						$year,
				));
				$content = ossn_set_page_layout('expensemanagement', array(
						'content' => ossn_plugin_view('expensemanagement/pages/print', array(
								'month' => $month,
								'year'  => $year,
						)),
				));
				echo ossn_view_page($title, $content, 'expensemanagement');
				break;
		}
}
ossn_register_callback('ossn', 'init', 'expense_management_init');