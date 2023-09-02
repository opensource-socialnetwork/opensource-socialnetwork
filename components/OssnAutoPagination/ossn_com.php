<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Source Social Network Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
define('AutoPagination', ossn_route()->com . 'AutoPagination/');

function auto_pagination() {
		ossn_new_external_js('ossn.autopagination', ossn_add_cache_to_url('components/OssnAutoPagination/vendors/jquery.scrolling.js'));
		ossn_load_external_js('ossn.autopagination');
		ossn_load_external_js('ossn.autopagination', 'admin');
		
		ossn_extend_view('js/ossn.site', 'AutoPagination/js');
}
ossn_register_callback('ossn', 'init', 'auto_pagination');
