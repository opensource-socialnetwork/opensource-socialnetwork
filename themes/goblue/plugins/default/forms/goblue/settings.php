 <fieldset class="titleform">
 	<div class="alert alert-warning">
    	<?php echo ossn_print('theme:goblue:browercache');?>
    </div>	
 	<div>	
    	<label><?php echo ossn_print('theme:goblue:logo:site');?> (450x90 - 500 KB PNG) </label>
        <input type="file" name="logo_site" />
        <div class="logo-container-goblue">
            	<?php if(ossn_site_settings('cache') == true){?>
            	<img src="<?php echo ossn_theme_url();?>images/logo.png" />
                <?php } else { ?>
            	<img src="<?php echo ossn_theme_url();?>images/logo.png?v=<?php echo time();?>" />                
                <?php } ?>
        </div>
    </div>
  	<div>	
    	<label><?php echo ossn_print('theme:goblue:logo:admin');?> (180x45 - 500 KB JPG)</label>
        <input type="file" name="logo_admin" />
        <div class="logo-container-goblue">
            			<?php if(ossn_site_settings('cache') == true){?>
            			<img src="<?php echo ossn_theme_url(); ?>images/logo_admin.jpg"/>
                        <?php } else { ?>
            			<img src="<?php echo ossn_theme_url(); ?>images/logo_admin.jpg?ver=<?php echo time();?>"/>                        
                        <?php } ?> 
        </div>
    </div>   
	<input type="submit" class="btn btn-success btn-sm" value="<?php echo ossn_print('save');?>"/>
</fieldset>