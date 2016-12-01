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
$from = $params['message_to'];
$to = ossn_loggedin_user();
$messages = ossn_chat()->getNew($from, $to);
if ($messages) {
    foreach ($messages as $message){
        if (ossn_loggedin_user()->guid == $message->message_from) {
            $vars['message'] = $message->message;
            echo ossn_plugin_view('chat/message-item-send', $vars);
        } else {
            $vars['reciever'] = ossn_user_by_guid($message->message_from);
            $vars['message'] = $message->message;
            echo ossn_plugin_view('chat/message-item-received', $vars);
        }
    }
}