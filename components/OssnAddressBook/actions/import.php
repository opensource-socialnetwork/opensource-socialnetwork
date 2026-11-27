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
if(empty($_FILES['contacts_file']['tmp_name'])) {
		ossn_trigger_message(ossn_print('ossnaddressbook:import:error'), 'error');
		redirect(REF);
}

$ext = strtolower(pathinfo($_FILES['contacts_file']['name'], PATHINFO_EXTENSION));
if(!in_array($ext, array('csv', 'vcf'))) {
		ossn_trigger_message(ossn_print('ossnaddressbook:import:invalid'), 'error');
		redirect(REF);
}

$addressbook = new OssnAddressBook();
$count       = $addressbook->importFile(ossn_loggedin_user()->guid, $_FILES['contacts_file']['tmp_name'], $ext);

if($count > 0) {
		ossn_trigger_message(ossn_print('ossnaddressbook:import:success', array($count)));
} else {
		ossn_trigger_message(ossn_print('ossnaddressbook:import:empty'), 'error');
}
redirect(REF);