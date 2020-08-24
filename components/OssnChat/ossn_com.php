<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
define('__OSSN_CHAT__', ossn_route()->com . 'OssnChat/');
if(com_is_active('OssnMessages')) {
	require_once(__OSSN_CHAT__ . 'classes/OssnChat.php');
	require_once(__OSSN_CHAT__ . 'libs/ossn.lib.chat.php');
}

function ossn_chat_init() {
	if(com_is_active('OssnMessages')) {
	    ossn_extend_view('css/ossn.default', 'css/OssnChat');

	    ossn_new_js('ossn.chat', 'js/OssnChat');

	    //chat bar
	    if (ossn_isLoggedIn()) {
	        //load js and chatbar if user is loggedin
 	       ossn_load_js('ossn.chat');
  	      ossn_extend_view('ossn/page/footer', 'chat/chatbar');
 	   }
 	   ossn_register_page('ossnchat', 'ossn_js_page_handler');

 	   ossn_register_action('ossnchat/send', __OSSN_CHAT__ . 'actions/message/send.php');
 	   ossn_register_action('ossnchat/markread', __OSSN_CHAT__ . 'actions/markread.php');
	   ossn_register_action('ossnchat/close', __OSSN_CHAT__ . 'actions/close.php');
	}
}

function ossn_js_page_handler($pages) {
    switch ($pages[0]) {
        case 'boot':
            if (!ossn_isLoggedIn()) {
                ossn_error_page();
            }
            if (isset($pages[1]) && $pages[1] == 'ossn.boot.chat.js') {
                header('Content-Type: application/javascript');
                echo ossn_plugin_view('js/OssnChat.Boot');
            }
            break;
        case 'selectfriend':
            $user = input('user');
            if (!empty($user)) {
                $user = ossn_user_by_guid($user);
                OssnChat::setUserChatSession($user);
                $friend['user'] = $user;
                echo ossn_plugin_view('chat/selectfriend', $friend);
            }
            break;
		case 'load':
			$guid = input('guid');
			$user = ossn_user_by_guid($guid);
			if(empty($user->guid)) {
					return;
			}
			
			$messages_meta  = ossn_chat()->getWith(ossn_loggedin_user()->guid, $user->guid);
			$messages_count = ossn_chat()->getWith(ossn_loggedin_user()->guid, $user->guid, true);
			echo "<div class='ossn-chat-messages-data-{$user->guid}'>";
			echo ossn_view_pagination($messages_count, 10, array(
							'offset_name' => "offset_message_xhr_with_{$user->guid}",															 
			));			
            if ($messages_meta) {
                foreach ($messages_meta as $message) {
					$deleted = false;
					$class = '';
					if(isset($message->is_deleted) && $message->is_deleted == true){
								$deleted = true;
								$class = ' ossn-message-deleted';
					}							
                    $vars['message'] = ossn_message_print($message->message);
                    $vars['time'] = $message->time;
                    $vars['id'] = $message->id;
					$vars['deleted'] = $deleted;
					$vars['class'] = $class;
                    if (ossn_loggedin_user()->guid == $message->message_from) {
                        echo ossn_plugin_view('chat/message-item-send', $vars);
                    } else {
                        if(!isset($vars['reciever'])){
							$vars['reciever'] = ossn_user_by_guid($message->message_from);
						}
                        echo ossn_plugin_view('chat/message-item-received', $vars);
                    }
                }
            }			
			echo "</div>";
			break;
        default:
            ossn_error_page();
            break;
    }
}

ossn_register_callback('ossn', 'init', 'ossn_chat_init');
