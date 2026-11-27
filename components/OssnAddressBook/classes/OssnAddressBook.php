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
class OssnAddressBook extends OssnObject {
		/**
		 * Add a new contact to a user's personal address book
		 *
		 * @param integer $owner_guid  GUID of the user creating the contact
		 * @param string  $name        Contact full name
		 * @param string  $phone       Optional phone or WhatsApp number
		 * @param string  $email       Optional email address
		 * @param string  $company     Optional company or organization name
		 * @param string  $address     Optional street or city address
		 * @param string  $category    Contact category ('personal', 'work', 'family', or 'other')
		 * @param string  $description Optional personal notes about the contact
		 *
		 * @return integer|boolean Newly created contact GUID on success, or false on failure
		 */
		public function addContact($owner_guid, $name, $phone = '', $email = '', $company = '', $address = '', $category = 'personal', $description = '') {
				if(empty($owner_guid) || empty($name)) {
						return false;
				}
				$allowed_categories = array('personal', 'work', 'family', 'other');

				$this->owner_guid        = (int)$owner_guid;
				$this->type              = 'user';
				$this->subtype           = 'addressItem';
				$this->title             = $name;
				$this->description       = $description;
				$this->data->phone       = $phone;
				$this->data->email       = $email;
				$this->data->company     = $company;
				$this->data->address     = $address;
				$this->data->category    = in_array($category, $allowed_categories) ? $category : 'personal';
				$this->data->is_favorite = '0';

				if($this->addObject()) {
						return $this->getObjectId();
				}
				return false;
		}

		/**
		 * Edit an existing contact owned by the specified user
		 *
		 * @param integer $guid        GUID of the contact object
		 * @param integer $owner_guid  GUID of the contact owner
		 * @param string  $name        Updated contact full name
		 * @param string  $phone       Updated phone or WhatsApp number
		 * @param string  $email       Updated email address
		 * @param string  $company     Updated company or organization name
		 * @param string  $address     Updated street or city address
		 * @param string  $category    Updated contact category ('personal', 'work', 'family', or 'other')
		 * @param string  $description Updated personal notes about the contact
		 *
		 * @return boolean True on success, or false on failure
		 */
		public function editContact($guid, $owner_guid, $name, $phone = '', $email = '', $company = '', $address = '', $category = 'personal', $description = '') {
				if(empty($guid) || empty($owner_guid) || empty($name)) {
						return false;
				}
				$contact = ossn_get_object((int)$guid);
				if(!$contact || $contact->subtype !== 'addressItem' || (int)$contact->owner_guid !== (int)$owner_guid) {
						return false;
				}
				$allowed_categories = array('personal', 'work', 'family', 'other');

				$contact->title          = $name;
				$contact->description    = $description;
				$contact->data->phone    = $phone;
				$contact->data->email    = $email;
				$contact->data->company  = $company;
				$contact->data->address  = $address;
				$contact->data->category = in_array($category, $allowed_categories) ? $category : 'personal';

				return $contact->save();
		}

		/**
		 * Retrieve a user's address book contacts ordered alphabetically with favorites first
		 *
		 * @param integer $owner_guid GUID of the contact owner
		 * @param string  $category   Optional category filter ('all', 'favorites', 'personal', 'work', 'family', or 'other')
		 *
		 * @return array|boolean Array of OssnObject instances, or false if none found
		 */
		public function getUserContacts($owner_guid, $category = 'all') {
				$params = array(
						'owner_guid' => (int)$owner_guid,
						'type'       => 'user',
						'subtype'    => 'addressItem',
						'page_limit' => false,
						'order_by'   => 'o.title ASC',
				);
				if($category === 'favorites') {
						$params['entities_pairs'] = array(
								array('name' => 'is_favorite', 'value' => '1'),
						);
				} elseif(in_array($category, array('personal', 'work', 'family', 'other'))) {
						$params['entities_pairs'] = array(
								array('name' => 'category', 'value' => $category),
						);
				}
				$items = $this->searchObject($params);
				if(!$items) {
						return false;
				}

				usort($items, function($a, $b) {
						$fa = ($a->is_favorite == '1') ? 0 : 1;
						$fb = ($b->is_favorite == '1') ? 0 : 1;
						if($fa !== $fb) {
								return $fa <=> $fb;
						}
						return strcasecmp($a->title, $b->title);
				});

				return $items;
		}

