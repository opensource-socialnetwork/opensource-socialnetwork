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

$com = input('component');
$delete = new OssnComponents;
if ($delete->deletecom($com)) {
    ossn_trigger_message(ossn_print('com:deleted'), 'success', 'admin');
    redirect(REF);
} else {
    ossn_trigger_message(ossn_print('con:delete:error'), 'error', 'admin');
    redirect(REF);
}