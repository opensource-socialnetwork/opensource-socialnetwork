<?php
/**
 * Open Source Social Network
 *
 * @package    Open Source Social Network
 * @author     Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license    Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link       https://www.opensource-socialnetwork.org/
 */
?>
<div class="ossn-chat-base d-none d-lg-block">
    <div class="ossn-chat-containers">
        <?php
        // Load active chat sessions
        $active_sessions = OssnChat::GetActiveSessions();
        if ($active_sessions) {
            foreach ($active_sessions as $user) {
                $user = ossn_user_by_guid($user);
                if ($user) {
                    $friend['user'] = $user;
                    echo ossn_plugin_view('chat/selectfriend', $friend);
                }
            }
        }
        ?>
    </div>
</div>