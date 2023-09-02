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

define('__OSSN_GROUPS__', ossn_route()->com . 'OssnGroups/');

/* Include group class and library */
require_once __OSSN_GROUPS__ . 'classes/OssnGroup.php';
require_once __OSSN_GROUPS__ . 'libraries/groups.php';
/**
 * Initialize Groups Component
 *
 * @return void;
 * @access private
 */
function ossn_groups() {
		//group css
		ossn_extend_view('css/ossn.default', 'css/groups');

		//group js
		ossn_extend_view('js/ossn.site', 'js/groups');

		//group pages
		ossn_register_page('group', 'ossn_group_page');
		ossn_register_page('groups', 'ossn_groups_page');
		ossn_group_subpage('about');
		ossn_group_subpage('members');
		ossn_group_subpage('edit');
		ossn_group_subpage('requests');

		//group hooks
		ossn_add_hook('group', 'subpage', 'group_subpage_access_validate');
		ossn_add_hook('group', 'subpage', 'group_about_page');
		ossn_add_hook('group', 'subpage', 'group_members_page');
		ossn_add_hook('group', 'subpage', 'group_edit_page');
		ossn_add_hook('group', 'subpage', 'group_requests_page');
		ossn_add_hook('newsfeed', 'left', 'ossn_add_groups_to_newfeed');
		ossn_add_hook('search', 'type:groups', 'groups_search_handler');
		ossn_add_hook('notification:add', 'comments:post:group:wall', 'ossn_notificaiton_groups_comments_hook');
		ossn_add_hook('notification:add', 'like:post:group:wall', 'ossn_notificaiton_groups_comments_hook');
		ossn_add_hook('notification:view', 'group:joinrequest', 'ossn_group_joinrequest_notification');

		//group actions
		if(ossn_isLoggedin()) {
				ossn_register_action('group/add', __OSSN_GROUPS__ . 'actions/group/add.php');
				ossn_register_action('group/edit', __OSSN_GROUPS__ . 'actions/group/edit.php');
				ossn_register_action('group/join', __OSSN_GROUPS__ . 'actions/group/join.php');
				ossn_register_action('group/delete', __OSSN_GROUPS__ . 'actions/group/delete.php');
				ossn_register_action('group/change_owner', __OSSN_GROUPS__ . 'actions/group/change_owner.php');
				ossn_register_action('group/member/approve', __OSSN_GROUPS__ . 'actions/group/member/request/approve.php');
				ossn_register_action('group/member/cancel', __OSSN_GROUPS__ . 'actions/group/member/request/cancel.php');
				ossn_register_action('group/member/decline', __OSSN_GROUPS__ . 'actions/group/member/request/decline.php');

				ossn_register_action('group/cover/upload', __OSSN_GROUPS__ . 'actions/group/cover/upload.php');
				ossn_register_action('group/cover/reposition', __OSSN_GROUPS__ . 'actions/group/cover/reposition.php');
				ossn_register_action('group/cover/delete', __OSSN_GROUPS__ . 'actions/group/cover/delete.php');

				//[E] Enhance group menu entries in sidebar #2072
				//only for loggedin users.
				ossn_register_callback('menu', 'section:before:view', 'ossn_group_sidebar_entries');
		}

		//callbacks
		ossn_register_callback('page', 'load:group', 'ossn_group_load_event');
		ossn_register_callback('page', 'load:search', 'ossn_group_search_link');
		ossn_register_callback('user', 'delete', 'ossn_user_groups_delete');
}

function ossn_group_sidebar_entries($event, $type, $params) {
		// using priority hack here to make the groups menu appear at the old known position :)
		// otherwise it's moved to the end because other component menus register earlier the old way
		// of course in longer terms those components may use the same callback too,
		// so things will be arranged as before
		$priority = 100;

		//group list in newsfeed sidebar mebu
		$groups_user = ossn_get_user_groups(ossn_loggedin_user());
		if($groups_user) {
				foreach($groups_user as $group) {
						$icon = ossn_site_url('components/OssnGroups/images/group.png');
						ossn_register_sections_menu('newsfeed', array(
								'text'     => $group->title,
								'name'     => 'groups',
								'url'      => ossn_group_url($group->guid),
								'parent'   => 'groups',
								'icon'     => $icon,
								'priority' => $priority++,
						));
						unset($icon);
				}
		}
		//add gorup link in sidebar
		ossn_register_sections_menu('newsfeed', array(
				'name'     => 'addgroup',
				'text'     => ossn_print('add:group'),
				'url'      => 'javascript:void(0);',
				'id'       => 'ossn-group-add',
				'parent'   => 'groups',
				'icon'     => ossn_site_url('components/OssnGroups/images/add.png'),
				'priority' => $priority++,
		));
		//Create link in nav to list all groups #990
		ossn_register_sections_menu('newsfeed', array(
				'name'     => 'allgroups',
				'text'     => ossn_print('groups'),
				'url'      => ossn_site_url('search?type=groups&q='),
				'parent'   => 'groups',
				'icon'     => true,
				'priority' => $priority++,
		));
}

