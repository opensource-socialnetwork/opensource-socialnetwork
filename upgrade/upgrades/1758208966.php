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

$entities = ossn_get_entities(array(
		'page_limit' => false,
		'subtype'    => 'time_updated',
		'wheres'     => array(
				"e.type IN ('object', 'user', 'annotation')",
		),
));
if($entities) {
		foreach ($entities as $entity) {
				$entity->deleteEntity();
		}
}

ossn_generate_server_config('apache');
ossn_version_upgrade('8.5');

$factory = new OssnFactory(array(
		'callback' => 'installation',
		'website'  => ossn_site_url(),
		'email'    => ossn_site_settings('owner_email'),
		'version'  => '8.5',
));
$factory->connect();