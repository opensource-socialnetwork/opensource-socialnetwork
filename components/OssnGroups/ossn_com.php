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
		ossn_extend_view('css/ossn.default', 'css/groups');
		
		//group js
		ossn_extend_view('js/opensource.socialnetwork', 'js/groups');
		
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
		ossn_add_hook('notification:add', 'comments:post:group:wall', 'ossn_notificaiton_groups_comments_hook');
		ossn_add_hook('notification:add', 'like:post:group:wall', 'ossn_notificaiton_groups_comments_hook');
		ossn_add_hook('notification:view', 'group:joinrequest', 'ossn_group_joinrequest_notification');
		
		//group actions
		if(ossn_isLoggedin()) {
				ossn_register_action('group/add', __OSSN_GROUPS__ . 'actions/group/add.php');
				ossn_register_action('group/edit', __OSSN_GROUPS__ . 'actions/group/edit.php');
				ossn_register_action('group/join', __OSSN_GROUPS__ . 'actions/group/join.php');
				ossn_register_action('group/delete', __OSSN_GROUPS__ . 'actions/group/delete.php');
				ossn_register_action('group/member/approve', __OSSN_GROUPS__ . 'actions/group/member/request/approve.php');
				ossn_register_action('group/member/cancel', __OSSN_GROUPS__ . 'actions/group/member/request/cancel.php');
				ossn_register_action('group/member/decline', __OSSN_GROUPS__ . 'actions/group/member/request/decline.php');
				
				ossn_register_action('group/cover/upload', __OSSN_GROUPS__ . 'actions/group/cover/upload.php');
				ossn_register_action('group/cover/reposition', __OSSN_GROUPS__ . 'actions/group/cover/reposition.php');
		}
		
		
		//callbacks
		ossn_register_callback('page', 'load:group', 'ossn_group_load_event');
		ossn_register_callback('page', 'load:search', 'ossn_group_search_link');
		ossn_register_callback('user', 'delete', 'ossn_user_groups_delete');
		
		//group list in newsfeed sidebar mebu
		$groups_user = ossn_get_user_groups(ossn_loggedin_user());
		if($groups_user) {
				foreach($groups_user as $group) {
						$icon = ossn_site_url('components/OssnGroups/images/group.png');
						ossn_register_sections_menu('newsfeed', array(
								'text' => $group->title,
								'name' => "groups",
								'url' => ossn_group_url($group->guid),
								'parent' => 'groups',
								'icon' => $icon
						));
						unset($icon);
				}
		}
		//add gorup link in sidebar
		ossn_register_sections_menu('newsfeed', array(
				'name' => 'addgroup',
				'text' => ossn_print('add:group'),
				'url' => 'javascript:void(0);',
				'id' => 'ossn-group-add',
				'parent' => 'groups',
				'icon' => ossn_site_url('components/OssnGroups/images/add.png')
		));
		//Create link in nav to list all groups #990
		ossn_register_sections_menu('newsfeed', array(
				'name' => 'allgroups',
				'text' => ossn_print('groups'),
				'url' => ossn_site_url('search?type=groups&q='),
				'parent' => 'groups',
				'icon' => true,
		));		
		//my groups link
		/* ossn_register_sections_menu('newsfeed', array(
		'text' => 'My Groups',
		'url' => 'javascript:void(0);',
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
		$groups     = new OssnGroup;
		$data       = $groups->searchGroups($params['q']);
		$Pagination->setItem($data);
		$group['groups'] = $Pagination->getItem();
		$search          = ossn_plugin_view('groups/search/view', $group);
		$search .= $Pagination->pagination();
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
		ossn_register_menu_link('members', 'members', ossn_group_url($owner) . 'members', 'groupheader');
}

/**
 * Add search group link on search page
 *
 * @return void;
 * @access private
 */
