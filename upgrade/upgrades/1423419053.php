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

$database = new OssnDatabase;
$Component = new OssnComponents;

/**
 * Fix typo in database table
 */
$database->statement("ALTER TABLE  `ossn_entities` 
					  CHANGE  `premission`  `permission` INT( 1 ) NOT NULL ;");	
$database->execute();

/**
 * Change component name size
 */
$database->statement("ALTER TABLE  `ossn_components` 
					  CHANGE  `com_id`  `com_id` TEXT CHARACTER SET utf8 
					  COLLATE utf8_general_ci NOT NULL ;");	
$database->execute();
/**
 * Add OssnEmbed and OssnInvite Component
 */
$Component->ENABLE('OssnEmbed');
$Component->ENABLE('OssnInvite');

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
