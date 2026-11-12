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

$user = $params['user'];
$cover = new OssnProfile;

$coverp = $cover->coverParameters($user->guid);
$cover = $cover->getCoverURL($user);

if (!is_array($coverp)) {
    $coverp = [];
}

if(!isset($coverp[0])){
	$coverp[0] = '';
}	
if(!isset($coverp[1])){
	$coverp[1] = '';
}	
$cover_top = '';
if(!empty($coverp[0])){
	$cover_top = "top:{$coverp[0]};";
}
$cover_left = '';
if(!empty($coverp[1])){
	$cover_left = "left:{$coverp[1]};";
}
if (ossn_isLoggedIn()) {
    $class = 'ossn-profile';
} else {
    $class = 'ossn-profile ossn-profile-tn';
}
?>

<div class="ossn-profile-facebook">
    
    <!-- FULL-WIDTH AMBIENT BLUR HEADER WRAPPER -->
    <div class="fb-header-fullwidth-wrapper" style="--fb-cover-bg: url('<?php echo $cover; ?>');">
        <div class="fb-header-ambient-blur"></div>
        
        <!-- CENTERED INNER CONTAINER -->
        <div class="fb-profile-centered-container">
            <div class="<?php echo $class; ?>">
                <div class="top-container">
                    
                    <!-- 1. COVER PHOTO (NATIVE OSSN ID & DRAGGABLE HOOKS) -->
                    <div id="container" class="fb-profile-cover profile-cover">
                        <?php if (ossn_loggedin_user() && ossn_loggedin_user()->guid == $user->guid) { ?>
                            <div class="profile-cover-controls">
                                <a href="javascript:void(0);" onclick="Ossn.Clk('.coverfile');" class="btn-action change-cover fb-btn-cover-action">
                                    <i class="fa-solid fa-camera"></i>
                                    <span><?php echo ossn_print('change:cover'); ?></span>
                                </a>

                                <a href="javascript:void(0);" id="reposition-profile-cover" class="btn-action reposition-cover fb-btn-cover-action">
                                    <i class="fa-solid fa-arrows-up-down-left-right"></i>
                                    <span><?php echo ossn_print('reposition:cover'); ?></span>
                                </a>
                            </div>

                            <form id="upload-cover" style="display:none;" method="post" enctype="multipart/form-data">
                                <input type="file" name="coverphoto" class="coverfile" onchange="Ossn.Clk('#upload-cover .upload');" />
                                <?php echo ossn_plugin_view('input/security_token'); ?>
                                <input type="submit" class="upload" />
                            </form>
                        <?php } ?>

                        <img id="draggable" class="profile-cover-img"
                            src="<?php echo $cover; ?>"
                            style="<?php echo $cover_top; ?><?php echo $cover_left; ?>"
                            data-top="<?php echo $coverp[0]; ?>"
                            data-left="<?php echo $coverp[1]; ?>" />

                        <!-- NATIVE SAVE REPOSITION MENU -->
                        <div id="cover-menu" class="profile-menu">
                            <a href="javascript:void(0);" onclick="Ossn.repositionCOVER();" class="btn btn-success fb-btn-save-cover">
                                <i class="far fa-floppy-disk"></i>
                                <span><?php echo ossn_print('save:position'); ?></span>
                            </a>
                        </div>
                    </div>

                    <!-- 2. USER HEADER (AVATAR + META + ACTION BUTTONS) -->
                    <div class="fb-profile-header-content ossn-profile-usermetadata">
                        
                        <!-- OVERLAPPING AVATAR -->
                      <div class="fb-profile-avatar-wrapper profile-photo">
    <img src="<?php echo $user->iconURL()->larger; ?>" alt="<?php echo $user->fullname; ?>" />
    
    <?php if (ossn_loggedin_user() && ossn_loggedin_user()->guid == $user->guid) { ?>
        <!-- Hidden Upload Form outside/decoupled from trigger -->
        <form id="upload-photo" action="<?php echo ossn_site_url('action/profile/photo/upload'); ?>" style="display:none;" method="post" enctype="multipart/form-data">
            <input type="file" name="userphoto" class="pfile" id="profile-photo-file-input" onchange="Ossn.Clk('#upload-photo .upload');" />
            <?php echo ossn_plugin_view('input/security_token'); ?>
            <input type="submit" class="upload" />
        </form>

        <!-- Clickable Camera Icon Trigger -->
        <label for="profile-photo-file-input" class="fb-avatar-upload-icon upload-photo" title="<?php echo ossn_print('change:photo'); ?>">
            <i class="fa-solid fa-camera"></i>
        </label>
    <?php } ?>
