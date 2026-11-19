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
$members = $params['group']->getMembers();
$count = $params['group']->getMembers(true);
$loggedin_moderator = false;
if (ossn_isLoggedin()) {
	if ($params['group']->isModerator(ossn_loggedin_user()->guid)) {
		$loggedin_moderator = true;
	}
}
if ($members) {
	echo '<div class="ossn-group-members ossn-output-users-list ossn-group-members-list">';
	foreach ($members as $user) {
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

				<div class="user-controls-box group-member-controls">
					<?php
					if (ossn_isLoggedin()) {
						// Friend request / relationship controls
						if (ossn_loggedin_user()->guid !== $user->guid) {
							if (!ossn_user_is_friend(ossn_loggedin_user()->guid, $user->guid)) {
								if (ossn_user()->requestExists(ossn_loggedin_user()->guid, $user->guid)) {
									echo ossn_plugin_view('output/url', array(
										'text' => ossn_print('cancel:request'),
										'href' => ossn_site_url("action/friend/remove?cancel=true&user={$user->guid}", true),
										'class' => 'ossn-action-btn btn-danger-outline group-member-btn',
									));
								} else {
									echo ossn_plugin_view('output/url', array(
										'text' => '<i class="fa fa-user-plus"></i> ' . ossn_print('add:friend'),
										'href' => ossn_site_url("action/friend/add?user={$user->guid}", true),
										'class' => 'ossn-action-btn btn-primary-outline group-member-btn',
									));
								}
							} else {
								echo ossn_plugin_view('output/url', array(
									'text' => ossn_print('remove:friend'),
									'href' => ossn_site_url("action/friend/remove?user={$user->guid}", true),
									'class' => 'ossn-action-btn btn-danger-outline group-member-btn',
								));
							}
						}

						// Group member removal & ownership transfer controls
						if (
							(ossn_isAdminLoggedin() || $loggedin_moderator || ossn_loggedin_user()->guid == $params['group']->owner_guid)
							&& $user->guid !== $params['group']->owner_guid
							&& $params['group']->isMember($params['group']->guid, $user->guid)
						) {
							echo ossn_plugin_view('output/url', array(
								'text' => ossn_print('group:memb:remove'),
								'href' => ossn_site_url("action/group/member/decline?group={$params['group']->guid}&user={$user->guid}", true),
								'class' => 'group-member-btn group-member-btn-remove ossn-make-sure',
							));

							// Don't let moderators make themselves owner
							if (ossn_loggedin_user()->guid == $params['group']->owner_guid || ossn_isAdminLoggedin()) {
								echo ossn_plugin_view('output/url', array(
									'data-new-owner' => $user->fullname,
									'data-is-admin' => ossn_isAdminLoggedin(),
									'text' => ossn_print('group:memb:make:owner'),
									'href' => ossn_site_url("action/group/change_owner?group={$params['group']->guid}&user={$user->guid}", true),
									'class' => 'group-member-btn group-member-btn-owner ossn-group-change-owner',
								));
							}
						}
					}
					?>
				</div>
			</div>
		</div>
		<?php
	}
	echo "</div>";
	echo ossn_view_pagination($count);
}