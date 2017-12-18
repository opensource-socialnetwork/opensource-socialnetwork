<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2018 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/
 */
define('__OSSN_SOUNDS__', ossn_route()->com . 'OssnSounds/');
function ossn_sounds_init() {
	ossn_extend_view('css/ossn.default', 'css/sounds');
	ossn_extend_view('js/opensource.socialnetwork', 'js/sounds');
}
ossn_register_callback('ossn', 'init', 'ossn_sounds_init');
