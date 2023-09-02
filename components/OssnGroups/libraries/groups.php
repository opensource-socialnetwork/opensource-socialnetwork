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
 
/**
 * Get group by guid
 *
 * @param int $guid Group guid
 * @return object
 */
function ossn_get_group_by_guid($guid) {
    $group = new OssnGroup;
    return $group->getGroup($guid);
}
/**
 * Get group layout
 *
 * @param html $contents Content of page (html, php)
 * @return mixed data
 */
function ossn_group_layout($contents) {
    $content['content'] = $contents;
    return ossn_plugin_view('groups/page/group', $content);
}
/**
 * Get user groups (owned/member of)
 *
 * @param object $user User entity
 * @return object
 */
function ossn_get_user_groups($user) {
    if ($user) {
        $groups = new OssnGroup;
		//get user owned/member of groups #155
        return $groups->getMyGroups($user);
    }
}
/**
 * Group subpage set
 *
 * @param string $page Page name
 * @return void
 */
function ossn_group_subpage($page) {
    global $VIEW;
    $VIEW->pagePush[] = $page;
}
/**
 * Check if page is instace of group subpage
 *
 * @param string $page Page name
 * @return bool
 */
function ossn_is_group_subapge($page) {
    global $VIEW;
    if (in_array($page, $VIEW->pagePush)) {
        return true;
    }
    return false;
}
/**
 * Get group url
 *
 * @param object $group Group entity
 * @return string
 */
function ossn_group_url($group) {
    return ossn_site_url("group/{$group}/");
}
