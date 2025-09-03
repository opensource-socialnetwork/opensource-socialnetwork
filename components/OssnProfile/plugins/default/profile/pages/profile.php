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

$user = $params['user'];
$cover = new OssnProfile;

$coverp = $cover->coverParameters($user->guid);
$cover = $cover->getCoverURL($user);

if(!isset($coverp[0])){
	$coverp[0] = '';
}	
if(!isset($coverp[1])){
	$coverp[1] = '';
}	
$cover_top = '';
if(!empty($coverp[0])){
	$cover_top = "top:{$coverp[0]};";
}
$cover_left = '';
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
		<div class="col-lg-11">
			<div class="<?php echo $class; ?>">
				<div class="top-container">
					<div id="container" class="profile-cover">
						<?php if (ossn_loggedin_user() && ossn_loggedin_user()->guid == $user->guid) { ?>
						<div class="profile-cover-controls" style="cursor:pointer;">
							<a href="javascript:void(0);" onclick="Ossn.Clk('.coverfile');" class='btn-action change-cover'>
							<?php echo ossn_print( 'change:cover'); ?>
							</a>
							<a href="javascript:void(0);" id="reposition-profile-cover" class='btn-action reposition-cover'>
							<?php echo ossn_print( 'reposition:cover'); ?>
							</a>
						</div>
						<form id="upload-cover" style="display:none;" method="post" enctype="multipart/form-data">
							<input type="file" name="coverphoto" class="coverfile" onchange="Ossn.Clk('#upload-cover .upload');" />
							<?php echo ossn_plugin_view( 'input/security_token'); ?>
							<input type="submit" class="upload" />
						</form>
						<?php } ?>
						<img id="draggable" class="profile-cover-img" src="<?php echo $cover; ?>" style='<?php echo $cover_top; ?><?php echo $cover_left; ?>' data-top='<?php echo $coverp[0]; ?>' data-left='<?php echo $coverp[1]; ?>'/>
					</div>
					<div class="ossn-profile-usermetadata">
						<div class="profile-photo">
							<?php if (ossn_loggedin_user() && ossn_loggedin_user()->guid == $user->guid) { ?>
							<div class="upload-photo" style="cursor:pointer;">
								<span onclick="Ossn.Clk('.pfile');" title="<?php echo ossn_print('change:photo'); ?>"><i class="fa-solid fa-camera"></i></span>
								<form id="upload-photo" style="display:none;" method="post" enctype="multipart/form-data">
									<input type="file" name="userphoto" class="pfile" onchange="Ossn.Clk('#upload-photo .upload');" />
									<?php echo ossn_plugin_view( 'input/security_token'); ?>
									<input type="submit" class="upload" />
								</form>
							</div>
							<?php } 
								//issues with ossn-viewer-comments #1411 (removed viewer)
								?>
							<img src="<?php echo $user->iconURL()->larger; ?>" />
						</div>
						<div class="user-fullname"><?php echo $user->fullname; ?></div>
						<?php echo ossn_plugin_view('profile/role', array('user' => $user)); ?>
                        <?php 
						$margin_top_user_username = "user-username-margin-top";
						if(ossn_isLoggedin() && !$user->canModerate()){ 
								//user-username margin-top
								//that mean no roles showing for noremal user
								//so to avoid extra space
								//because of position absolute
								$margin_top_user_username = "user-username-margin-top-offset";
						}
						?>
						<div class="user-fullname user-username <?php echo $margin_top_user_username;?>">@<?php echo $user->username; ?></div>
						<div id="profile-menu" class="profile-menu">
							<?php if (ossn_isLoggedIn()) { ?>
							<?php 
								if (ossn_loggedin_user()->guid !== $user->guid) { if (!ossn_user_is_friend(ossn_loggedin_user()->guid, $user->guid)) {
									if (ossn_user()->requestExists(ossn_loggedin_user()->guid, $user->guid)) {
								?>
							<a href="<?php echo ossn_site_url("action/friend/remove?cancel=true&user={$user->guid}", true); ?>" class='btn btn-secondary'>
								<i class="fas fa-user-slash"></i><?php echo ossn_print('cancel:request'); ?>
							</a>
							<?php } else { ?>
							<a href="<?php echo ossn_site_url("action/friend/add?user={$user->guid}", true); ?>" class='btn btn-secondary'>
								<i class="fa fa-user-plus"></i><?php echo ossn_print('add:friend'); ?>
							</a>
							<?php } } else { ?>
							<a href="<?php echo ossn_site_url("action/friend/remove?user={$user->guid}", true); ?>"  class='btn btn-secondary'>
							<i class="fas fa-user-xmark"></i><?php echo ossn_print('remove:friend'); ?>
							</a>
							<?php } 
								if(com_is_active('OssnMessages')) { ?>
							<a href="<?php echo ossn_site_url("messages/message/{$user->username}"); ?>" id="profile-message" data-guid='<?php echo $user->guid; ?>' class='btn btn-primary'>
								<i class="fa fa-message"></i> <?php echo ossn_print('message'); ?></a>
							<?php } ?>
							<div class="ossn-profile-extra-menu dropdown">
								<?php echo ossn_view_menu( 'profile_extramenu', 'profile/menus/extra'); ?>
							</div>
							<?php } ?>
							<?php if(ossn_loggedin_user()->guid == $user->guid){ ?>
                            	<a href="<?php echo ossn_loggedin_user()->profileURL('/edit'); ?>" class="btn btn-secondary"><i class="fas fa-pencil"></i><?php echo ossn_print('edit:profile');?></a>
                                	<?php if(com_is_active('OssnMessages')){ ?>
                            			<a href="<?php echo ossn_site_url('messages/all');?>" class="btn btn-primary"><i class="fa fa-message"></i> <?php echo ossn_print('user:messages');?></a>
                                	<?php } ?>
                            <?php } ?>
							<?php }?>
						</div>
						<div id="cover-menu" class="profile-menu">
							<a href="javascript:void(0);" onclick="Ossn.repositionCOVER();" class='btn btn-success'>
								<i class="far fa-floppy-disk"></i><?php echo ossn_print('save:position'); ?>
							</a>
						</div>    
					</div>
				</div>
			</div>
		</div>
	</div>
    <div class="row">
    	<div class="col-lg-11">
        	<div class="profile-menu-hr-container">
					<div id='profile-hr-menu' class="profile-hr-menu d-none d-lg-block">
						<?php echo ossn_plugin_view('menus/user_timeline', array('menu_width' => 60)); ?>
					</div>
					<div id='profile-hr-menu' class="profile-hr-menu d-none d-md-block d-lg-none">
						<?php echo ossn_plugin_view('menus/user_timeline', array('menu_width' => 40)); ?>
					</div>
					<div id='profile-hr-menu' class="profile-hr-menu d-none d-sm-block d-md-none">
						<?php echo ossn_plugin_view('menus/user_timeline', array('menu_width' => 25)); ?>
					</div>
					<div id='profile-hr-menu' class="profile-hr-menu d-block d-sm-none">
						<?php echo ossn_plugin_view('menus/user_timeline', array('menu_width' => 1)); ?>
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
		<div class="col-lg-7">
			<div class="ossn-profile-wall">
				<?php 
					if(com_is_active('OssnWall')) { 
							$params['user'] =  $user; 
							echo ossn_plugin_view('wall/user/wall', $params); 
					} ?>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="ossn-profile-sidebar d-none d-sm-block">
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