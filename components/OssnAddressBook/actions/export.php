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
$format      = input('format');
$addressbook = new OssnAddressBook();
$user_guid   = ossn_loggedin_user()->guid;

if($format === 'vcf') {
		$data = $addressbook->exportVcf($user_guid);
		header('Content-Type: text/vcard; charset=utf-8');
		header('Content-Disposition: attachment; filename="contacts-' . date('Y-m-d') . '.vcf"');
		echo $data;
		exit;
}

$data = $addressbook->exportCsv($user_guid);
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="contacts-' . date('Y-m-d') . '.csv"');
echo $data;
exit;