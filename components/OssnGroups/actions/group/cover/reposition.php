<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
header('Content-Type: application/json');
$group = ossn_get_group_by_guid(input('group'));
if ($group->owner_guid !== ossn_loggedin_user()->guid && !ossn_isAdminLoggedin()) {
    exit;
}
if ($group->repositionCOVER($group->guid, input('top'), input('left'))) {
    $params = $group->coverParameters($group->guid);
    echo json_encode(array(
            'top' => $params[0],
            'left' => $params[1]
        ));
    exit;
}
