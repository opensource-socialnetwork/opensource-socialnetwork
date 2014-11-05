<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$edit = new OssnAds;

$params['title'] = input('title');
$params['description'] = input('description');
$params['siteurl'] = input('siteurl');
$params['guid'] = input('entity');

foreach ($params as $field) {
    if (empty($field)) {
        ossn_trigger_message(ossn_print('fields:required'), 'error', 'admin');
        redirect(REF);
    }
}

if ($edit->EditAd($params)) {
    ossn_trigger_message(ossn_print('ad:edited'), 'success', 'admin');
    redirect(REF);
} else {
    ossn_trigger_message(ossn_print('ad:edit:fail'), 'error', 'admin');
    redirect(REF);
}
