<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Rafael Amorim <amorim@rafaelamorim.com.br>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$component = new OssnComponents;
$settings  = array(
		'api_key' => input('mapbox_api_key'),
);
if($component->setSettings('OssnLocation', $settings)) {
		ossn_trigger_message(ossn_print('ossn:admin:settings:saved'));
} else {
		ossn_trigger_message(ossn_print('ossn:admin:settings:save:error'), 'error');
}
redirect(REF);