<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.Open Source Social Network.org/licence
 * @link      http://www.Open Source Social Network.org/licence
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