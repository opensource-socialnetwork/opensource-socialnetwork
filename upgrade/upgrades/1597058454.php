<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author	OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link	  https://www.opensource-socialnetwork.org/
 */

set_time_limit(0);
ossn_generate_server_config('apache');
ossn_version_upgrade($upgrade, '5.3');

$v53update	  = "ALTER TABLE `ossn_object` 
	CHANGE `subtype` `subtype` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;
	
ALTER TABLE `ossn_object` 
	CHANGE `type` `type` VARCHAR(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;

ALTER TABLE `ossn_entities` 
	CHANGE `type` `type` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;
	
ALTER TABLE `ossn_entities` 
	CHANGE `subtype` `subtype` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;
	
ALTER TABLE `ossn_annotations` 
	CHANGE `type` `type` VARCHAR(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;
	
ALTER TABLE `ossn_notifications` 
	CHANGE `type` `type` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;
	
ALTER TABLE `ossn_site_settings`
	CHANGE `name` `name` VARCHAR(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;
	
ALTER TABLE `ossn_users` 
	CHANGE `activation` `activation` VARCHAR(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;
	
ALTER TABLE `ossn_components` 
	CHANGE `com_id` `com_id` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;
	
ALTER TABLE `ossn_entities_metadata` 
	CHANGE `value` `value` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;

ALTER TABLE `ossn_likes` 
	CHANGE `type` `type` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;

ALTER TABLE `ossn_likes` 
	CHANGE `subtype` `subtype` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

ALTER TABLE `ossn_messages` 
	CHANGE `message` `message` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;
	
ALTER TABLE `ossn_messages` 
	CHANGE `viewed` `viewed` VARCHAR(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

ALTER TABLE `ossn_notifications` 
	CHANGE `viewed` `viewed` VARCHAR(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;
	
ALTER TABLE `ossn_object` 
	CHANGE `title` `title` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;

ALTER TABLE `ossn_object` 
	CHANGE `description` `description` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;
	
ALTER TABLE `ossn_relationships` 
	CHANGE `type` `type` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;
	
ALTER TABLE `ossn_site_settings` 
CHANGE `value` `value` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;

ALTER TABLE `ossn_users` 
	CHANGE `type` `type` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
	CHANGE `username` `username` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
	CHANGE `email` `email` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
	CHANGE `password` `password` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
	CHANGE `salt` `salt` VARCHAR(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
	CHANGE `first_name` `first_name` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
	CHANGE `last_name` `last_name` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;

ALTER TABLE `ossn_annotations`
	DROP INDEX `type`,
	ADD INDEX `type`(`type`);

ALTER TABLE `ossn_entities` 
	DROP INDEX `type`,
	ADD INDEX `type`(`type`),
	ADD KEY `eky_ts` (`type`,`subtype`),
	ADD KEY `eky_tso` (`type`,`subtype`,`owner_guid`);

	
ALTER TABLE `ossn_entities` 
	DROP INDEX `subtype`, 
	ADD INDEX `subtype`(`subtype`);

ALTER TABLE `ossn_likes` 
	DROP KEY `subtype`,
	ADD KEY `subtype`(`subtype`);
	
ALTER TABLE `ossn_messages` 
	ADD INDEX `message_to`(`message_to`),
	ADD INDEX `message_from`(`message_from`);

ALTER TABLE `ossn_notifications`
	DROP INDEX `type`,
	ADD INDEX `type`(`type`);

ALTER TABLE `ossn_object`
	DROP INDEX `type`,
	ADD INDEX `type`(`type`);

ALTER TABLE `ossn_object`
	DROP INDEX `subtype`,
	ADD INDEX `subtype`(`subtype`),
	ADD KEY `oky_ts` (`type`, `subtype`),
	ADD KEY `oky_tsg` (`type`,`subtype`,`guid`);

ALTER TABLE `ossn_relationships`
	DROP INDEX `type`,
	ADD INDEX `type`(`type`);

ALTER TABLE `ossn_annotations` 
	CHANGE `time_created` `time_created` INT NOT NULL;

ALTER TABLE `ossn_annotations` 
	CHANGE `id` `id` BIGINT NOT NULL AUTO_INCREMENT,
	CHANGE `owner_guid` `owner_guid` BIGINT NOT NULL,
	CHANGE `subject_guid` `subject_guid` BIGINT NOT NULL,
	CHANGE `time_created` `time_created` INT NOT NULL;
	
ALTER TABLE `ossn_components` 
	CHANGE `id` `id` BIGINT NOT NULL AUTO_INCREMENT,
	CHANGE `active` `active` INT NOT NULL;
	
ALTER TABLE `ossn_entities` 
	CHANGE `guid` `guid` BIGINT NOT NULL AUTO_INCREMENT,
	CHANGE `owner_guid` `owner_guid` BIGINT NOT NULL,
	CHANGE `time_created` `time_created` INT NOT NULL,
	CHANGE `time_updated` `time_updated` INT NULL DEFAULT NULL,
	CHANGE `permission` `permission` INT NOT NULL,
	CHANGE `active` `active` INT NOT NULL;
	
ALTER TABLE `ossn_entities_metadata` 
	CHANGE `id` `id` BIGINT NOT NULL AUTO_INCREMENT,
	CHANGE `guid` `guid` BIGINT NOT NULL;
	
ALTER TABLE `ossn_likes` 
	CHANGE `id` `id` BIGINT NOT NULL AUTO_INCREMENT,
	CHANGE `subject_id` `subject_id` BIGINT NOT NULL,
	CHANGE `guid` `guid` BIGINT NOT NULL;
	
ALTER TABLE `ossn_messages` 
	CHANGE `id` `id` BIGINT NOT NULL AUTO_INCREMENT,
	CHANGE `message_from` `message_from` BIGINT NOT NULL,
	CHANGE `message_to` `message_to` BIGINT NOT NULL,
	CHANGE `time` `time` INT NOT NULL;
	
ALTER TABLE `ossn_notifications` 
	CHANGE `guid` `guid` BIGINT NOT NULL AUTO_INCREMENT,
	CHANGE `poster_guid` `poster_guid` BIGINT NOT NULL,
	CHANGE `owner_guid` `owner_guid` BIGINT NOT NULL,
	CHANGE `subject_guid` `subject_guid` BIGINT NOT NULL,
	CHANGE `time_created` `time_created` INT NOT NULL,
	CHANGE `item_guid` `item_guid` BIGINT NOT NULL;
	
ALTER TABLE `ossn_object` 
	CHANGE `guid` `guid` BIGINT NOT NULL AUTO_INCREMENT,
	CHANGE `owner_guid` `owner_guid` BIGINT NOT NULL,
	CHANGE `time_created` `time_created` INT NOT NULL;
	
ALTER TABLE `ossn_relationships` 
	CHANGE `relation_id` `relation_id` BIGINT NOT NULL AUTO_INCREMENT,
	CHANGE `relation_from` `relation_from` BIGINT NOT NULL,
	CHANGE `relation_to` `relation_to` BIGINT NOT NULL,
	CHANGE `time` `time` INT NOT NULL;
	
ALTER TABLE `ossn_site_settings` CHANGE `setting_id` `setting_id` BIGINT NOT NULL AUTO_INCREMENT;
ALTER TABLE `ossn_users` 
	CHANGE `guid` `guid` BIGINT NOT NULL AUTO_INCREMENT,
	CHANGE `last_login` `last_login` INT NOT NULL,
	CHANGE `last_activity` `last_activity` INT NOT NULL,
	CHANGE `time_created` `time_created` INT NOT NULL;";
	
$script		 = preg_replace('/\-\-.*\n/', '', $v53update);
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
		'OssnMessageTyping',
		'OssnRealTimeComments',
		'OssnPostBackground',
);
$todelete = array(
		'MessageTyping',
		'RealTimeComments',
		'PostBackground',			  
);
$components = new OssnComponents;
$systemcoms = $components->getComponents();

foreach($new_components as $item) {
		if(!in_array($item, $systemcoms)) {
				$components->enable($item);
		}
}
foreach($todelete as $item) {
		if(in_array($item,  $systemcoms)){
				$components->delete($item);
		}
}
if(class_exists('OssnMessages')){
	$messages = new OssnMessages;
	$list     = $messages->searchMessages(array(
				'wheres' => array("m.id IS NOT NULL"),		
				'page_limit' => false,
	));
	if($list){
		foreach($list as $item){
				$item->data->is_deleted_from = false;
				$item->data->is_deleted_to   = false;
				$item->save();
		}
	}

}
//re-login as old database returns strings results so it might create issues.
$guid = ossn_loggedin_user()->guid;
OssnUser::setLogin(intval($guid));

$factory = new OssnFactory(array(
		'callback' => 'installation',
		'website' => ossn_site_url(),
		'email' => ossn_site_settings('owner_email'),
		'version' => '5.3'
));
$factory->connect;
