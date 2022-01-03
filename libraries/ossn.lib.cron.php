<?php
/**
 * Open Source Social Network
 *
 * @package   Ossn.CRON
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
/**
 * OSSN CRON handler
 *
 * @return boolean|void
 */
function ossn_cron_handler() {
		if(!ossn_is_from_cli()) {
				return false;
		}
		$time = time();
		//call it before setting it again!
		$last_activity = ossn_cron_last_activity();
		ossn_cron_set_last_activity($time);
		$args = array(
				'current_time'  => $time,
				'last_activity' => $last_activity,
		);
		ossn_trigger_callback('cron', 'loaded', $args);
}
/**
 * Set a last acitivty for a specific handler
 *
 * @param integer $time Timestamp
 *
 * @return boolean|integer
 */
function ossn_cron_set_last_activity($time = false) {
		if(empty($time)) {
				return false;
		}
		$cron_temp_method = ossn_get_userdata('cron/');
		if(!is_dir($cron_temp_method)) {
				mkdir($cron_temp_method, 0755, true);
		}
		return file_put_contents($cron_temp_method . 'last_activty', $time);
}
/**
 * Get last activity for CRON job in seconds
 *
 * @return boolean|integer
 */
function ossn_cron_last_activity() {
		$cron_temp_method = ossn_get_userdata('cron/');
		if(!file_exists($cron_temp_method . 'last_activty')) {
				return false;
		}
		$current = time();
		$actual  = file_get_contents($cron_temp_method . 'last_activty');
		return intval($current) - intval($actual);
}
/**
 * Set a last acitivty for a specific handler
 *
 * @param string $handler Name of handler
 *
 * @return boolean|integer
 */
function ossn_cron_set_handler_last_activity($handler = false) {
		if(empty($handler) || !ctype_alnum($handler)) {
				return false;
		}
		$cron_temp_method = ossn_get_userdata("cron/{$handler}/");
		if(!is_dir($cron_temp_method)) {
				mkdir($cron_temp_method, 0755, true);
		}
		$time = time();
		return file_put_contents($cron_temp_method . 'last_activty', $time);
}
/**
 * Get last activity for CRON handler in seconds
 *
 * @param string $handler Name of handler
 *
 * @return boolean|integer
 */
function ossn_cron_handler_last_activity($handler = false) {
		if(empty($handler) || !ctype_alnum($handler)) {
				return false;
		}
		$cron_temp_method = ossn_get_userdata("cron/{$handler}/");
		if(!file_exists($cron_temp_method . 'last_activty')) {
				return false;
		}
		$current = time();
		$actual  = file_get_contents($cron_temp_method . 'last_activty');
		return intval($current) - intval($actual);
}
/** 
Example usage
function cron_init(){
		ossn_register_callback('cron', "loaded", 'cron');	
}
function cron($cb, $type, $args){
			echo ossn_dump($args);
			ossn_cron_set_handler_last_activity('videos');
					 
			ossn_cli_output("Process started", 'success');
			ossn_cli_output("Process issue", 'warning');
					 /// your stuff here
			ossn_cli_output('Process error', "error");
}
ossn_register_callback('ossn', 'init', 'cron_init');
*/
