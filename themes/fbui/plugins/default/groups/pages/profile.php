<?php
/**
 * Open Source Social Network
 *
 * @package    Open Source Social Network
 * @author     Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license    Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link       https://www.opensource-socialnetwork.org/
 */

$cover = $params['group']->haveCover();
$iscover = '';
if ($cover) {
    $iscover = 'ossn-group-cover-header';
    $coverp = $params['group']->coverParameters($params['group']->guid);
    if(isset($coverp[0]) && strlen($coverp[0])){
		$cover_top = "top:{$coverp[0]}px;";
	}
	else {
		$cover_top = 'top:0px;';
	}
	if(isset($coverp[1]) && strlen($coverp[1])){
	    $cover_left = "left:{$coverp[1]}px;";
	}
	else {
		$cover_left = 'left:0px;';
	}
	if(!is_array($coverp)){
		$coverp = array();	
	}
	if(!isset($coverp[0])){
		$coverp[0] = '';
	}
	if(!isset($coverp[1])){
		$coverp[1] = '';
	}	
}

$members = false;
if($params['group']->membership == OSSN_PUBLIC || ($params['group']->membership == OSSN_PRIVATE && $params['ismember'])){
	$members = $params['group']->getMembers();
}
if($params['ismember']){
	fbui_add_user_shortcut(ossn_loggedin_user()->guid, 'group', $params['group']->guid);	
}
?>
<div class="ossn-group-profile">
    <!-- FULL WIDTH TOP HEADER SECTION -->
    <div class="fbui-group-header-card ossn-group-top-row">
        <!-- Light Blurred Cover Backdrop for Side Margins -->
        <?php if ($cover && ossn_isLoggedin()) { ?>
            <div class="fbui-cover-blur-container">
                <div class="fbui-cover-blur-bg" style="background-image: url('<?php echo $params['group']->coverURL(); ?>');"></div>
            </div>
        <?php } ?>

        <div class="fbui-group-header-inner profile-header <?php echo $iscover; ?>">
            
            <!-- Hidden Cover Upload Form -->
            <?php if (ossn_loggedin_user() && ($params['group']->owner_guid == ossn_loggedin_user()->guid || ossn_isAdminLoggedin())) { ?>
                <form id="group-upload-cover" style="display:none;" method="post" enctype="multipart/form-data">
                    <input type="file" name="coverphoto" class="coverfile" onchange="Ossn.Clk('#group-upload-cover .upload');"/>
                    <input type="hidden" value="<?php echo $params['group']->guid; ?>" name="group"/>
                    <input type="submit" class="upload"/>
                </form>
            <?php } ?>

            <!-- Cover Photo Area -->
            <div class="fbui-group-cover-wrapper">
                <div class="ossn-group-cover" id="container">
                    
                    <!-- Reposition Button Wrapper ALWAYS in DOM for JS toggle -->
                    <?php if (ossn_loggedin_user() && ($params['group']->owner_guid == ossn_loggedin_user()->guid || ossn_isAdminLoggedin())) { ?>
                        <div class="ossn-group-cover-button fbui-cover-actions" style="<?php echo ($cover && ossn_isLoggedin()) ? '' : 'display:none;'; ?>">
                            <a href="javascript:void(0);" id="reposition-group-cover" class="fbui-btn-glass">
                                <i class="fa fa-arrows-alt"></i> <?php echo ossn_print('reposition:cover'); ?>
                            </a>
                        </div>
                    <?php } ?>

                    <?php if ($cover && ossn_isLoggedin()) { ?>
                        <img id="draggable"
                             src="<?php echo $params['group']->coverURL(); ?>"
                             style="<?php echo $cover_top; ?><?php echo $cover_left; ?>"
                             data-top="<?php echo $coverp[0]; ?>"
                             data-left="<?php echo $coverp[1]; ?>"/>
                    <?php } else { ?>
                        <!-- Placeholder Image Tag ready for JS AJAX response -->
                        <img id="draggable" style="display:none;" />
                    <?php } ?>

                </div>
            </div>

            <!-- Group Title & Meta Info -->
            <div class="fbui-group-info-bar">
                <div class="fbui-group-info-left">
                    <h1 class="fbui-group-title">
                        <a href="<?php echo ossn_group_url($params['group']->guid); ?>">
                            <?php echo $params['group']->title; ?>
                        </a>
                    </h1>
                    
                    <div class="fbui-group-meta">
                        <span class="fbui-privacy-badge">
                            <i class="fa <?php echo ($params['group']->membership == OSSN_PRIVATE) ? 'fa-lock' : 'fa-globe'; ?>"></i>
                            <?php echo ($params['group']->membership == OSSN_PRIVATE) ? ossn_print('fbui:private:group') : ossn_print('fbui:public:group'); ?>
                        </span>
                        
                        <span class="fbui-dot">&bull;</span>
                        
                        <span class="fbui-member-count">
                            <strong><?php echo $params['group']->getMembers(true); ?></strong> <?php echo ossn_print('fbuitheme:members');?>
                        </span>
                    </div>

                    <!-- Overlapping Stacked Member Avatars -->
                    <?php if ($members) { ?>
                        <div class="fbui-avatar-stack">
                            <?php 
                            $stack_limit = 0;
                            foreach ($members as $member) {
                                if ($stack_limit < 8) { ?>
                                    <a href="<?php echo $member->profileURL(); ?>" title="<?php echo $member->fullname; ?>">
                                        <img src="<?php echo $member->iconURL()->small; ?>" alt="<?php echo $member->fullname; ?>" />
                                    </a>
                                <?php 
                                $stack_limit++;
                                }
                            } 
                            ?>
                        </div>
                    <?php } ?>
                </div>

                <!-- Group Action Buttons Bar -->
                <div class="groups-buttons fbui-group-actions">
                    <?php if (ossn_isLoggedin() && $params['group']->owner_guid !== ossn_loggedin_user()->guid) { ?>

                        <?php if ($params['ismember']) { ?>
                            <a href="<?php echo ossn_site_url("action/group/member/cancel?group={$params['group']->guid}", true); ?>"
                               class="fbui-btn fbui-btn-secondary">
                                <i class="fa fa-user-check"></i> <?php echo ossn_print('leave:group'); ?>
                            </a>
                        <?php } elseif (!$params['group']->requestExists(ossn_loggedin_user()->guid, false)) { ?>
                            <a href="<?php echo ossn_site_url("action/group/join?group={$params['group']->guid}", true); ?>"
                               class="fbui-btn fbui-btn-primary">
                                <i class="fa fa-user-plus"></i> <?php echo ossn_print('join:group'); ?>
                            </a>
                        <?php } ?>

                        <?php if (!$params['ismember'] && $params['group']->requestExists(ossn_loggedin_user()->guid, false)) { ?>
                            <a href="<?php echo ossn_site_url("action/group/member/cancel?group={$params['group']->guid}", true); ?>"
                               class="fbui-btn fbui-btn-secondary">
                                <?php echo ossn_print('cancel:membership'); ?>
                            </a>
                        <?php } ?>

                    <?php } ?>

                    <?php if (ossn_loggedin_user() && ($params['group']->owner_guid == ossn_loggedin_user()->guid || ossn_isAdminLoggedin())) {
                        $params['ismember'] = 1;
                    ?>
                        <!-- Settings Button -->
                        <a href="<?php echo ossn_group_url($params['group']->guid); ?>edit"
                           class="fbui-btn fbui-btn-secondary">
                            <i class="fa fa-cog"></i> <?php echo ossn_print('settings'); ?>
                        </a>

                        <!-- Save Position Button with Icon -->
                        <a href="javascript:void(0);"
                           onclick="Ossn.repositionGroupCOVER(<?php echo $params['group']->guid; ?>);"
                           class="fbui-btn fbui-btn-secondary group-c-position"
                           style="display:none;">
                            <i class="fa fa-check"></i> <?php echo ossn_print('save:position'); ?>
                        </a>

                        <!-- Change Cover Button -->
                        <a href="javascript:void(0);" id="add-cover-group" class="fbui-btn fbui-btn-primary">
                            <i class="fa fa-camera"></i> <?php echo ossn_print('change:cover'); ?>
                        </a>

                    <?php } ?>

                    <?php if (!ossn_isLoggedin()) { ?>
                        <a href="<?php echo ossn_site_url("login"); ?>"
                           class="fbui-btn fbui-btn-primary"
                           id="group-btn-unloggedin-join">
                            <i class="fa fa-user-plus"></i> <?php echo ossn_print('join:group'); ?>
                        </a>
                    <?php } ?>
                </div>
            </div>

            <div class="fbui-divider"></div>

            <!-- Navigation Tabs Bar -->
