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
?>
<div>
	<form method="post">
		<input type="text" name="search_users" placeholder="<?php echo ossn_print('search'); ?>" />
		<input type="submit" class="btn btn-primary btn-sm" value="<?php echo ossn_print('search'); ?>"/>
	</form>
</div>
<div class="margin-top-10">
	<div class="table-responsive">
		<table class="table ossn-users-list">
			<tbody>
				<tr class="table-titles">
					<th></th>
					<th><?php echo ossn_print('name'); ?></th>
					<th><?php echo ossn_print('username'); ?></th>
					<th><?php echo ossn_print('email'); ?></th>
					<th><?php echo ossn_print('type'); ?></th>
					<th><?php echo ossn_print('validate'); ?></th>
					<th><?php echo ossn_print('edit'); ?></th>
					<th><?php echo ossn_print('delete'); ?></th>
				</tr>
				<?php
					if($list) {
							foreach($list as $user) {
					?>
				<tr>
					<td><input type="checkbox" name="users_guids" value="<?php echo $user->guid;?>" class="ossn-admin-unvalidated-users-check" /></td>
					<td>
						<div class="left image"><img class="user-icon-smaller" src="<?php echo $user->iconURL()->smaller; ?>"/></div>
						<div class="name"><?php echo $user->fullname; ?></div>
					</td>
					<td><?php echo $user->username;?></td>
					<td><?php echo $user->email; ?></td>
					<td><?php echo $user->type; ?></td>
					<td><a class="badge bg-success text-white" href="<?php echo ossn_site_url("action/admin/validate/user?guid={$user->guid}", true); ?>"><i class="fa-solid fa-user-check"></i><?php echo ossn_print('validate'); ?></a></td>
					<td>
						<a class="badge bg-warning text-white" href="<?php echo ossn_site_url("administrator/edituser/{$user->username}");?>"><i class="fa-solid fa-square-pen"></i><?php echo ossn_print('edit'); ?></a>
					</td>
					<td><a class="badge bg-danger text-white" href="<?php echo ossn_site_url("action/admin/delete/user?guid={$user->guid}", true); ?>"><i class="fa-solid fa-trash-can"></i><?php echo ossn_print('delete'); ?></a></td>
				</tr>
				<?php
					}
					}
					?>
			</tbody>
		</table>
		<?php echo ossn_view_pagination($count); ?>
	</div>
</div>
<div class="ossn-unvalidated-multiple-settings d-none">
	<hr />
	<div class="dropdown">
		<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
		<i class="fa-solid fa-cogs"></i>
		</button>
		<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
			<li><a class="dropdown-item" id="ossn-unvalidated-multi-validate" href="javascript:void(0);"><?php echo ossn_print('validate'); ?></a></li>
			<li><a class="dropdown-item" id="ossn-unvalidated-multi-delete" href="javascript:void(0);"><?php echo ossn_print('delete'); ?></a></li>
		</ul>
	</div>
	<div class="margin-top-10"></div>
</div>