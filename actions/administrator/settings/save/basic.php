<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$settings = new OssnDatabase;

$sitename = input('sitename');
$owneremail = input('owneremail');
$sitelang = input('sitelang');
$notification_email = input('notification_email');

$errors = input('errors');

if (empty($sitename) || empty($owneremail) || empty($sitelang) || empty($errors)
) {
    redirect(REF);
}

ossn_site_setting_update('site_name', $sitename, 2);
ossn_site_setting_update('lang', $sitelang, 3);
ossn_site_setting_update('owner_email', $owneremail, 5);
ossn_site_setting_update('notification_email', $notification_email, 6);

//update errors settings
$update['table'] = 'ossn_site_settings';
$update['names'] = array('value');
$update['values'] = array($errors);
$update['wheres'] = array("name='display_errors'");
$settings->update($update);

ossn_trigger_message(ossn_print('settings:saved'), 'success');
redirect(REF);
