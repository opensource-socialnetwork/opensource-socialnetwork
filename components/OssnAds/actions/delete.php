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
$delete = new OssnAds();
$guids  = input('guid');
foreach ($guids as $guid) {
		$ad = ossn_get_ad($guid);
		if(!$ad->deleteObject()) {
				ossn_trigger_message(ossn_print('ad:delete:fail'), 'error');
		} else {
				ossn_trigger_message(
						ossn_print('ad:deleted', array(
								$ad->title,
						)),
						'success'
				);
		}
}

redirect(REF);