<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2016 SOFTLAB24 LIMITED
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
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
