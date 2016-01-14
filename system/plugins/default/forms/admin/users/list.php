<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$search = input('search_users');
$users = new OssnUser;
$pagination = new OssnPagination;

if (!empty($search)) {
   $list = $users->searchUsers(array(
				 'keyword' => $search,
			));
   $count = $users->searchUsers(array(
				 'count' => true,
			));  
} else {
   $list = $users->searchUsers(array(
				 'keyword' => false,
			));
   $count = $users->searchUsers(array(
				 'keyword' => false,
				 'count' => true,
			));  }
?>
<div class="row margin-top-10">
<table class="table ossn-users-list">
    <tbody>
    <tr class="table-titles">
        <th><?php echo ossn_print('name'); ?></th>
        <th><?php echo ossn_print('username'); ?></th>
        <th><?php echo ossn_print('email'); ?></th>
        <th><?php echo ossn_print('type'); ?></th>
        <th><?php echo ossn_print('lastlogin'); ?></th>
        <th><?php echo ossn_print('edit'); ?></th>
        <th><?php echo ossn_print('delete'); ?></th>
    </tr>
    <?php 
	if($list){
	foreach ($list as $user) {
		$lastlogin = '';
		if(!empty($user->last_login)){
			$lastlogin = ossn_user_friendly_time($user->last_login);
		}
        ?>
        <tr>
            <td>
                <div class="left image"><img src="<?php echo $user->iconURL()->smaller; ?>"/></div>
                <div class="name"><?php echo $user->fullname; ?></div>
            </td>
            <td><?php echo $user->username; ?></td>
            <td><?php echo $user->email; ?></td>
            <td><?php echo $user->type; ?></td>
            <td><?php echo $lastlogin; ?></td>
            <td>
                <a href="<?php echo ossn_site_url("administrator/edituser/{$user->username}"); ?>"><?php echo ossn_print('edit'); ?></a>
            </td>
            <td><a href="<?php echo ossn_site_url("action/admin/delete/user?guid={$user->guid}", true); ?>" class="userdelete"><?php echo ossn_print('delete'); ?></a></td>

        </tr>
    <?php 
		} 
	}
	?>
    </tbody>
</table>
</div>
<div class="row">
	<?php echo ossn_view_pagination($count); ?>
</div>
