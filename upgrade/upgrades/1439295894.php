<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
 
//This upgrade might timeout, so set no time limit 
set_time_limit(0);

//Please see: Things , should be provided in 3.x #421
$database = new OssnDatabase;

//delete a notification that have incorrect owner_guid
//1.) Remove old like:post:group:wall notification type
//2.) Remove old comments:post:group:wall type

$vars['from']   = 'ossn_notifications';
$vars['wheres'] = array(
		"type = 'like:post:group:wall' OR type='comments:post:group:wall'"
);
$database->delete($vars);

//add new column to users table
//3.) Add time_created to ossn_users table
$database->statement("ALTER TABLE `ossn_users` ADD `time_created` INT(11) NOT NULL AFTER `activation`;");
$database->execute();

//ossn_object description text to longtext and title to text #459
//5.) ossn_object description text to longtext and title to text #459

$database->statement("ALTER TABLE `ossn_object` CHANGE `title` `title` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, 
					 CHANGE `description` `description` LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;");
$database->execute();

//add last_cache and site_version in settings

$database->statement("INSERT INTO `ossn_site_settings` (`name`) VALUES ('last_cache')");
$database->execute();

$database->statement("INSERT INTO `ossn_site_settings` (`name`) VALUES ('site_version')");
$database->execute();

//update user time_created cloumn from user entites
$users = ossn_get_entities(array(
		'type' => 'user',
		'subtype' => 'gender',
		'page_limit' => false,
));
if($users) {
		unset($vars);
		foreach($users as $user) {
				if(isset($user->owner_guid) && empty($user->owner_guid)) {
						continue;
				}
				$vars           = array();
				$vars['table']  = 'ossn_users';
				$vars['names']  = array(
						'time_created'
				);
				$vars['values'] = array(
						$user->time_created
				);
				$vars['wheres'] = array(
						"guid={$user->owner_guid}"
				);
				$database->update($vars);
		}
}
//regenerate .htaccess file
ossn_generate_server_config('apache');

/**
 * Update processed updates in database so user cannot upgrade again and again.
 *
 * can we make this script short? 
 */
$upgrade_json = array_merge(ossn_get_upgraded_files(), array(
		$upgrade
));
$upgrade_json = json_encode($upgrade_json);

$update           = array();
$update['table']  = 'ossn_site_settings';
$update['names']  = array(
		'value'
);
$update['values'] = array(
		$upgrade_json
);
$update['wheres'] = array(
		"name='upgrades'"
);

$upgrade = str_replace('.php', '', $upgrade);
if($database->update($update) && ossn_update_db_version('3.0')) {
		ossn_trigger_message(ossn_print('upgrade:success', array(
				$upgrade
		)), 'success');
} else {
		ossn_trigger_message(ossn_print('upgrade:failed', array(
				$upgrade
		)), 'error');
}
