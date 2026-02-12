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
$users      = new OssnUser;
$search = input('search_users');

$list = $users->getUnvalidatedUSERS($search);
$count = $users->getUnvalidatedUSERS($search, 'count');

echo ossn_view_form('admin/users/list_search', array(
    'action' => ossn_site_url('administrator/unvalidated_users'),
    'class' => 'ossn-admin-form',
));
?>
<div class="ossn-admin-all-users">
    <div class="margin-top-10">
        <div class="table-responsive">
            <table class="table ossn-users-list">
                <thead>
                    <tr class="table-titles">
                        <th width="40" class="position-relative"><input type="checkbox" id="ossn-check-all" onclick="$('.ossn-admin-unvalidated-users-check').click();" /></th>
                        <th><?php echo ossn_print('name'); ?></th>
                        <th><?php echo ossn_print('username'); ?></th>
                        <th><?php echo ossn_print('email'); ?></th>
                        <th class="text-center"><?php echo ossn_print('validate'); ?></th>
                        <th class="text-center"><?php echo ossn_print('edit'); ?></th>
                        <th class="text-center"><?php echo ossn_print('delete'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($list) {
                        foreach($list as $user) {
                        ?>
                    <tr>
                        <td><input type="checkbox" name="users_guids" value="<?php echo $user->guid;?>" class="ossn-admin-unvalidated-users-check" /></td>
                        <td>
                            <div class="user-identity">
                                <img class="user-avatar-modern" src="<?php echo $user->iconURL()->smaller; ?>"/>
                                <div class="user-info-text">
                                    <span class="full-name"><?php echo $user->fullname; ?></span>
                                </div>
                            </div>
                        </td>
                   		 <td>
                        <span class="text-muted">@</span><?php echo $user->username; ?>
                    	</td>
                        <td><?php echo $user->email; ?></td>
                        <td class="text-center">
                            <a class="action-badge badge-validate" style="color: #10b981;" href="<?php echo ossn_site_url("action/admin/validate/user?guid={$user->guid}", true); ?>">
                                <i class="fa-solid fa-user-check me-0"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a class="action-badge badge-edit" href="<?php echo ossn_site_url("administrator/edituser/{$user->username}");?>">
                                <i class="fa-solid fa-square-pen me-0"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a class="action-badge badge-delete" href="<?php echo ossn_site_url("action/admin/delete/user?guid={$user->guid}", true); ?>">
                                <i class="fa-solid fa-trash-can me-0"></i>
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
</div>
<div class="ossn-unvalidated-multiple-settings d-none">
            <div class="dropdown">
                <button class="btn btn-dark dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" style="border-radius: 8px; padding: 10px 20px;">
                    <i class="fa-solid fa-gears me-0"></i>
                </button>
                <ul class="dropdown-menu shadow border-0">
                    <li><a class="dropdown-item" id="ossn-unvalidated-multi-validate" href="javascript:void(0);"><i class="fa-solid fa-check text-success me-2"></i><?php echo ossn_print('validate'); ?></a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" id="ossn-unvalidated-multi-delete" href="javascript:void(0);"><i class="fa-solid fa-trash me-2"></i><?php echo ossn_print('delete'); ?></a></li>
                </ul>
            </div>
</div>