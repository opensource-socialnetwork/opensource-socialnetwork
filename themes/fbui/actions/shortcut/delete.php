<?php
/**
 * Open Source Social Network
 *
 * @package    Open Source Social Network
 * @author     OSSN Core Team <info@openteknik.com>
 * @copyright  (C) OPENTEKNIK LLC, COMMERCIAL LICENSE
 * @license    OPENTEKNIK LLC, COMMERCIAL LICENSE https://www.opensource-socialnetwork.org/licence
 */

$user = ossn_loggedin_user();
$type = input('type');
$guid = input('guid');

if(empty($type) || empty($guid)) {
		echo json_encode(array(
				'success' => false,
		));
		exit();
}

// Locate the user's shortcuts JSON file
$user_dir  = ossn_get_userdata("user/{$user->guid}/shortcuts");
$file_path = $user_dir . '/shortcuts.json';

if(file_exists($file_path)) {
		$json_data = file_get_contents($file_path);
		$shortcuts = json_decode($json_data, true);

		if(is_array($shortcuts)) {
				// Filter out the matching shortcut
				$shortcuts = array_filter($shortcuts, function ($item) use ($type, $guid) {
						return !($item['type'] === $type && (int) $item['guid'] === (int) $guid);
				});

				// Re-index array values and save back cleanly
				file_put_contents($file_path, json_encode(array_values($shortcuts), JSON_PRETTY_PRINT));
		}
}

echo json_encode(array(
		'success' => true,
));
exit();