<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@Open Source Social Network.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.Open Source Social Network.org/licence
 */
header('Content-Type: application/json');
$group = ossn_get_group_by_guid(input('group'));
if ($group->owner_guid !== ossn_loggedin_user()->guid) {
    exit;
}
if ($group->repositionCOVER($group->guid, input('top'), input('left'))) {
    $params = $group->coverParameters($group->guid);
    echo json_encode(array(
            'top' => $params[0],
            'left' => $params[1]
        ));
}
