<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$user = $params['user'];
$cover = new OssnProfile;

$coverp = $cover->coverParameters($user->guid);
$cover = $cover->getCoverURL($user);

if(!empty($coverp[0])){
	$cover_top = "top:{$coverp[0]};";
}
if(!empty($coverp[1])){
	$cover_left = "left:{$coverp[1]};";
}
if (ossn_isLoggedIn()) {
    $class = 'ossn-profile';
} else {
    $class = 'ossn-profile ossn-profile-tn';
}
?>
<div class="ossn-profile container">
	<div class="row">
    	<div class="col-md-11">
			<div class="<?php echo $class; ?>">
				<div class="top-container">
					<div id="container" class="profile-cover">
						<?php if (ossn_loggedin_user()->guid == $user->guid) { ?>
						<div class="profile-cover-controls">
							<a href="javascript:void(0);" onclick="Ossn.Clk('.coverfile');" class='btn-action change-cover'>
								<?php echo ossn_print( 'change:cover'); ?>
							</a>
							<a href="javascript:void(0);" id="reposition-cover" class='btn-action reposition-cover'>
								<?php echo ossn_print( 'reposition:cover'); ?>
							</a>
						</div>
						<form id="upload-cover" style="display:none;" method="post" enctype="multipart/form-data">
							<input type="file" name="coverphoto" class="coverfile" onchange="Ossn.Clk('#upload-cover .upload');" />
							<?php echo ossn_plugin_view( 'input/security_token'); ?>
							<input type="submit" class="upload" />
						</form>
						<?php } ?>
						<img id="draggable" class="profile-cover-img" src="<?php echo $cover; ?>" style='<?php echo $cover_top; ?><?php echo $cover_left; ?>' />
					</div>
					<div class="profile-photo">
						<?php if (ossn_loggedin_user()->guid == $user->guid) { ?>
						<div class="upload-photo" style="display:none;cursor:pointer;">
							<span onclick="Ossn.Clk('.pfile');"><?php echo ossn_print('change:photo'); ?></span>

							<form id="upload-photo" style="display:none;" method="post" enctype="multipart/form-data">
								<input type="file" name="userphoto" class="pfile" onchange="Ossn.Clk('#upload-photo .upload');" />
								<?php echo ossn_plugin_view( 'input/security_token'); ?>
								<input type="submit" class="upload" />
							</form>
						</div>
						<?php } 
						$viewer= '' ; 
						if (ossn_isLoggedIn() && get_profile_photo_guid($user->guid)) { 
								$viewer = 'onclick="Ossn.Viewer(\'photos/viewer?user=' . $user->username . '\');"';
						}
						?>
						<img src="<?php echo $user->iconURL()->larger; ?>" height="170" width="170" <?php echo $viewer; ?> />
					</div>
					<div class="user-fullname"><?php echo $user->fullname; ?></div>
                    <?php echo ossn_plugin_view('profile/role', array('user' => $user)); ?>
					<div id='profile-hr-menu' class="profile-hr-menu">
						<?php echo ossn_view_menu( 'user_timeline'); ?>
					</div>

					<div id="profile-menu" class="profile-menu">
						<?php if (ossn_isLoggedIn()) { if (ossn_loggedin_user()->guid == $user->guid) { ?>
						<a href="<?php echo $user->profileURL('/edit'); ?>" class='btn-action'>
							<?php echo ossn_print( 'update:info'); ?>
						</a>
						<?php } ?>
						<?php if (ossn_loggedin_user()->guid !== $user->guid) { if (!ossn_user_is_friend(ossn_loggedin_user()->guid, $user->guid)) { if (ossn_user()->requestExists(ossn_loggedin_user()->guid, $user->guid)) { ?>
						<a href="<?php echo ossn_site_url("action/friend/remove?cancel=true&user={$user->guid}", true); ?>" class='btn-action'>
                                <?php echo ossn_print('cancel:request'); ?>
                            </a>
						<?php } else { ?>
						<a href="<?php echo ossn_site_url("action/friend/add?user={$user->guid}", true); ?>" class='btn-action'>
                                <?php echo ossn_print('add:friend'); ?>
                         </a>
						<?php } } else { ?>
						<a href="<?php echo ossn_site_url("action/friend/remove?user={$user->guid}", true); ?>"  class='btn-action'>
                            <?php echo ossn_print('remove:friend'); ?>
                        </a>
						<?php } ?>
					  	<a href="<?php echo ossn_site_url("messages/message/{$user->username}"); ?>" id="profile-message" data-guid='<?php echo $user->guid; ?>' class='btn-action'>
                        <?php echo ossn_print('message'); ?></a>
						<div class="ossn-profile-extra-menu dropdown">
							<?php echo ossn_view_menu( 'profile_extramenu', 'profile/menus/extra'); ?>
						</div>
						<?php } }?>
					</div>
					<div id="cover-menu" class="profile-menu">
						<a href="javascript:void(0);" onclick="Ossn.repositionCOVER();" class='btn-action'>
							<?php echo ossn_print('save:position'); ?>
						</a>
					</div>
				</div>

			</div>   
          </div>   
    </div>
	<div class="row ossn-profile-bottom">
	 <?php if (isset($params['subpage']) && !empty($params[ 'subpage']) && ossn_is_profile_subapge($params['subpage'])) { 
 				if (ossn_is_hook( 'profile', 'subpage')) { 
							echo ossn_call_hook('profile', 'subpage', $params);
				}
			} else { ?>   
            <div class="col-md-7">
					<div class="ossn-profile-wall">
						<?php 
						if(com_is_active('OssnWall')) { 
								$params['user'] =  $user; 
								echo ossn_plugin_view('wall/user/wall', $params); 
						} ?>
					</div>
         </div>      
		<div class="col-md-4">
			<div class="ossn-profile-sidebar hidden-xs">
				<?php if (com_is_active( 'OssnAds')) { echo ossn_plugin_view( 'ads/page/view_small'); } ?>
 				<div class="ossn-profile-modules">
					<?php if (ossn_is_hook( 'profile', 'modules')) { 
								$params[ 'user'] = $user; 
								$modules = ossn_call_hook('profile', 'modules', $params); 
								echo implode( '', $modules);
					} ?>

				</div>               
			</div>
		</div>
       <?php } ?>  
	</div>
</div>