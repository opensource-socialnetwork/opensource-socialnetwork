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
$cover = $params['group']->haveCover();
if ($cover) {
    $iscover = 'ossn-group-cover-header';
    $coverp = $params['group']->coverParameters($params['group']->guid);
    $cover_top = $coverp[0];
    $cover_left = $coverp[1];
} else {
    $cover_top = '';
    $cover_left = '';
    $iscover = '';
}
//group members total count becomes 0 when group cover is set #156 $dev.githubertus 
$members = $params['group']->getMembers();
?>
<div class="ossn-group-profile">
    <div class="profile-header <?php echo $iscover; ?>">
        <?php if ($params['group']->owner_guid == ossn_loggedin_user()->guid) { ?>

            <form id="group-upload-cover" style="display:none;" method="post" enctype="multipart/form-data">
                <input type="file" name="coverphoto" class="coverfile"
                       onchange="Ossn.Clk('#group-upload-cover .upload');"/>
                <input type="hidden" value="<?php echo $params['group']->guid; ?>" name="group"/>
                <input type="submit" class="upload"/>
            </form>

        <?php
        }
        if ($cover) {
            ?>
            <div class="ossn-group-cover" id="container">
                <?php if ($params['group']->owner_guid == ossn_loggedin_user()->guid) { ?>
                    <div class="ossn-group-cover-button">
                        <a href="javascript:void(0);" id="reposition-cover"
                           class='button-grey'><?php echo ossn_print('reposition:cover'); ?></a>
                        <a href="javascript:void(0);" id="add-cover-group"
                           class='button-grey'><?php echo ossn_print('change:cover'); ?></a>
                    </div>
                <?php } ?>
                <img id="draggable" src="<?php echo $params['group']->coverURL(); ?>"
                     style='position:relative;top:<?php echo $cover_top; ?>px;left:<?php echo $cover_left; ?>px;'/>
            </div>
        <?php } else { ?>
            <div class="header-users">
                <?php
                if ($members) {
                    foreach ($members as $member) {
                        ?>
                        <img src="<?php echo $member->iconURL()->large; ?>"/>
                    <?php
                    }
                }?>
            </div>
        <?php } ?>

        <div class="header-bottom">
            <div class="group-name">
                <a href="<?php echo ossn_group_url($params['group']->guid); ?>"><?php echo $params['group']->title; ?></a>
            </div>
            <div id="group-header-menu" class="group-header-menu">
                <ul>
                    <?php echo ossn_view_menu('groupheader'); ?>
                </ul>
            </div>
            <div class="groups-buttons">
                <?php  if ($params['group']->owner_guid !== ossn_loggedin_user()->guid) {
                    if ($params['group']->isMember(NULL, ossn_loggedin_user()->guid)) {
                        $ismember = 1;
                        ?>
                        <a href="<?php echo ossn_site_url("action/group/member/cancel?group={$params['group']->guid}", true); ?>"
                           class='button-grey'>
                            <?php echo ossn_print('leave:group'); ?></a>
                    <?php
                    } else if (!$params['group']->requestExists(ossn_loggedin_user()->guid, false)) {
                        ?>
                        <a href="<?php echo ossn_site_url("action/group/join?group={$params['group']->guid}", true); ?>"
                           class='button-grey'>
                            <?php echo ossn_print('join:group'); ?></a>
                    <?php
                    }

                    if (!$ismember && $params['group']->requestExists(ossn_loggedin_user()->guid, false)) {
                        ?>
                        <a href="<?php echo ossn_site_url("action/group/member/cancel?group={$params['group']->guid}", true); ?>"
                           class='button-grey'>
                            <?php echo ossn_print('cancel:membership'); ?></a>
                    <?php } ?>

                <?php } ?>
                <?php  if ($params['group']->owner_guid == ossn_loggedin_user()->guid) {
                    $ismember = 1;
                    ?>
                    <a href="<?php echo ossn_group_url($params['group']->guid); ?>edit"
                       class='button-grey'><?php echo ossn_print('settings'); ?></a>
                    <a href="javascript:void(0);" onclick="Ossn.repositionGroupCOVER(<?php echo $params['group']->guid; ?>);"
                       class='button-grey group-c-position'><?php echo ossn_print('save:position'); ?></a>
                    <?php if (!$cover) { ?>
                        <a href="javascript:void(0);" id="add-cover-group"
                           class='button-grey'><?php echo ossn_print('change:cover'); ?></a>
                    <?php } ?>
                <?php } ?>
            </div>

        </div>
    </div>
    <!-- End of Header -->
    <div class="group-body">
        <?php if (isset($params['subpage']) && !empty($params['subpage']) && ossn_is_group_subapge($params['subpage'])) {
            if (ossn_is_hook('group', 'subpage')) {
                echo ossn_call_hook('group', 'subpage', $params);
            }
        } else {
            ?>
            <div class="group-wall">
                <?php
			//#113 make contents of public groups visible. 
			//send ismember, and member ship param to group wall
                	echo ossn_plugin_view('wall/group', array(
									'group' => $params, 
									'ismember' => $ismember,
									'membership' => $params['group']->membership
									));
                if ($params['group']->membership == OSSN_PRIVATE && $ismember !== 1) {
                    ?>
                    <div class="group-closed-container">
                        <div class="title-h3"><?php echo ossn_print('closed:group'); ?></div>
                        <p><?php echo ossn_print('close:group:notice'); ?></p>

                        <div class="title-h3"> <?php echo ossn_print('group:members', array(count($members))); ?></div>
                        <div class="group-members-small">

                            <?php
                            $members = $params['group']->getMembers();
                            $limit = 30;
                            if ($members) {
                                foreach ($members as $member) {
                                    if ($limit <= 30) {
                                        ?>
                                        <img src="<?php echo ossn_site_url("avatar/{$member->username}/small"); ?>"
                                             title="<?php echo $member->fullname; ?>"/>
                                    <?php
                                    }
                                    $limit++;
                                }
                            }
                            ?>

                        </div>
                        <div class="title-h3"> <?php echo ossn_print('group:admin'); ?> </div>
                        <div class="group-members-small">
                            <?php
                            $group_admin = ossn_user_by_guid($params['group']->owner_guid); ?>

                            <img src="<?php echo ossn_site_url("avatar/{$group_admin->username}/small"); ?>"
                                 title="<?php echo $group_admin->fullname; ?>"/>

                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

            <div class="group-sidebar">
                <div class="group-about">
                    <div class='heading'> <?php echo ossn_print('about:group'); ?> </div>
                    <div class="text"><?php echo $params['group']->description; ?></div>
                    <div class="members-count"><a> <?php echo ossn_print('total:members'); ?>
                            (<?php echo count($members); ?>) </a></div>
                </div>
                <?php if ($params['group']->owner_guid == ossn_loggedin_user()->guid) { ?>
                    <div class="group-about" style="margin-top: 10px;">
                        <div
                            class='heading'> <?php echo ossn_print('member:requests', array($params['group']->countRequests())); ?></div>
                        <div class="members-count"><a
                                href="<?php echo ossn_group_url($params['group']->guid); ?>requests">
                                <?php echo ossn_print('view:all'); ?></a></div>
                    </div>
                <?php
                }
                if (com_is_active('OssnAds')) {
                    echo ossn_plugin_view('ads/page/view');
                }
                ?>
            </div>
        <?php } ?>
    </div>

</div>
