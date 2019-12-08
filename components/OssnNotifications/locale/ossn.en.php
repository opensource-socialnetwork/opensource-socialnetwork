<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$en = array(
	'ossnnotifications' => 'Notifications',
    'ossn:notifications:comments:post' => "%s commented on the post.",
    'ossn:notifications:like:post' => "%s liked your post.",
    'ossn:notifications:like:annotation' => "%s liked your comment.",
    'ossn:notifications:like:entity:file:ossn:aphoto' => "%s liked your photo.",
    'ossn:notifications:comments:entity:file:ossn:aphoto' => '%s commented on your photo.',
    'ossn:notifications:wall:friends:tag' => '%s tagged you in a post.',
    'ossn:notification:are:friends' => 'You are now friends!',
    'ossn:notifications:comments:post:group:wall' => "%s commented on the group post.",
    'ossn:notifications:like:entity:file:profile:photo' => "%s liked your profile photo.",
    'ossn:notifications:comments:entity:file:profile:photo' => "%s commented your the profile photo.",
    'ossn:notifications:like:entity:file:profile:cover' => "%s liked your profile cover.",
    'ossn:notifications:comments:entity:file:profile:cover' => "%s commented on your profile cover.",

    'ossn:notifications:like:post:group:wall' => '%s liked your post.',
	
    'ossn:notification:delete:friend' => 'Friend request deleted!',
    'notifications' => 'Notifications',
    'see:all' => 'See All',
    'friend:requests' => 'Friend Requests',
    'ossn:notifications:friendrequest:confirmbutton' => 'Confirm',
    'ossn:notifications:friendrequest:denybutton' => 'Deny',
	
    'ossn:notification:mark:read:success' => 'Successfully marked all as read',
    'ossn:notification:mark:read:error' => 'Can not mark all as read',
    
    'ossn:notifications:mark:as:read' => 'Mark all as read',
	'ossn:notifications:admin:settings:close_anywhere:title' => 'Close notification windows by clicking anywhere',
	'ossn:notifications:admin:settings:close_anywhere:note' => '<i class="fa fa-info-circle"></i> closes any notification window by clicking anywhere on the page<br><br>',
);
ossn_register_languages('en', $en); 
