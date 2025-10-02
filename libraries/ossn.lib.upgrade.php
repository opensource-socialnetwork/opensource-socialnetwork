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

/**
 * Disable Errors during upgrade
 *
 * @return void
 * @access private
 */
function ossn_upgrade_init() {
		ossn_add_hook('database', 'execution:message', 'ossn_disable_database_exception');
		ossn_register_callback('cli', 'loaded', 'ossn_upgrade_cli_handler');
}
/**
 * Handles the CLI upgrade process by authenticating the admin user and triggering the upgrade process.
 * [E] Allow upgrade process using CLI #2463
 *
 * Usage using CLI
 * /usr/bin/php system/handlers/cli --handler=upgrade --username=adminusername --password=adminpassword
 *
 * @return void
 */
function ossn_upgrade_cli_handler($cb, $type, $args) {
		if($args['handler'] == 'upgrade') {
				$vars = ossn_cli_input(array(
						'username',
						'password',
				));

				if(isset($vars['username']) && isset($vars['password'])) {
						$login           = new OssnUser();
						$login->username = $vars['username'];
						$login->password = $vars['password'];

						function cli_upgrade_ms_time() {
								$date = new DateTime();
								return $date->format('l jS \of F Y h:i:s.') . substr($date->format('u'), 0, 3);
						}

						if(!$login->Login()) {
								ossn_cli_output('Admin login details are invalid unable to login', 'error');
						} else {
								//convert video
								ossn_cli_output('Upgrade process has started at ' . cli_upgrade_ms_time(), 'warning');
								set_time_limit(0);
								ossn_trigger_upgrades();
								ossn_cli_output('Upgrade process completed at ' . cli_upgrade_ms_time(), 'success');
						}
				} else {
						ossn_cli_output('Please provide --username and --password for admin account!', 'error');
				}
		}
}
/**
 * Get upgrade files
 *
 * @return array
 * @access private
 */
function ossn_get_upgrade_files() {
		$path   = ossn_validate_filepath(ossn_route()->upgrade . 'upgrades/');
		$handle = opendir($path);
		if(!$handle) {
				return false;
		}

		$files = array();

		while ($file = readdir($handle)) {
				if($file != '.' && $file != '..') {
						$files[] = $file;
				}
		}

		sort($files);
		return $files;
}

/**
 * Get the list of files that already being upraded
 *
 * @return array
 * @access private
 */
function ossn_get_upgraded_files() {
		$settings = new OssnSite();
		$upgrades = $settings->getSettings('upgrades');
		$upgrades = json_decode($upgrades);
		if(!is_array($upgrades) || empty($upgrades)) {
				$upgrades = array();
		}
		return $upgrades;
}

/**
 * Get the files that need to be run for upgrade
 *
 * @return array
 * @access private
 */
function ossn_get_process_upgrade_files() {
		$upgrades           = ossn_get_upgraded_files();
		$available_upgrades = ossn_get_upgrade_files();
		return array_diff($available_upgrades, $upgrades);
}

/**
 * Trigger upgrade / Run upgrade
 * [E] Refactor ossn_version_upgrade #2478
 *
 * @return boolean
 */
