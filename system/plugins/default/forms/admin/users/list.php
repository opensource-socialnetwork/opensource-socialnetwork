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
$search     = input('search_users');
$users      = new OssnUser();
$pagination = new OssnPagination();

if(!empty($search)) {
		$list = $users->searchUsers(array(
				'keyword' => $search,
		));
		$count = $users->searchUsers(array(
				'keyword' => $search,
				'count'   => true,
		));
} else {
		$list = $users->searchUsers(array(
				'keyword' => false,
		));
		$count = $users->searchUsers(array(
				'keyword' => false,
				'count'   => true,
		));
}
?>
<div class="ossn-admin-all-users mt-4">
    <div class="table-responsive">
        <table class="table ossn-users-list">
            <thead>
                <tr class="table-titles">
                    <th><?php echo ossn_print('name'); ?></th>
                    <th><?php echo ossn_print('username'); ?></th>
                    <th><?php echo ossn_print('email'); ?></th>
                    <th><?php echo ossn_print('type'); ?></th>
                    <th><?php echo ossn_print('lastlogin'); ?></th>
                    <th class="text-center"><?php echo ossn_print('edit'); ?></th>
                    <th class="text-center"><?php echo ossn_print('delete'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if($list){
                    foreach ($list as $user) {
                        $lastlogin = '---';
                        $isActive = false;
                        if(!empty($user->last_login)){
                            $lastlogin = ossn_user_friendly_time($user->last_login);
                            // Visual indicator if logged in within last 24 hours
                            if($user->isOnline()) { $isActive = true; }
                        }
                ?>
                <tr>
                    <td>
                        <div class="user-identity">
                            <img class="user-avatar-modern" src="<?php echo $user->iconURL()->smaller; ?>"/>
                            <div class="user-info-text">
                                <span class="full-name"><?php echo $user->fullname; ?></span>
                                <span class="user-type-tag"><?php echo $user->type; ?></span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="text-muted">@</span><?php echo $user->username; ?>
                    </td>
                    <td><?php echo $user->email; ?></td>
                    <td>
                        <span class="badge" style="background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; font-weight: 500;">
                            <?php echo $user->type; ?>
                        </span>
                    </td>
                    <td>
                        <span class="last-login-text">
                            <?php if($isActive): ?><span class="login-active"></span><?php endif; ?>
                            <?php echo $lastlogin; ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <a class="action-link action-edit" href="<?php echo ossn_site_url("administrator/edituser/{$user->username}"); ?>">
                            <i class="fa-solid fa-user-pen"></i> <?php echo ossn_print('edit'); ?>
                        </a>
                    </td>
                    <td class="text-center">
                        <a class="action-link action-delete ossn-make-sure" data-ossn-msg="ossn:user:delete:exception" href="<?php echo ossn_site_url("action/admin/delete/user?guid={$user->guid}", true); ?>">
                            <i class="fa-solid fa-trash-can"></i> <?php echo ossn_print('delete'); ?>
                        </a>
                    </td>
                </tr>
                <?php 
                    } 
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="ossn-pagination-container">
    <?php echo ossn_view_pagination($count); ?>
</div>