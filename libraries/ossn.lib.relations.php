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

/**
 * Ossn Add Relations
 *
 * @params $from => relation from guid
 *         $to => relation to guid
 *         $type => relation type
 * @param string $type
 *
 * @return bool
 */
function ossn_add_relation($from, $to, $type) {
    if ($from > 0 && $to > 0 && !empty($type) && $type !== 0) {
        $add = new OssnDatabase;
        $params['into'] = 'ossn_relationships';
        $params['names'] = array(
            'relation_from',
            'relation_to',
            'type',
            'time'
        );
        $params['values'] = array(
            $from,
            $to,
            $type,
            time()
        );
        if ($add->insert($params)) {
            return true;
        }
    }
    return false;
}
/**
 * Delete user relations if user is deleted
 *
 * @param  OssnUser $user Entity of user 
 *
 * @return bool
 */
function ossn_delete_user_relations($user) {
    if ($user) {
        $delete = new OssnDatabase;
        $params['from'] = 'ossn_relationships';
        //delete friend requests and group member requests if user deleted
        $params['wheres'] = array(
            "relation_from='{$user->guid}' AND type='friend:request' OR",
            "relation_to='{$user->guid}' AND type='friend:request' OR",
            "relation_from='{$user->guid}' AND type='group:join' OR",
            "relation_to='{$user->guid}' AND type='group:join:approve'"
        );
        if ($delete->delete($params)) {
            return true;
        }
    }
    return false;
}
/**
 * Delete group relations if user is deleted
 *
 * @param  (object) $group Group Entity
 *
 * @return bool
 */
function ossn_delete_group_relations($group){
    if ($group) {
        $delete = new OssnDatabase;
        $params['from'] = 'ossn_relationships';
        //delete group member requests if group deleted
        $params['wheres'] = array(
            "relation_from='{$group->guid}' AND type='group:join:approve' OR",
            "relation_to='{$group->guid}' AND type='group:join'"
        );
        if ($delete->delete($params)) {
            return true;
        }
    }
    return false;	
}