<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */

define('__OSSN_GROUPS__', ossn_route()->com . 'OssnGroups/');

/* Include group class and library */
require_once(__OSSN_GROUPS__ . 'classes/OssnGroup.php');
require_once(__OSSN_GROUPS__ . 'libraries/groups.php');
/**
 * Initialize Groups Component
 *
 * @return void;
 * @access private
 */
function ossn_groups() {
    //group css
    ossn_extend_view('css/ossn.default', 'components/OssnGroups/css/groups');

    //group js
    ossn_extend_view('js/opensource.socialnetwork', 'components/OssnGroups/js/groups');

    //group pages
    ossn_register_page('group', 'ossn_group_page');
    ossn_register_page('groups', 'ossn_groups_page');
    ossn_group_subpage('members');
    ossn_group_subpage('edit');
    ossn_group_subpage('requests');

    //group hooks
    ossn_add_hook('group', 'subpage', 'group_members_page');
    ossn_add_hook('group', 'subpage', 'group_edit_page');
    ossn_add_hook('group', 'subpage', 'group_requests_page');
    ossn_add_hook('newsfeed', "left", 'ossn_add_groups_to_newfeed');
    ossn_add_hook('search', 'type:groups', 'groups_search_handler');

    //group actions
    if (ossn_isLoggedin()) {
        ossn_register_action('group/add', __OSSN_GROUPS__ . 'actions/group/add.php');
        ossn_register_action('group/edit', __OSSN_GROUPS__ . 'actions/group/edit.php');
        ossn_register_action('group/join', __OSSN_GROUPS__ . 'actions/group/join.php');
        ossn_register_action('group/member/approve', __OSSN_GROUPS__ . 'actions/group/member/request/approve.php');
        ossn_register_action('group/member/cancel', __OSSN_GROUPS__ . 'actions/group/member/request/cancel.php');
        ossn_register_action('group/member/decline', __OSSN_GROUPS__ . 'actions/group/member/request/decline.php');

        ossn_register_action('group/cover/upload', __OSSN_GROUPS__ . 'actions/group/cover/upload.php');
        ossn_register_action('group/cover/reposition', __OSSN_GROUPS__ . 'actions/group/cover/reposition.php');
    }


    //callbacks
    ossn_register_callback('page', 'load:group', 'ossn_group_load_event');
    ossn_register_callback('page', 'load:profile', 'ossn_profile_load_event');
    ossn_register_callback('page', 'load:search', 'ossn_group_search_link');
    ossn_register_callback('user', 'delete', 'ossn_user_groups_delete');
	
    //group list in newsfeed sidebar mebu
    $groups_user = ossn_get_user_groups(ossn_loggedin_user());
    if ($groups_user) {
        foreach ($groups_user as $group) {
            $icon = ossn_site_url('components/OssnGroups/images/group.png');
            ossn_register_sections_menu('newsfeed', array(
                'text' => $group->title,
                'url' => ossn_group_url($group->guid),
                'section' => 'groups',
                'icon' => $icon
            ));
            unset($icon);
        }
    }
    //add gorup link in sidebar
    ossn_register_sections_menu('newsfeed', array(
        'text' => 'Add Group',
        'url' => 'javascript::;',
        'params' => array('id' => 'ossn-group-add'),
        'section' => 'groups',
        'icon' => ossn_site_url('components/OssnGroups/images/add.png')
    ));
    //my groups link
    /* ossn_register_sections_menu('newsfeed', array(
                                      'text' => 'My Groups',
                                      'url' => 'javascript::;',
                                      'section' => 'groups',
                                      'icon' => ossn_site_url('components/OssnGroups/images/manages.png')
                                      ));*/

}

/**
 * Group search page handler
 *
 * @return mixdata;
 * @access private
 */
function groups_search_handler($hook, $type, $return, $params) {
    $Pagination = new OssnPagination;
    $groups = new OssnGroup;
    $data = $groups->searchGroups($params['q']);
    $Pagination->setItem($data);
    $group['groups'] = $Pagination->getItem();
    $search = ossn_view('components/OssnGroups/search/view', $group);
    $search .= $Pagination->pagination();
    if (empty($data)) {
        return 'No result found';
    }
    return $search;
}

/**
 * Call event on group load
 *
 * @return void;
 * @access private
 */
function ossn_group_load_event($event, $type, $params) {
    $owner = ossn_get_page_owner_guid();
    $url = ossn_site_url();
    ossn_register_menu_link('members', 'members', ossn_group_url($owner) . 'members', 'groupheader');
}

/**
 * Add search group link on search page
 *
 * @return void;
 * @access private
 */
function ossn_group_search_link($event, $type, $params) {
    $url = OssnPagination::constructUrlArgs();
    ossn_register_menu_link('search:users', 'search:groups', "search?type=groups{$url}", 'search');
}

