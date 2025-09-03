<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
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
    'group:memb:make:owner' => 'Make group owner',
    'group:memb:make:owner:confirm' => 'Attention! This action will make >> %s << the new owner of the group and you will lose all of your group admin privileges. Are you sure to proceed?',
    'group:memb:make:owner:admin:confirm' => 'Attention! This action will make >> %s << the new owner of the group and the former owner will lose all of his group admin privileges. Are you sure to proceed?',
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

	'group:delete:cover' => 'Delete Cover',
	'group:delete:cover:error' => 'An error occurred while deleting the cover image',
	'group:delete:cover:success' => 'The cover image was successfully deleted',

);
ossn_register_languages('en', $en); 
