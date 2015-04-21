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

$enable = new OssnComponents;
$com = input('com');
if ($enable->DISABLE($com)) {
    ossn_trigger_message(ossn_print('com:disabled'), 'error');
    redirect(REF);
}