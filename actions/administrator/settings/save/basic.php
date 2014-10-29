<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */
$settings = new OssnDatabase;

$sitename = input('sitename');
$owneremail = input('owneremail');
$sitelang = input('sitelang');
$errors = input('errors');

if (empty($sitename) || empty($owneremail) || empty($sitelang) || empty($errors)
) {
    redirect(REF);
}

ossn_site_setting_update('site_name', $sitename, 2);
ossn_site_setting_update('lang', $sitelang, 3);
ossn_site_setting_update('owner_email', $owneremail, 5);

//update errors settings
$update['table'] = 'ossn_site_settings';
$update['names'] = array('value');
$update['values'] = array($errors);
$update['wheres'] = array("name='display_errors'");
$settings->update($update);

ossn_trigger_message(ossn_print('settings:saved'), 'success', 'admin');
redirect(REF);