function ossn_trigger_upgrades() {
		if(!ossn_isAdminLoggedin()) {
				ossn_kill_upgrading();
				ossn_error_page();
		}

		$continue = true;
		$upgrades = ossn_get_process_upgrade_files();

		if(!is_array($upgrades) || empty($upgrades)) {
				ossn_trigger_message(ossn_print('upgrade:not:available'), 'error');

				if(ossn_is_from_cli()) {
						ossn_cli_output(ossn_print('upgrade:not:available'), 'error');
						$continue = false;
				}
				ossn_kill_upgrading();

				//in cli mode it is exit()
				if(!ossn_is_from_cli()) {
						redirect('administrator');
				}
		}
		if($continue === false) {
				return false;
		}
		foreach ($upgrades as $upgrade) {
				$file = ossn_route()->upgrade . "upgrades/{$upgrade}";
				// Use the isolated include function
				ossn_include_upgrade_file($file);
				ossn_update_upgraded_files($upgrade);
		}
		/**
		 * Since the update wiki states that disable cache,  so this code never works
		 * https://www.opensource-socialnetwork.org/wiki/view/708/how-to-upgrade-ossn
		 *
		 * OSSN v4.2
		 */

		//need to reset cache files
		//if(ossn_site_settings('cache') !== 0) {
		//		ossn_trigger_css_cache();

		//		ossn_trigger_js_cache();
		//}

		return true;
}
/**
 * Safely includes an upgrade file in an isolated scope.
 *
 * @param string $file Full path to the upgrade file.
 * @return mixed The result of the included file, or throws an Exception on failure.
 * @throws Exception if the file doesn't exist.
 */
function ossn_include_upgrade_file($file) {
		if(!file_exists($file)) {
				throw new Exception(ossn_print('upgrade:file:load:error'));
		}

		// Include in isolated function scope
		include_once $file;

		$release = basename($file, '.php');
		$success = ossn_print('upgrade:success', array(
				$release,
		));
		ossn_trigger_message($success, 'success');

		if(ossn_is_from_cli()) {
				ossn_cli_output($success, 'success');
		}
}
/**
 * Get update status
 *
 * @return boolean
 */
function ossn_get_upgrade_status() {
		$upgrading = ossn_route()->www . '_upgrading_process';
		if(is_file($upgrading)) {
				return true;
		}
		return false;
}
/**
 * Disable exception during upgrade
 *
 * @return void|false
 */
function ossn_disable_database_exception() {
		if(ossn_get_upgrade_status()) {
				return false;
		}
}
/**
 * Kill upgrading
 *
 * @return boolean
 */
function ossn_kill_upgrading() {
		if(ossn_get_upgrade_status()) {
				$upgrading = ossn_route()->www . '_upgrading_process';
				unlink($upgrading);
		}
}
/**
 * Update site version
 *
 * @param string $version new Version
 *
 * @return boolean
 */
function ossn_update_db_version($version = '') {
		if(!empty($version)) {
				$db            = new OssnDatabase();
				$vars          = array();
				$vars['table'] = 'ossn_site_settings';
				$vars['names'] = array(
						'value',
				);
				$vars['values'] = array(
						$version,
				);
				$vars['wheres'] = array(
						"name='site_version'",
				);
				return $db->update($vars);
		}
}
/**
 * Update processed upgrades
 *
 * @param integer $upgrade New release
 *
 * @return boolean
 */
function ossn_update_upgraded_files($upgrade) {
		if(empty($upgrade)) {
				return false;
		}
		$database     = new OssnDatabase();
		$upgrade_json = array_merge(ossn_get_upgraded_files(), array(
				$upgrade,
		));
		$upgrade_json = json_encode($upgrade_json);

		$update          = array();
		$update['table'] = 'ossn_site_settings';
		$update['names'] = array(
				'value',
		);
		$update['values'] = array(
				$upgrade_json,
		);
		$update['wheres'] = array(
				"name='upgrades'",
		);

		if($database->update($update)) {
				return true;
		} else {
				return false;
		}
}
/**
 * Update version of Ossn
 * $upgrade param removed OSSN 8.7 as its done automatically
 *
 * @param string $version New version
 *
 * @return boolean
 */
function ossn_version_upgrade($version) {
		if(empty($version)) {
				return false;
		}
		if(!ossn_update_db_version($version)) {
				$error = ossn_print('upgrade:failed', array(
						$release,
				));
				ossn_trigger_message($error, 'error');

				if(ossn_is_from_cli()) {
						ossn_cli_output($error, 'error');
				}
		}
		return true;
}
//initilize upgrades
ossn_register_callback('ossn', 'init', 'ossn_upgrade_init', 1);