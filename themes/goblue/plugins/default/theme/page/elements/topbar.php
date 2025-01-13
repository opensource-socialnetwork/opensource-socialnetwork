<?php
	$hide_loggedin = '';
	if(ossn_isLoggedin()){		
		$hide_loggedin = "d-none d-md-inline-block";
	}
?>
<!-- ossn topbar -->
<div class="topbar">
			<?php if(ossn_isLoggedin()){ ?>
			<div class="left-side d-inline-block">
				<div class="topbar-menu-left">
					<li id="sidebar-toggle" data-toggle='0'>
						<a role="button" data-bs-target="#"> <i class="fa fa-th-list"></i></a>
					</li>
				</div>
			</div>
			<?php } ?>
			<div class="site-name text-center <?php echo $hide_loggedin;?>">
				<span><a href="<?php echo ossn_site_url();?>"><?php echo ossn_site_settings('site_name');?></a></span>
			</div>
            <?php if(ossn_isLoggedin()){ ?>
			<div class="text-right right-side d-inline-block">
				<div class="topbar-menu-right">
					<ul>
					<li class="ossn-topbar-dropdown-menu">
						<div class="dropdown">
						<?php
							if(ossn_isLoggedin()){						
								echo ossn_plugin_view('output/url', array(
									'role' => 'button',
									'data-bs-toggle' => 'dropdown',
									'data-bs-target' => '#',
									'text' => '<i class="fa fa-sort-down"></i>',
								));									
								echo ossn_view_menu('topbar_dropdown'); 
							}
							?>
						</div>
					</li>                
					<?php
						if(ossn_isLoggedin()){
							echo ossn_plugin_view('notifications/page/topbar');
						}
						?>
					</ul>
				</div>
			</div>
			<?php } ?>            
</div>
<!-- ./ ossn topbar -->