<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 
function ossn_themes_init(){
	ossn_register_plugins_by_path(ossn_default_theme() . 'plugins/');
}
ossn_register_callback('ossn', 'init', 'ossn_themes_init');
