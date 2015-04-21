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
/**
 * Check if the site errors settings exists or not
 *
 * @access private
 */
$fetch['from'] = 'ossn_site_settings';
$fetch['wheres'] = array("name='display_errors'");
$siterror_settings = $database->select($fetch);

/**
 * If settings didn't exist then create settings
 *
 * @access private
 */
if (empty($siterror_settings->setting_id)) {
    $insert['into'] = 'ossn_site_settings';
    $insert['names'] = array(
        'name',
        'value'
    );
    $insert['values'] = array(
        'display_errors',
        'off'
    );
    $database->insert($insert);
}


/**
 * Check if the site key settings exists or not
 *
 * @access private
 */
$fetch['from'] = 'ossn_site_settings';
$fetch['wheres'] = array("name='site_key'");
$site_key_settings = $database->select($fetch);

/**
 * If settings didn't exist then create settings
 *
 * @access private
 */
if (empty($site_key_settings->setting_id)) {
    $insert['into'] = 'ossn_site_settings';
    $insert['names'] = array(
        'name',
        'value'
    );
    $insert['values'] = array(
        'site_key',
        ossn_generate_site_screat()
    );
    $database->insert($insert);
}

/**
 * Update configuration file
 *
 * @access private
 */
$file = file_get_contents(ossn_route()->configs . 'ossn.config.site.php');
$remove_errors = str_replace("error_reporting(E_NOTICE ^ ~E_WARNING);", "", $file);
file_put_contents(ossn_route()->configs . 'ossn.config.site.php', $remove_errors);

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