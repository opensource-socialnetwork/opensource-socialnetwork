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

$class = 'ossn-checkbox-input';
if(isset($params['class'])){
	//[B] strangeness of class extending in input modules #1635
	$class = $class .' '. $params['class'];
}
$value = (isset($params['value'])) ? $params['value'] : '';
$vars  = array();

$defaults = array(
	'disabled' => false,
	'class' => $class,
	'type' => 'checkbox',
);

$params = array_merge($defaults, $params);
unset($params['value']);
$attributes = ossn_args($params);
if(!empty($value) && $value == true){
		$vars['checked'] = 'checked';
}
$vars = ossn_args($vars);
echo  "<div class='checkbox-block'><input {$attributes} {$vars} /><span>{$label}</span></div>";
