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
header('Content-Type: application/json');

$addressbook = new OssnAddressBook();
if($addressbook->deleteAllContacts(ossn_loggedin_user()->guid)) {
		echo json_encode(array('status' => 'success'));
} else {
		echo json_encode(array(
				'status'  => 'error',
				'message' => ossn_print('ossnaddressbook:delete:error'),
		));
}
exit;
