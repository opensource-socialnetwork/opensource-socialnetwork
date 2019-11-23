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
global $Ossn;
$OssnComponents = new OssnComponents;
$Ossn->activeComponents = $OssnComponents->getActive(true);

/**
 * Get components object
 *
 * @return OssnComponents
 */
function ossn_components() {
		$coms = new OssnComponents;
		return $coms;
}

/**
 * Check whether component is active or not.
 *
 * @param string $comn Component id
 *
 * @return bool
 */
function com_is_active($comn = '') {
		global $Ossn;
		if(!empty($comn) && in_array($comn, $Ossn->activeComponents)){
				return true;	
		}
		return false;
}

/**
 * Count total components
 *
 * @return integer
 */
function ossn_total_components() {
		$com = new OssnComponents;
		return $com->total();
}

/**
 * Load the locales
 *
 * @return array
 */
ossn_default_load_locales();

/**
 * Includes all components and active theme
 *
 * @return bool
 */

//loads active theme
$theme = new OssnThemes;
$theme->loadActive();

//load active components
$coms = new OssnComponents;
$coms->loadComs();

/**
 * Initialize components
 *
 * @return false|null
 * @access private;
 */

function ossn_components_init() {
		$panels = ossn_registered_com_panel();
		if($panels) {
			foreach($panels as $configure) {
				ossn_register_menu_item('topbar_admin', array(
						'name' => OssnTranslit::urlize($configure),
						'text' => $configure,
						'parent' => 'configure',
						'href' => ossn_site_url("administrator/component/{$configure}")
				));
			}
		}
}

ossn_register_callback('ossn', 'init', 'ossn_components_init');
