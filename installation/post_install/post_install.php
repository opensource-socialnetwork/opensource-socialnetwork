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
 
$files = ossn_get_upgrade_files();
if($files){	
	foreach($files as $upgrade){
		ossn_update_upgraded_files($upgrade);
	}
}

$ossn_xml = ossn_package_information();
$version = $ossn_xml->version;

ossn_update_db_version($version);
