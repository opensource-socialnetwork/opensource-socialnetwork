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
 
$params['guid'] 		 = input('guid');
$params['title']         = input('title');
$params['description']   = input('description');
$params['siteurl']       = input('siteurl');
$params['gender_target'] = input('gender_target');
$params['placement']     = input('placement');

foreach ($params as $field) {
    if (empty($field)) {
        ossn_trigger_message(ossn_print('fields:required'), 'error');
        redirect(REF);
    }
}

$expiry_date = input('expiry_date');
if(!empty($expiry_date)) {
		$dateObject = DateTime::createFromFormat('Y-m-d H:i:s', $expiry_date . ' 23:59:59');
		// Verify the raw string parsed cleanly into a real calendar date object
		if($dateObject && $dateObject->format('Y-m-d H:i:s') === $expiry_date . ' 23:59:59') {
				$params['expiry_date'] = $dateObject->getTimestamp();
		}
}

$edit = new OssnAds();
if ($edit->editAd($params)) {
    ossn_trigger_message(ossn_print('ad:edited'), 'success');
    redirect(REF);
} else {
    ossn_trigger_message(ossn_print('ad:edit:fail'), 'error');
    redirect(REF);
}
