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
			$params['action'] = $action;
            ossn_trigger_callback('action', 'load', $params);
            include_once($Ossn->action[$action]);
			if(ossn_is_xhr()){
				header('Content-Type: application/json');
				$vars = array();
				if(isset($_SESSION['ossn_messages']['success']) 
					&& !empty($_SESSION['ossn_messages']['success'])){
						$vars['success'] = $_SESSION['ossn_messages']['success'];
				}
				//danger = error bootstrap
				if(isset($_SESSION['ossn_messages']['danger']) 
					&& !empty($_SESSION['ossn_messages']['danger'])){
						$vars['error'] = $_SESSION['ossn_messages']['danger'];
				}
				if(isset($Ossn->redirect) && !empty($Ossn->redirect)){
					$vars['redirect'] = $Ossn->redirect;
				}
				if(isset($Ossn->ajaxData) && !empty($Ossn->ajaxData)){
					$vars['data'] = $Ossn->ajaxData;
				}
				unset($_SESSION['ossn_messages']);
				if(!empty($vars)){
					echo json_encode($vars);
				}
			}
        }
    } else {
        ossn_error_page();
    }
}