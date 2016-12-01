<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
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
