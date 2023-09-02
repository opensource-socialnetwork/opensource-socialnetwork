<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
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
