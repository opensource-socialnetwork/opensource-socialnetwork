<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
//upgrade proccess 
$upgrading = dirname(dirname(__FILE__)). '/_upgrading_process';
file_put_contents($upgrading, 1);

define('OSSN_ALLOW_SYSTEM_START', TRUE);
require_once(dirname(dirname(__FILE__)) . '/system/start.php');
//redirect user after all upgrades
if(ossn_trigger_upgrades()){
	 ossn_kill_upgrading();
	 redirect('administrator');
}
