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
ossn_version_upgrade($upgrade, '6.5');

//OssnLocation
$new_components = array(
		'OssnLocation',
);
$components = new OssnComponents();
$systemcoms = $components->getComponents();

foreach($new_components as $item) {
		if(!in_array($item, $systemcoms)) {
				$components->enable($item);
		}
}
//Wall upgrade for old versions.
$wall  = new OssnWall();
$posts = $wall->GetPosts(array(
		'page_limit' => false,
));
if($posts) {
		foreach($posts as $post) {
				$data         = json_decode($post->description, true);
				$data['post'] = strip_tags(html_entity_decode($data['post']));

				$post->description = json_encode($data, JSON_UNESCAPED_UNICODE);
				$post->save();
		}
}
$v65update = "UPDATE `ossn_users`  SET `last_name`  = SUBSTRING(last_name, 1, 30);
UPDATE `ossn_users`  SET `first_name` = SUBSTRING(first_name, 1, 30);
ALTER TABLE `ossn_users` CHANGE `first_name` `first_name` VARCHAR(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;
ALTER TABLE `ossn_users` CHANGE `last_name` `last_name` VARCHAR(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;";

$script         = preg_replace('/\-\-.*\n/', '', $v65update);
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
		'version'  => '6.5',
));
$factory->connect;