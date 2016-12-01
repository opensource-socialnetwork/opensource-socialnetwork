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
$add = new OssnGroup;
$group = input('group');
$user = input('user');

if (ossn_get_group_by_guid($group)->owner_guid !== ossn_loggedin_user()->guid && !ossn_isAdminLoggedin()) {
    ossn_trigger_message(ossn_print('member:add:error'), 'error');
    redirect(REF);
}
if ($add->deleteMember($user, $group)) {
    ossn_trigger_message(ossn_print('member:request:deleted'), 'success');
    redirect(REF);
} else {
    ossn_trigger_message(ossn_print('member:request:delete:fail'), 'error');
    redirect(REF);
}
