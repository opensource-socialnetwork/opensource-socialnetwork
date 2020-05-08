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

$class = 'ossn-radio-input';
if(isset($params['class'])){
	//[B] strangeness of class extending in input modules #1635
	$class = $class .' '. $params['class'];
}
$value = (isset($params['value'])) ? $params['value'] : '';
$values = (isset($params['options'])) ? $params['options'] : array();

$defaults = array(
	'disabled' => false,
	'class' => $class,
	'type' => 'radio',
);

$params = array_merge($defaults, $params);
unset($params['value']);
unset($params['options']);

$attributes = ossn_args($params);

if(empty($values)){
	return;
}
foreach($values as $item => $label){
	$vars			= array();
	$vars['value'] 	  = $item;
	if(!empty($value) && $value === $item){
		$vars['checked'] = 'checked';
	}
	
	$vars = ossn_args($vars);	
	echo  "<div class='radio-block'><input {$attributes} {$vars} /><span>{$label}</span></div>";
}