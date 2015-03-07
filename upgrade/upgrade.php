<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */
//upgrade proccess 
$upgrading = dirname(dirname(__FILE__)). '/_upgrading_process';
file_put_contents($upgrading, 1);

require_once(dirname(dirname(__FILE__)) . '/system/start.php');
//redirect user after all upgrades
if(ossn_trigger_upgrades()){
	 ossn_kill_upgrading();
	 redirect('administrator');
}
