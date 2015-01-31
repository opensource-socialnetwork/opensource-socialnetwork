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
$users      = new OssnUser;
$pagination = new OssnPagination;
$pagination->setItem($users->getUnvalidatedUSERS());
$list = $pagination->getItem();

?>
<div class="top-controls top-controls-users-page">
    <a href="<?php echo ossn_site_url("administrator/adduser");?>" class="ossn-admin-button button-green"><?php echo ossn_print('add'); ?></a>
</div>
<table class="table ossn-users-list">
    <tbody>
    <tr class="table-titles">
        <td><?php echo ossn_print('name'); ?></td>
        <td><?php echo ossn_print('username'); ?></td>
        <td><?php echo ossn_print('email'); ?></td>
        <td><?php echo ossn_print('type'); ?></td>
        <td><?php echo ossn_print('validate'); ?></td>
        <td><?php echo ossn_print('edit'); ?></td>
        <td><?php echo ossn_print('delete'); ?></td>
    </tr>
    <?php
if($list) {
		foreach($pagination->getItem() as $user) {
				$user      = ossn_user_by_guid($user->guid);
?>
        <tr>
            <td>
                <div class="image"><img src="<?php echo ossn_site_url(); ?>avatar/<?php echo $user->username; ?>/smaller"/></div>
                <div class="name" style="margin-left:39px;margin-top: -39px;min-height: 30px;"><?php echo strl($user->fullname, 20); ?></div>
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
<?php
echo $pagination->pagination();
?>
