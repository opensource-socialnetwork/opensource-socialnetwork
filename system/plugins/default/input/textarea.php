<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$class = 'ossn-textarea-input';
if(isset($params['class'])){
	//[B] strangeness of class extending in input modules #1635
	$class = $class .' '. $params['class'];
}
$value = (isset($params['value'])) ? $params['value'] : '';
unset ($params['value']);

$defaults = array(
	'disabled' => false,
	'class' => $class,
);
$params = array_merge($defaults, $params);
$attributes = ossn_args($params);

echo "<textarea {$attributes}>{$value}</textarea>";
