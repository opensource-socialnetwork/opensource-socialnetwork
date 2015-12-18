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
$block = new OssnBlock;
$user = input('user');
$user = ossn_user_by_guid($user);

//Admin profiles should be unblockable by 'normal' members #625
if(!$user || $user->isAdmin()){
    ossn_trigger_message(ossn_print('user:block:error'), 'error');
    redirect(REF);	
}
if ($block->addBlock(ossn_loggedin_user()->guid, $user->guid)) {
    ossn_trigger_message(ossn_print('user:blocked'), 'success');
    redirect(REF);
} else {
    ossn_trigger_message(ossn_print('user:block:error'), 'error');
    redirect(REF);
}