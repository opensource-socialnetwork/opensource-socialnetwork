<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
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
		
		$statusBit=array();
		$statusBit['hidden']=1; //0b00000001
		$statusBit['archive']=2; //0b00000010
		$statusBit['spam']=4; //0b00000100
		$statusBit['block']=8; //0b00001000
		//always make sure 'status' is not null
		$OssnMessages->initStatus(ossn_loggedin_user()->guid); 
		
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
								$params['data']   = $OssnMessages->get(ossn_loggedin_user()->guid, $user->guid);
								$params['user']   = $user;
								$params['recent'] = $OssnMessages->recentChat(ossn_loggedin_user()->guid);
								$contents         = array(
										'content' => ossn_plugin_view('messages/pages/view', $params)
								);
								$content          = ossn_set_page_layout('media', $contents);
								echo ossn_view_page($title, $content);
								
						} else {
								ossn_error_page();
						}
						break;
				case 'all':
						$params['recent'] = $OssnMessages->recentChat(ossn_loggedin_user()->guid);
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
								$params['data'] = $OssnMessages->get(ossn_loggedin_user()->guid, $getuser);
								
								$params['user'] = $user;
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
										$params['message_id']=$message->id;
										$message           = $message->message;
										$params['user']    = $user;
										$params['message'] = $message;
										echo ossn_plugin_view('messages/templates/message-send', $params);
								}
								$OssnMessages->markViewed($guid, ossn_loggedin_user()->guid);
								echo '<script>Ossn.playSound();</script>';
						}
						break;
				
				case 'getrecent':
						$params['recent'] = $OssnMessages->recentChat(ossn_loggedin_user()->guid);
						echo ossn_plugin_view('messages/templates/message-with', $params);
						break;
				
				case 'deletemessage':
						$id = $pages[1];
						$delete = $OssnMessages->setStatus($id,$statusBit['hidden']);
						echo $delete;
						break;
						
				case 'getlist':
					$guid = $pages[1];
					//get all messages of from / to users
					$items = $OssnMessages->get(ossn_loggedin_user()->guid, $guid, 'all');
					if ($items){
						$lists=array();
						foreach($items as $i=>$item){
							$list='{"id":'.$item->id.',"viewed":'.$item->viewed.',"status":'.$item->status.'}';
							foreach($statusBit as $key=>$status){
								if ($item->status & $status){
									$lists[$key][]=$list;
								}
							}
						}
						echo json_encode($lists);
					} else {
						echo '[]';
					}
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
ossn_register_callback('ossn', 'init', 'ossn_messages');
