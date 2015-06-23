<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$friends = ossn_loggedin_user()->getFriends();
$have = '';
if ($friends) {
    foreach ($friends as $friend) {
        $vars['entity'] = $friend;
        $vars['icon'] = $friend->iconURL()->smaller;
        $have = 1;
        echo ossn_plugin_view('chat/friends/friend-item', $vars);
    }
}
if ($have !== 1) {
    echo '<div class="ossn-chat-none">'.ossn_print('ossn:chat:no:friend:online').'</div>';
}