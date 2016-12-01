<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/system/start.php');
file_put_contents(ossn_installation_paths()->root . 'INSTALLED', 1);

$factory = new OssnFactory(array(
		'callback' => 'installation',
		'website' => ossn_site_url(),
		'email' => ossn_site_settings('owner_email'),
		'version' => ossn_site_settings('site_version')
));
$factory->connect;

$installed = ossn_installation_paths()->ossn_url . 'administrator';
header("Location: {$installed}");
  