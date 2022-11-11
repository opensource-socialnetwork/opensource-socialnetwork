<?php
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

if(!isset($params['user']) || (isset($params['user']) && !$params['user'] instanceof OssnUser)) {
		throw new exception('output/user/url expecting a instance of OssnUser');
		return;
}
$default = array(
		'href'  => $params['user']->profileURL(),
		'text'  => $params['user']->fullname,
		'class' => 'ossn-output-user-url',
);
unset($params['user']);
if(isset($params['class'])) {
		$default['class'] = 'ossn-output-user-url ' . $params['class'];
		unset($params['class']);
}
$args = array_merge($params, $default);
unset($args['section']);
echo ossn_plugin_view('output/url', $args);