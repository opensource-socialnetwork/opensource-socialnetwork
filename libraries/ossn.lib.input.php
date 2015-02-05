<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */

/**
 * Get input from user; using secure method;
 *
 * @param string $input Name of input;
 * @params  integer $validate If you don't want to encode to html entities then add 1 as second arg in function.
 *
 * @last edit: $arsalanshah
 * @reason: fix docs;
 * @return false|string
 */
function input($input, $validate = '') {
    $replacements = array(
        "\x00" => '\x00',
        "\n" => '\n',
        "\r" => '\r',
        "\\" => '\\\\',
        "'" => "\'",
        '"' => '\"',
        "\x1a" => '\x1a'
    );
    if (isset($_REQUEST[$input]) && empty($validate)) {
        $data = htmlentities($_REQUEST[$input], ENT_QUOTES, 'UTF-8');
        return strtr($data, $replacements);
    } elseif ($validate == 1) {
        return strtr($input, $replacements);
    }
    return false;
}
/**
 * Ossn Restore New Lines
 * Restore \n\r from the string to new line
 *
 * @param string $string A valid string in which you want to restore lines.
 * @return string
 */
function ossn_restore_new_lines($string){
	if(empty($string)){
		return false;
	}
	$replacements = array(
        "\n" => '\n',
        "\r" => '\r',
	);
	$replacements = array_flip($replacements);
	return strtr($string, $replacements);
}
