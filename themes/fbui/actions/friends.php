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

header('Content-Type: application/json');

if (!ossn_isLoggedin()) {
    echo json_encode(array('html' => '', 'pagination' => ''));
    exit();
}

$user = ossn_loggedin_user();
$offset = (int) input('offset', '', 1);
$search_term = trim((string) input('search_term'));

// Force OSSN global input so ossn_view_pagination() highlights the correct active page
ossn_set_input('offset', $offset);

// Calculate total count for updated ossn_view_pagination()
$count = $user->getFriends($user->guid, array(
    'count'  => true,
    'wheres' => array(
        array(
            'name'       => 'CONCAT(u.first_name, " ", u.last_name)',
            'comparator' => 'LIKE',
            'value'      => "%{$search_term}%",
        ),
    ),                          
));

// Fetch friend objects for requested offset page
$friends = $user->getFriends($user->guid, array(
    'wheres' => array(
        array(
            'name'       => 'CONCAT(u.first_name, " ", u.last_name)',
            'comparator' => 'LIKE',
            'value'      => "%{$search_term}%",
        ),
    ),          
));

// Helper function for activity status
if (!function_exists('fbui_action_get_friend_status')) {
    function fbui_action_get_friend_status($friend) {
        $time = time();
        $last_activity = isset($friend->last_activity) ? (int)$friend->last_activity : 0;
        $diff = $time - $last_activity;

        if ($diff <= 180) { // Active within 3 minutes = Online Green Dot
            return array('status' => 'online', 'badge' => '');
        } elseif ($diff <= 3600) { // Active within 60 minutes = Recent Minutes badge
            $mins = max(1, floor($diff / 60));
            return array('status' => 'recent', 'badge' => "{$mins}m");
        }

        return array('status' => 'offline', 'badge' => '');
    }
}

$html = '';
if ($friends) {
    ob_start();
    foreach ($friends as $friend) {
        $status_info = fbui_action_get_friend_status($friend);
        $status = $status_info['status'];
        $badge = $status_info['badge'];
        ?>
        <li class="fbui-contact-item" data-guid="<?php echo $friend->guid; ?>" onclick="Ossn.ChatnewTab(<?php echo $friend->guid; ?>);">
            <div class="fbui-contact-avatar-wrapper">
                <img src="<?php echo $friend->iconURL()->small; ?>" alt="<?php echo $friend->fullname; ?>" />
                <?php if ($status === 'online'): ?>
                    <span class="fbui-status-badge fbui-status-online"></span>
                <?php elseif ($status === 'recent'): ?>
                    <span class="fbui-status-badge fbui-status-recent"><?php echo $badge; ?></span>
                <?php endif; ?>
            </div>
            <span class="fbui-contact-name"><?php echo $friend->fullname; ?></span>
        </li>
        <?php
    }
    $html = ob_get_clean();
}

// Generate updated pagination HTML with active page shifted to current $offset
$pagination_html = ossn_view_pagination($count);

echo json_encode(array(
    'html'       => $html,
    'pagination' => $pagination_html,
));
exit();