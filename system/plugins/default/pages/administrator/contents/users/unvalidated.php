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
<div class="row">
	<div class="col-md-12">
    <form method="post">
        <input type="text" name="search_users" placeholder="<?php echo ossn_print('search'); ?>" />
        <input type="submit" class="btn btn-primary btn-sm" value="<?php echo ossn_print('search'); ?>"/>
    </form>    
    </div>
</div>
<div class="row margin-top-10">
<div class="col-md-12">
<table class="table ossn-users-list">
    <tbody>
    <tr class="table-titles">
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
            <td>
                <div class="left image"><img class="user-icon-smaller" src="<?php echo $user->iconURL()->smaller; ?>"/></div>
                <div class="name"><?php echo $user->fullname; ?></div>
            </td>
            <td><?php echo $user->username;?></td>
            <td><?php echo $user->email; ?></td>
            <td><?php echo $user->type; ?></td>
            <td><a href="<?php echo ossn_site_url("action/admin/validate/user?guid={$user->guid}", true); ?>"><?php echo ossn_print('validate'); ?></a></td>
            <td>
                <a href="<?php echo ossn_site_url("administrator/edituser/{$user->username}");?>"><?php echo ossn_print('edit'); ?></a>
            </td>
            <td><a href="<?php echo ossn_site_url("action/admin/delete/user?guid={$user->guid}", true); ?>"><?php echo ossn_print('delete'); ?></a></td>
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