		/**
		 * Toggle the favorite status ('0' or '1') of a user's contact
		 *
		 * @param integer $guid       GUID of the contact object
		 * @param integer $owner_guid GUID of the contact owner
		 *
		 * @return string|boolean New favorite status ('0' or '1') on success, or false on failure
		 */
		public function toggleFavorite($guid, $owner_guid) {
				$contact = ossn_get_object((int)$guid);
				if(!$contact || $contact->subtype !== 'addressItem' || (int)$contact->owner_guid !== (int)$owner_guid) {
						return false;
				}
				$new_status                = ($contact->is_favorite == '1') ? '0' : '1';
				$contact->data->is_favorite = $new_status;
				if($contact->save()) {
						return $new_status;
				}
				return false;
		}

		/**
		 * Delete a single contact owned by the specified user
		 *
		 * @param integer $guid       GUID of the contact object
		 * @param integer $owner_guid GUID of the contact owner
		 *
		 * @return boolean True on success, or false on failure
		 */
		public function deleteContact($guid, $owner_guid) {
				$contact = ossn_get_object((int)$guid);
				if(!$contact || $contact->subtype !== 'addressItem' || (int)$contact->owner_guid !== (int)$owner_guid) {
						return false;
				}
				return $contact->deleteObject();
		}

		/**
		 * Delete all contacts belonging to a user
		 *
		 * @param integer $owner_guid GUID of the contact owner
		 *
		 * @return boolean True once all contacts are removed
		 */
		public function deleteAllContacts($owner_guid) {
				$items = $this->getUserContacts($owner_guid, 'all');
				if(!$items) {
						return true;
				}
				foreach($items as $item) {
						$item->deleteObject();
				}
				return true;
		}
/**
		 * Export all contacts of a user as a CSV string
		 *
		 * @param integer $owner_guid GUID of the contact owner
		 *
		 * @return string CSV formatted contact data
		 */
		public function exportCsv($owner_guid) {
				$items  = $this->getUserContacts($owner_guid, 'all');
				$stream = fopen('php://temp', 'r+');
				fputcsv($stream, array('Name', 'Phone', 'Email', 'Company', 'Address', 'Group', 'Favorite', 'Notes'));

				if($items) {
						foreach($items as $item) {
								fputcsv($stream, array(
										html_entity_decode($item->title, ENT_QUOTES, 'UTF-8'),
										html_entity_decode((string)$item->phone, ENT_QUOTES, 'UTF-8'),
										html_entity_decode((string)$item->email, ENT_QUOTES, 'UTF-8'),
										html_entity_decode((string)$item->company, ENT_QUOTES, 'UTF-8'),
										html_entity_decode((string)$item->address, ENT_QUOTES, 'UTF-8'),
										(string)$item->category,
										($item->is_favorite == '1') ? '1' : '0',
										html_entity_decode((string)$item->description, ENT_QUOTES, 'UTF-8'),
								));
						}
				}
				rewind($stream);
				$csv = stream_get_contents($stream);
				fclose($stream);
				return $csv;
		}

		/**
		 * Export all contacts of a user as a vCard 3.0 (.vcf) string
		 *
		 * @param integer $owner_guid GUID of the contact owner
		 *
		 * @return string vCard formatted contact data
		 */
		public function exportVcf($owner_guid) {
				$items = $this->getUserContacts($owner_guid, 'all');
				if(!$items) {
						return '';
				}
				$lines = array();
				foreach($items as $item) {
						$name    = html_entity_decode($item->title, ENT_QUOTES, 'UTF-8');
						$phone   = html_entity_decode((string)$item->phone, ENT_QUOTES, 'UTF-8');
						$email   = html_entity_decode((string)$item->email, ENT_QUOTES, 'UTF-8');
						$company = html_entity_decode((string)$item->company, ENT_QUOTES, 'UTF-8');
						$address = html_entity_decode((string)$item->address, ENT_QUOTES, 'UTF-8');
						$note    = str_replace(array("\r\n", "\n", "\r"), '\n', html_entity_decode((string)$item->description, ENT_QUOTES, 'UTF-8'));

						$lines[] = 'BEGIN:VCARD';
						$lines[] = 'VERSION:3.0';
						$lines[] = 'FN:' . $name;
						if($phone !== '') {
								$lines[] = 'TEL;TYPE=CELL:' . $phone;
						}
						if($email !== '') {
								$lines[] = 'EMAIL;TYPE=INTERNET:' . $email;
						}
						if($company !== '') {
								$lines[] = 'ORG:' . $company;
						}
						if($address !== '') {
								$lines[] = 'ADR;TYPE=HOME:;;' . $address . ';;;;';
						}
						if($note !== '') {
								$lines[] = 'NOTE:' . $note;
						}
						$lines[] = 'END:VCARD';
				}
				return implode("\r\n", $lines) . "\r\n";
		}

