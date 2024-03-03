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
$class = 'ossn-checkbox-input';
if(isset($params['class'])) {
		//[B] strangeness of class extending in input modules #1635
		$params['class'] = $class . ' ' . $params['class'];
}
$value = isset($params['value']) ? $params['value'] : '';
//[B] input/checkbox not getting any label #1849
//this label is not the forum label but the checkbox title example [ ] Label  not form <label>...
$label   = isset($params['label']) ? $params['label'] : '';
$options = isset($params['options']) ? $params['options'] : false;

//old checkbox 
if(!$options) {
	$options = array(
			"{$params['name']}" => $label,				 
	);
}
$vars = array();

$defaults = array(
		'disabled' => false,
		'class'    => $class,
		'type'     => 'checkbox',
);

if(!empty($options)) {
		$options_count = count($options);
		//explode user option value later used for checking/unchecking box
		if($options_count > 0 && !empty($value) && !is_array($value)){
				$value = explode(',', $value);
				$value = array_map('trim', $value);
		}
		foreach ($options as $key => $option_label) {
				$args = array_merge($defaults, $params);
				
				unset($args['value']);
				unset($args['options']);
				unset($args['label']);
				
				$args['value'] = $key;
				//if more than 1 options then name is array[]
				if($options_count > 1) {
						$args['name'] = "{$args['name']}[]";
				}

				if((!empty($value) && is_array($value) && in_array($key, $value)) || ($options_count == 1 && $value === true)) {
						$args['checked'] = 'checked';
				}
				
				$attributes = ossn_args($args);
				echo "<div class='checkbox-block'><input {$attributes} /><span>{$option_label}</span></div>";
		}
}