/**
 * Group search page handler
 *
 * @return mixdata;
 * @access private
 */
function groups_search_handler($hook, $type, $return, $params) {
		$groups = new OssnGroup();
		$data   = $groups->searchGroups($params['q']);
		$count  = $groups->searchGroups($params['q'], array(
				'count' => true,
		));

		$group['groups'] = $data;
		$search          = ossn_plugin_view('groups/search/view', $group);
		$search .= ossn_view_pagination($count);
		if(empty($data)) {
				return ossn_print('ossn:search:no:result');
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
		$url   = ossn_site_url();
		ossn_register_menu_link('about', 'about:group', ossn_group_url($owner) . 'about', 'groupheader');
		ossn_register_menu_link('members', 'members', ossn_group_url($owner) . 'members', 'groupheader');
		// show 'Requests' menu tab only on pending requests
		$group = ossn_get_group_by_guid($owner);
		// removed && $group->countRequests()
		if(ossn_isLoggedin() && $group) {
				if($group->owner_guid == ossn_loggedin_user()->guid || ossn_isAdminLoggedin() || $group->isModerator(ossn_loggedin_user()->guid)) {
						ossn_register_menu_link('requests', 'requests', ossn_group_url($owner) . 'requests', 'groupheader');
				}
		}
}

/**
 * Add search group link on search page
 *
 * @return void;
 * @access private
 */
function ossn_group_search_link($event, $type, $params) {
		$url = OssnPagination::constructUrlArgs(array(
				'type',
		));
		ossn_register_menu_link('groups', 'groups', "search?type=groups{$url}", 'search');
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
		if(empty($page)) {
				return false;
		}
		switch($page) {
			case 'add':
				$params = array(
						'action'    => ossn_site_url() . 'action/group/add',
						'component' => 'OssnGroups',
						'class'     => 'ossn-form',
				);
				$form = ossn_view_form('add', $params, false);
				echo ossn_plugin_view('output/ossnbox', array(
						'title'    => ossn_print('add:group'),
						'contents' => $form,
						'callback' => '#ossn-group-submit',
				));
				break;
			case 'cover':
				if(isset($pages[1]) && !empty($pages[1])) {
						$File          = new OssnFile();
						$File->guid    = $pages[1];
						$File          = $File->getFile();

						if($File && $File->type == 'object' && $File->subtype == 'file:cover') {
								$File->output();
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
		if(empty($pages[0])) {
				ossn_error_page();
		}
		if(!empty($pages[0])) {
				if(isset($pages[1])) {
						$params['subpage'] = $pages[1];
				} else {
						$params['subpage'] = '';
				}

				if(!ossn_is_group_subapge($params['subpage']) && !empty($params['subpage'])) {
						ossn_error_page();
				}
				$group = ossn_get_group_by_guid($pages[0]);
				if(empty($group->guid)) {
						ossn_error_page();
				}
				ossn_set_page_owner_guid($group->guid);
				ossn_trigger_callback('page', 'load:group', array(
								'group' => $group, //added OSSN 7.1
				));
				$ismember = false;
				if(ossn_isLoggedin()){
					$ismember = $group->isMember(NULL, ossn_loggedin_user()->guid);	
				}
				//[B] add group user membership status in advance to avoid checking multiple times #2276
				$params['ismember'] = $ismember;
				$params['group'] = $group;
				$title           = $group->title;
				$view            = ossn_plugin_view('groups/pages/profile', $params);
				$content         = ossn_group_layout($view);
				echo ossn_view_page($title, $content);
		}
}

/**
 * Group about page
 *
 * Page:
 *      group/<guid>/about
 *
 * @return mixdata;
 * @access private
 */
function group_about_page($hook, $type, $return, $params) {
		$page = $params['subpage'];
		if($page == 'about') {
				$mod_content = ossn_plugin_view('groups/pages/about', $params);
				$mod         = array(
						'title'   => ossn_print('about:group'),
						'content' => $mod_content,
				);
				echo ossn_set_page_layout('module', $mod);
		}
}
/**
 * Restrict access to group subpages if user is not a member and its private group
 *
 * @return void
 * @access private
 */
function group_subpage_access_validate($hook, $type, $return, $params){
	        if($params['group']->membership == OSSN_PRIVATE && !$params['ismember']){
						redirect("group/{$params['group']->guid}/");	
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
		if($page == 'members') {
				$mod_content = ossn_plugin_view('groups/pages/members', $params);
				$mod         = array(
						'title'   => ossn_print('members'),
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
		$page  = $params['subpage'];
		$group = ossn_get_group_by_guid(ossn_get_page_owner_guid());
		if(ossn_isLoggedin()) {
				if($group->owner_guid !== ossn_loggedin_user()->guid && !ossn_isAdminLoggedin()) {
						return false;
				}
		}
		if($page == 'edit') {
				$params = array(
						'action'    => ossn_site_url() . 'action/group/edit',
						'component' => 'OssnGroups',
						'class'     => 'ossn-edit-form',
						'params'    => array(
								'group' => $group,
						),
				);
				$form = ossn_view_form('edit', $params, false);
				echo ossn_set_page_layout('module', array(
						'title'   => ossn_print('edit'),
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
		$page  = $params['subpage'];
		$group = ossn_get_group_by_guid(ossn_get_page_owner_guid());
		if($page == 'requests') {
				if($group->owner_guid !== ossn_loggedin_user()->guid && !$group->isModerator(ossn_loggedin_user()->guid) && !ossn_isAdminLoggedin()) {
						redirect("group/{$group->guid}");
				}
				$mod_content = ossn_plugin_view('groups/pages/requests', array(
						'group' => $group,
				));
				$mod = array(
						'title'   => ossn_print('requests'),
						'content' => $mod_content,
				);
				echo ossn_set_page_layout('module', $mod);
		}
}
/**
 * Group delete callback
 *
 * @param string $callback Callback name
 * @param string $type Callback type
 * @param array Callback data
 *
 * @return void;
 * @access private
 */
function ossn_user_groups_delete($callback, $type, $params) {
		$deleteGroup = new OssnGroup();
		$groups      = $deleteGroup->getUserGroups($params['entity']->guid, array(
				'page_limit' => false,
		));
		if($groups) {
				foreach($groups as $group) {
						$deleteGroup->deleteGroup($group->guid);
				}
		}
}
/**
 * Group comments/likes notification hook
 *
 * @param string $hook Hook name
 * @param string $type Hook type
 * @param array Callback data
 *
 * @return array or false;
 * @access public
 */
function ossn_notificaiton_groups_comments_hook($hook, $type, $return, $params) {
		$object              = new OssnObject();
		$object->object_guid = $params['subject_guid'];
		$object              = $object->getObjectById();
		if($object) {
				$params['owner_guid'] = $object->poster_guid;
				return $params;
		}
		return false;
}

// #186 group join request hook
function ossn_group_joinrequest_notification($name, $type, $return, $params) {
		$baseurl        = ossn_site_url();
		$user           = ossn_user_by_guid($params->poster_guid);
		$user->fullname = "<strong>{$user->fullname}</strong>";
		$group          = ossn_get_group_by_guid($params->subject_guid);
		$img            = "<div class='notification-image'><img src='{$baseurl}avatar/{$user->username}/small' /></div>";
		$type           = "<div class='ossn-groups-notification-icon'></div>";
		if($params->viewed !== null) {
				$viewed = '';
		} elseif($params->viewed == null) {
				$viewed = 'class="ossn-notification-unviewed"';
		}
		// lead directly to groups request page
		$url               = "{$baseurl}group/{$params->subject_guid}/requests";
		$notification_read = "{$baseurl}notification/read/{$params->guid}?notification=" . urlencode($url);
		return "<a href='{$notification_read}' class='ossn-group-notification-item'>
	       <li {$viewed}> {$img}
		   <div class='notfi-meta'> {$type}
		   <div class='data'>" .
		ossn_print("ossn:notifications:{$params->type}", array(
				$user->fullname,
				$group->title,
		)) .
				'</div>
		   </div></li></a>';
}
/**
 * Delete group relations if user is deleted
 *
 * @param  (object) $group Group Entity
 *
 * @return bool
 */
function ossn_delete_group_relations($group) {
		if($group) {
				$delete           = new OssnDatabase;
				$params['from']   = 'ossn_relationships';
				//delete group member requests if group deleted
				$params['wheres'] = array(
						"relation_from='{$group->guid}' AND type='group:join:approve' OR",
						"relation_to='{$group->guid}' AND type='group:join'"
				);
				if($delete->delete($params)) {
						return true;
				}
		}
		return false;
}
ossn_register_callback('ossn', 'init', 'ossn_groups');
