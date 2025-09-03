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
		ossn_extend_view('js/ossn.site', 'js/OssnMessages');
		
		if(ossn_isLoggedin()) {
				ossn_register_action('message/send', __OSSN_MESSAGES__ . 'actions/message/send.php');
				ossn_register_action('message/delete', __OSSN_MESSAGES__ . 'actions/message/delete.php');
				ossn_register_action('message/delete_conversation', __OSSN_MESSAGES__ . 'actions/message/delete_conversation.php');
				
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
		//make links clickable
		ossn_add_hook('message', 'print', 'ossn_linkify_messages_print');	
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
 		ossn_unload_js('ossn.chat');
  	    ossn_unextend_view('ossn/page/footer', 'chat/chatbar');	
			
		ossn_load_external_css('jquery.fancybox.min.css');
		ossn_load_external_js('jquery.fancybox.min.js');
		
		$OssnMessages = new OssnMessages;
		$page         = $pages[0];
		if(empty($page)) {
				$page = 'all';
		}
		switch($page) {
				case 'message':
						$username = $pages[1];
						if(!empty($username)) {
								$user = ossn_user_by_username($username);
								if(empty($user->guid)) {
										ossn_error_page();
								}
								//[E] Stop user sending message to himself #1836
								if($user->username == ossn_loggedin_user()->username) {
										redirect("messages/all");
								}
								$title = ossn_print('ossn:message:between', array(
										$user->fullname
								));
								$OssnMessages->markViewed($user->guid, ossn_loggedin_user()->guid);
								$params['data']  = $OssnMessages->getWith(ossn_loggedin_user()->guid, $user->guid);
								$params['count'] = $OssnMessages->getWith(ossn_loggedin_user()->guid, $user->guid, true);
								$params['user']  = $user;
								
								$loggedin_guid          = ossn_loggedin_user()->guid;
								$params['recent']       = $OssnMessages->recentChat($loggedin_guid);
								$params['count_recent'] = $OssnMessages->recentChat($loggedin_guid, true);
								
								$contents = array(
										'content' => ossn_plugin_view('messages/pages/view', $params)
								);
								$content  = ossn_set_page_layout('contents', $contents);
								echo ossn_view_page($title, $content);
								
						} else {
								ossn_error_page();
						}
						break;
				case 'delete':
						$id      = input('id');
						$message = ossn_get_message($id);
						$user    = ossn_loggedin_user()->guid;
						if($message && ($message->message_from == $user || $message->message_to == $user)) {
								$params = array(
										'title' => ossn_print('delete'),
										'contents' => ossn_view_form('OssnMessages/delete', array(
												'action' => ossn_site_url('action/message/delete'),
												'id' => 'ossn-message-delete-form',
												'params' => array(
														'message' => $message
												)
										)),
										'button' => ossn_print('delete'),
										'callback' => '#ossn-md-edit-save'
								);
								echo ossn_plugin_view('output/ossnbox', $params);
						}
						break;
				case 'delete_conversation':
						$id      = input('id');
						if($id) {
								$params = array(
										'title' => ossn_print('delete'),
										'contents' => ossn_view_form('OssnMessages/delete_conversation', array(
												'action' => ossn_site_url('action/message/delete_conversation'),
												'id' => 'ossn-message-delete-conv-form',
										)),
										'button' => ossn_print('delete'),
										'callback' => '#ossn-mdc-save'
								);
								echo ossn_plugin_view('output/ossnbox', $params);
						}				
					break;
				case 'attachment':
					$file = ossn_get_file($pages[1]);
					if($file && $file->type == 'message' && $file->subtype == 'file:attachment') {
						$file->output();
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
						$loggedin_guid          = ossn_loggedin_user()->guid;
						$params['recent']       = $OssnMessages->recentChat($loggedin_guid);
						if($params['recent']) {
								$params['count_recent'] = $OssnMessages->recentChat($loggedin_guid, true);
								//[E] Don't open the last message in messages/all #2283								
								$params['user']   = false;
								$params['countm'] = false;
								$contents = array(
										'content' => ossn_plugin_view('messages/pages/all', $params)
								);
						} else {
								$contents = array(
										'content' => ossn_plugin_view('messages/pages/messages-none')
								);
						}
						$title   = ossn_print('messages');
						$content = ossn_set_page_layout('contents', $contents);
						echo ossn_view_page($title, $content);
						break;
				case 'getnew':
						header('Content-Type: application/json; charset=utf-8');
						$username = $pages[1];
						$friend   = ossn_user_by_username($username);
						if(!$friend){
							echo json_encode(array(
									'html' => false,
									'is_online' => false,
							));	
							exit;
						}
						$recent_guids = input('recent_guids');
						$guid     = $friend->guid;
						$messages = $OssnMessages->getNew($guid, ossn_loggedin_user()->guid);
						$html = '';
						if($messages) {
								foreach($messages as $message) {
										$message              = ossn_get_message($message->id);
										$params['instance']   = (clone $message);
										$params['message_id'] = $message->id;
										$params['view_type']  = 'messages/pages/view/with-xhr';
										//reduce loop for getting user again and again as its only the $friend or loggedin user
										if($message->message_from != $guid){
												$user =  ossn_loggedin_user();
										} else {
												$user = $friend;	
										}
										$params['user']    = $user;
										$message           = $message->message;
										$params['message'] = $message;
										$html .= ossn_plugin_view('messages/templates/message-send', $params);
								}
								$OssnMessages->markViewed($guid, ossn_loggedin_user()->guid);
								$html .= '<script>Ossn.MessageplaySound();</script>';
						}
						echo json_encode(array(
									'html' => $html,
									'is_online' => $friend->isOnline(10),
									'recent_status' => $OssnMessages->onlineStatus($recent_guids),
						));						
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
		$message = ossn_call_hook('message', 'print', false, $message);
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
 * Linkify Messages
 * 
 * @param string $callback message
 * @param string $type print
 * @param array  $return Message
 *
 * @access private
 * @return array
 */
function ossn_linkify_messages_print($hook, $type, $return, $params) {
		return linkify_chat($return);
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
function ossn_messages_entity_type($hook, $type, $return, $params) {
		$return['message'] = 'OssnMessages';
		return $return;
}
/* File:        linkify.php
 * Version:     20101010_1000
 * Copyright:   (c) 2010 Jeff Roberson - http://jmrware.com
 * MIT License: http://www.opensource.org/licenses/mit-license.php
 *
 * Summary: This script linkifys http URLs on a page.
 *
 * Usage:   See example page: linkify.html
 */
function linkify_chat($text){
    $url_pattern = '/# Rev:20100913_0900 github.com\/jmrware\/LinkifyURL
    # Match http & ftp URL that is not already linkified.
      # Alternative 1: URL delimited by (parentheses).
      (\()                     # $1  "(" start delimiter.
      ((?:ht|f)tps?:\/\/[a-z0-9\-._~!$&\'()*+,;=:\/?#[\]@%]+)  # $2: URL.
      (\))                     # $3: ")" end delimiter.
    | # Alternative 2: URL delimited by [square brackets].
      (\[)                     # $4: "[" start delimiter.
      ((?:ht|f)tps?:\/\/[a-z0-9\-._~!$&\'()*+,;=:\/?#[\]@%]+)  # $5: URL.
      (\])                     # $6: "]" end delimiter.
    | # Alternative 3: URL delimited by {curly braces}.
      (\{)                     # $7: "{" start delimiter.
      ((?:ht|f)tps?:\/\/[a-z0-9\-._~!$&\'()*+,;=:\/?#[\]@%]+)  # $8: URL.
      (\})                     # $9: "}" end delimiter.
    | # Alternative 4: URL delimited by <angle brackets>.
      (<|&(?:lt|\#60|\#x3c);)  # $10: "<" start delimiter (or HTML entity).
      ((?:ht|f)tps?:\/\/[a-z0-9\-._~!$&\'()*+,;=:\/?#[\]@%]+)  # $11: URL.
      (>|&(?:gt|\#62|\#x3e);)  # $12: ">" end delimiter (or HTML entity).
    | # Alternative 5: URL not delimited by (), [], {} or <>.
      (                        # $13: Prefix proving URL not already linked.
        (?: ^                  # Can be a beginning of line or string, or
        | [^=\s\'"\]]          # a non-"=", non-quote, non-"]", followed by
        ) \s*[\'"]?            # optional whitespace and optional quote;
      | [^=\s]\s+              # or... a non-equals sign followed by whitespace.
      )                        # End $13. Non-prelinkified-proof prefix.
      ( \b                     # $14: Other non-delimited URL.
        (?:ht|f)tps?:\/\/      # Required literal http, https, ftp or ftps prefix.
        [a-z0-9\-._~!$\'()*+,;=:\/?#[\]@%]+ # All URI chars except "&" (normal*).
        (?:                    # Either on a "&" or at the end of URI.
          (?!                  # Allow a "&" char only if not start of an...
            &(?:gt|\#0*62|\#x0*3e);                  # HTML ">" entity, or
          | &(?:amp|apos|quot|\#0*3[49]|\#x0*2[27]); # a [&\'"] entity if
            [.!&\',:?;]?        # followed by optional punctuation then
            (?:[^a-z0-9\-._~!$&\'()*+,;=:\/?#[\]@%]|$)  # a non-URI char or EOS.
          ) &                  # If neg-assertion true, match "&" (special).
          [a-z0-9\-._~!$\'()*+,;=:\/?#[\]@%]* # More non-& URI chars (normal*).
        )*                     # Unroll-the-loop (special normal*)*.
        [a-z0-9\-_~$()*+=\/#[\]@%]  # Last char can\'t be [.!&\',;:?]
      )                        # End $14. Other non-delimited URL.
    /imx';
	//Open link in new tab (enhancement) #518
    $url_replace = '$1$4$7$10$13<a href="$2$5$8$11$14" \\1 target="_blank">$2$5$8$11$14</a>$3$6$9$12';
    return preg_replace($url_pattern, $url_replace, $text);
}
ossn_register_callback('ossn', 'init', 'ossn_messages');