</div>

                        <!-- NAME & ROLE DETAILS -->
                        <div class="fb-profile-user-details ossn-profile-page-usermeta-area">
                            <h1 class="fb-user-fullname user-fullname"><?php echo $user->fullname; ?></h1>
                            <?php echo ossn_plugin_view('profile/role', array('user' => $user)); ?>
                            <div class="fb-user-username user-username">@<?php echo $user->username; ?></div>
                        </div>

                        <!-- ACTION BUTTONS -->
                        <div id="profile-menu" class="fb-profile-actions profile-menu">
                            <?php if (ossn_isLoggedIn()) { ?>
                                <?php if (ossn_loggedin_user()->guid !== $user->guid) { ?>

                                    <?php if (!ossn_user_is_friend(ossn_loggedin_user()->guid, $user->guid)) { ?>
                                        <?php if (ossn_user()->requestExists(ossn_loggedin_user()->guid, $user->guid)) { ?>
                                            <a href="<?php echo ossn_site_url("action/friend/remove?cancel=true&user={$user->guid}", true); ?>" class="btn btn-secondary fb-btn fb-btn-secondary">
                                                <i class="fas fa-user-slash"></i>
                                                <span><?php echo ossn_print('cancel:request'); ?></span>
                                            </a>
                                        <?php } else { ?>
                                            <a href="<?php echo ossn_site_url("action/friend/add?user={$user->guid}", true); ?>" class="btn btn-primary fb-btn fb-btn-primary">
                                                <i class="fa fa-user-plus"></i>
                                                <span><?php echo ossn_print('add:friend'); ?></span>
                                            </a>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <a href="<?php echo ossn_site_url("action/friend/remove?user={$user->guid}", true); ?>" class="btn btn-secondary fb-btn fb-btn-secondary">
                                            <i class="fas fa-user-xmark"></i>
                                            <span><?php echo ossn_print('remove:friend'); ?></span>
                                        </a>
                                    <?php } ?>

                                    <?php if (com_is_active('OssnMessages')) { ?>
                                        <a href="<?php echo ossn_site_url("messages/message/{$user->username}"); ?>" id="profile-message" data-guid="<?php echo $user->guid; ?>" class="btn btn-primary fb-btn fb-btn-primary">
                                            <i class="fa-solid fa-message"></i>

                                            <span><?php echo ossn_print('message'); ?></span>
                                        </a>
                                    <?php } ?>

                                    <div class="ossn-profile-extra-menu dropdown">
                                        <?php echo ossn_view_menu('profile_extramenu', 'profile/menus/extra'); ?>
                                    </div>

                                <?php } else { ?>

                                    <a href="<?php echo ossn_loggedin_user()->profileURL('/edit'); ?>" class="btn btn-secondary fb-btn fb-btn-secondary">
                                        <i class="fas fa-pencil"></i>
                                        <span><?php echo ossn_print('edit:profile'); ?></span>
                                    </a>

                                    <?php if (com_is_active('OssnMessages')) { ?>
                                        <a href="<?php echo ossn_site_url('messages/all'); ?>" class="btn btn-primary fb-btn fb-btn-primary">
                                            <i class="fa-solid fa-message"></i>
                                            <span><?php echo ossn_print('user:messages'); ?></span>
                                        </a>
                                    <?php } ?>

                                <?php } ?>
                            <?php } ?>
                        </div>

                    </div>

                    <!-- 3. NAVIGATION TABS BAR -->
                    <div class="fb-profile-navigation-bar profile-menu-hr-container">
                        <div id="profile-hr-menu" class="fb-profile-tabs profile-hr-menu d-none d-lg-block">
                            <?php echo ossn_plugin_view('menus/user_timeline', array('menu_width' => 60)); ?>
                        </div>

                        <div id="profile-hr-menu" class="fb-profile-tabs profile-hr-menu d-none d-md-block d-lg-none">
                            <?php echo ossn_plugin_view('menus/user_timeline', array('menu_width' => 40)); ?>
                        </div>

                        <div id="profile-hr-menu" class="fb-profile-tabs profile-hr-menu d-none d-sm-block d-md-none">
                            <?php echo ossn_plugin_view('menus/user_timeline', array('menu_width' => 25)); ?>
                        </div>

                        <div id="profile-hr-menu" class="fb-profile-tabs profile-hr-menu d-block d-sm-none">
                            <?php echo ossn_plugin_view('menus/user_timeline', array('menu_width' => 1)); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- 4. MAIN FEED / WALL CONTENT (CENTERED BELOW) -->
    <div class="fb-profile-centered-container">
        <div class="ossn-profile-bottom">
            <?php if (isset($params['subpage']) && !empty($params['subpage']) && ossn_is_profile_subapge($params['subpage'])) { ?>
                <?php if (ossn_is_hook('profile', 'subpage')) {
                    echo ossn_call_hook('profile', 'subpage', $params);
                } ?>
            <?php } else { ?>
                <div class="row">
                    <!-- LEFT SIDEBAR -->
                    <div class="col-lg-5 col-xl-5 order-2 order-lg-1">
                        <div class="ossn-profile-sidebar">
                            <div class="ossn-profile-modules">
                                <?php if (ossn_is_hook('profile', 'modules')) {
                                    $params['user'] = $user;
                                    $modules = ossn_call_hook('profile', 'modules', $params);
                                    echo implode('', $modules);
                                } ?>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT MAIN FEED -->
                    <div class="col-lg-7 col-xl-7 order-1 order-lg-2">
                        <div class="ossn-profile-wall">
                            <?php
                            if (com_is_active('OssnWall')) {
                                $params['user'] = $user;
                                echo ossn_plugin_view('wall/user/wall', $params);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</div>