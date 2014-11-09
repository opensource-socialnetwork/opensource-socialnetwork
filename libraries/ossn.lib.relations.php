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

/**
 * Ossn Add Relations
 *
 * @params $from => relation from guid
 *         $to => relation to guid
 *         $type => relation type
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

function ossn_delete_user_relations($user){
	if($user){
	     $delete = new OssnDatabase;	
		 $params['from'] = 'ossn_relationships';
		 $params['wheres'] = array(
		    "relation_from='{$user->guid}' OR", 
		    "relation_to='{$user->guid}'"
		  );
		 if($delete->delete($params)){
			 return true;
		 }
	}
	return false;
}