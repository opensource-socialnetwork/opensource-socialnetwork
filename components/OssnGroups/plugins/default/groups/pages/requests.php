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
$requests = $params['group']->getMembersRequests();
if (empty($requests)) {
    echo '<div class="ossn-group-no-requests">' . ossn_print('no:requests') . '</div>';
} else {
    foreach ($requests as $user) {
        ?>

        <div class="ossn-group-members">
            <img src="<?php echo ossn_site_url("avatar/{$user->username}/large"); ?>" width="100" height="100"/>

            <div class="uinfo">
                <a class="userlink" href="<?php echo $user->profileURL(); ?>"><?php echo $user->fullname; ?></a>
            </div>
            <a href="<?php echo ossn_site_url("action/group/member/approve?group={$params['group']->guid}&user={$user->guid}", true); ?>"
               class='friendlink button-grey-light'><?php echo ossn_print('approve'); ?></a>
			 <a href="<?php echo ossn_site_url("action/group/member/decline?group={$params['group']->guid}&user={$user->guid}", true); ?>"

               class='friendlink button-grey-light'><?php echo ossn_print('decline'); ?></a>

        </div>

    <?php
    }
}
