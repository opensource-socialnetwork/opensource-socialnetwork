<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014-2016 SOFTLAB24 LIMITED
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$block = new OssnBlock;
$user = input('user');
if ($block->removeBlock(ossn_loggedin_user()->guid, $user)) {
    ossn_trigger_message(ossn_print('user:unblocked'), 'success');
    redirect(REF);
} else {
    ossn_trigger_message(ossn_print('user:unblock:error'), 'error');
    redirect(REF);
}