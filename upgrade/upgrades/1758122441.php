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

function v82update_json_validate_fallback($string) {
		if(!is_string($string)) {
				return false;
		}

		json_decode($string);
		return json_last_error() === JSON_ERROR_NONE;
}

$v82update = "ALTER TABLE ossn_users DROP INDEX index_username;
ALTER TABLE ossn_users ADD UNIQUE INDEX index_username (username);

CREATE INDEX idx_annotations_type_subject ON ossn_annotations (type, subject_guid);
CREATE INDEX idx_entities_type_owner ON ossn_entities (type, owner_guid);

ALTER TABLE ossn_components DROP INDEX index_com_id;
ALTER TABLE ossn_components ADD UNIQUE INDEX index_com_id (com_id);

ALTER TABLE ossn_users DROP INDEX email;
ALTER TABLE ossn_users ADD UNIQUE INDEX email (email);

ALTER TABLE ossn_site_settings ADD UNIQUE INDEX name (name);

ALTER TABLE ossn_messages ADD INDEX index_from_to (message_from, message_to);
ALTER TABLE ossn_messages ADD INDEX index_to_from (message_to, message_from);

ALTER TABLE ossn_relationships ADD INDEX idx_relation_forward (relation_from, relation_to, type);
ALTER TABLE ossn_relationships ADD INDEX idx_relation_reverse (relation_to, relation_from, type);
CREATE INDEX idx_to_type ON ossn_relationships (relation_to, type);
CREATE INDEX idx_from_type ON ossn_relationships (relation_from, type);

ALTER TABLE `ossn_entities` DROP INDEX `eky_tso`;
ALTER TABLE ossn_entities ADD INDEX idx_owner_type_subtype (owner_guid, type, subtype);
ALTER TABLE ossn_entities_metadata ADD INDEX idx_guid_value (guid, value(50));

ALTER TABLE `ossn_object` ADD `time_updated` INT NOT NULL AFTER `time_created`;
ALTER TABLE `ossn_annotations` ADD `time_updated` INT NOT NULL AFTER `time_created`;
ALTER TABLE `ossn_users` ADD `time_updated` INT NOT NULL AFTER `time_created`;

ALTER TABLE `ossn_object`ADD KEY `time_updated` (`time_updated`);
ALTER TABLE `ossn_annotations`ADD KEY `time_updated` (`time_updated`);
ALTER TABLE `ossn_users`ADD KEY `time_updated` (`time_updated`);";

ossn_run_sql_script($v82update);

if(com_is_active('OssnWall')) {
		$wall = new OssnWall();
		$all  = $wall->GetPosts(array(
				'page_limit' => false,
		));
		if($all) {
				foreach ($all as $item) {
						if(!v82update_json_validate_fallback($item->description)) {
								continue;
						}
						$data = json_decode($item->description);
						//text
						if($data) {
								//restore /r/n because input comes with /r/n new lines instead of actual lines
								//we simulate input()
								$text = ossn_input_escape($data->post);
								if($text == 'null:data') {
										$text = '';
								}
								$item->description = $text;
						}
						//location
						if(isset($data->location)) {
								$item->data->location = $data->location;
						}
						//friends
						if(isset($data->friend)) {
								$item->data->tag_friend_guids = $data->friend;
						}
						$item->save();
				}
		}
}

//update version once done
ossn_generate_server_config('apache');
ossn_version_upgrade('8.2');

$factory = new OssnFactory(array(
		'callback' => 'installation',
		'website'  => ossn_site_url(),
		'email'    => ossn_site_settings('owner_email'),
		'version'  => '8.2',
));
$factory->connect();