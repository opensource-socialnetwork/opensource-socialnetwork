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
function com_is_active($comn) {
		$com = new OssnComponents;
		if($com->isActive($comn)) {
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
		if(!$panels) {
				return false;
		}
		foreach($panels as $configure) {
				ossn_register_menu_item('topbar_admin', array(
						'name' => OssnTranslit::urlize($configure),
						'text' => $configure,
						'parent' => 'configure',
						'href' => ossn_site_url("administrator/component/{$configure}")
				));
		}
}

ossn_register_callback('ossn', 'init', 'ossn_components_init');
