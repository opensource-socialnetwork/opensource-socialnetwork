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
$custom_settings = ossn_goblue_get_custom_logos_bgs_setting(); 
?>
<div class="row ossn-page-contents">
		<div class="col-lg-6 home-left-contents">
			<div class="logo">
            	<?php if(isset($custom_settings) && isset($custom_settings['logo_site'])){ ?>
            		<img src="<?php echo ossn_add_cache_to_url(ossn_theme_url("logos_backgrounds/logo_site_{$custom_settings['logo_site']}"));?>" />
                <?php } else { ?>
            		<img src="<?php echo ossn_theme_url();?>images/logo.png" />                
                <?php } ?>
            </div>	
            <div class="description">
            	<?php echo ossn_print('home:top:heading', array(ossn_site_settings('site_name'))); ?>
            </div>
            <div class="buttons">
            	<a href="<?php echo ossn_site_url('login');?>" class="btn btn-primary btn-sm"><?php echo ossn_print('site:login'); ?></a>
                <a href="<?php echo ossn_site_url('resetlogin');?>" class="btn btn-warning btn-sm"><?php echo ossn_print('reset:login'); ?></a>
            </div>
           <div class="landing-page-icons">
                	<span class="landing-page-icons-span"><i class="fa fa-users fa-3x"></i></span>
                	<span class="landing-page-icons-span"><i class="fa fa-comments fa-3x"></i></span>
                	<span class="landing-page-icons-span"><i class="fa fa-envelope fa-3x"></i></span>
                	<span class="landing-page-icons-span"><i class="fa fa-globe-americas fa-3x"></i></span>
                	<span class="landing-page-icons-span"><i class="fa fa-image fa-3x"></i></span>
                	<span class="landing-page-icons-span"><i class="fa fa-video fa-3x"></i></span>
                	<span class="landing-page-icons-span"><i class="fa fa-map-marker fa-3x"></i></span>
                	<span class="landing-page-icons-span"><i class="fa fa-calendar fa-3x"></i></span>
            </div>
 	   </div>   
       <div class="col-lg-6">
    	<?php 
			$contents = ossn_view_form('signup', array(
        				'id' => 'ossn-home-signup',
        				'action' => ossn_site_url('action/user/register')
	   	 	));
			$heading = "<p>".ossn_print('its:free')."</p>";
			echo ossn_plugin_view('widget/view', array(
						'title' => ossn_print('create:account'),
						'contents' => $heading.$contents,
			));
			?>	       			
       </div>     
</div>	
