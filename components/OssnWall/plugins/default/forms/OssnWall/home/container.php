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
if (!isset($params['user']->guid)) {
    $params['user'] = new stdClass;
    $params['user']->guid = '';
}
if (isset($_COOKIE['ossn_home_wall_privacy'])) {
    $privacy = $_COOKIE['ossn_home_wall_privacy'];
} else {
    $privacy = OSSN_PUBLIC;
}
 ossn_load_external_js('places.min');
 ossn_load_external_js('jquery.tokeninput'); 
?>
<div class="tabs-input">
    <div class="wall-tabs">
        <?php
			echo ossn_view_menu('wall/container/home', 'wall/menus/container'); 
		?>
    </div>
</div>
<div class="ossn-wall-container-data ossn-wall-container-data-post" data-type="post">
    <textarea placeholder="<?php echo ossn_print('wall:post:container'); ?>" name="post"></textarea>
    <div id="ossn-wall-friend" style="display:none;">
        <input type="text" placeholder="<?php echo ossn_print('tag:friends'); ?>" name="friends" id="ossn-wall-friend-input" />
    </div>
    <div id="ossn-wall-location" style="display:none;">
        <input type="text" placeholder="<?php echo ossn_print('enter:location'); ?>" name="location" id="ossn-wall-location-input" />
    </div>
    <div id="ossn-wall-photo" style="display:none;">
        <input type="file" name="ossn_photo" />
    </div>
    <div class="controls">
        <?php
			echo ossn_view_menu('wall/container/controls/home', 'wall/menus/container_controls'); 
		?>            
    </div>
    <div class='ossn-wall-post-button-container'>
            <div class="ossn-loading ossn-hidden"></div>
            <input class="btn btn-primary ossn-wall-post" type="submit" value="<?php echo ossn_print('post'); ?>" />
    </div>
    <div class="ossn-wall-privacy">
            <span><i class="ossn-wall-privacy-lock fa fa-lock"></i><span class=""><?php echo ossn_print('privacy'); ?></span></span>
    </div>           
    <input type="hidden" value="<?php echo $params['user']->guid; ?>" name="wallowner" />
    <input type="hidden" name="privacy" id="ossn-wall-privacy" value="<?php echo $privacy; ?>" />
</div>
