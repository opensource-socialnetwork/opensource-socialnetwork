<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Informatikon Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      http://www.informatikon.com/
 */
//Restrict calling start.php directly from browser #1315
if(!defined("OSSN_ALLOW_SYSTEM_START")){
	header("HTTP/1.0 404 Not Found");	
	exit;
}
global $Ossn;
if (!isset($Ossn)) {
    $Ossn = new stdClass;
}
include_once(dirname(dirname(__FILE__)) . '/libraries/ossn.lib.route.php');

if (!is_file(ossn_route()->configs . 'ossn.config.site.php') && !is_file(ossn_route()->configs . 'ossn.config.db.php')) {
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
    header("Location: installation");
	exit;
}
include_once(ossn_route()->configs . 'libraries.php');
include_once(ossn_route()->configs . 'classes.php');

include_once(ossn_route()->configs . 'ossn.config.site.php');
include_once(ossn_route()->configs . 'ossn.config.db.php');

//Load session start after classes #1318
session_start();
foreach ($Ossn->libraries as $lib) {
    if (!include_once(ossn_route()->libs . "ossn.lib.{$lib}.php")) {
        throw new exception('Cannot include all libraries');
    }
}
ossn_trigger_callback('ossn', 'init');
//need to update user last_action 
// @note why its here?
update_last_activity();
