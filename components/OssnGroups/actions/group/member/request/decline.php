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
$add = new OssnGroup;
$group = input('group');
$user = input('user');
$group = ossn_get_group_by_guid($group);
if ($group->owner_guid !== ossn_loggedin_user()->guid && !ossn_isAdminLoggedin() && !$group->isModerator(ossn_loggedin_user()->guid)) {
    ossn_trigger_message(ossn_print('member:add:error'), 'error');
    redirect(REF);
}
if ($add->deleteMember($user, $group->guid)) {
    ossn_trigger_message(ossn_print('member:request:deleted'), 'success');
    redirect(REF);
} else {
    ossn_trigger_message(ossn_print('member:request:delete:fail'), 'error');
    redirect(REF);
}
