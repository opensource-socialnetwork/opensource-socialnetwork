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
if (!isset($params['params'])) {
    $params['params'] = array();
}
if ($params['type'] == false) {
    $body = ossn_plugin_view("forms/{$params['component']}/{$params['name']}", $params['params']);
}
if ($params['type'] == 'core') {
    $body = ossn_plugin_view('forms/' . $params['name'], $params['params']);
}
if (isset($params['class'])) {
    $params['class'] = "ossn-form {$params['class']}";
} else {
    $params['class'] = 'ossn-form';
}
unset($params['name']);
unset($params['type']);
unset($params['params']);
unset($params['component']);

if (!isset($params['method'])) {
    $params['method'] = 'post';
}

$token = ossn_plugin_view('input/security_token');
if(isset($params['security_tokens']) && $params['security_tokens'] === false){
	$token = false;
}
$attributes = ossn_args($params);
echo "<form $attributes  enctype='multipart/form-data'><fieldset>$token $body</fieldset></form>";