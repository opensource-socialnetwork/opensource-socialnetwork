<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$users      = new OssnUser;
$pagination = new OssnPagination;
$search = input('search_users');

$data = $users->getUnvalidatedUSERS($search);

$pagination->setItem($data);
$list = $pagination->getItem();

?>
<div class="row">
    <form method="post">
        <input type="text" name="search_users" placeholder="<?php echo ossn_print('search'); ?>" />
        <input type="submit" class="btn btn-primary" value="<?php echo ossn_print('search'); ?>"/>
    </form>    
</div>
<div class="row margin-top-10">
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
		foreach($pagination->getItem() as $user) {
				$user      = ossn_user_by_guid($user->guid);
?>
        <tr>
            <td>
                <div class="left image"><img src="<?php echo $user->iconURL()->smaller; ?>"/></div>
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
</div>
<div class="row">
	<?php echo $pagination->pagination(); ?>
</div>
