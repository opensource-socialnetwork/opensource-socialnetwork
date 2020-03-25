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
$friends = ossn_chat()->getOnlineFriends('', 10);
$have = '';
if ($friends) {
    foreach ($friends as $friend) {
        $friend = arrayObject($friend, 'OssnUser');
        //[B] user get hook didn't works on chat #1679
	if(!isset($friend->fullname)){
		$friend->fullname = $friend->first_name . ' ' . $friend->last_name;
	}
        $vars['entity'] = $friend;
        $vars['icon'] = $friend->iconURL()->smaller;
        $have = 1;
        echo ossn_plugin_view('chat/friends-item', $vars);
    }
}
if ($have !== 1) {
    echo '<div class="ossn-chat-none">'.ossn_print('ossn:chat:no:friend:online').'</div>';
}