function ossn_group_search_link($event, $type, $params) {
		$url = OssnPagination::constructUrlArgs(array(
				'type'
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
								'action' => ossn_site_url() . 'action/group/add',
								'component' => 'OssnGroups',
								'class' => 'ossn-form'
						);
						$form   = ossn_view_form('add', $params, false);
						echo ossn_plugin_view('output/ossnbox', array(
								'title' => ossn_print('add:group'),
								'contents' => $form,
								'callback' => '#ossn-group-submit'
						));
						break;
				case 'cover':
						if(isset($pages[1]) && !empty($pages[1])) {
								$File          = new OssnFile;
								$File->file_id = $pages[1];
								$File          = $File->fetchFile();
								
								$etag = $File->guid . $File->time_created;
								
								if(isset($_SERVER['HTTP_IF_NONE_MATCH']) && trim($_SERVER['HTTP_IF_NONE_MATCH']) == "\"$etag\"") {
										header("HTTP/1.1 304 Not Modified");
										exit;
								}
								if(isset($File->guid)) {
										$Cover    = ossn_get_userdata("object/{$File->owner_guid}/{$File->value}");
										$filesize = filesize($Cover);
										header("Content-type: image/jpeg");
										header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', strtotime("+6 months")), true);
										header("Pragma: public");
										header("Cache-Control: public");
										header("Content-Length: $filesize");
										header("ETag: \"$etag\"");
										readfile($Cover);
										return;
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
		if(!empty($pages[0]) && !empty($pages[0])) {
				if(isset($pages[1])) {
						$params['subpage'] = $pages[1];
				} else {
						$params['subpage'] = '';
				}
				
				if(!ossn_is_group_subapge($params['subpage']) && !empty($params['subpage'])) {
						return false;
				}
				$group = ossn_get_group_by_guid($pages[0]);
				if(empty($group->guid)) {
						ossn_error_page();
				}
				ossn_set_page_owner_guid($group->guid);
				ossn_trigger_callback('page', 'load:group');
				
				
				$params['group']     = $group;
				$title               = $group->title;
				$view                = ossn_plugin_view('groups/pages/profile', $params);
				$contents['content'] = ossn_group_layout($view);
				$content             = ossn_set_page_layout('contents', $contents);
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
		if($page == 'members') {
				$mod_content = ossn_plugin_view('groups/pages/members', $params);
				$mod         = array(
						'title' => ossn_print('members'),
						'content' => $mod_content
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
		if($group->owner_guid !== ossn_loggedin_user()->guid && !ossn_isAdminLoggedin()) {
				return false;
		}
		if($page == 'edit') {
				$params = array(
						'action' => ossn_site_url() . 'action/group/edit',
						'component' => 'OssnGroups',
						'class' => 'ossn-edit-form',
						'params' => array(
								'group' => $group
						)
				);
				$form   = ossn_view_form('edit', $params, false);
				echo ossn_set_page_layout('module', array(
						'title' => ossn_print('edit'),
						'content' => $form
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
				if($group->owner_guid !== ossn_loggedin_user()->guid && !ossn_isAdminLoggedin()) {
						redirect("group/{$group->guid}");
				}
				$mod_content = ossn_plugin_view('groups/pages/requests', array(
						'group' => $group
				));
				$mod         = array(
						'title' => ossn_print('requests'),
						'content' => $mod_content
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
		$deleteGroup = new OssnGroup;
		$groups      = $deleteGroup->getUserGroups($params['entity']->guid);
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
		$object              = new OssnObject;
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
		if($params->viewed !== NULL) {
				$viewed = '';
		} elseif($params->viewed == NULL) {
				$viewed = 'class="ossn-notification-unviewed"';
		}
		// lead directly to groups request page
		$url               = "{$baseurl}group/{$params->subject_guid}/requests";
		$notification_read = "{$baseurl}notification/read/{$params->guid}?notification=" . urlencode($url);
		return "<a href='{$notification_read}' class='ossn-group-notification-item'>
	       <li {$viewed}> {$img} 
		   <div class='notfi-meta'> {$type}
		   <div class='data'>" . ossn_print("ossn:notifications:{$params->type}", array(
				$user->fullname,
				$group->title
		)) . '</div>
		   </div></li>';
}
ossn_register_callback('ossn', 'init', 'ossn_groups');
