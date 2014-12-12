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