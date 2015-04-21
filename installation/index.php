<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
global $OssnInstall;
if (!isset($OssnInstall)) {
    $OssnInstall = new stdClass;
}
session_start();

if (is_file('DISPLAY_ERRORS')) {
    error_reporting(E_NOTICE ^ ~E_WARNING);
} else {
    ini_set('display_errors', 'off');
}
if (is_file('INSTALLED')) {
    exit('It seems the Open Source Social Network is already installed');
}
require_once(dirname(__FILE__) . '/libraries/ossn.install.php');
require_once(dirname(__FILE__) . '/classes/OssnInstall.php');
if (!isset($_REQUEST['action'])) {
    ossn_installation_page();
}
if (!isset($_REQUEST['page'])) {
    ossn_installation_actions();
}
  

