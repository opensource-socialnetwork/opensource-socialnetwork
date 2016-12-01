<?php
/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
/**
 * Escape input string
 *
 * @param string $str A valid string in which you want to restore lines.
 * @param boolean $newlines If you also want to escape new lines , default settings will replace it
 *
 * @return string
 */
function ossn_input_escape($str, $newlines = true) {
		$replacements = array(
				"\x00" => '\x00',
				"\n" => '\n',
				"'" => "\'",
				'"' => '\"',
				"\x1a" => '\x1a'
		);
		if($newlines === true) {
				$newline      = array(
						"\r" => '\r',
						"\\" => '\\\\'
				);
				$replacements = array_merge($replacements, $newline);
		}
		if(!empty($str)) {
				return strtr($str, $replacements);
		}
		return false;
}
/**
 * Get input from user; using secure method;
 *
 * @param string  $input Name of input;
 * @param integer $noencode If you don't want to encode to html entities then add 1 as second arg in function.
 * @param boolean $strip Remove spaces from start and end of input
 *
 * @last edit: $arsalanshah
 * @reason: fix docs;
 * @return false|string
 */
function input($input, $noencode = '', $default = false, $strip = true) {
		$str  = false;
		$hook = ossn_call_hook('ossn', 'input', false, array(
				'input' => $input,
				'noencode' => $noencode,
				'default' => $default,
				'strip' => $strip,
				'data' => $_REQUEST[$input]
		));
		if($hook) {
				$input    = $hook['input'];
				$noencode = $hook['noencode'];
				$default  = $hook['default'];
				$strip    = $hook['strip'];
				if(isset($hook['data']) && is_array($hook['data'])) {
						foreach($hook['data'] as $key => $value) {
								$hook['data'][$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
						}
						return $hook['data'];
				}
				if(!isset($hook['data']) && $default) {
						return $default;
				}
				if(isset($hook['data']) && empty($noencode)) {
						$data = htmlspecialchars($hook['data'], ENT_QUOTES, 'UTF-8');
						$str  = $data;
				} elseif($noencode == true) {
						$str = $data;
				}
				if($str) {
						if($strip) {
								return trim(ossn_input_escape($str));
						} else {
								return ossn_input_escape($str);
						}
				}
		}
		return false;
}
/**
 * Ossn Restore New Lines
 * Restore \n\r from the string to new line
 *
 * @param string $string A valid string in which you want to restore lines.
 * @param boolean $br If you want newlines to replaced by html <br /> tag.
 *
 * @return string
 */
function ossn_restore_new_lines($string, $br = false) {
		if(empty($string)) {
				return false;
		}
		$replacements = array(
				"\n" => '\n',
				"\r" => '\r'
		);
		$replacements = array_flip($replacements);
		$result       = strtr($string, $replacements);
		if($br === true) {
				$result = nl2br($result);
		}
		return $result;
}
/**
 * Set a value for input
 *
 * @param string $name Name of input
 * @param string $value Value of input
 * 
 * @return void
 */
function ossn_set_input($name, $value) {
		if(isset($name) && isset($value)) {
				$_REQUEST[$name] = $value;
		}
}
