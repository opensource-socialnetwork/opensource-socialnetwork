<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$Settings = new OssnInstallation;
$Settings->dbusername($_POST['dbuser']);
$Settings->dbpassword($_POST['dbpwd']);
$Settings->dbhost($_POST['dbhost']);
$Settings->dbname($_POST['dbname']);
$Settings->weburl($_POST['url']);
$Settings->datadir($_POST['datadir']);
$Settings->setStartupSettings(array(
    'owner_email' => $_POST['owner_email'],
    'notification_email' => $_POST['notification_email'],
    'sitename' => $_POST['sitename']
));
if(empty($_POST['owner_email']) || empty($_POST['notification_email']) || empty($_POST['sitename'])){
	    ossn_installation_message(ossn_installation_print('fields:require'), 'fail');
    	$failed = ossn_installation_paths()->url . '?page=settings';
		header("Location: {$failed}");	
		exit;
}
if ($Settings->INSTALL()) {
    $installed = ossn_installation_paths()->url . '?page=account';
    header("Location: {$installed}");
} else {
    ossn_installation_message($Settings->error_mesg, 'fail');
    $failed = ossn_installation_paths()->url . '?page=settings';
    header("Location: {$failed}");
}
