<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$en = array(
    'groups' => 'Groups',
    'add:group' => 'Add Group',
    'requests' => 'Requests',

    'members' => 'Members',
    'member:add:error' => 'Something went wrong please try again',
    'member:added' => 'Membership approved',

    'member:request:deleted' => 'Membership successfully declined',
    'member:request:delete:fail' => 'Cannot decline membership please try again later',
    'membership:cancel:succes' => 'Membership successfully canceled',
    'membership:cancel:fail' => 'Cannot cancel membership please try again later',

    'group:added' => 'Successfully created the group',
    'group:add:fail' => 'Cannot create group',

    'memebership:sent' => 'Request successfully sent',
    'memebership:sent:fail' => 'Cannot send request',

    'group:updated' => 'Group has been updated successfully',
    'group:update:fail' => 'Cannot update group',

    'group:name' => 'Group Name',
    'group:desc' => 'Group Description',
    'privacy:group:public' => 'Any one can see the group, its post, only members can post',
    'privacy:group:close' => 'Any one can see the group, only members can post',

    'group:memb:remove' => 'Remove',
    'leave:group' => 'Leave Group',
    'join:group' => 'Join Group',
    'total:members' => 'Total Members',
    'group:members' => "Members (%s)",
    'view:all' => 'View all',
    'member:requests' => 'REQUESTS (%s)',
    'about:group' => 'Group About',
    'cancel:membership' => 'Membership cancel',

    'no:requests' => 'No Requests',
    'approve' => 'Approve',
    'decline' => 'Decline',
    'search:groups' => 'Search Groups',

    'close:group:notice' => 'Join this group to see the post, photos and comment.',
    'closed:group' => 'Closed group',
    'group:admin' => 'Admin',
	
	'title:access:private:group' => 'Group post',

	// #186 group join request message var1 = user, var2 = name of group
	'ossn:notifications:group:joinrequest' => '%s requested to join %s',
);
ossn_register_languages('en', $en); 