		/**
		 * Import contacts from an uploaded CSV or vCard (.vcf) file
		 *
		 * @param integer $owner_guid GUID of the user importing contacts
		 * @param string  $tmp_path   Temporary uploaded file path
		 * @param string  $extension  Lowercase file extension ('csv' or 'vcf')
		 *
		 * @return integer Number of contacts imported
		 */
		public function importFile($owner_guid, $tmp_path, $extension) {
				if(empty($owner_guid) || !is_readable($tmp_path)) {
						return 0;
				}
				$imported = 0;

				if($extension === 'csv') {
						if(($handle = fopen($tmp_path, 'r')) !== false) {
								$row_index = 0;
								while(($row = fgetcsv($handle)) !== false) {
										$row_index++;
										if($row_index === 1 && isset($row[0]) && strtolower(trim($row[0])) === 'name') {
												continue;
										}
										$name = isset($row[0]) ? htmlspecialchars(trim($row[0]), ENT_QUOTES, 'UTF-8') : '';
										if($name === '') {
												continue;
										}
										$phone   = isset($row[1]) ? htmlspecialchars(trim($row[1]), ENT_QUOTES, 'UTF-8') : '';
										$email   = isset($row[2]) ? htmlspecialchars(trim($row[2]), ENT_QUOTES, 'UTF-8') : '';
										$company = isset($row[3]) ? htmlspecialchars(trim($row[3]), ENT_QUOTES, 'UTF-8') : '';
										$address = isset($row[4]) ? htmlspecialchars(trim($row[4]), ENT_QUOTES, 'UTF-8') : '';
										$cat     = isset($row[5]) ? strtolower(trim($row[5])) : 'personal';
										$notes   = isset($row[7]) ? htmlspecialchars(trim($row[7]), ENT_QUOTES, 'UTF-8') : '';

										if($this->addContact($owner_guid, $name, $phone, $email, $company, $address, $cat, $notes)) {
												$imported++;
										}
								}
								fclose($handle);
						}
				} elseif($extension === 'vcf') {
						$content = file_get_contents($tmp_path);
						$cards   = preg_split('/BEGIN:VCARD/i', $content);
						foreach($cards as $card) {
								if(stripos($card, 'END:VCARD') === false) {
										continue;
								}
								$name = $phone = $email = $company = $address = $notes = '';
								foreach(preg_split('/\r\n|\r|\n/', $card) as $line) {
										if(stripos($line, 'FN:') === 0) {
												$name = substr($line, 3);
										} elseif(preg_match('/^TEL[^:]*:(.*)$/i', $line, $m) && $phone === '') {
												$phone = $m[1];
										} elseif(preg_match('/^EMAIL[^:]*:(.*)$/i', $line, $m) && $email === '') {
												$email = $m[1];
										} elseif(stripos($line, 'ORG:') === 0) {
												$company = str_replace(';', ' ', substr($line, 4));
										} elseif(preg_match('/^ADR[^:]*:(.*)$/i', $line, $m)) {
												$parts   = array_filter(array_map('trim', explode(';', $m[1])));
												$address = implode(', ', $parts);
										} elseif(stripos($line, 'NOTE:') === 0) {
												$notes = str_replace('\n', "\n", substr($line, 5));
										}
								}
								$name = htmlspecialchars(trim($name), ENT_QUOTES, 'UTF-8');
								if($name !== '') {
										if($this->addContact(
												$owner_guid,
												$name,
												htmlspecialchars(trim($phone), ENT_QUOTES, 'UTF-8'),
												htmlspecialchars(trim($email), ENT_QUOTES, 'UTF-8'),
												htmlspecialchars(trim($company), ENT_QUOTES, 'UTF-8'),
												htmlspecialchars(trim($address), ENT_QUOTES, 'UTF-8'),
												'personal',
												htmlspecialchars(trim($notes), ENT_QUOTES, 'UTF-8')
										)) {
												$imported++;
										}
								}
						}
				}

				return $imported;
		}		
}
