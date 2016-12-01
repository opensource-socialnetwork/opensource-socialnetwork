<?php
/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$type  = input('type');
$types = array(
		'friends',
		'public'
);
if(!in_array($type, $types)) {
		ossn_trigger_message(ossn_print('ossn:wall:settings:save:error'), 'error');
		redirect(REF);
}
if(ossn_set_homepage_wall_access($type)) {
		ossn_trigger_message(ossn_print('ossn:wall:settings:saved'));
} else {
		ossn_trigger_message(ossn_print('ossn:wall:settings:save:error'), 'error');
}
redirect(REF);