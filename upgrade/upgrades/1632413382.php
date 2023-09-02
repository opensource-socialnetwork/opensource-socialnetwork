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
ossn_generate_server_config('apache');
ossn_version_upgrade($upgrade, '6.0');

//Thanks to Benjamin Oldenburg https://github.com/ordisbold
$v60update	  = "ALTER TABLE ossn_users MODIFY username VARCHAR(50);
ALTER TABLE ossn_users MODIFY password VARCHAR(65);
ALTER TABLE ossn_users ADD INDEX index_username (username);

ALTER TABLE ossn_components ADD INDEX index_com_id (com_id);
ALTER TABLE ossn_components ADD INDEX index_active (active);

ALTER TABLE ossn_likes ADD INDEX index_subject_id_guid_type (subject_id,guid,type);
ALTER TABLE ossn_likes ADD INDEX index_subject_id_type (subject_id,type);";
	
$script		 = preg_replace('/\-\-.*\n/', '', $v60update);
$sql_statements = preg_split('/;[\n\r]+/', $script);

foreach($sql_statements as $statement) {
				$database  = new OssnDatabase;
				$statement = trim($statement);
				if(!empty($statement)) {
						try {
								$database->statement($statement);
								$database->execute();
						}
						catch(Exception $e) {
								$errors[] = $e->getMessage();
						}
				}
}
$new_components = array(
		'OssnGiphy',
);

$components = new OssnComponents;
$systemcoms = $components->getComponents();

foreach($new_components as $item) {
		if(!in_array($item, $systemcoms)) {
				$components->enable($item);
		}
}
$factory = new OssnFactory(array(
		'callback' => 'installation',
		'website' => ossn_site_url(),
		'email' => ossn_site_settings('owner_email'),
		'version' => '6.0'
));
$factory->connect;
