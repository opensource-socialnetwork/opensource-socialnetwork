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
$en = array(
    'groups' => 'Groups',
    'add:group' => 'Add Group',
    'requests' => 'Requests',

    'members' => 'Members',
    'member:add:error' => 'Something went wrong! Please try again later.',
    'member:added' => 'Membership request approved!',

    'member:request:deleted' => 'Membership request declined!',
    'member:request:delete:fail' => 'Cannot decline membership request! Please try again later.',
    'membership:cancel:succes' => 'Membership request cancelled!',
    'membership:cancel:fail' => 'Cannot cancel membership request! Please try again later.',

    'group:added' => 'Successfully created the group!',
    'group:add:fail' => 'Cannot create group! Please try again later.',

    'memebership:sent' => 'Request successfully sent!',
    'memebership:sent:fail' => 'Cannot send request! Please try again later.',

    'group:updated' => 'Group has been updated!',
    'group:update:fail' => 'Cannot update group! Please try again later.',

    'group:name' => 'Group Name',
    'group:desc' => 'Group Description',
    'privacy:group:public' => 'Everyone can see this group and its posts. Only members can post to this group.',
    'privacy:group:close' => 'Everyone can see this group. Only members can post and see posts.',

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

    'close:group:notice' => 'Join this group to see the posts, photos, and comments.',
    'closed:group' => 'Closed group',
    'group:admin' => 'Admin',
	
	'title:access:private:group' => 'Group post',

	// #186 group join request message var1 = user, var2 = name of group
	'ossn:notifications:group:joinrequest' => '%s has requested to join %s',
	'ossn:group:by' => 'By:',
	
	'group:deleted' => 'Group and group contents deleted',
	'group:delete:fail' => 'Group could not be deleted',	
);
ossn_register_languages('en', $en); 
