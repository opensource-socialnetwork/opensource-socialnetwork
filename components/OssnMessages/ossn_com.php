<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
define('__OSSN_MESSAGES__', ossn_route()->com . 'OssnMessages/');
require_once(__OSSN_MESSAGES__ . 'classes/OssnMessages.php');

/**
 * Ossn messages
 * Get object into function
 *
 * @return object
 */
function OssnMessages() {
		$OssnMessages = new OssnMessages;
		return $OssnMessages;
}
/**
 * Initilize the the component
 *
 * @return void
 */
function ossn_messages() {
		ossn_extend_view('css/ossn.default', 'css/message');
		ossn_register_page('messages', 'ossn_messages_page');
		ossn_extend_view('js/opensource.socialnetwork', 'js/OssnMessages');
		
		if(ossn_isLoggedin()) {
				ossn_register_action('message/send', __OSSN_MESSAGES__ . 'actions/message/send.php');
				ossn_register_action('message/delete', __OSSN_MESSAGES__ . 'actions/message/delete.php');
				
				$user_loggedin = ossn_loggedin_user();
				$icon          = ossn_site_url('components/OssnMessages/images/messages.png');
				ossn_register_sections_menu('newsfeed', array(
						'name' => 'messages',
						'text' => ossn_print('user:messages'),
						'url' => ossn_site_url('messages/all'),
						'parent' => 'links',
						'icon' => $icon
				));
				
		}
		//callbacks
		ossn_register_callback('user', 'delete', 'ossn_user_messages_delete');
		//add messages entity type
		ossn_add_hook('entities', 'types', 'ossn_messages_entity_type');
}
/**
 * Ossn messages page handler
 *
 * @param array $pages Pages
 *
 * @return mixed data
 */
