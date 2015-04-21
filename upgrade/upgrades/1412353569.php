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

$component = new OssnComponents;
$database = new OssnDatabase;
/**
 * Add OssnChat Component
 *
 * @access private
 */
$component->ENABLE('OssnChat');

/**
 * Update processed updates in database so user cannot upgrade again and again.
 *
 * @access private
 */

$upgrade_json = array_merge(ossn_get_upgraded_files(), array($upgrade));
$upgrade_json = json_encode($upgrade_json);

$update['table'] = 'ossn_site_settings';
$update['names'] = array('value');
$update['values'] = array($upgrade_json);
$update['wheres'] = array("name='upgrades'");

$upgrade = str_replace('.php', '', $upgrade);
if ($database->update($update)) {
    ossn_trigger_message(ossn_print('upgrade:success', array($upgrade)), 'success');
} else {
    ossn_trigger_message(ossn_print('upgrade:failed', array($upgrade)), 'error');
}