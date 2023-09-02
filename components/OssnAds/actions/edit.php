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
$edit = new OssnAds;

$params['title'] = input('title');
$params['description'] = input('description');
$params['siteurl'] = input('siteurl');
$params['guid'] = input('entity');

foreach ($params as $field) {
    if (empty($field)) {
        ossn_trigger_message(ossn_print('fields:required'), 'error');
        redirect(REF);
    }
}

if ($edit->EditAd($params)) {
    ossn_trigger_message(ossn_print('ad:edited'), 'success');
    redirect(REF);
} else {
    ossn_trigger_message(ossn_print('ad:edit:fail'), 'error');
    redirect(REF);
}
