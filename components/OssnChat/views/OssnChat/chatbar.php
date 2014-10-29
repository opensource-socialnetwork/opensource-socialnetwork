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
?>
<div class="ossn-chat-base">
    <div class="ossn-chat-bar">
        <div class="friends-list">

            <div class="ossn-chat-tab-titles">
                <div class="text">Chat</div>
            </div>

            <div class="data">
                <?php
                echo ossn_view('components/OssnChat/views/OssnChat/friendslist');
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
         *    OpenSource-SocialNetwork
         *
         * @package   (Informatikon.com).ossn
         * @author    OSSN Core Team <info@opensource-socialnetwork.com>
         * @copyright 2014 iNFORMATIKON TECHNOLOGIES
         * @license   General Public Licence http://opensource-socialnetwork.com/licence
         * @link      http://www.opensource-socialnetwork.org/licence
         */

        // load active chats
        $active_sessions = OssnChat::GetActiveSessions();
        if ($active_sessions) {
            foreach ($active_sessions as $user) {
                $user = ossn_user_by_guid($user);
                $friend['user'] = $user;
                echo ossn_view('components/OssnChat/views/OssnChat/selectfriend', $friend);
            }
        }
        ?>
    </div>
</div>
<audio id="ossn-chat-sound" src="<?php echo ossn_site_url("components/OssnChat/sound/pling.mp3"); ?>"
       preload="auto"></audio>
<div class="ossn-chat-windows-long">
    <div class="inner">
        <?php
        echo ossn_view('components/OssnChat/views/OssnChat/friends/status');
        ?>
    </div>
</div>