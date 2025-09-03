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

$class = 'ossn-dropdown-input';
if(isset($params['class'])) {
		//[B] strangeness of class extending in input modules #1635
		$params['class'] = $class . ' ' . $params['class'];
}
$value  = isset($params['value']) ? $params['value'] : '';
$values = isset($params['options']) ? $params['options'] : array();

$options = array();
//[E] placeholder for input/dropdown #1813
if(isset($params['placeholder']) && !empty($params['placeholder'])) {
		$options[] = "<option  disabled selected hidden>{$params['placeholder']}</options>";
}
unset($params['placeholder']);
foreach($values as $item => $val) {
		$vars          = array();
		$vars['value'] = $item;
		//[E] Multiple select (html) handler #2040
		if(!empty($value) && !is_array($item) && $value === $item) {
				$vars['selected'] = 'selected';
		}
		if(!empty($value) && is_array($value)) {
				if(in_array($item, $value)) {
						$vars['selected'] = 'selected';
				}
		}
		//[E] input/dropdown allow option values to set class, id etc
		if(is_array($val)) {
				$text = $val['text'];
				unset($val['text']);
				$vars = array_merge($vars, $val);
				$val  = $text;
		}
		$options[] = '<option ' . ossn_args($vars) . ">{$val}</option>";
}
$defaults = array(
		'disabled' => false,
		'class'    => $class,
);

$params = array_merge($defaults, $params);
unset($params['options']);
$attributes = ossn_args($params);

$values = implode('', $options);
echo "<select {$attributes}>{$values}</select>";
