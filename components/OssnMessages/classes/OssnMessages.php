<?php

/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */
class OssnMessages extends OssnDatabase {
    /**
     * Send message
     *
     * @params $from: User 1 guid
     *         $to User 2 guid
     *         $message Message
     *
     * @return bool;
     */
    public function send($from, $to, $message) {
	if(empty($message)){
		return false;
	}
	//send valid text to database only no html tags
	//missing reconversion of html escaped characters in messages #118
	$message = html_entity_decode($message, ENT_QUOTES, "UTF-8");
	$message = strip_tags($message);
	$message = ossn_restore_new_lines($message);
	$message = ossn_input_escape($message, false);
		
        $params['into'] = 'ossn_messages';
        $params['names'] = array(
            'message_from',
            'message_to',
            'message',
            'time',
            'viewed'
        );
        $params['values'] = array(
            (int)$from,
            (int)$to,
            $message,
            time(),
            '0'
        );
        if ($this->insert($params)) {
		$this->lastMessage = $this->getLastEntry();
            return true;
        }
        return false;
    }

    /**
     * Mark message as viewed
     *
     * @params $from: User 1 guid
     *         $to User 2 guid
     *
     * @return bool
     */
    public function markViewed($from, $to) {
        $params['table'] = 'ossn_messages';
        $params['names'] = array('viewed');
        $params['values'] = array(1);
        $params['wheres'] = array(
            "message_from='{$from}' AND
								   message_to='{$to}'"
        );
        if ($this->update($params)) {
            return true;
        }
        return false;
    }

    /**
     * Get new messages
     *
     * @params $from: User 1 guid
     *         $to User 2 guid
     *
     * @return bool
     */
    public function getNew($from, $to, $viewed = 0) {
        $params['from'] = 'ossn_messages';
        $params['wheres'] = array(
            "message_from='{$from}' AND
								   message_to='{$to}' AND viewed='{$viewed}'"
        );
        return $this->select($params, true);
    }

    /**
     * Get recently chat list
     *
     * @params  $to User 2 guid
     *
     * @return object
     */
    public function recentChat($to) {
        $params['from'] = 'ossn_messages';
        $params['wheres'] = array("message_to='{$to}' OR message_from='{$to}'");
        $params['order_by'] = "id DESC";
        $chats = $this->select($params, true);
        if (!$chats) {
            return false;
        }
        foreach ($chats as $rec) {
            $recents[$rec->message_from] = $rec->message_to;
        }
        foreach ($recents as $k => $v) {
            if ($k !== $to) {
                $message_get = $this->get($to, $k);
                if ($message_get) {
                    $latest = get_object_vars($message_get);
                    $latest = array_reverse($latest);
                    $latest = arrayObject($latest[0]);
                    $c = get_object_vars($latest);
                    if (!empty($c)) {
                        $users[] = $latest;
                    }
                }
            }
        }
        if (isset($users)) {
            return $users;
        }
        return false;
    }

    /**
     * Get messages between two users
     *
     * @params $from: User 1 guid
     *         $to User 2 guid
     *
     * @return object
     */
    public function get($from, $to) {
        $params['from'] = 'ossn_messages';
        $params['wheres'] = array(
            "message_from='{$from}' AND
								  message_to='{$to}' OR
								  message_from='{$to}' AND
								  message_to='{$from}'"
        );
        $params['order_by'] = "id ASC";
        return $this->select($params, true);
    }

    /**
     * Get recent sent messages
     *
     * @params  $from User 1 guid
     *
     * @return object
     */
    public function recentSent($from) {
        $params['from'] = 'ossn_messages';
        $params['wheres'] = array("message_from='{$from}'");
        $params['order_by'] = "id DESC";
        $c = $this->select($params, true);
        foreach ($c as $rec) {
            $r[$rec->message_from] = $rec->message_to;
        }
        return $r;
    }

    /**
     * Count unread messages
     *
     * @params  integer $to Users guid
     *
     * @return object
     */
    public function countUNREAD($to) {
        $params['from'] = 'ossn_messages';
        $params['wheres'] = array("message_to='{$to}'AND viewed='0'");
        $params['params'] = array('count(*) as new');
        $count = $this->select($params, true);
        return $count->{0}->new;
    }
	/**
     * Get message by id
     *
     * @params  integer $id ID of message
     *
     * @return object
     */
	public function getMessage($id){
        $params['from'] = 'ossn_messages';
        $params['wheres'] = array("id='{$id}'");
        $get = $this->select($params);
		if($get){
			return $get;
		}
		return false;
	}
}//class
