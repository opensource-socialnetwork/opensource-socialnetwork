<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */


$database = new OssnDatabase;
/**
 * Check if the upgrades settings exist or not
 *
 * @access private
 */
$fetch['from'] = 'ossn_site_settings';
$fetch['wheres'] = array("name='upgrades'");
$upgrade_settings = $database->select($fetch);

/**
 * If settings didn't exist then create settings
 *
 * @access private
 */
if (empty($upgrade_settings->setting_id)) {
    $insert['into'] = 'ossn_site_settings';
    $insert['names'] = array(
        'name',
        'value'
    );
    $insert['values'] = array(
        'upgrades',
        ''
    );
    $database->insert($insert);
}

/**
 * Fixed the relationship table type from int to varchat
 *
 * @access private
 */
$database->statement("ALTER TABLE  `ossn_relationships`
                      CHANGE  `type`  `type` VARCHAR( 20 ) 
					  CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;");
$database->execute();

/**
 * Fix character settings for settings table
 *
 * @access private
 */
$database->statement("ALTER TABLE  `ossn_site_settings` 
                      DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;");
$database->execute();

/**
 * Register a OssnBlock component
 *
 * @access private
 */
$database->statement("INSERT `ossn_components` (`com_id`, `active`) 
                      VALUES('OssnBlock', '0')");
$database->execute();

/**
 * Register a OssnPoke component
 *
 * @access private
 */
$database->statement("INSERT `ossn_components` (`com_id`, `active`) 
                      VALUES('OssnPoke', '0')");
$database->execute();

/**
 * Fix lenght of time_created
 *
 * @access private
 */
$database->statement("ALTER TABLE  `ossn_notifications` 
                      CHANGE  `time_created`  `time_created` INT( 11 ) NOT NULL ;");
$database->execute();
/**
 * Delete wrong relationships
 *
 * @access private
 */
$delete['from'] = 'ossn_relationships';
$delete['wheres'] = array("type='0'");
$database->delete($delete);

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