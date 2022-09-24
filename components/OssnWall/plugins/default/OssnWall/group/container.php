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
 ossn_load_external_js('maps.google');
 ossn_load_external_js('jquery.tokeninput');   
?>
<div class="tabs-input">
    <div class="wall-tabs">
        <div class="item">
            <div class="ossn-wall-status"></div>
            <div class="text"><?php echo ossn_print('post'); ?></div>
        </div>
    </div>
    <textarea placeholder="<?php echo ossn_print('wall:post:container'); ?>" name="post"></textarea>

    <!--
    //Remove of Algolia places API. Migrating to a new component #2184
    <div id="ossn-wall-location" style="display:none;">
        <input type="text" placeholder="<?php echo ossn_print('enter:location'); ?>" name="location"
               id="ossn-wall-location-input"/>
    </div>
    -->
    <div id="ossn-wall-photo" style="display:none;">
        <input type="file" name="ossn_photo"/>
    </div>
</div>
<div class="controls">
    <li class="ossn-wall-location">
       <i class="fa fa-map-marker"></i>
    </li>
    <li class="ossn-wall-photo">
       <i class="fa fa-image"></i>
    </li>
    <div style="float:right;">
        <input type="hidden" value="<?php echo $params['group']['group']->guid; ?>" name="wallowner"/>
     	<div class="ossn-loading ossn-hidden"></div>     
        <input class="btn btn-primary ossn-wall-post" type="submit" value="<?php echo ossn_print('post'); ?>"/>
    </div>
</div>