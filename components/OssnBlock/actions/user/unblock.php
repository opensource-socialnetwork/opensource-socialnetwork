<?php
/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
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