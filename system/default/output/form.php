<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
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

$attributes = ossn_args($params);
echo "<form $attributes  enctype='multipart/form-data'><fieldset>$token $body</fieldset></form>";