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

$path  = ossn_route()->themes . 'goblue/logos_backgrounds/';
//[B] Reset logo if no logo set before causing error #2368
if(!is_dir($path)){
	redirect(REF);
}
$files = array_diff(scandir($path), array(
		'.',
		'..',
));
if($path) {
		foreach ($files as $file) {
				unlink("{$path}/{$file}");
		}
}
redirect(REF);
