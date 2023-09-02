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
$add = new OssnAds;

$params['title'] = input('title');
$params['description'] = input('description');
$params['siteurl'] = input('siteurl');
foreach ($params as $field) {
    if (empty($field)) {
        ossn_trigger_message(ossn_print('fields:required'), 'error');
        redirect(REF);
    }
}

if ($add->addNewAd($params)) {
    ossn_trigger_message(ossn_print('ad:created'), 'success');
    redirect(REF);
} else {
    ossn_trigger_message(ossn_print('ad:create:fail'), 'error');
    redirect(REF);
}
