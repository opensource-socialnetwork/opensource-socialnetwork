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

$db = new OssnDatabase;
$db->statement("ALTER TABLE `ossn_components` CHANGE `com_id` `com_id` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;");
$db->execute();

ossn_generate_server_config('apache');
ossn_version_upgrade($upgrade, '4.5');

$factory = new OssnFactory(array(
		'callback' => 'installation',
		'website' => ossn_site_url(),
		'email' => ossn_site_settings('owner_email'),
		'version' => '4.5'
));
$factory->connect;
