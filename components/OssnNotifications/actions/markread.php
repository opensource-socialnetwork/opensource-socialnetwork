<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2016 SOFTLAB24 LIMITED
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 $user = ossn_loggedin_user();
 $notification = new OssnNotifications;
 if($notification->clearAll($user->guid)){
	ossn_trigger_message(ossn_print('ossn:notification:mark:read:success'));
	redirect(REF);	 
 } else {
	ossn_trigger_message(ossn_print('ossn:notification:mark:read:error'), 'error');
	redirect(REF);	 
 }