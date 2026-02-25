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
$users = $params['users'];
$avatar_size = isset($params['icon_size']) ? $params['icon_size'] : 'large';
$sizes = array('large', 'larger', 'small', 'topbar');

if ($users) {
    // Wrap in the prefix class for CSS scoping
    echo '<div class="ossn-output-users-list">';

    foreach ($users as $user) {
        if (isset($avatar_size) && in_array($avatar_size, $sizes)) {
            $icon = $user->iconURL()->$avatar_size;
        } else {
            $icon = $user->iconURL()->small;
        }
    ?>
        <div class="user-item-card">
            <div class="user-item-inner">
                <div class="user-info-box">
                    <div class="user-avatar-container">
                        <img class="user-icon-<?php echo $avatar_size; ?>" src="<?php echo $icon; ?>" />
                    </div>
                    <div class="user-details">
                        <div class="user-name-text">
                            <?php
                            echo ossn_plugin_view('output/user/url', array(
                                'user' => $user,            
                                'class' => 'user-link-inherited',
                                'section' => 'output/users/list',
                            ));
                            ?>
                        </div>
                    </div>
                </div>

                <div class="user-controls-box">
                    <?php if (ossn_isLoggedIn() && ossn_loggedin_user()->guid !== $user->guid) { ?>
                        <?php if (!ossn_user_is_friend(ossn_loggedin_user()->guid, $user->guid)) { ?>
                            <?php if (ossn_user()->requestExists(ossn_loggedin_user()->guid, $user->guid)) { ?>
                                <a href="<?php echo ossn_site_url("action/friend/remove?cancel=true&user={$user->guid}", true); ?>" 
                                   class="ossn-action-btn btn-danger-outline">
                                    <?php echo ossn_print('cancel:request'); ?>
                                </a>
                            <?php } else { ?>
                                <a href="<?php echo ossn_site_url("action/friend/add?user={$user->guid}", true); ?>" 
                                   class="ossn-action-btn btn-primary-outline">
                                    <i class="fa fa-user-plus"></i> <?php echo ossn_print('add:friend'); ?>
                                </a>
                            <?php } ?>
                        <?php } else { ?>
                            <a href="<?php echo ossn_site_url("action/friend/remove?user={$user->guid}", true); ?>" 
                               class="ossn-action-btn btn-danger-outline">
                                <?php echo ossn_print('remove:friend'); ?>
                            </a>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php
    }

    echo '</div>'; // Close prefix wrapper
} 
?>