<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$component = new OssnComponents;
$mode  = input('compatibility_mode');
$modes = array(
		'off',
		'on'
);
if(!in_array($mode, $modes)) {
		ossn_trigger_message(ossn_print('ossn:smilies:admin:settings:save:error'), 'error');
		redirect(REF);
}
if($component->setSettings('OssnSmilies', array('compatibility_mode' => $mode))) {
		ossn_trigger_message(ossn_print('ossn:smilies:admin:settings:saved'));
} else {
		ossn_trigger_message(ossn_print('ossn:smilies:admin:settings:save:error'), 'error');
}
redirect(REF);