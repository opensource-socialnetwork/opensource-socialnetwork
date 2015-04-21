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
$theme = input('theme');
$delete = new OssnThemes;
if (strtolower($delete->getActive()) == strtolower($theme)) {
    ossn_trigger_message(ossn_print('theme:delete:active'), 'error');
    redirect(REF);
}
if ($delete->deletetheme($theme)) {
    ossn_trigger_message(ossn_print('theme:deleted'), 'success');
    redirect(REF);
} else {
    ossn_trigger_message(ossn_print('theme:delete:error'), 'error');
    redirect(REF);
}