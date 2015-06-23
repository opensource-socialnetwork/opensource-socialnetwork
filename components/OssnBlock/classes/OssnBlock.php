<?php

/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
class OssnBlock extends OssnEntities {
    /**
     * Check if loggedin user is blocked by $user.
     *
     * @params $user entity of user a
     *
     * @return bool;
     * @access public;
     */
    public static function UserBlockCheck($user) {
        return self::isBlocked($user, ossn_loggedin_user());
    }

    /**
     * Check if loggedin user is blocked by $user.
     *
     * @params $user entity of usera
     *         $userb entity of userb
     *
     * @return bool;
     * @access public;
     */
    public static function isBlocked($usera, $userb) {
        if (isset($usera->blockedusers)) {
            $owner = json_decode($usera->blockedusers);
            $userb = $userb->guid;
            if (isset($owner) && in_array($userb, $owner)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Add new user to block.
     *
     * @params $from Guid of user, who is blocking
     *         $to Guid of user which is going to be blocked
     *
     * @return bool;
     * @access public;
     */
    public function addBlock($from, $to) {
        if ($from == $to) {
            return false;
        }
        $user = ossn_user_by_guid($from);
        $this->owner_guid = $user->guid;
        $this->type = 'user';
        $this->subtype = 'blockedusers';
        if (!isset($user->blockedusers)) {
            $this->value = '';
            $this->add();
        }
        $blocked = json_decode($user->blockedusers);

        if (in_array($to, $blocked)) {
            return false;
        }

        if (!empty($blocked)) {
            $blocked = array_merge($blocked, array($to));
        } else {
            $blocked = array($to);
        }

        $save = json_encode($blocked);
        $this->data->blockedusers = $save;

        if ($this->save()) {
            $user = ossn_loggedin_user();
            unset($user->blockedusers);
            $user->blockedusers = $save;
            $_SESSION['OSSN_USER'] = $user;

            return true;
        }
        return false;
    }

    /**
     * Remove user block
     *
     * @params $from guid of user, who blocked other
     *         $to Guid of user which is going to be unblocked
     *
     * @return bool;
     * @access public;
     */
    public function removeBlock($from, $to) {
        if ($from == $to) {
            return false;
        }
        $user = ossn_user_by_guid($from);
        $this->owner_guid = $user->guid;
        $this->type = 'user';
        $this->subtype = 'blockedusers';

        $blocked = json_decode($user->blockedusers);

        if (!in_array($to, $blocked)) {
            return false;
        }

        $key = array_search($to, $blocked);
        unset($blocked[$key]);

        $save = json_encode($blocked);
        $this->data->blockedusers = $save;

        if ($this->save()) {
            $user = ossn_loggedin_user();
            unset($user->blockedusers);
            $user->blockedusers = $save;
            $_SESSION['OSSN_USER'] = $user;

            return true;
        }
        return false;
    }

}//class