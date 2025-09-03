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

$new_owner = input('user');
$group     = ossn_get_group_by_guid(input('group'));
if ($group->owner_guid !== ossn_loggedin_user()->guid && !ossn_isAdminLoggedin()) {
    ossn_trigger_message(ossn_print('group:update:fail'), 'error');
    redirect(REF);
}

if ($group->changeOwner($new_owner, $group->guid)) {
    ossn_trigger_message(ossn_print('group:updated'));
    redirect("group/{$group->guid}/members");
} else {
    ossn_trigger_message(ossn_print('group:update:fail'), 'error');
    redirect(REF);
}
