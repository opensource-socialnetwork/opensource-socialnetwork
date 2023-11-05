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
?>
<div class="ossn-chat-base d-none d-lg-block">
    <div class="ossn-chat-bar">
        <div class="friends-list">

            <div class="ossn-chat-tab-titles">
                <div class="text">Chat</div>
            </div>

            <div class="data">
                <?php
                echo ossn_plugin_view('chat/friendslist');
                ?>
            </div>
        </div>
        <div class="inner friends-tab">
            <div class="ossn-chat-icon">
                <div class="ossn-chat-inner-text ossn-chat-online-friends-count">
                    Chat (<span><?php echo ossn_chat()->countOnlineFriends('', 10); ?></span>)
                </div>
            </div>
        </div>

    </div>

    <div class="ossn-chat-containers">
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

        // load active chats
        $active_sessions = OssnChat::GetActiveSessions();
        if ($active_sessions) {
            foreach ($active_sessions as $user) {
                $user = ossn_user_by_guid($user);
                if($user) {
                    $friend['user'] = $user;
                    echo ossn_plugin_view('chat/selectfriend', $friend);
                }
            }
        }
        ?>
    </div>
</div>
<div class="ossn-chat-windows-long">
    <div class="inner">
        <?php
        echo ossn_plugin_view('chat/friends/status');
        ?>
    </div>
</div>
