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

ossn_generate_server_config('apache');
ossn_version_upgrade($upgrade, '7.3');


$v73update = "ALTER TABLE `ossn_users` DROP INDEX `email`;
ALTER TABLE ossn_users ADD UNIQUE (email);
ALTER TABLE ossn_components ADD UNIQUE (com_id);";

$script         = preg_replace('/\-\-.*\n/', '', $v73update);
$sql_statements = preg_split('/;[\n\r]+/', $script);

foreach($sql_statements as $statement) {
		$database  = new OssnDatabase();
		$statement = trim($statement);
		if(!empty($statement)) {
				try {
						$database->statement($statement);
						$database->execute();
				} catch (Exception $e) {
						$errors[] = $e->getMessage();
				}
		}
}


$factory = new OssnFactory(array(
		'callback' => 'installation',
		'website'  => ossn_site_url(),
		'email'    => ossn_site_settings('owner_email'),
		'version'  => '7.3',
));
$factory->connect();
