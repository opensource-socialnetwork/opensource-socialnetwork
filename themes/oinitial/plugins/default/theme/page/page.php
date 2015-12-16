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
$sitename = ossn_site_settings('site_name');
if (isset($params['title'])) {
    $title = $params['title'] . ' : ' . $sitename;
} else {
    $title = $sitename;
}
if (isset($params['contents'])) {
    $contents = $params['contents'];
} else {
    $contents = '';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo $title; ?></title>

	<?php echo ossn_fetch_extend_views('ossn/endpoint'); ?>
    <?php echo ossn_fetch_extend_views('ossn/site/head'); ?>

    <script>
        <?php echo ossn_fetch_extend_views('ossn/js/head'); ?>
    </script>
</head>

<body>
<div class="ossn-halt ossn-light"></div>
<div class="ossn-message-box"></div>
<div class="ossn-viewer" style="display:none"></div>
<div class="ossn-system-messages">
	<div class="ossn-system-messages-inner">
    		<?php echo ossn_display_system_messages(); ?>
    </div>
</div>
<?php if (!ossn_isLoggedin()) { ?>
    <div class="ossn-header">
        <div class="inner">
            <a href="<?php echo ossn_site_url(); ?>">
                <div class="ossn-logo"></div>
            </a>
            <?php echo ossn_view_form('login', array(
                'id' => 'ossn-header-login',
                'action' => ossn_site_url('action/user/login'),
                'method' => 'post'
            )); ?>

        </div>
    </div>
<?php } else { ?>
    <div class="ossn-topbar">
        <div class="inner">
            <a href="<?php echo ossn_site_url(); ?>">
			<div class="logo-second"></div>
			</a>
            <div class="ossn-search">
                <form action="<?php echo ossn_site_url("search"); ?>" method="get">
                    <input type="text" name="q" placeholder="<?php echo ossn_print('ossn:search:topbar:search');?>"
                           onblur="if (this.value=='') { this.value=Ossn.Print('ossn:search'); }"
                           onFocus="if (this.value==Ossn.Print('ossn:search');) { this.value='' };"/>
                </form>
            </div>
            <div class="ossn-topbar-menu">
                <li>
                    <a href="<?php echo ossn_site_url(); ?>u/<?php echo ossn_loggedin_user()->username; ?>?ref=ossntb">
                        <img src="<?php echo ossn_loggedin_user()->iconURL()->topbar; ?>" height="20" width="20"/>
                        <span><?php echo ossn_loggedin_user()->first_name; ?></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo ossn_site_url(); ?>home"><span><?php echo ossn_print('home'); ?></span></a>
                </li>

                <?php echo ossn_plugin_view('notifications/page/topbar'); ?>

                <div class="ossn-topbar-dropdown-menu">
                	<?php echo ossn_view_menu('topbar_dropdown'); ?>
                </div>
            </div>
<!-- notification box -->
        <div class="ossn-notifications-box" style="height: 140px;">
            <div class="selected"></div>
            <div class="type-name"> <?php echo ossn_print('notifications'); ?> </div>
            <div class="metadata">
                <div style="height: 66px;">
                    <div class="ossn-loading ossn-notification-box-loading"></div>
                </div>
                <div class="bottom-all">
                    <a href="#"><?php echo ossn_print('see:all'); ?></a>
                </div>
            </div>
        </div>
<!-- notification box end -->
        </div>
    </div>
    <div class="ossn-content-spacing"></div>
<?php } ?>

<div class="ossn-contents">
    <?php echo $contents; ?>
</div>
<div class="ossn-footer">
    <div class="ossn-footer-inner">
        <div class="ossn-footer-menu">
            <?php echo ossn_view_menu('footer'); ?>
        </div>
    </div>
</div>
<?php echo ossn_fetch_extend_views('ossn/page/footer'); ?>
</body>
</html>
