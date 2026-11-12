<?php
/**
 * OpenSource-SocialNetwork
 *
 * @package   Open Source Social Network (OSSN)
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
ossn_load_external_js('jquery.tokeninput'); 
$user = ossn_loggedin_user();
?>

<!-- ====================================================================
     1. DUMMY FACEBOOK BOX (Always visible on newsfeed)
     ==================================================================== -->
<div class="fbui-wall-dummy-box" id="fbui-wall-dummy">
    <div class="fbui-dummy-avatar">
        <img src="<?php echo $user->iconURL()->smaller; ?>" alt="<?php echo $user->fullname; ?>" />
    </div>
    
    <div class="fbui-dummy-input" role="button">
        <span><?php echo ossn_print('wall:post:container'); ?></span>
    </div>

    <div class="fbui-dummy-actions">
		<button type="button" class="fbui-action-btn icon-live" title="<?php echo ossn_print('fbui:live'); ?>">
  		  	 <i class="fa fa-video"></i>
		</button>
		<button type="button" class="fbui-action-btn icon-photo" title="<?php echo ossn_print('fbui:photo'); ?>">
   		 	 <i class="fa fa-images"></i>
		</button>
		<button type="button" class="fbui-action-btn icon-emoji" title="<?php echo ossn_print('fbui:activity'); ?>">
   			 <i class="far fa-face-smile"></i>
		</button>
    </div>
</div>

<!-- ====================================================================
     2. POPUP MODAL OVERLAY & CONTAINER (Hidden by default)
     ==================================================================== -->
<div class="fbui-wall-modal-overlay" id="fbui-wall-modal-overlay" style="display: none;">
    <div class="fbui-modal-dialog">
        
        <!-- Modal Header -->
        <div class="fbui-modal-header">
            <h3><?php echo ossn_print('fbui:create:post'); ?></h3>
            <button type="button" class="fbui-modal-close" id="fbui-modal-close-btn" title="Close">
                <i class="fa fa-xmark"></i>
            </button>
        </div>

        <!-- Modal Body / Real OSSN Form -->
        <div class="fbui-modal-body">
            <div class="fbui-wall-real-container" id="fbui-wall-real">
                
                <div class="tabs-input">
                    <div class="wall-tabs">
                        <?php echo ossn_view_menu('wall/container/user', 'wall/menus/container');  ?>
                    </div>
                </div>

                <div class="ossn-wall-container-data ossn-wall-container-data-post" data-type="post">
                    
                    <!-- User Header Row: Avatar + Name + Privacy Button Below Name -->
                    <div class="fbui-user-header-row">
                        <div class="ossn-wall-userimage-form">
                            <img src="<?php echo $user->iconURL()->smaller;?>" />
                        </div>
                        <div class="fbui-user-info">
                            <span class="fbui-user-name"><?php echo $user->fullname; ?></span>
                            
                            <!-- Privacy Selector Pill under Name -->
                            <div class="ossn-wall-privacy">
                                <span>
                                    <i class="ossn-wall-privacy-lock fa fa-globe-americas"></i>
                                    <span><?php echo ossn_print('privacy'); ?></span>
                                    <i class="fa fa-caret-down fbui-privacy-arrow"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Textarea Area -->
                    <div contenteditable="true" class="ossn-wall-textarea" placeholder="<?php echo ossn_print('wall:post:container'); ?>"></div>
                    
                    <!-- Dynamic Extra Inputs -->
                    <div id="ossn-wall-friend" style="display:none;">
                        <input type="text" placeholder="<?php echo ossn_print('tag:friends'); ?>" name="friends" id="ossn-wall-friend-input" />
                    </div>
                    <div id="ossn-wall-location" style="display:none;">
                        <input type="text" placeholder="<?php echo ossn_print('enter:location'); ?>" name="location" id="ossn-wall-location-input" />
                    </div>
                    <div id="ossn-wall-photo" style="display:none;">
                        <input type="file" name="ossn_photo" accept="image/*" />
                    </div>
                    
                    <!-- Action Bar with Localized Data Attribute -->
                    <div class="controls" data-title="<?php echo ossn_print('wall:addtopost'); ?>">
                        <?php echo ossn_view_menu('wall/container/controls/user', 'wall/menus/container_controls');  ?>          
                    </div>
                    
                    <!-- Full-Width Post Button Bar at Bottom -->
                    <div class="ossn-wall-post-button-container">
                        <div class="ossn-loading ossn-hidden"></div>
                        <input class="btn btn-primary btn-sm ossn-wall-post" type="button" value="<?php echo ossn_print('post'); ?>" />
                    </div>
                    
                    <input type="hidden" value="<?php echo $params['user']->guid; ?>" name="wallowner"/>
                    <input type="hidden" name="privacy" id="ossn-wall-privacy" value="<?php echo $privacy; ?>" />
                </div>
            </div>
        </div>

    </div>
</div>