/**
 * Groups page handler
 *
 * Pages:
 *      groups/
 *      groups/add ( ajax )
 * @return mixdata;
 * @access private
 */
function ossn_groups_page($pages) {
    $page = $pages[0];
    if (empty($page)) {
        return false;
    }
    switch ($page) {
        case 'add':
            $params = array(
                'action' => ossn_site_url() . 'action/group/add',
                'component' => 'OssnGroups',
                'class' => 'ossn-form',
            );
            $form = ossn_view_form('add', $params, false);
            echo ossn_view('system/templates/ossnbox', array(
                'title' => ossn_print('add:group'),
                'contents' => $form,
                'callback' => '#ossn-group-submit',
            ));
            break;
        case 'cover':
            if (isset($pages[1]) && !empty($pages[1])) {
                $File = new OssnFile;
                $File->file_id = $pages[1];
                $File = $File->fetchFile();
                if (isset($File->guid)) {
                    $Cover = ossn_get_userdata("object/{$File->owner_guid}/{$File->value}");
                    header('Content-Type: image/jpeg');
                    echo file_get_contents($Cover);
                } else {
                    ossn_error_page();
                }
            }
            break;
        default:
            echo ossn_error_page();
            break;
    }
}

/**
 * Group page handler
 * This page also contain subpages like group/<guid>/members
 *
 * Pages:
 *      group/<guid>
 *      group/<guid>/<subpage>
 * Subpage need to be register seperatly.
 *
 * @return mixdata;
 * @access private
 */
function ossn_group_page($pages) {
    if (empty($pages[0])) {
        ossn_error_page();
    }
    if (!empty($pages[0]) && !empty($pages[0])
    ) {
        if (isset($pages[1])) {
            $params['subpage'] = $pages[1];
        } else {
            $params['subpage'] = '';
        }

        if (!ossn_is_group_subapge($params['subpage']) && !empty($params['subpage'])) {
            return false;
        }
        $group = ossn_get_group_by_guid($pages[0]);
        if (empty($group->guid)) {
            ossn_error_page();
        }
        ossn_set_page_owner_guid($group->guid);
        ossn_trigger_callback('page', 'load:group');


        $params['group'] = $group;
        $title = $group->title;
        $view = ossn_view('components/OssnGroups/pages/profile', $params);
        $contents['content'] = ossn_group_layout($view);
        $content = ossn_set_page_layout('contents', $contents);
        echo ossn_view_page($title, $content);
    }
}

/**
 * Group member page
 *
 * Page:
 *      group/<guid>/member
 *
 * @return mixdata;
 * @access private
 */
function group_members_page($hook, $type, $return, $params) {
    $page = $params['subpage'];
    if ($page == 'members') {
        $mod_content = ossn_view('components/OssnGroups/pages/members', $params);
        $mod = array(
            'title' => 'Members',
            'content' => $mod_content,
        );
        echo ossn_set_page_layout('module', $mod);
    }
}

/**
 * Group edit page
 *
 * Page:
 *      group/<guid>/edit
 *
 * @return mixdata;
 * @access private
 */
function group_edit_page($hook, $type, $return, $params) {
    $page = $params['subpage'];
    $group = ossn_get_group_by_guid(ossn_get_page_owner_guid());
    if ($group->owner_guid !== ossn_loggedin_user()->guid) {
        return false;
    }
    if ($page == 'edit') {
        $params = array(
            'action' => ossn_site_url() . 'action/group/edit',
            'component' => 'OssnGroups',
            'class' => 'ossn-edit-form',
            'params' => array('group' => $group)
        );
        $form = ossn_view_form('edit', $params, false);
        echo ossn_set_page_layout('module', array(
                'title' => 'Edit',
                'content' => $form,
            ));
    }
}

/**
 * Group member requests page
 *
 * Page:
 *      group/<guid>/requests
 *
 * @return mixdata;
 * @access private
 */
function group_requests_page($hook, $type, $return, $params) {
    $page = $params['subpage'];
    $group = ossn_get_group_by_guid(ossn_get_page_owner_guid());
    if ($group->owner_guid !== ossn_loggedin_user()->guid) {
        redirect("group/{$group->guid}");
    }
    if ($page == 'requests') {
        $mod_content = ossn_view('components/OssnGroups/pages/requests', array('group' => $group));
        $mod = array(
            'title' => ossn_print('requests'),
            'content' => $mod_content,
        );
        echo ossn_set_page_layout('module', $mod);
    }
}
function ossn_user_groups_delete($callback, $type, $params){
	$deleteGroup = new OssnGroup;
	$groups = $deleteGroup->getUserGroups($params['entity']->guid);
	if($groups){
		foreach($groups as $group){
			$deleteGroup->deleteGroup($group->guid);
		}
	}
}
ossn_register_callback('ossn', 'init', 'ossn_groups');
