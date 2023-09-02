<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$component = new OssnComponents;
$modes = array(
		'off',
		'on'
);
$close_anywhere  = input('close_anywhere');
if(in_array($close_anywhere, $modes)) {
	if($component->setSettings('OssnNotifications', array('close_anywhere' => $close_anywhere))) {
		ossn_trigger_message(ossn_print('ossn:admin:settings:saved'));
		redirect(REF);
	}
}
ossn_trigger_message(ossn_print('ossn:admin:settings:save:error'), 'error');
redirect(REF);
