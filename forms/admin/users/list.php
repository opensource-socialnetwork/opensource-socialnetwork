<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */
$search = input('search_users');
$users = new OssnUser;
$pagination = new OssnPagination;

if (!empty($search)) {
    $pagination->setItem($users->SearchSiteUsers($search));
} else {
    $pagination->setItem($users->getSiteUsers());
}
?>
<div class="top-controls">
    <a href="<?php echo ossn_site_url("administrator/adduser"); ?>"
       class="ossn-admin-button button-green"><?php echo ossn_print('add'); ?></a>
</div>
<table class="table ossn-users-list">
    <tbody>
    <tr class="table-titles">
        <td><?php echo ossn_print('name'); ?></td>
        <td><?php echo ossn_print('username'); ?></td>
        <td><?php echo ossn_print('email'); ?></td>
        <td><?php echo ossn_print('type'); ?></td>
        <td><?php echo ossn_print('lastlogin'); ?></td>
        <td><?php echo ossn_print('edit'); ?></td>
        <td><?php echo ossn_print('delete'); ?></td>
    </tr>
    <?php foreach ($pagination->getItem() as $user) {
        $user = ossn_user_by_guid($user->guid);
		$lastlogin = '';
		if(!empty($user->last_login)){
			$lastlogin = ossn_user_friendly_time($user->last_login);
		}
        ?>
        <tr>
            <td>
                <div class="image"><img
                        src="<?php echo ossn_site_url(); ?>avatar/<?php echo $user->username; ?>/smaller"/></div>
                <div class="name"
                     style="margin-left:39px;margin-top: -39px;min-height: 30px;"><?php echo strl($user->fullname, 20); ?></div>
            </td>
            <td><?php echo $user->username; ?></td>
            <td><?php echo $user->email; ?></td>
            <td><?php echo $user->type; ?></td>
            <td><?php echo $lastlogin; ?></td>
            <td>
                <a href="<?php echo ossn_site_url("administrator/edituser/{$user->username}"); ?>"><?php echo ossn_print('edit'); ?></a>
            </td>
            <td><a href="<?php echo ossn_site_url("action/admin/delete/user?guid={$user->guid}", true); ?>"><?php echo ossn_print('delete'); ?></a></td>

        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $pagination->pagination(); ?>
