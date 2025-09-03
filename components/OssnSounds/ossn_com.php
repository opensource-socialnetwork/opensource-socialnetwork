<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright 2014-2018 OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/
 */
define('__OSSN_SOUNDS__', ossn_route()->com . 'OssnSounds/');
function ossn_sounds_init() {
	ossn_extend_view('css/ossn.default', 'css/sounds');
	ossn_extend_view('js/ossn.site', 'js/sounds');
}
ossn_register_callback('ossn', 'init', 'ossn_sounds_init');
