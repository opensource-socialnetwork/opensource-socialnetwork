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
class OssnPoke extends OssnDatabase {
    /**
     * Add poke
     *
     * @params $poker guid of user who is trying to poke
     *         $owner guid of user who is going to be poked
     *
     * @return bool;
     * @access public;
     */
    public function addPoke($poker, $owner) {
        /*
        * Check if user is blocked or not
        */
        if (com_is_active('OssnBlock')) {
            $user = ossn_user_by_guid($owner);
            if (OssnBlock::UserBlockCheck($user)) {
                return false;
            }
        }
        /*
        * Send notification
        */
        $type = 'ossnpoke:poke';
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
            $type,
            $poker,
            $owner,
            NULL,
            NULL,
            time()
        );
        if ($this->insert($params)) {
            return true;
        }
        return false;
    }

}