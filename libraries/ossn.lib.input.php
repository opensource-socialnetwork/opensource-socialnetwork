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
function ossn_input_escape($str, $newlines = true){
    $replacements = array(
        "\x00" => '\x00',
        "\n" => '\n',
        "'" => "\'",
        '"' => '\"',
        "\x1a" => '\x1a'
    );
	if($newlines === true){
		$newline = array(       
	        "\r" => '\r',
            "\\" => '\\\\',
	    );
		$replacements = array_merge($replacements, $newline);
	}
	if(!empty($str)){
		return strtr($str, $replacements);	
	}
	return false;
}
/**
 * Get input from user; using secure method;
 *
 * @param string $input Name of input;
 * @params  integer $noencode If you don't want to encode to html entities then add 1 as second arg in function.
 *
 * @last edit: $arsalanshah
 * @reason: fix docs;
 * @return false|string
 */
function input($input, $noencode = '') {
	$str = false;
    if (isset($_REQUEST[$input]) && empty($noencode)) {
        $data = htmlentities($_REQUEST[$input], ENT_QUOTES, 'UTF-8');
		$str = $data;
    } elseif ($noencode == 1) {
        $str = ossn_input_escape($data);
    }
	if($str){
		return ossn_input_escape($str);
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
