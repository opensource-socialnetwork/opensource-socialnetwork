<?php
	$hide_loggedin = '';
	$topbar_float = "position-relative";
	if(ossn_isLoggedin()){		
		$hide_loggedin = "d-none d-md-inline-block";
		$topbar_float = "";
		$user = ossn_loggedin_user();
	}
// 1. Get the current context (e.g., 'play/all', 'video/watch', 'home')
$context = ossn_get_context();
$custom_settings = ossn_fbui_get_custom_logos_bgs_setting();

?>

<!-- FBUI Topbar Header -->
<div class="topbar <?php echo $topbar_float;?>">
	<?php
	
// 3. Determine which tab should be active
$active_home        = ($context == 'home') ? 'class="active"' : '';
$active_video       = ($context == 'video/watch') ? 'class="active"' : '';
$active_marketplace = ($context == 'marketplace/list') ? 'class="active"' : '';
$active_groups_feed = ($context == 'groups_feed') ? 'class="active"' : '';
$active_games       = ($context == 'play/all') ? 'class="active"' : ''; // Matches 'play/all'
	?>
	<!-- LEFT: Desktop Circle Logo / Mobile Text Logo + Search Input -->
<div class="fbui-topbar-left">
		<a href="<?php echo ossn_site_url();?>" class="fbui-logo-icon" aria-label="Home">
            <?php if (isset($custom_settings) && isset($custom_settings['icon_site'])) { ?>
                <img class="main-logo" src="<?php echo ossn_add_cache_to_url(ossn_theme_url("logos_backgrounds/icon_site_{$custom_settings['icon_site']}")); ?>" />
            <?php } else { ?>
                <img class="fbui-logo-img" src="<?php echo ossn_theme_url(); ?>images/icon.png" />
            <?php } ?>            
		</a>	
		<?php if(ossn_isLoggedin()){ ?>
		<div class="fbui-search-box position-relative">
			<i class="fa fa-search"></i>
			<form action="<?php echo ossn_site_url('search');?>" method="GET" id="fbui-search-form">
				<input type="text" name="q" id="fbui-search-input" placeholder="Search" autocomplete="off" />
			</form>
            
            <!-- Simple Facebook-style dropdown redirect box -->
            <div id="fbui-search-dropdown" class="dropdown-menu shadow-sm p-0 border-0" style="display: none;">
                <a href="javascript:void(0);" id="fbui-search-redirect-btn" class="fbui-search-item">
                    <i class="fa fa-search text-muted"></i>
                    <span><?php echo ossn_print('fbui:searchfor');?> "<strong id="fbui-search-query-text"></strong>"</span>
                </a>
            </div>
		</div>
        <?php } ?>
	</div>

	<!-- CENTER / MOBILE BOTTOM: Navigation Tabs -->
	<?php if(ossn_isLoggedin()){ ?>
		<div class="fbui-topbar-center">
			<ul class="fbui-nav-tabs">
				<li <?php echo $active_home;?>>
					<a href="<?php echo ossn_site_url();?>home">
						<i class="fa fa-home"></i>
					</a>
				</li>
                <?php if(com_is_active('Videos')){ ?>                
				<li <?php echo $active_video;?>>
					<a href="<?php echo ossn_site_url();?>video/watch">
						<i class="fa-brands fa-youtube"></i>
					</a>
				</li>
                <?php } ?>
                <?php if(com_is_active('MarketPlace')){ ?>
				<li <?php echo $active_marketplace;?>>
					<a href="<?php echo ossn_site_url();?>marketplace/list">
						<i class="fa fa-store"></i>
					</a>
				</li>                
                <?php } ?>
				<li <?php echo $active_groups_feed;?>>
					<a href="<?php echo ossn_site_url(); ?>groups_feed">
						<i class="fa fa-users"></i>
					</a>
				</li>
				<li <?php echo $active_games;?>>
					<a href="<?php echo ossn_site_url();?>play/all">
						<i class="fas fa-gamepad"></i>
					</a>
				</li>
			</ul>
		</div>
	<?php } ?>

	<!-- RIGHT: Top Action Controls (Plus, Search, Messenger, Desktop Avatar) -->
	<div class="fbui-topbar-right">
		<?php if(ossn_isLoggedin()){ ?>
			<div class="topbar-menu-right">
				<ul>
<!-- 1. Grid/Menu Icon with Megamenu Dropdown -->
<li class="dropdown fbui-megamenu-dropdown">
	<a href="javascript:void(0);" 
	   class="fbui-action-btn" 
	   title="Menu" 
	   data-bs-toggle="dropdown" 
	   data-bs-auto-close="outside" 
	   aria-expanded="false">
		<i class="fa fa-th"></i>
	</a>
	
	<!-- Dropdown Container rendering newsfeed.php -->
	<div class="dropdown-menu dropdown-menu-end p-0 border-0 bg-transparent">
		<?php echo ossn_view_sections_menu('newsfeed'); ?>
	</div>
</li>

					<?php echo ossn_plugin_view('notifications/page/topbar'); ?>
					
					<!-- Desktop Avatar Dropdown Button -->
					<li class="ossn-topbar-dropdown-menu">
						<div class="dropdown">
							<a role="button" class="fbui-user-avatar-btn" data-bs-toggle="dropdown" href="javascript:void(0);">
								<div class="fbui-avatar-wrapper">
									<img src="<?php echo $user->iconURL()->small; ?>" alt="<?php echo $user->fullname; ?>" />
										<div class="fbui-avatar-caret">
													<i class="fa fa-chevron-down"></i>
										</div>
                                </div>
							</a>
							<?php echo ossn_view_menu('topbar_dropdown'); ?>
						</div>
					</li>            
				</ul>
			</div>
		<?php } else { ?>
			<a class="btn ossn-topbar-login-btn" href="<?php echo ossn_site_url('login'); ?>">
				<?php echo ossn_print('site:login');?>
			</a>
		<?php } ?>          
	</div>

</div>