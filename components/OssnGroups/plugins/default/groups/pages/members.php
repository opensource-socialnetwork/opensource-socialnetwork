<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$members = $params['group']->getMembers();
if ($members) {
    foreach ($members as $user) {
        ?>

        <div class="ossn-group-members">
            <img src="<?php echo ossn_site_url("avatar/{$user->username}/large"); ?>" width='100' height="100"/>

            <div class="uinfo">
                <a class="userlink" href="<?php echo $user->profileURL(); ?>"><?php echo $user->fullname; ?></a>
            </div>
            <?php
            if (ossn_loggedin_user()->guid !== $params['group']->owner_guid) {
                if (ossn_loggedin_user()->guid !== $user->guid) {
                    if (!ossn_user_is_friend(ossn_loggedin_user()->guid, $user->guid)) {
                        ?>
                        <a href="<?php echo ossn_site_url("action/friend/add?user={$user->guid}", true); ?>"
                           class='friendlink button-grey-light'>
                            <?php echo ossn_print('add:friend'); ?></a>
                    <?php } else { ?>
                        <a href="<?php echo ossn_site_url("action/friend/remove?user={$user->guid}", true); ?>"
                           class='friendlink button-grey-light'>
                            <?php echo ossn_print('remove:friend'); ?></a>
                    <?php
                    }
                }
            } else {
                if ($user->guid !== $params['group']->owner_guid && $params['group']->isMember($params['group']->guid, $user->guid)) {
                    ?>

                    <a href="<?php echo ossn_site_url("action/group/member/decline?group={$params['group']->guid}&user={$user->guid}", true); ?>"
                       class='friendlink button-grey-light'><?php echo ossn_print('group:memb:remove'); ?></a>
                <?php
                }
            }
            ?>
        </div>


    <?php
    }

}?>
