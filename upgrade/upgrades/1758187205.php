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

$v84update = "ALTER TABLE `ossn_annotations` ENGINE=InnoDB;
ALTER TABLE `ossn_components` ENGINE=InnoDB;
ALTER TABLE `ossn_entities` ENGINE=InnoDB;
ALTER TABLE `ossn_entities_metadata` ENGINE=InnoDB;
ALTER TABLE `ossn_likes` ENGINE=InnoDB;
ALTER TABLE `ossn_messages` ENGINE=InnoDB;
ALTER TABLE `ossn_notifications` ENGINE=InnoDB;
ALTER TABLE `ossn_object` ENGINE=InnoDB;
ALTER TABLE `ossn_relationships` ENGINE=InnoDB;
ALTER TABLE `ossn_site_settings` ENGINE=InnoDB;
ALTER TABLE `ossn_users` ENGINE=InnoDB;";

ossn_run_sql_script($v84update);

//update version once sql is done
ossn_generate_server_config('apache');
ossn_version_upgrade('8.4');

$factory = new OssnFactory(array(
		'callback' => 'installation',
		'website'  => ossn_site_url(),
		'email'    => ossn_site_settings('owner_email'),
		'version'  => '8.4',
));
$factory->connect();