<?php
$custom_settings = ossn_fbui_get_custom_logos_bgs_setting();
?>
<style>
body { background:#fff; }
.topbar { display:none; }
.landing-split .collage i {
	margin-right:0;	
}
</style>
<div class="landing-split">
    <!-- LEFT PANEL -->
    <div class="landing-split__left">

        <div class="brand-glass-box">
            <?php if (isset($custom_settings) && isset($custom_settings['icon_site'])) { ?>
                <img class="main-logo" src="<?php echo ossn_add_cache_to_url(ossn_theme_url("logos_backgrounds/icon_site_{$custom_settings['icon_site']}")); ?>" />
            <?php } else { ?>
                <img class="main-logo" src="<?php echo ossn_theme_url(); ?>images/icon.png" />
            <?php } ?>
        </div>

        <!-- decorative collage, pure CSS, no external images -->
        <div class="collage">
            <div class="collage-card collage-card--a">
                <span class="collage-card__icon"><i class="fas fa-image"></i></span>
            </div>
            <div class="collage-card collage-card--b">
                <div class="collage-card__bar"></div>
                <span class="collage-card__icon"><i class="fas fa-circle-user"></i></span>
                <div class="collage-card__lines">
                    <span></span><span></span><span></span>
                </div>
            </div>
            <div class="collage-card collage-card--c">
                <span class="collage-card__icon"><i class="fas fa-location-dot"></i></span>
            </div>
            <div class="collage-card collage-card--d">
                <span class="collage-card__icon"><i class="fas fa-comment-dots"></i></span>
            </div>
            <div class="collage-badge collage-badge--time"><i class="fas fa-clock"></i> 16:45</div>
            <div class="collage-badge collage-badge--emoji"><i class="fas fa-face-smile"></i></div>
            <div class="collage-badge collage-badge--heart"><i class="fas fa-heart"></i></div>
            <div class="collage-avatar"><i class="fas fa-user"></i></div>
        </div>

        <h1 class="landing-split__heading">
            <?php echo ossn_print('landing:connect:with:people'); ?><br>
            with the people<br>
            <span class="text-highlight"><?php echo ossn_print('landing:people:you:love'); ?></span>
        </h1>

        <div class="modern-features">
            <span class="feature-tag"><i class="fas fa-users"></i> <?php echo ossn_print('feature:homepage:groups'); ?></span>
            <span class="feature-tag"><i class="fas fa-id-badge"></i> <?php echo ossn_print('feature:homepage:profiles'); ?></span>
            <span class="feature-tag"><i class="fas fa-camera"></i> <?php echo ossn_print('feature:homepage:photos'); ?></span>
            <span class="feature-tag"><i class="fas fa-comment"></i> <?php echo ossn_print('feature:homepage:comments'); ?></span>
            <span class="feature-tag"><i class="fas fa-thumbs-up"></i> <?php echo ossn_print('feature:homepage:likes'); ?></span>
            <span class="feature-tag"><i class="fas fa-paper-plane"></i> <?php echo ossn_print('feature:homepage:messaging'); ?></span>
            <span class="feature-tag"><i class="fas fa-bell"></i> <?php echo ossn_print('feature:homepage:notifications'); ?></span>
            <span class="feature-tag"><i class="fas fa-magnifying-glass"></i> <?php echo ossn_print('feature:homepage:search'); ?></span>
            <span class="feature-tag"><i class="fas fa-share-nodes"></i> <?php echo ossn_print('feature:homepage:collaboration'); ?></span>
        </div>

    </div>

    <!-- RIGHT PANEL (Dynamic Switcher: Login default, Signup toggled) -->
    <div class="landing-split__right">

        <!-- LOGIN FORM VIEW (Default) -->
        <div class="signup-panel auth-form-box" id="login-box">
            <div class="signup-title">
                <h2><?php echo ossn_print('site:login'); ?></h2>
                <span><?php echo ossn_print('welcome:back:details'); ?></span>
            </div>
            <?php
                echo ossn_view_form('login2', array(
                    'id'    => 'ossn-home-login',
                    'action' => ossn_site_url('action/user/login'),
                ));
            ?>
            
            <!-- Forgot / Reset Password Link -->
            <div class="text-center mt-3">
                <a href="<?php echo ossn_site_url('resetlogin'); ?>" class="forgot-link text-muted small text-decoration-none">
                    <i class="fa fa-question-circle"></i> <?php echo ossn_print('reset:login'); ?>
                </a>
            </div>

            <div class="auth-switch-text">
                <?php echo ossn_print('auth:dont:have:account'); ?> <a href="javascript:void(0);" onclick="toggleAuthForms('signup')"><?php echo ossn_print('auth:create:new:account'); ?></a>
            </div>
            <?php if (isset($custom_settings) && isset($custom_settings['logo_site'])) { ?>
                <img class="sidepanel-logo" src="<?php echo ossn_add_cache_to_url(ossn_theme_url("logos_backgrounds/logo_site_{$custom_settings['logo_site']}")); ?>" />
            <?php } else { ?>
                <img class="sidepanel-logo" src="<?php echo ossn_theme_url(); ?>images/logo.png" />
            <?php } ?>   
        </div>

        <!-- SIGNUP FORM VIEW (Hidden by default, toggled via JS) -->
        <div class="signup-panel auth-form-box" id="signup-box" style="display: none;">
            <div class="signup-title">
                <h2><?php echo ossn_print('create:account'); ?></h2>
                <span><?php echo ossn_print('its:free'); ?></span>
            </div>
            <?php
                echo ossn_view_form('signup', array(
                    'id'    => 'ossn-home-signup',
                    'action' => ossn_site_url('action/user/register'),
                ));
            ?>
            <div class="auth-switch-text">
                <?php echo ossn_print('auth:already:have:account'); ?> <a href="javascript:void(0);" onclick="toggleAuthForms('login')"><?php echo ossn_print('auth:log:in'); ?></a>
            </div>
            <?php if (isset($custom_settings) && isset($custom_settings['logo_site'])) { ?>
                <img class="sidepanel-logo" src="<?php echo ossn_add_cache_to_url(ossn_theme_url("logos_backgrounds/logo_site_{$custom_settings['logo_site']}")); ?>" />
            <?php } else { ?>
                <img class="sidepanel-logo" src="<?php echo ossn_theme_url(); ?>images/logo.png" />
            <?php } ?>            
        </div>
    </div>
</div>

<script>
function toggleAuthForms(formType) {
    if (formType === 'signup') {
        document.getElementById('login-box').style.display = 'none';
        document.getElementById('signup-box').style.display = 'block';
    } else {
        document.getElementById('signup-box').style.display = 'none';
        document.getElementById('login-box').style.display = 'block';
    }
}
</script>