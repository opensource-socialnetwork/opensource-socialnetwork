<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$requests = $params['group']->getMembersRequests();
if (empty($requests)) {
    echo '<div class="ossn-group-no-requests">' . ossn_print('no:requests') . '</div>';
} else {
	echo '<div class="ossn-group-members ossn-output-users-list">';
    foreach ($requests as $user) {
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
							echo ossn_plugin_view('output/url', array(
									'text' => ossn_print('approve'),
									'href' =>  ossn_site_url("action/group/member/approve?group={$params['group']->guid}&user={$user->guid}", true),
									'class' => 'ossn-action-btn btn-primary-outline me-2',
							));
							echo ossn_plugin_view('output/url', array(
									'text' => ossn_print('decline'),
									'href' =>  ossn_site_url("action/group/member/decline?group={$params['group']->guid}&user={$user->guid}", true),
									'class' => 'ossn-action-btn btn-danger-outline',
							));
						?>		  
            </div>
        </div>
    </div>	   
    <?php
    }
	echo "</div>";
}
