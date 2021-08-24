<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
define('OSSN_ALLOW_SYSTEM_START', TRUE);
require_once('system/start.php');
//page handler
$handler = input('h');
//page name
$page = input('p');

//check if there is no handler then load index page handler
if (empty($handler)) {
    $handler = 'index';
}
echo ossn_load_page($handler, $page);
