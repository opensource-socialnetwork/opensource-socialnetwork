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
$block = new OssnBlock;
$user = input('user');
$user = ossn_user_by_guid($user);

//Admin profiles should be unblockable by 'normal' members #625
//[E] OssnBlock allows blocking of moderators #2358
if(!$user || $user->isAdmin() || $user->canModerate()){
    ossn_trigger_message(ossn_print('user:block:error'), 'error');
    redirect(REF);	
}
if ($block->addBlock(ossn_loggedin_user()->guid, $user->guid)) {
    //Blocked user should be removed from friend list #1439
    ossn_remove_friend(ossn_loggedin_user()->guid, $user->guid);
														 
    ossn_trigger_message(ossn_print('user:blocked'), 'success');
    $loggedin_user = ossn_loggedin_user();
	redirect("u/{$loggedin_user->username}/edit?section=blocking");
} else {
    ossn_trigger_message(ossn_print('user:block:error'), 'error');
    redirect(REF);
}
