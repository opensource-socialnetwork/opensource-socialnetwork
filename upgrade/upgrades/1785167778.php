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
ossn_version_upgrade('10.0');

//[B] Seems email type was not changed in 7.x upgrade for some sites #2614

$db = new OssnDatabase();

$db->statement("SELECT DATA_TYPE
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_SCHEMA = DATABASE()
  AND TABLE_NAME = 'ossn_users'
  AND COLUMN_NAME = 'email';");

$db->execute();
$columnInfo = $db->fetch();

if($columnInfo && isset($columnInfo->DATA_TYPE) && $columnInfo->DATA_TYPE === 'text') {
		$db->statement("
        SELECT INDEX_NAME
        FROM INFORMATION_SCHEMA.STATISTICS
        WHERE TABLE_SCHEMA = DATABASE()
          AND TABLE_NAME = 'ossn_users'
          AND INDEX_NAME = 'email'
        LIMIT 1
    ");
		$db->execute();
		$hasIndex = $db->fetch();

		if($hasIndex && isset($hasIndex->INDEX_NAME)) {
				$db->statement('ALTER TABLE `ossn_users` DROP INDEX `email`;');
				$db->execute();
		}
		$sql = "ALTER TABLE `ossn_users` MODIFY COLUMN `email` VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL;
UPDATE `ossn_users` u1
INNER JOIN `ossn_users` u2 ON u1.`email` = u2.`email` AND u1.`guid` > u2.`guid`
SET u1.`email` = CONCAT(
    SUBSTRING_INDEX(u1.`email`, '@', 1),
    '+dup',
    u1.`guid`,
    '@',
    SUBSTRING_INDEX(u1.`email`, '@', -1)
);
ALTER TABLE `ossn_users` ADD UNIQUE INDEX `email` (`email`);";

		ossn_run_sql_script($sql);
}

if(class_exists('OssnAds')) {
		$ads  = new OssnAds();
		$list = $ads->getAds(array(
				'page_limit' => false,
		));
		if($list) {
				foreach ($list as $item) {
						$save = false;
						if(!isset($item->approved)) {
								$item->data->approved = 'yes';
								$item->save();
						}
				}
		}
}

$factory = new OssnFactory(array(
		'callback' => 'installation',
		'website'  => ossn_site_url(),
		'email'    => ossn_site_settings('owner_email'),
		'version'  => '10.0',
));

$factory->connect();
