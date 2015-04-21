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
 
function ossn_themes_init(){
	ossn_register_plugins_by_path(ossn_default_theme() . 'plugins/');
}
ossn_register_callback('ossn', 'init', 'ossn_themes_init');