function ossn_messages_page($pages) {
		if(!ossn_isLoggedin()) {
				ossn_error_page();
		}
		$OssnMessages = new OssnMessages;
		$page         = $pages[0];
		if(empty($page)) {
				$page = 'messages';
		}
		switch($page) {
				case 'message':
						$username = $pages[1];
						if(!empty($username)) {
								$user = ossn_user_by_username($username);
								if(empty($user->guid)) {
										ossn_error_page();
								}
								$title = ossn_print('ossn:message:between', array(
										$user->fullname
								));
								$OssnMessages->markViewed($user->guid, ossn_loggedin_user()->guid);
								$params['data']  = $OssnMessages->getWith(ossn_loggedin_user()->guid, $user->guid);
								$params['count'] = $OssnMessages->getWith(ossn_loggedin_user()->guid, $user->guid, true);
								$params['user']  = $user;
								
								$loggedin_guid    = ossn_loggedin_user()->guid;
								$params['recent'] = $OssnMessages->recentChat($loggedin_guid);
								$params['count_recent']  = $OssnMessages->recentChat($loggedin_guid, true);
								
								$contents = array(
										'content' => ossn_plugin_view('messages/pages/view', $params)
								);
								$content  = ossn_set_page_layout('media', $contents);
								echo ossn_view_page($title, $content);
								
						} else {
								ossn_error_page();
						}
						break;
				case 'xhr':
						switch($pages[1]) {
								case 'recent':
										$loggedin_guid    = ossn_loggedin_user()->guid;
										$params           = array();
										$params['recent'] = $OssnMessages->recentChat($loggedin_guid);
										$params['count']  = $OssnMessages->recentChat($loggedin_guid, true);
										echo ossn_plugin_view('messages/pages/view/recent', $params);
										break;
								case 'notification':
										$loggedin_guid    = ossn_loggedin_user()->guid;
										$params['recent'] = $OssnMessages->recentChat($loggedin_guid);
										$data             = ossn_plugin_view('messages/templates/message-with-notifi', $params);
										if(!empty($params['recent'])) {
												echo $data;
										} else {
												echo '<div class="ossn-no-notification">' . ossn_print('ossn:notification:no:notification') . '</div>';
										}
										break;
								case 'with':
										$guid = input('guid');
										if(!empty($guid)) {
												$user = ossn_user_by_guid($guid);
												if(empty($user->guid)) {
														return;
												}
												$OssnMessages->markViewed($user->guid, ossn_loggedin_user()->guid);
												$params['data']  = $OssnMessages->getWith(ossn_loggedin_user()->guid, $user->guid);
												$params['count'] = $OssnMessages->getWith(ossn_loggedin_user()->guid, $user->guid, true);
												$params['user']  = $user;
												echo ossn_plugin_view('messages/pages/view/with-xhr', $params);
										}
										break;
						}
						break;
				case 'all':
						$loggedin_guid    = ossn_loggedin_user()->guid;
						$params['recent'] = $OssnMessages->recentChat($loggedin_guid);
						$params['count_recent']  = $OssnMessages->recentChat($loggedin_guid, true);
						$active           = $params['recent'][0];
						if(isset($active->message_to) && $active->message_to == ossn_loggedin_user()->guid) {
								$getuser = $active->message_from;
						}
						if(isset($active->message_from) && $active->message_from == ossn_loggedin_user()->guid) {
								$getuser = $active->message_to;
						}
						if(isset($getuser)) {
								$user = ossn_user_by_guid($getuser);
								$OssnMessages->markViewed($getuser, ossn_loggedin_user()->guid);
								$params['data']   = $OssnMessages->getWith(ossn_loggedin_user()->guid, $getuser);
								$params['countm'] = $OssnMessages->getWith(ossn_loggedin_user()->guid, $getuser, true);
								$params['user']   = $user;
						}
						$contents = array(
								'content' => ossn_plugin_view('messages/pages/messages', $params)
						);
						if(!isset($getuser)) {
								$contents = array(
										'content' => ossn_plugin_view('messages/pages/messages-none')
								);
						}
						$title   = ossn_print('messages');
						$content = ossn_set_page_layout('media', $contents);
						echo ossn_view_page($title, $content);
						break;
				case 'getnew':
						$username = $pages[1];
						$guid     = ossn_user_by_username($username)->guid;
						$messages = $OssnMessages->getNew($guid, ossn_loggedin_user()->guid);
						if($messages) {
								foreach($messages as $message) {
										$user              = ossn_user_by_guid($message->message_from);
										$message           = $message->message;
										$params['user']    = $user;
										$params['message'] = $message;
										echo ossn_plugin_view('messages/templates/message-send', $params);
								}
								$OssnMessages->markViewed($guid, ossn_loggedin_user()->guid);
								echo '<script>Ossn.MessageplaySound();</script>';
						}
						break;
				
				case 'getrecent':
						$params['recent'] = $OssnMessages->recentChat(ossn_loggedin_user()->guid);
						echo ossn_plugin_view('messages/templates/message-with', $params);
						break;
				default:
						ossn_error_page();
						break;
						
		}
}
/**
 * Print user messages
 * This will translate unix new lines to html line break
 *
 * @param string $message Message
 *
 * @return string
 */
function ossn_message_print($message) {
		return nl2br($message);
}
/**
 * Delete user messages
 *
 * @param string $callback Name of callback
 * @param string $type Callback type
 * @param array $params Arrays or Objects
 *
 * @return void
 * @access private
 */
function ossn_user_messages_delete($callback, $type, $params) {
		$messages = new OssnMessages;
		if(isset($params['entity']->guid)) {
				$messages->deleteUser($params['entity']->guid);
		}
}
/** 
 * Get a message by id
 *
 * @param integer $id Message id
 * @return boolean|object
 */
function ossn_get_message($id = false) {
		if(isset($id) && $id > 0) {
				$message  = new OssnMessages;
				$messages = $message->searchMessages(array(
						'id' => $id
				));
				if($messages) {
						return $messages[0];
				}
		}
		return false;
}
/**
 * Add a entity type for messages
 * 
 * @param string $callback Name of callback
 * @param string $type Callback type
 * @param array $params Arrays or Objects
 *
 * @access private
 * @return array
 */
function ossn_messages_entity_type($hook, $type, $return, $params){
			$return['message'] = 'OssnMessages';
			return $return;
}
ossn_register_callback('ossn', 'init', 'ossn_messages');