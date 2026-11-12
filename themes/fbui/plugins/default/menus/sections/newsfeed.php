<?php
/**
 * Open Source Social Network
 *
 * @package    Open Source Social Network (OSSN)
 * @author     OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license    Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link       https://www.opensource-socialnetwork.org/
 */
$menus = $params['menu'];
?>
<div class="fbui-megamenu-overlay">
	<div class="fbui-megamenu-header">Menu</div>
	
	<div class="fbui-megamenu-grid">
		<!-- LEFT SIDE: Dynamic OSSN Sections & Links -->
		<div class="fbui-megamenu-left">
			<div class="fbui-megamenu-search">
				<i class="fa fa-search"></i>
				<input type="text" placeholder="Search menu" id="fbui-menu-search-input" />
			</div>

			<div class="sidebar-menu-nav">
				<div class="sidebar-menu">
					<ul id="menu-content" class="menu-content">
					<?php            
					foreach ($menus as $name => $menu) {
						$section = 'menu-section-'.OssnTranslit::urlize($name).' ';
						$items = 'menu-section-items-'.OssnTranslit::urlize($name).' ';
						
						$expend = '';
						$icon = "fa-angle-right";
						if($name == 'links'){
							$icon = "fa-newspaper";
						}
						if($name == 'groups'){
							$icon = "fa-users";
						}
						$hash = 'nm'.md5($name);
						?>
						<li data-bs-toggle="collapse" data-bs-target="#<?php echo $hash;?>" class="sidebar-parent-item-main <?php echo $section;?>" aria-expanded="true">
							<a href="javascript:void(0);"><i class="fa <?php echo $icon;?>"></i><?php echo ossn_print($name);?><span class="arrow"></span></a>
						</li>
						<ul class="sub-menu <?php echo $expend;?> <?php echo $items;?>" id="<?php echo $hash;?>"> 
						<?php
						if(is_array($menu)){
							foreach ($menu as $data) {
								$data['li_class'] = 'menu-section-item-'.OssnTranslit::urlize($data['name']);
								$data['class'] = 'menu-section-item-a-'.OssnTranslit::urlize($data['data-name'] ?? $data['name']);
								unset($data['name']);      
								if(isset($data['icon'])){
									unset($data['icon']);
								}
								unset($data['section']);
								
								if(isset($data['parent'])){
									unset($data['parent']);
								}
								echo ossn_plugin_view('output/section_submenu_url', $data);
								if(isset($data['li_class'])){
									unset($data['li_class']);
								}
								if(isset($data['class'])){
									unset($data['class']);
								}
							}
						}
						echo "</ul>";
					}
					?>
					</ul>
				</div>
			</div>
		</div>

		<!-- RIGHT SIDE: Create Action Panel -->
		<div class="fbui-megamenu-right">
			<div class="fbui-megamenu-right-title"><?php echo ossn_print('fbui:create');?></div>
			<ul class="fbui-create-list">
				<li>
					<a id="topbar-megamenu-postcreate" href="<?php echo ossn_site_url(); ?>">
						<span class="fbui-create-icon"><i class="fa fa-edit"></i></span>
						<?php echo ossn_print('fbui:post');?>
					</a>
				</li>       
                <?php if(com_is_active('Stories')){ ?>     
				<li>
					<a href="<?php echo ossn_site_url(); ?>stories/add">
						<span class="fbui-create-icon"><i class="fa fa-book-open"></i></span>
						<?php echo ossn_print('fbui:story');?>
					</a>
				</li>
                <?php } ?>
                <?php if(com_is_active('Videos')){ ?>
				<li>
					<a href="<?php echo ossn_site_url(); ?>video/add">
						<span class="fbui-create-icon"><i class="fa fa-film"></i></span>
						<?php echo ossn_print('fbui:video');?>
					</a>
				</li>
                <?php } ?>
                 <?php if(com_is_active('Events')){ ?>
				<li>
					<a href="<?php echo ossn_site_url(); ?>event/add">
						<span class="fbui-create-icon"><i class="fa-solid fa-calendar"></i></span>
						<?php echo ossn_print('fbui:event');?>
					</a>
				</li>
                <?php } ?>
                 <?php if(com_is_active('Polls')){ ?>
				<li>
					<a href="<?php echo ossn_site_url(); ?>polls/add">
						<span class="fbui-create-icon"><i class="fa-solid fa-square-poll-vertical"></i></span>
						<?php echo ossn_print('fbui:poll');?>
					</a>
				</li>			
                <?php } ?>	
				<div class="fbui-create-divider"></div>
				<li>
					<a id="topbar-megamenu-groupadd" href="javascript::void(0);" onclick="$('#ossn-group-add').trigger('click');">
						<span class="fbui-create-icon"><i class="fa fa-users"></i></span>
						<?php echo ossn_print('fbui:group');?>
					</a>
				</li>                
				<?php if(com_is_active('BusinessPage')){ ?>
				<li>
					<a href="javascript::void(0);">
						<span class="fbui-create-icon"><i class="fa fa-users"></i></span>
						<?php echo ossn_print('bpage');?>
					</a>
				</li>    
                <?php } ?>
                <?php if(com_is_active('Marketplace')){ ?>
				<li>
					<a href="<?php echo ossn_site_url('marketplace/add');?>">
						<span class="fbui-create-icon"><i class="fa fa-store"></i></span>
						<?php echo ossn_print('fbui:marketplace:listing');?>
					</a>
				</li>
                <?php } ?>                                
			</ul>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	// Lock body scrolling when megamenu opens
	$(document).on('show.bs.dropdown', '.fbui-megamenu-dropdown', function () {
		$('body').css('overflow', 'hidden');
	});

	// Restore body scrolling when megamenu closes
	$(document).on('hide.bs.dropdown', '.fbui-megamenu-dropdown', function () {
		$('body').css('overflow', '');
	});
});
</script>