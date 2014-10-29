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

$message = input('message');
$to = input('to');
$from = ossn_loggedin_user()->guid;

header('Content-Type: application/json');
if (empty($to) || empty($from) || empty($message)) {
    echo json_encode(array('type' => 0));
}
$send = ossn_chat();
if ($send->send($from, $to, $message)) {
    $vars['message'] = $message;
    $vars['time'] = time();
    echo json_encode(array(
        'type' => 1,
        'message' => ossn_view('components/OssnChat/views/OssnChat/message-item-send', $vars),
    ));
} else {
    echo json_encode(array('type' => 0));
}
