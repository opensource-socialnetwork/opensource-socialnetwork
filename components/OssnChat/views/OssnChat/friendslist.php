<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$friends = ossn_chat()->getOnlineFriends('', 10);
$have = '';
if ($friends) {
    foreach ($friends as $friend) {
        $friend = arrayObject($friend, 'OssnUser');
        $friend->fullname = $friend->first_name . ' ' . $friend->last_name;
        $vars['entity'] = $friend;
        $vars['icon'] = $friend->iconURL()->smaller;
        $have = 1;
        echo ossn_view('components/OssnChat/views/OssnChat/friends-item', $vars);
    }
}
if ($have !== 1) {
    echo '<div class="ossn-chat-none">No one is online</div>';
}