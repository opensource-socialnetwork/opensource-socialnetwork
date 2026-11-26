<?php
/**
- Open Source Social Network
 *
- @package   (softlab24.com).ossn
- @author    OSSN Core Team <info@softlab24.com>
- @copyright (C) SOFTLAB24 LIMITED
- @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
- @link      https://www.opensource-socialnetwork.org/
 */
class OssnExpenses extends OssnObject {
		/**
		 * Add a new expense item for the logged-in user
		 *
		 * @param integer $day Day of the month
		 * @param integer $month Month number (1-12)
		 * @param integer $year Four-digit year
		 * @param string $item Expense item title
		 * @param float $price Expense item price
		 *
		 * @return integer|boolean Object GUID on success, false on failure
		 */
		public function addItem(int $day, int $month, int $year, string $item, float $price) {
				if(empty($item) || empty($price) || empty($day) || empty($month) || empty($year)) {
						return false;
				}
				$this->owner_guid = ossn_loggedin_user()->guid;
				$this->type       = 'user';
				$this->subtype    = 'expense:item';
				$this->title      = $item;

				$this->data->price = $price;
				$this->data->day   = $day;
				$this->data->month = $month;
				$this->data->year  = $year;

				return $this->addObject();
		}
		/**
		 * Get distinct years that have recorded expenses for a user
		 *
		 * @param integer $user_guid User GUID
		 *
		 * @return array|boolean Array of years or false if invalid user GUID
		 */
		public function getYears(int $user_guid) {
				if(empty($user_guid)) {
						return false;
				}
				$args = array(
						'from'     => 'ossn_object as o',
						'params'   => array(
								'emd.value',
						),
						'joins'    => array(
								'JOIN ossn_entities as e ON (o.guid=e.owner_guid AND e.type="object" AND e.subtype="year")',
								'JOIN ossn_entities_metadata as emd ON (e.guid=emd.guid)',
						),
						'wheres'   => array(
								$this->constructWheres(array(
										"o.owner_guid='{$user_guid}'",
										'o.subtype="expense:item"',
								)),
						),
						'order_by' => 'emd.value DESC',
						'group_by' => 'emd.value',
				);
				$list = $this->select($args, true);
				if($list) {
						foreach ($list as $item) {
								$lists[$item->value] = $item->value;
						}
						return $lists;
				} else {
						return array(
								date('Y'),
						);
				}
		}
		/**
		 * Get expense items for a user filtered by month, year, and optional search query
		 *
		 * @param integer $user_guid User GUID
		 * @param integer $month Month number (1-12)
		 * @param integer $year Four-digit year
		 * @param string $query Optional title search keyword
		 * @param array $params Additional searchObject() parameters
		 *
		 * @return array|boolean Array of expense objects or false on failure
		 */
		public function getList(int $user_guid, int $month, int $year, $query = '', $params = array()) {
				if(empty($user_guid) || empty($month) || empty($year)) {
						return false;
				}
				$vars = array(
						'type'           => 'user',
						'subtype'        => 'expense:item',
						'title'          => $query,
						'page_limit'     => false,
						'owner_guid'     => $user_guid,
						'entities_pairs' => array(
								array(
										'name'  => 'month',
										'value' => $month,
								),
								array(
										'name'  => 'year',
										'value' => $year,
								),
						),
				);
				$args = array_merge($vars, $params);
				return $this->searchObject($args);
		}
		/**
		 * Get total expense amount for a given month and year
		 *
		 * @param integer $user_guid User GUID
		 * @param integer $month Month number (1-12)
		 * @param integer $year Four-digit year
		 *
		 * @return float|string Sum of prices or "---" when no items exist
		 */
		public function getTotal(int $user_guid, int $month, int $year) {
				$list = $this->getList($user_guid, $month, $year);
				if($list) {
						foreach ($list as $item) {
								$prices[] = floatval($item->price);
						}
						return array_sum($prices);
				}
				return '---';
		}
		/**
		 * Check if any expense items exist for a user in a given month and year
		 *
		 * @param integer $user_guid User GUID
		 * @param integer $month Month number (1-12)
		 * @param integer $year Four-digit year
		 *
		 * @return array|boolean Matching object list or false if none/invalid
		 */
		public function getMonthStatus(int $user_guid, int $month, int $year) {
				return $this->getList($user_guid, $month, $year, '', array(
						'page_limit' => 1,
				));
		}
} //class