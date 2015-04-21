<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
class OssnNotifications extends OssnDatabase {
    /**
     * Add notification to database
     *
     * @params $subject_id: Id of item which user comment
     *         $poster_guid: Guid of item poster
     *         $item_guid: Guid of item
     *         $notification_owner: Guid of notification owner
     *
     * @return bool;
     */
    public function add($type, $poster_guid, $subject_guid, $item_guid = NULL, $notification_owner = '') {
        if (!empty($type) && !empty($subject_guid) && !empty($poster_guid)) {
			$vars = array(
						  'type' => $type,
						  'poster_guid' => $poster_guid,
						  'owner_guid' => null,
						  'item_guid' => $item_guid,
						  'subject_guid' => $subject_guid,
						  'notification_owner' => $notification_owner,
						  );
			$this->notification = ossn_call_hook('notification:add', $type, $vars);
			if(!$this->notification){
				return false;
			}		
			//check if owner_guid is empty or owner_guid is same as poster_guid then return false, 
			if(empty($this->notification['owner_guid']) || 
				$this->notification['owner_guid'] == $this->notification['poster_guid']){
				return false;
			}
            //check if notification owner is set then use it.
            if (!empty($this->notification['notification_owner'])) {
                $this->notification['owner_guid'] = $this->notification['notification_owner'];
            }
            if ($poster_guid == $guid_two) {
                $paricipates = $this->get_comments_participates($subject_guid);
                if ($type !== 'like:post' && $paricipates) {
                    foreach ($paricipates as $partcipate) {
                        $params['into'] = 'ossn_notifications';
                        $params['names'] = array(
                            'type',
                            'poster_guid',
                            'owner_guid',
                            'subject_guid',
                            'item_guid',
                            'time_created'
                        );
                        $params['values'] = array(
                            $this->notification['type'],
                            $this->notification['poster_guid'],
                            $partcipate,
                            $this->notification['subject_guid'],
                            $this->notification['item_guid'],
                            time()
                        );
                        if ($partcipate !== $poster_guid) {
                            $this->insert($params);
                        }
                    }
                }
                return false;
            }

            $params['into'] = 'ossn_notifications';
            $params['names'] = array(
                'type',
                'poster_guid',
                'owner_guid',
                'subject_guid',
                'item_guid',
                'time_created'
            );
            $params['values'] = array(
                $this->notification['type'],
                $this->notification['poster_guid'],
                $this->notification['owner_guid'],
                $this->notification['subject_guid'],
                $this->notification['item_guid'],
                time()
            );
            if ($this->insert($params)) {
                $paricipates = $this->get_comments_participates($subject_guid);
                if ($type !== 'like:post' && $paricipates) {
                    foreach ($paricipates as $partcipate) {
                        $params['into'] = 'ossn_notifications';
                        $params['names'] = array(
                            'type',
                            'poster_guid',
                            'owner_guid',
                            'subject_guid',
                            'item_guid',
                            'time_created'
                        );
                        $params['values'] = array(
                            $this->notification['type'],
                            $this->notification['poster_guid'],
                            $partcipate,
                            $this->notification['subject_guid'],
                            $this->notification['item_guid'],
                            time()
                        );
                        if ($partcipate !== $poster_guid) {
                            $this->insert($params);
                        }
                    }
                }
                return true;
            }
        }
        return false;
    }

    /**
     * Get comments participates
     *
     * @params $subject_id: Id of item which user comment
     *
     * @return array;
     */
    public function get_comments_participates($subject_guid) {
        $params['from'] = 'ossn_notifications';
        $params['wheres'] = array("type='comments:post' AND subject_guid='{$subject_guid}'");
        $users = $this->select($params, true);
        $participates = array();
        if ($users) {
            foreach ($users as $user) {
                $participates[] = $user->poster_guid;
            }
            return array_unique($participates);
        }
    }

    /**
     * Get notifications
     *
     * @params $guid_two User guid
     *         $poster_guid: Guid of item poster;
     *
     * @return array
     */
    public function get($guid_two, $unread = false) {
		$getunread = '';
		if($unread === true){
			$getunread = "AND viewed IS NULL";
		}
        $baseurl = ossn_site_url();
        $this->statement("SELECT * FROM ossn_notifications WHERE(
		                  owner_guid='{$guid_two}' {$getunread}) ORDER by guid DESC");
        $this->execute();
        $get = $this->fetch(true);
        if (!$get) {
            return false;
        }
        foreach ($get as $notif) {
            if (ossn_is_hook('notification:view', $notif->type)) {
                $messages[] = ossn_call_hook('notification:view', $notif->type, $notif);
            }
        }
        return $messages;
    }

    /**
     * Count user notification


     *
     * @params $guid: Count user notifications
     *
     * @return int;
     */
    public function countNotification($guid) {
        $notifications = $this->get($guid, true);
        if ($notifications) {
            $count = count($notifications);
            if ($count > 0) {
                return $count;
            }
        }
        return false;
    }

    /**
     * Get notitication by guid
     *
     * @params $guid: Notification guid
     *
     * @return object;
     */
    public function getbyGUID($guid) {
        $this->statement("SELECT * FROM ossn_notifications WHERE(guid='{$guid}');");
        $this->execute();
        $data = $this->fetch();
        return $data;
    }

    /**
     * Mark notification as viewd
     *
     * @params $guid: Notification guid
     *
     * @return object;
     */
    public function setViewed($guid) {
        $this->statement("UPDATE ossn_notifications SET viewed='' WHERE(guid='{$guid}');");
        if ($this->execute()) {
            return true;
        }
        return false;
    }
    /**
     * Delete user notifications
     *
     * @param (object) $user User entity
     *
     * @return bool;
     */	
	public function deleteUserNotifications($user){
		if($user){
			$this->statement("DELETE FROM ossn_notifications WHERE(
							  poster_guid='{$user->guid}' OR owner_guid='{$user->guid}');");
			if($this->execute()){
				return true;
			}
		}
		return false;
	}

}
