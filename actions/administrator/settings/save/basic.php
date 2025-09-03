<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$settings = new OssnDatabase();

$sitename           = input('sitename');
$owneremail         = input('owneremail');
$sitelang           = input('sitelang');
$notification_email = input('notification_email');
$notification_name  = input('notification_name');
$copyrights         = input('copyrights');

$errors = input('errors');

if(empty($sitename) || empty($owneremail) || empty($sitelang) || empty($errors) || empty($notification_name) || empty($copyrights)) {
		redirect(REF);
}

$Site = new OssnSite();
$Site->setSetting('site_name', $sitename);
$Site->setSetting('language', $sitelang);
$Site->setSetting('owner_email', $owneremail);
$Site->setSetting('notification_email', $notification_email);
$Site->setSetting('display_errors', $errors);
$Site->setSetting('notification_name', $notification_name);
$Site->setSetting('copyrights', $copyrights);

ossn_trigger_message(ossn_print('settings:saved'), 'success');
redirect(REF);