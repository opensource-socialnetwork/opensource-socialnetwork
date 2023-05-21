<?php
/**
 * Open Source Social Network
 *
 * @package   OSSN.CLI
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
/**
 * Check if OSSN is running from CLI
 *
 * Since php_sapi_name() not always return cli not at least running from cpanel based shell
 * We uses $_SERVER['argv'] to check the condtion as this is only set if php is running via cli
 *
 * @return boolean
 */
function ossn_is_from_cli() {
		//because 0th location is always the script name
		if(php_sapi_name() == 'cli' || (isset($argv) && isset($argv[0]) && !empty($argv[0]))) {
				return true;
		}
		return false;
}
/**
 * Output text via CLI
 *
 * @param string $text Output text
 *
 * @return void
 */
function ossn_cli_output($text, $type = 'default') {
		if(empty($text)) {
				return;
		}
		switch($type) {
			case 'default':
				echo $text . PHP_EOL;
				break;
			case 'success':
				echo "\033[32m{$text} \033[0m\n";
				break;
			case 'error':
				echo "\033[31m{$text} \033[0m\n";
				break;
			case 'warning':
				echo "\033[33m{$text} \033[0m\n";
				break;
		}
}
/**
 * Input
 * You neeed to specify all variables names
 *
 * @param array $names All names example, title, desc
 *
 * @return array
 */
function ossn_cli_input(array $names = array()) {
		if(empty($names)) {
				return false;
		}
		$args = array();
		foreach($names as $item) {
				array_push($args, $item . ':');
		}
		return getopt(null, $args);
}
/**
 * OSSN ClI handler
 *
 * @return void
 */
function ossn_cli_handler() {
		if(!ossn_is_from_cli()) {
				return false;
		}
		$required = array(
				'handler',
		);
		//ossn_cli_input for getting paramters
		//you need to use again ossn_cli_input in your callback for your customs args
		$args = ossn_cli_input($required);
		if(!$args || (isset($args) && empty($args['handler']))) {
				ossn_cli_output('Invalid handler supplied make sure you supplied --handler={name of handler}');
				exit();
		}
		$handler = $args['handler'];
		if(!ctype_alnum($handler)) {
				return false;
		}
		$args = array(
				'handler' => $handler,
		);
		//save time when cli is loaded last time
		$time     = time();
		$cli_temp = ossn_get_userdata('cli/');
		if(!is_dir($cli_temp)) {
				mkdir($cli_temp, 0755, true);
		}
		//overall loaded time
		file_put_contents($cli_temp . 'last_activty', $time);
		ossn_trigger_callback('cli', 'loaded', $args);
}
/**
 * Set a last acitivty for a specific handler
 *
 * @param string $handler Name of handler
 *
 * @return boolean|integer
 */
function ossn_cli_set_handler_last_activity($handler = false) {
		if(empty($handler) || !ctype_alnum($handler)) {
				return false;
		}
		$cli_temp_method = ossn_get_userdata("cli/{$handler}/");
		if(!is_dir($cli_temp_method)) {
				mkdir($cli_temp_method, 0755, true);
		}
		$time = time();
		return file_put_contents($cli_temp_method . 'last_activty', $time);
}
/**
 * Get last activity for CLI handler in seconds
 *
 * @param string $handler Name of handler
 *
 * @return boolean|integer
 */
function ossn_cli_handler_last_activity($handler = false) {
		if(empty($handler) || !ctype_alnum($handler)) {
				return false;
		}
		$cli_temp_method = ossn_get_userdata("cli/{$handler}/");
		if(!file_exists($cli_temp_method . 'last_activty')) {
				return false;
		}
		$current = time();
		$actual  = file_get_contents($cli_temp_method . 'last_activty');
		return intval($current) - intval($actual);
}
/**
 * Get last activity for CLI in seconds
 *
 * @return boolean|integer
 */
function ossn_cli_last_activity() {
		$current  = time();
		$cli_temp = ossn_get_userdata('cli/');
		if(!file_exists($cli_temp . 'last_activty')) {
				return false;
		}
		$actual = file_get_contents($cli_temp . 'last_activty');
		return intval($current) - intval($actual);
}
/****************************************************************
 * Usage Example
 *
 * function cli_init(){
 *    ossn_register_callback('cli', "loaded", 'cli');
 * }
 * function cli($cb, $type, $args){
 *		if($args['handler'] == 'abc'){
 *			echo ossn_dump(ossn_cli_input(array('guid', 'name')));
 *		}
 * }
 * ossn_register_callback('ossn', 'init', 'cli_init');
 ****************************************************************/
