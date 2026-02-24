<?php
/**
 * OSSN Modern Landing - High Intensity Blobs
 */
$custom_settings = ossn_goblue_get_custom_logos_bgs_setting(); 
?>
<div class="landing-main">
    <div class="row align-items-center">
        <div class="col-lg-6">
            <div class="brand-glass-box">
                <?php if(isset($custom_settings) && isset($custom_settings['logo_site'])){ ?>
                    <img class="main-logo" src="<?php echo ossn_add_cache_to_url(ossn_theme_url("logos_backgrounds/logo_site_{$custom_settings['logo_site']}"));?>" />
                <?php } else { ?>
                    <img class="main-logo" src="<?php echo ossn_theme_url();?>images/logo.png" />                
                <?php } ?>
            </div>
            
            <h1 class="display-4 fw-bold text-dark mt-4">
                <?php echo ossn_print('home:top:heading', array(ossn_site_settings('site_name'))); ?>
            </h1>
            
            <div class="modern-features mt-4">
                <span class="feature-tag"><i class="fa fa-users"></i> <?php echo ossn_print('feature:homepage:groups'); ?></span>
                <span class="feature-tag"><i class="fa fa-id-badge"></i> <?php echo ossn_print('feature:homepage:profiles'); ?></span>
                <span class="feature-tag"><i class="fa fa-camera"></i> <?php echo ossn_print('feature:homepage:photos'); ?></span>
                <span class="feature-tag"><i class="fa fa-comment"></i> <?php echo ossn_print('feature:homepage:comments'); ?></span>
                <span class="feature-tag"><i class="fa fa-thumbs-up"></i> <?php echo ossn_print('feature:homepage:likes'); ?></span>
                <span class="feature-tag"><i class="fa fa-paper-plane"></i> <?php echo ossn_print('feature:homepage:messaging'); ?></span>
                <span class="feature-tag"><i class="fa fa-bell"></i> <?php echo ossn_print('feature:homepage:notifications'); ?></span>
                <span class="feature-tag"><i class="fa fa-search"></i> <?php echo ossn_print('feature:homepage:search'); ?></span>
                <span class="feature-tag"><i class="fa fa-share-alt"></i> <?php echo ossn_print('feature:homepage:collaboration'); ?></span>
            </div>
        </div>

        <div class="col-lg-5 offset-lg-1">
            <div class="glass-signup-card">
                <div class="signup-title">
                    <h2><?php echo ossn_print('create:account'); ?></h2>
                    <span><?php echo ossn_print('its:free'); ?></span>
                </div>
                <?php 
                    echo ossn_view_form('signup', array(
                        'id' => 'ossn-home-signup',
                        'action' => ossn_site_url('action/user/register')
                    ));
                ?>
            </div>
        </div>
    </div>
</div>