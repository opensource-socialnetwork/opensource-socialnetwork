<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$save = new OssnSitePages();
$page = input('page');
$desc = input('description');
$lang = input('language');

if(!in_array($page, ossn_site_pages_valid_pages_prefixes())) {
		ossn_trigger_message(ossn_print('page:save:error'), 'error');
		redirect(REF);
}

if($save->savePage($page, $desc, $lang)) {
		ossn_trigger_message(ossn_print('page:saved'), 'success');
		redirect(REF);
} else {
		ossn_trigger_message(ossn_print('page:save:error'), 'error');
		redirect(REF);
}