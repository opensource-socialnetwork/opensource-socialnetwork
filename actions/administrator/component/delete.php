<?php
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$delete = new OssnComponents;
$com    = input('component');
$cache  = ossn_site_settings('cache');

if($delete->delete($com)) {
		ossn_trigger_message(ossn_print('com:deleted'), 'success');
		if($cache == false) {
				redirect(REF);
		} else {
				//redirect and flush cache
				$action = ossn_add_tokens_to_url("action/admin/cache/flush");
				redirect($action);
		}
} else {
		ossn_trigger_message(ossn_print('com:delete:error'), 'error');
		redirect(REF);
}
