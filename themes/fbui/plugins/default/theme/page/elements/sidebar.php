<?php
/**
 * Open Source Social Network
 *
 * @package    Open Source Social Network
 * @author     OSSN Core Team <info@openteknik.com>
 * @copyright  (C) OPENTEKNIK LLC, COMMERCIAL LICENSE
 * @license    OPENTEKNIK LLC, COMMERCIAL LICENSE https://www.openteknik.com/license/commercial-license-v1
 * @link       http://www.opensource-socialnetwork.org/licence
 */

if(!ossn_isLoggedin()){
	return;
}
$user = ossn_loggedin_user();
$site_url = ossn_site_url();

// Load User Shortcuts from JSON
$shortcuts = array();
$user_dir = ossn_get_userdata("user/{$user->guid}/shortcuts");
$shortcuts_file = $user_dir . "/shortcuts.json";
if (file_exists($shortcuts_file)) {
    $json_data = file_get_contents($shortcuts_file);
    $decoded = json_decode($json_data, true);
    if (is_array($decoded)) {
        $shortcuts = $decoded;
    }
}
?>
<div class="fbui-sidebar-wrapper">
	<div class="fbui-static-sidebar">
		<div class="fbui-static-sidebar-content">
			<ul class="fbui-sidebar-list" id="fbui-sidebar-main-list">
				
				<!-- ========================================================= -->
				<!-- 1. MAIN NAVIGATION LINKS                                  -->
				<!-- ========================================================= -->
				<li class="fbui-always-visible">
					<a href="<?php echo $user->profileURL(); ?>">
						<div class="fbui-sidebar-avatar">
							<img src="<?php echo $user->iconURL()->small; ?>" alt="<?php echo $user->fullname; ?>" />
						</div>
						<span class="fbui-sidebar-label"><?php echo $user->fullname; ?></span>
					</a>
				</li>
				<li class="fbui-always-visible">
					<a href="<?php echo $site_url; ?>home">
						<div class="fbui-sidebar-icon icon-newsfeed">
							<i class="fa-solid fa-newspaper me-0"></i>
						</div>
						<span class="fbui-sidebar-label"><?php echo ossn_print('news:feed');?></span>
					</a>
				</li>
				<li class="fbui-always-visible">
					<a href="<?php echo $user->profileURL('/friends'); ?>">
						<div class="fbui-sidebar-icon icon-friends">
							<i class="fa-solid fa-user-group me-0"></i>
						</div>
						<span class="fbui-sidebar-label"><?php echo ossn_print('friends');?></span>
					</a>
				</li>
				<?php if(com_is_active('Bookmarks')){ ?>
				<li class="fbui-always-visible">
					<a href="<?php echo $site_url; ?>saved">
						<div class="fbui-sidebar-icon icon-saved">
							<i class="fa fa-bookmark me-0"></i>
						</div>
						<span class="fbui-sidebar-label"><?php echo ossn_print('bookmark:saved');?></span>
					</a>
				</li>
				<?php } ?>  
				<?php if(com_is_active('Events')){ ?>
				<li class="fbui-always-visible">
					<a href="<?php echo $site_url; ?>events">
						<div class="fbui-sidebar-icon icon-events">
							<i class="fa fa-calendar-alt me-0"></i>
						</div>
						<span class="fbui-sidebar-label"><?php echo ossn_print('events');?></span>
					</a>
				</li>
				<?php } ?>
				<?php if(com_is_active('MarketPlace')){ ?>
				<li class="fbui-always-visible">
					<a href="<?php echo $site_url; ?>marketplace">
						<div class="fbui-sidebar-icon icon-marketplace">
							<i class="fa fa-store me-0"></i>
						</div>
						<span class="fbui-sidebar-label"><?php echo ossn_print('marketplace');?></span>
					</a>
				</li>
				<?php } ?>                            
				<li class="fbui-always-visible">
					<a href="<?php echo $user->profileURL('/photos'); ?>">
						<div class="fbui-sidebar-icon icon-photos">
							<i class="fa-solid fa-images me-0"></i>
						</div>
						<span class="fbui-sidebar-label"><?php echo ossn_print('photos');?></span>
					</a>
				</li>

				<!-- Collapsible Main Links -->
				<div class="fbui-links-collapsible" id="fbui-links-collapse-wrapper">
					<?php if(com_is_active('Videos')){ ?>
					<li>
						<a href="<?php echo $site_url; ?>video/watch">
							<div class="fbui-sidebar-icon icon-watch">
								<i class="fa-brands fa-youtube me-0"></i>
							</div>
							<span class="fbui-sidebar-label"><?php echo ossn_print('video:watch');?></span>
						</a>
					</li>
					<?php } ?>
					<?php if(com_is_active('OssnGroups')){ ?>
					<li>
						<a href="<?php echo $site_url; ?>search?type=groups&q=">
							<div class="fbui-sidebar-icon icon-groups">
								<i class="fa fa-users-rectangle me-0"></i>
							</div>
							<span class="fbui-sidebar-label"><?php echo ossn_print('groups');?></span>
						</a>
					</li>
					<?php } ?>
					<?php if(com_is_active('BusinessPage')){ ?>
					<li>
						<a href="<?php echo $site_url; ?>page/all">
							<div class="fbui-sidebar-icon icon-pages">
								<i class="fa fa-flag me-0"></i>
							</div>
							<span class="fbui-sidebar-label"><?php echo ossn_print('fbui:bpages');?></span>
						</a>
					</li>
					<?php } ?>
					<?php if(com_is_active('Blog')){ ?>
					<li>
						<a href="<?php echo $site_url; ?>blog/all_blogs_by_date">
							<div class="fbui-sidebar-icon icon-blogs">
								<i class="fa fa-newspaper me-0"></i>
							</div>
							<span class="fbui-sidebar-label"><?php echo ossn_print('com:blog:blog:all');?></span>
						</a>
					</li>
					<?php } ?>
					<?php if(com_is_active('OssnMessages')){ ?>
					<li>
						<a href="<?php echo $site_url; ?>messages/all">
							<div class="fbui-sidebar-icon icon-messenger">
								<i class="fa-brands fa-facebook-messenger me-0"></i>
							</div>
							<span class="fbui-sidebar-label"><?php echo ossn_print('fbui:messenger');?></span>
						</a>
					</li>
					<?php } ?>                
					<?php if(com_is_active('Polls')){ ?>
					<li>
						<a href="<?php echo $site_url; ?>polls/list/all">
							<div class="fbui-sidebar-icon icon-polls">
								<i class="fa fa-square-poll-vertical me-0"></i>
							</div>
							<span class="fbui-sidebar-label"><?php echo ossn_print('polls');?></span>
						</a>
					</li>
					<?php } ?>
					<?php if(com_is_active('MP3')){ ?>
					<li>
						<a href="<?php echo $site_url; ?>mp3/all">
							<div class="fbui-sidebar-icon icon-mp3">
								<i class="fa fa-music me-0"></i>
							</div>
							<span class="fbui-sidebar-label"><?php echo ossn_print('mp3file');?></span>
						</a>
					</li>
					<?php } ?>
					<?php if(com_is_active('Monetization')){ ?>
					<li>
						<a href="<?php echo $site_url; ?>campaigns/dashboard">
							<div class="fbui-sidebar-icon icon-adsmanager">
								<i class="fa-solid fa-chart-simple me-0"></i>
							</div>
							<span class="fbui-sidebar-label"><?php echo ossn_print('fbui:adsmanager');?></span>
						</a>
					</li>
					<?php } ?>                
					<li>
						<a href="<?php echo $site_url; ?>play/all">
							<div class="fbui-sidebar-icon icon-games">
								<i class="fas fa-gamepad me-0"></i>
							</div>
							<span class="fbui-sidebar-label"><?php echo ossn_print('games');?></span>
						</a>
					</li>
					<li>
						<a href="<?php echo $site_url; ?>search?q=">
							<div class="fbui-sidebar-icon icon-members">
								<i class="fa fa-address-book me-0"></i>
							</div>
							<span class="fbui-sidebar-label"><?php echo ossn_print('fbui:members');?></span>
						</a>
					</li>
				</div>

				<!-- Main Links See More Toggle -->
				<li id="fbui-links-see-more-btn" class="fbui-always-visible">
					<a href="javascript:void(0);">
						<div class="fbui-sidebar-icon icon-see-more" id="links-see-more-icon-wrap">
							<i class="fa fa-chevron-down me-0" id="links-see-more-icon"></i>
						</div>
						<span class="fbui-sidebar-label" id="links-see-more-text"><?php echo ossn_print('fbui:see_more'); ?></span>
					</a>
				</li>

				<!-- ========================================================= -->
				<!-- 2. SHORTCUTS SECTION                                      -->
				<!-- ========================================================= -->
				<?php if(!empty($shortcuts)): ?>
					<hr class="fbui-shortcuts-divider" />
					<li class="fbui-sidebar-header">
						<span><?php echo ossn_print('fbui:shortcuts'); ?></span>
					</li>
					
					<?php 
					$shortcut_counter = 0;
					foreach($shortcuts as $sc): 
						$item_title = '';
						$item_url = '';
						$cover_style = 'background-color: #e4e6eb;';
						
						if ($sc['type'] === 'group' && com_is_active('OssnGroups')) {
							$group = ossn_get_group_by_guid($sc['guid']);
							if ($group) {
								$item_title = $group->title;
								$item_url = ossn_group_url($group->guid);
								$cover_url = $group->coverURL();
								if (!empty($cover_url)) {
									$cover_style = "background-image: url('{$cover_url}'); background-size: cover; background-position: center;";
								}
							}
						} elseif ($sc['type'] === 'businesspage' && com_is_active('BusinessPage')) {
							$bpage = get_business_page($sc['guid']);
							if ($bpage) {
								$item_title = $bpage->title;
								$item_url = $bpage->getURL();
								$photo_url = $bpage->photoURL();
								if (!empty($photo_url)) {
									$cover_style = "background-image: url('{$photo_url}'); background-size: cover; background-position: center;";
								}
							}
						}

						if (empty($item_title) || empty($item_url)) {
							continue;
						}

						$shortcut_counter++;
						if ($shortcut_counter == 3) {
							echo '<div class="fbui-shortcuts-collapsible" id="fbui-shortcuts-collapse-wrapper">';
						}
					?>
					<li class="fbui-shortcut-item" data-type="<?php echo $sc['type']; ?>" data-guid="<?php echo $sc['guid']; ?>">
						<a href="<?php echo $item_url; ?>">
							<div class="fbui-sidebar-icon fbui-shortcut-cover" style="<?php echo $cover_style; ?>">
								<?php if(strpos($cover_style, 'background-image') === false): ?>
									<i class="fa fa-bookmark text-muted me-0"></i>
								<?php endif; ?>
							</div>
							<span class="fbui-sidebar-label"><?php echo $item_title; ?></span>
						</a>
						<span class="fbui-shortcut-delete" title="Remove shortcut" data-type="<?php echo $sc['type']; ?>" data-guid="<?php echo $sc['guid']; ?>">
							<i class="fa fa-trash-can me-0"></i>
						</span>
					</li>
					<?php endforeach; 
					if ($shortcut_counter > 2) {
						echo '</div>'; 
					}
					?>

					<!-- Shortcuts See More Toggle -->
					<?php if($shortcut_counter > 2): ?>
					<li id="fbui-shortcuts-see-more-btn">
						<a href="javascript:void(0);">
							<div class="fbui-sidebar-icon icon-see-more" id="shortcuts-see-more-icon-wrap">
								<i class="fa fa-chevron-down me-0" id="shortcuts-see-more-icon"></i>
							</div>
							<span class="fbui-sidebar-label" id="shortcuts-see-more-text"><?php echo ossn_print('fbui:see_more'); ?></span>
						</a>
					</li>
					<?php endif; ?>

				<?php endif; ?>

			</ul>
		</div>
	</div>
</div>