<div class="fbui-group-nav profile-menu-hr-container">
    <div id="group-header-menu" class="group-header-menu d-none d-lg-block">
        <?php echo ossn_plugin_view('menus/groupheader', array('menu_width' => 60)); ?>
    </div>

    <div id="group-header-menu" class="group-header-menu d-none d-md-block d-lg-none">
        <?php echo ossn_plugin_view('menus/groupheader', array('menu_width' => 40)); ?>
    </div>

    <div id="group-header-menu" class="group-header-menu d-none d-sm-block d-md-none">
        <?php echo ossn_plugin_view('menus/groupheader', array('menu_width' => 25)); ?>
    </div>

    <div id="group-header-menu" class="group-header-menu d-block d-sm-none">
        <?php echo ossn_plugin_view('menus/groupheader', array('menu_width' => 1)); ?>
    </div>
</div>

        </div> <!-- ./fbui-group-header-inner -->
    </div> <!-- ./fbui-group-header-card -->

    <!-- BOTTOM SECTION: FEED WALL & SIDEBAR -->
    <div class="ossn-group-bottom-row margin-top-10">

        <?php
        if (isset($params['subpage']) && !empty($params['subpage']) && ossn_is_group_subapge($params['subpage'])) {
            if (ossn_is_hook('group', 'subpage')) {
                echo ossn_call_hook('group', 'subpage', $params);
            }
        } else {
        ?>

        <div class="row">

            <div class="col-lg-7">
                <div class="group-wall">

                    <?php
                    echo ossn_plugin_view('wall/group', array(
                        'group' => $params,
                        'ismember' => $params['ismember'],
                        'membership' => $params['group']->membership
                    ));
                    ?>

                    <?php if ($params['group']->membership == OSSN_PRIVATE && !$params['ismember']) { ?>
                        <div class="group-closed-container">
                            <?php
                            echo ossn_view_widget(array(
                                'title' => ossn_print('closed:group'),
                                'contents' => "<p>" . ossn_print('close:group:notice') . "</p>"
                            ));
                            ?>
                        </div>
                    <?php } ?>

                </div> <!-- ./group-wall -->
            </div> <!-- ./col-lg-8 -->

            <div class="col-lg-5">
                <div class="d-none d-sm-block">

                    <?php
                    echo ossn_view_widget(array(
                        'title' => ossn_print('about:group'),
                        'contents' => nl2br($params['group']->description),
                        'class' => 'widget-description',
                    ));
                    ?>

                    <?php
                    if (ossn_loggedin_user() && ($params['group']->owner_guid == ossn_loggedin_user()->guid || ossn_isAdminLoggedin() || $params['group']->isModerator(ossn_loggedin_user()->guid))) {

                        $member_requests = ossn_plugin_view('output/url', array(
                            'text' => ossn_print('view:all'),
                            'href' => ossn_group_url($params['group']->guid) . 'requests'
                        ));

                        $requests = $params['group']->countRequests();
                        if ($requests === false) {
                            $requests = 0;
                        }

                        echo ossn_view_widget(array(
                            'title' => ossn_print('member:requests', array($requests)),
                            'contents' => $member_requests,
                            'class' => 'group-requests-widget',
                        ));
                    }
                    ?>

                    <?php
                    $count = $params['group']->getMembers(true);
                    $limit = 1;

                    if ($members) {
                        $members_html = [];

                        foreach ($members as $member) {
                            if ($limit <= 10) {
                                $img = '<img class="user-icon-small" src="' . $member->iconURL()->small . '" title="' . $member->fullname . '"/>';
                                $profile_url = ossn_plugin_view('output/url', array(
                                    'text' => $img,
                                    'href' => $member->profileURL()
                                ));
                                $members_html[] = $profile_url;
                                $limit++;
                            }
                        }

                        echo '<div class="group-widget-members">';
                        echo ossn_view_widget(array(
                            'title' => ossn_print('group:members', array($count)),
                            'contents' => implode('', $members_html)
                        ));
                        echo '</div>';
                    }
                    ?>

                    <?php
                    if (ossn_is_hook('group', 'widgets')) {
                        $params['group'] = $params['group'];
                        $modules = ossn_call_hook('group', 'widgets', $params);
                        if ($modules) {
                            echo implode('', $modules);
                        }
                    }
                    ?>

                </div> <!-- ./page-sidebar -->
            </div> <!-- ./col-lg-4 -->

        </div> <!-- ./row -->

        <?php } ?>

    </div> <!-- ./ossn-group-bottom-row -->

</div>

<script>
    $(document).ready(function() {
        // Intercept global AJAX calls to detect when group cover upload finishes
        $(document).ajaxComplete(function(event, xhr, settings) {
            if (settings.url && settings.url.indexOf('action/group/cover/upload') !== -1) {
                // Unhide the reposition button and display its wrapper container
                $('#reposition-group-cover').show();
                $('.ossn-group-cover-button').show();

                // If side blur background exists, update its image dynamically
                if (xhr.responseJSON && xhr.responseJSON.url) {
                    if ($('.fbui-cover-blur-bg').length) {
                        $('.fbui-cover-blur-bg').css('background-image', 'url("' + xhr.responseJSON.url + '")');
                    } else {
                        $('.fbui-group-header-card').prepend(
                            '<div class="fbui-cover-blur-container"><div class="fbui-cover-blur-bg" style="background-image: url(\'' + xhr.responseJSON.url + '\');"></div></div>'
                        );
                    }
                }
            }
        });
    });
</script>