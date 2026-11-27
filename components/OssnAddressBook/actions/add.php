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

$name        = input('name');
$phone       = input('phone');
$email       = input('email');
$company     = input('company');
$address     = input('address');
$category    = input('category');
$description = input('description');

$addressbook = new OssnAddressBook();
$guid        = $addressbook->addContact(
		ossn_loggedin_user()->guid,
		$name,
		$phone,
		$email,
		$company,
		$address,
		$category,
		$description
);

if($guid) {
		$item = ossn_get_object($guid);
		echo json_encode(array(
				'status'      => 'success',
				'guid'        => $guid,
				'name'        => $item->title,
				'phone'       => $item->phone,
				'email'       => $item->email,
				'company'     => $item->company,
				'address'     => $item->address,
				'category'    => $item->category,
				'description' => $item->description,
				'is_favorite' => $item->is_favorite,
		));
} else {
		echo json_encode(array(
				'status'  => 'error',
				'message' => ossn_print('ossnaddressbook:add:error'),
		));
}
exit;
