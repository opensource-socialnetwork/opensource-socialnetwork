<?php
/**
 * Buddyexpress Framework Core
 *
 * @package   Bframework
 * @author    Buddyexpress Core Team <admin@buddyexpress.net
 * @copyright 2012 BUDDYEXPRESS.
 * @license   Buddyexpress Public License http://www.buddyexpress.net/Licences/bpl/ 
 * @link      http://bserver.buddyexpress.net
 * @Contributors http://www.buddyexpress.net/bframework/contributors.b
 */

/*
* BFramework Args seprator
* @uses bbframework_args(array(<args>));
*/ 
function bframework_args(array $attrs) {
	$attrs = $attrs;
	$attributes = array();

	foreach ($attrs as $attr => $val) {
	$attr = strtolower($attr);
    if ($val === TRUE) {
	/* array('attr' => 'attr') to attr="attr" */
	$val = $attr; } if ($val !== NULL && $val !== false && (is_array($val) || !is_object($val))) {
	if (is_array($val)) {$val = implode(' ', $val);}
    $val = htmlspecialchars($val, ENT_QUOTES, 'UTF-8', false);
	$attributes[] = "$attr=\"$val\"";
		}
	} 
	return implode(' ', $attributes);
}
 