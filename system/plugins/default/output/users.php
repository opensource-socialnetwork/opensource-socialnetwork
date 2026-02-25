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
if ($users) {
    // Wrap the loop in the prefix class so your CSS can target the cards
    echo '<div class="ossn-output-users-list">';
    
    foreach ($users as $user) {
?>
    <div class="user-item-card">
        <div class="user-item-inner">
            <div class="user-info-box">
                <div class="user-avatar-container">
                    <img src="<?php echo $user->iconURL()->large; ?>" alt="user" />
                </div>
                <div class="user-details">
                    <div class="user-name-text">
                        <?php
                            echo ossn_plugin_view('output/user/url', array(
                                'user' => $user,            
                                'class' => 'user-link-inherited', 
                            ));                         
                        ?>
                    </div>
                    <div class="user-username-sub">@<?php echo $user->username; ?></div>
                </div>
            </div>

            <div class="user-controls-box">
                <?php
                if (ossn_isLoggedIn() && ossn_loggedin_user()->guid !== $user->guid) {
                    if (!ossn_user_is_friend(ossn_loggedin_user()->guid, $user->guid)) {
                        if (ossn_user()->requestExists(ossn_loggedin_user()->guid, $user->guid)) {
                            echo ossn_plugin_view('output/url', array(
                                'text' => ossn_print('cancel:request'),
                                'href' => ossn_site_url("action/friend/remove?cancel=true&user={$user->guid}", true),
                                'class' => 'ossn-action-btn btn-danger-outline',
                            ));
                        } else {
                            echo ossn_plugin_view('output/url', array(
                                'text' => '<i class="fa fa-user-plus"></i> ' . ossn_print('add:friend'),
                                'href' => ossn_site_url("action/friend/add?user={$user->guid}", true),
                                'class' => 'ossn-action-btn btn-primary-outline',
                            ));     
                        }
                    } else {
                        echo ossn_plugin_view('output/url', array(
                            'text' => ossn_print('remove:friend'),
                            'href' => ossn_site_url("action/friend/remove?user={$user->guid}", true),
                            'class' => 'ossn-action-btn btn-danger-outline',
                        )); 
                    }
                }
                ?>      
            </div>
        </div>
    </div>
<?php
    }
    
    echo '</div>'; // Close the prefix wrapper
} ?>