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

/**
 * Registers an action.
 *
 * @param string $action The name of the action
 * @param string $filename The filename where this action is located.
 *
 * @return void
 */
function ossn_register_action($action, $file) {
    global $Ossn;
    $Ossn->action[$action] = $file;
}

/**
 * Unregister action
 *
 * @param string $action The name of the action
 *
 * @return void
 */
function ossn_unregister_action($action) {
    global $Ossn;
    unset($Ossn->action[$action]);
}

/**
 * Load action.
 *
 * @param string $action The name of the action
 *
 * @return void
 */
function ossn_action($action) {
    global $Ossn;
    if (isset($Ossn->action) && array_key_exists($action, $Ossn->action)
    ) {
        if (is_file($Ossn->action[$action])) {
            ossn_trigger_callback('action', 'validate');
            ossn_trigger_callback('action', "load:{$action}");
            include_once($Ossn->action[$action]);
        }
    } else {
        ossn_error_page();
    }
}