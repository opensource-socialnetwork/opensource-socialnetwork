<?php
  $custom_settings = ossn_goblue_get_custom_logos_bgs_setting();
?>
 <fieldset class="titleform">
 	<div class="alert alert-warning">
    	<?php echo ossn_print('theme:goblue:browercache');?>
    </div>	
 	<div>	
    	<label><?php echo ossn_print('theme:goblue:logo:site');?> (450x90 - 500 KB) </label>
        <input type="file" name="logo_site" />
        <div class="logo-container-goblue">
        		<?php
					if(isset($custom_settings) && isset($custom_settings['logo_site'])){
						$logo_url = ossn_add_cache_to_url(ossn_theme_url("logos_backgrounds/logo_site_{$custom_settings['logo_site']}"));
					} else {
						$logo_url = ossn_add_cache_to_url(ossn_theme_url("images/logo.png?v={$time}"));
					}
				?>
            	<img src="<?php echo $logo_url;?>" />
        </div>
    </div>
  	<div>	
    	<label><?php echo ossn_print('theme:goblue:logo:admin');?> (180x45 - 500 KB)</label>
        <input type="file" name="logo_admin" />
        <div class="logo-container-goblue">
        		<?php
					if(isset($custom_settings) && isset($custom_settings['logo_admin'])){
						$logo_url = ossn_add_cache_to_url(ossn_theme_url("logos_backgrounds/logo_admin_{$custom_settings['logo_admin']}"));
					} else {					
						$logo_url = ossn_add_cache_to_url(ossn_theme_url("images/logo_admin.jpg?v={$time}"));
					}
				?>
            	<img src="<?php echo $logo_url;?>" />                        
        </div>
    </div>   
	<input type="submit" class="btn btn-success btn-sm d-inline-block" value="<?php echo ossn_print('save');?>"/>
    <a href="<?php echo ossn_site_url("action/goblue/settings/logos_bgs_reset", true);?>" class="btn btn-danger d-inline-block right btn-sm"><i class="fa-solid fa-rotate"></i> Reset</a>
</fieldset>
