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
set_time_limit(0);


$v86update = "UPDATE ossn_annotations SET time_updated = time_created WHERE time_updated = 0;
UPDATE ossn_users SET time_updated = time_created WHERE time_updated = 0;
UPDATE ossn_object SET time_updated = time_created WHERE time_updated = 0;";

ossn_run_sql_script($v86update);


//update version once done
ossn_generate_server_config('apache');
ossn_version_upgrade('8.6');

$factory = new OssnFactory(array(
		'callback' => 'installation',
		'website'  => ossn_site_url(),
		'email'    => ossn_site_settings('owner_email'),
		'version'  => '8.6',
));
$factory->connect();