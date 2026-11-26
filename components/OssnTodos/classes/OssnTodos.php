<?php
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
class OssnTodos extends OssnObject {
		/**
		 * Add a new to-do task for a user
		 *
		 * @param integer $owner_guid  GUID of the user creating the task
		 * @param string  $title       Task title
		 * @param string  $description Optional detailed notes or description
		 * @param string  $due_date    Optional due date (YYYY-MM-DD)
		 * @param string  $priority    Task priority ('low', 'normal', or 'high')
		 *
		 * @return integer|boolean Newly created task GUID on success, or false on failure
		 */
		public function addTodo($owner_guid, $title, $description = '', $due_date = '', $priority = 'normal') {
				if(empty($owner_guid) || empty($title)) {
						return false;
				}
				$this->owner_guid         = (int) $owner_guid;
				$this->type               = 'user';
				$this->subtype            = 'ossntodo';
				$this->title              = $title;
				$this->description        = $description;
				$this->data->is_completed = '0';
				$this->data->due_date     = $due_date;
				$this->data->priority     = in_array($priority, array(
						'low',
						'normal',
						'high',
				))
				? $priority
				: 'normal';

				if($this->addObject()) {
						return $this->getObjectId();
				}
				return false;
		}

		/**
		 * Edit an existing to-do task owned by the specified user
		 *
		 * @param integer $guid        GUID of the to-do object
		 * @param integer $owner_guid  GUID of the task owner
		 * @param string  $title       Updated task title
		 * @param string  $description Updated detailed notes or description
		 * @param string  $due_date    Updated due date (YYYY-MM-DD)
		 * @param string  $priority    Updated task priority ('low', 'normal', or 'high')
		 *
		 * @return boolean True on success, or false on failure
		 */
		public function editTodo($guid, $owner_guid, $title, $description = '', $due_date = '', $priority = 'normal') {
				if(empty($guid) || empty($owner_guid) || empty($title)) {
						return false;
				}
				$todo = ossn_get_object((int) $guid);
				if(!$todo || $todo->subtype !== 'ossntodo' || (int) $todo->owner_guid !== (int) $owner_guid) {
						return false;
				}

				$todo->title          = $title;
				$todo->description    = $description;
				$todo->data->due_date = $due_date;
				$todo->data->priority = in_array($priority, array(
						'low',
						'normal',
						'high',
				))
				? $priority
				: 'normal';

				return $todo->save();
		}

		/**
		 * Retrieve a user's to-do tasks filtered by completion status and sorted by criteria
		 *
		 * @param integer $owner_guid GUID of the task owner
		 * @param string  $status     Filter status ('all', 'pending', or 'completed')
		 * @param string  $sort       Sort order ('newest', 'oldest', 'priority', or 'due_date')
		 *
		 * @return array|boolean Array of OssnObject instances, or false if none found
		 */
		public function getUserTodos($owner_guid, $status = 'all', $sort = 'newest') {
				$params = array(
						'owner_guid' => (int) $owner_guid,
						'type'       => 'user',
						'subtype'    => 'ossntodo',
						'page_limit' => false,
						'order_by'   => $sort === 'oldest' ? 'o.guid ASC' : 'o.guid DESC',
				);
				if($status === 'pending') {
						$params['entities_pairs'] = array(
								array(
										'name'  => 'is_completed',
										'value' => '0',
								),
						);
				} elseif($status === 'completed') {
						$params['entities_pairs'] = array(
								array(
										'name'  => 'is_completed',
										'value' => '1',
								),
						);
				}
				$items = $this->searchObject($params);
				if(!$items) {
						return false;
				}

				if($sort === 'priority') {
						$weights = array(
								'high'   => 1,
								'normal' => 2,
								'low'    => 3,
						);
						usort($items, function ($a, $b) use ($weights) {
								$wa = $weights[$a->priority] ?? 2;
								$wb = $weights[$b->priority] ?? 2;
								return $wa <=> $wb;
						});
				} elseif($sort === 'due_date') {
						usort($items, function ($a, $b) {
								$da = !empty($a->due_date) ? $a->due_date : '9999-12-31';
								$db = !empty($b->due_date) ? $b->due_date : '9999-12-31';
								return strcmp($da, $db);
						});
				}

				return $items;
		}

		/**
		 * Get the total count of pending (incomplete) tasks for a user
		 *
		 * @param integer $owner_guid GUID of the task owner
		 *
		 * @return integer Number of pending tasks
		 */
		public function getPendingCount($owner_guid) {
				$items = $this->getUserTodos($owner_guid, 'pending');
				return $items ? count($items) : 0;
		}

		/**
		 * Toggle the completion status ('0' or '1') of a user's to-do task
		 *
		 * @param integer $guid       GUID of the to-do object
		 * @param integer $owner_guid GUID of the task owner
		 *
		 * @return string|boolean New status ('0' or '1') on success, or false on failure
		 */
		public function toggleTodo($guid, $owner_guid) {
				$todo = ossn_get_object((int) $guid);
				if(!$todo || $todo->subtype !== 'ossntodo' || (int) $todo->owner_guid !== (int) $owner_guid) {
						return false;
				}
				$new_status               = $todo->is_completed == '1' ? '0' : '1';
				$todo->data->is_completed = $new_status;
				if($todo->save()) {
						return $new_status;
				}
				return false;
		}

		/**
		 * Delete a single to-do task owned by the specified user
		 *
		 * @param integer $guid       GUID of the to-do object
		 * @param integer $owner_guid GUID of the task owner
		 *
		 * @return boolean True on success, or false on failure
		 */
		public function deleteTodo($guid, $owner_guid) {
				$todo = ossn_get_object((int) $guid);
				if(!$todo || $todo->subtype !== 'ossntodo' || (int) $todo->owner_guid !== (int) $owner_guid) {
						return false;
				}
				return $todo->deleteObject();
		}

		/**
		 * Delete all to-do tasks belonging to a user
		 *
		 * @param integer $owner_guid GUID of the task owner
		 *
		 * @return boolean True once all tasks are removed
		 */
		public function deleteAllTodos($owner_guid) {
				$items = $this->getUserTodos($owner_guid, 'all');
				if(!$items) {
						return true;
				}
				foreach ($items as $item) {
						$item->deleteObject();
				}
				return true;
		}
}