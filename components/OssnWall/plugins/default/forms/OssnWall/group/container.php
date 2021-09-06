<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright (C) OpenTeknik LLC
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */
  ossn_load_external_js('places.min');
  ossn_load_external_js('jquery.tokeninput'); 
?>
<div class="tabs-input">
    <div class="wall-tabs">
        <?php
			echo ossn_view_menu('wall/container/group', 'wall/menus/container'); 
		?>
    </div>
</div>
<div class="ossn-wall-container-data ossn-wall-container-data-post" data-type="post">
    <textarea placeholder="<?php echo ossn_print('wall:post:container'); ?>" name="post"></textarea>
    <div id="ossn-wall-location" style="display:none;">
        <input type="text" placeholder="<?php echo ossn_print('enter:location'); ?>" name="location" id="ossn-wall-location-input" />
    </div>
    <div id="ossn-wall-photo" style="display:none;">
        <input type="file" name="ossn_photo" />
    </div>
    <div class="controls">
        <?php
			echo ossn_view_menu('wall/container/controls/group', 'wall/menus/container_controls'); 
		?>      
    </div>
    <div class='ossn-wall-post-button-container'>
            <div class="ossn-loading ossn-hidden"></div>
            <input class="btn btn-primary ossn-wall-post" type="submit" value="<?php echo ossn_print('post'); ?>" />
    </div>  
    <div class="ossn-wall-privacy-dummy">
    		<?php if($params['group']['group']->membership == OSSN_PUBLIC){ ?>
            <span title="<?php echo ossn_print('privacy:group:public');?>"><i class="ossn-wall-privacy-lock fa fa-lock"></i><span class=""><?php echo ossn_print('public'); ?></span></span>
            <?php } else {?>
            <span title="<?php echo ossn_print('privacy:group:close');?>"><i class="ossn-wall-privacy-lock fa fa-lock"></i><span class=""><?php echo ossn_print('close'); ?></span></span>            
            <?php } ?> 
    </div>          
	 <input type="hidden" value="<?php echo $params['group']['group']->guid; ?>" name="wallowner"/>
</div>
