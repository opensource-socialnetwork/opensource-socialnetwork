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
$addressbook = new OssnAddressBook();
$items       = $addressbook->getUserContacts(ossn_loggedin_user()->guid, 'all');
$total_count = $items ? count($items) : 0;
$fav_count   = 0;
if($items) {
		foreach($items as $it) {
				if($it->is_favorite == '1') {
						$fav_count++;
				}
		}
}
?>
<div class="ossnab-wrapper">
		<div class="ossnab-card">
				<!-- Header -->
				<div class="ossnab-header">
						<div class="ossnab-title-group">
								<div class="ossnab-icon-box">
										<i class="fa fa-address-book me-0"></i>
								</div>
								<div>
										<h4 class="ossnab-heading mb-0"><?php echo ossn_print('ossnaddressbook:title'); ?></h4>
										<span class="ossnab-subtitle">
												<span id="ossnab-total-stat"><?php echo $total_count; ?></span> <?php echo ossn_print('ossnaddressbook:subtitle:contacts'); ?> &bull;
												<span id="ossnab-fav-stat"><?php echo $fav_count; ?></span> <?php echo ossn_print('ossnaddressbook:subtitle:favorites'); ?>
										</span>
								</div>
						</div>

						<div class="d-flex align-items-center flex-wrap gap-2">
								<a href="<?php echo ossn_add_tokens_to_url(ossn_site_url('action/addressbook/export?format=csv')); ?>" id="ossnab-export-csv" class="ossnab-cancel-btn d-inline-flex align-items-center text-decoration-none <?php echo ($total_count === 0) ? 'd-none' : ''; ?>">
										<i class="fa fa-download me-1"></i><?php echo ossn_print('ossnaddressbook:export:csv'); ?>
								</a>
								<a href="<?php echo ossn_add_tokens_to_url(ossn_site_url('action/addressbook/export?format=vcf')); ?>" id="ossnab-export-vcf" class="ossnab-cancel-btn d-inline-flex align-items-center text-decoration-none <?php echo ($total_count === 0) ? 'd-none' : ''; ?>">
										<i class="fa fa-id-card me-1"></i><?php echo ossn_print('ossnaddressbook:export:vcf'); ?>
								</a>
								<label for="ossnab-import-input" class="ossnab-cancel-btn d-inline-flex align-items-center mb-0">
										<i class="fa fa-upload me-1"></i><?php echo ossn_print('ossnaddressbook:import'); ?>
								</label>
								<button type="button" id="ossnab-delete-all" class="ossnab-delete-all-btn <?php echo ($total_count === 0) ? 'd-none' : ''; ?>">
										<i class="fa fa-trash me-1"></i><?php echo ossn_print('ossnaddressbook:delete:all'); ?>
								</button>
								<button type="button" id="ossnab-toggle-composer" class="ossnab-submit-btn">
										<i class="fa fa-user-plus me-1"></i><?php echo ossn_print('ossnaddressbook:add:toggle'); ?>
								</button>
						</div>
				</div>

				<!-- Hidden Import Form -->
				<?php
				echo ossn_view_form('addressbook/import', array(
						'id'        => 'ossnab-import-form',
						'class'     => 'd-none',
						'enctype'   => 'multipart/form-data',
						'action'    => ossn_site_url('action/addressbook/import'),
						'component' => 'OssnAddressBook',
				));
				?>

				<!-- Collapsible Add Contact Form -->
				<div id="ossnab-composer-wrap" class="ossnab-composer-wrap d-none">
						<?php
						echo ossn_view_form('addressbook/add', array(
								'id'        => 'ossnab-add-form',
								'class'     => 'ossnab-composer',
								'action'    => ossn_site_url('action/addressbook/add'),
								'component' => 'OssnAddressBook',
						));
						?>
				</div>

				<!-- Search & Category Filter Bar -->
				<div class="ossnab-toolbar">
						<div class="ossnab-search-wrap">
								<i class="fa fa-search ossnab-search-icon"></i>
								<input type="text" id="ossnab-search" class="ossnab-search-input" placeholder="<?php echo ossn_print('ossnaddressbook:search:placeholder'); ?>" autocomplete="off">
						</div>

						<div class="ossnab-tabs" role="group">
								<button type="button" class="ossnab-tab active ossnab-filter" data-filter="all">
										<?php echo ossn_print('ossnaddressbook:category:all'); ?>
								</button>
								<button type="button" class="ossnab-tab ossnab-filter" data-filter="favorites">
										<i class="fa fa-star me-1"></i><?php echo ossn_print('ossnaddressbook:category:favorites'); ?>
								</button>
								<button type="button" class="ossnab-tab ossnab-filter" data-filter="personal">
										<?php echo ossn_print('ossnaddressbook:category:personal'); ?>
								</button>
								<button type="button" class="ossnab-tab ossnab-filter" data-filter="work">
										<?php echo ossn_print('ossnaddressbook:category:work'); ?>
								</button>
								<button type="button" class="ossnab-tab ossnab-filter" data-filter="family">
										<?php echo ossn_print('ossnaddressbook:category:family'); ?>
								</button>
								<button type="button" class="ossnab-tab ossnab-filter" data-filter="other">
										<?php echo ossn_print('ossnaddressbook:category:other'); ?>
								</button>
						</div>
				</div>

				<!-- Contact List -->
				<div class="ossnab-list" id="ossnab-list">
						<?php if($items): ?>
								<?php foreach($items as $item): ?>
										<?php
										$is_fav   = ($item->is_favorite == '1');
										$initials = strtoupper(mb_substr(strip_tags(html_entity_decode($item->title, ENT_QUOTES, 'UTF-8')), 0, 2, 'UTF-8'));
										$cat      = !empty($item->category) ? $item->category : 'personal';
										?>
										<div class="ossnab-item <?php echo $is_fav ? 'is-favorite' : ''; ?>"
											 data-guid="<?php echo $item->guid; ?>"
											 data-category="<?php echo $cat; ?>"
											 data-favorite="<?php echo $is_fav ? '1' : '0'; ?>">
												<div class="ossnab-raw-name d-none"><?php echo $item->title; ?></div>
												<div class="ossnab-raw-phone d-none"><?php echo $item->phone; ?></div>
												<div class="ossnab-raw-email d-none"><?php echo $item->email; ?></div>
												<div class="ossnab-raw-company d-none"><?php echo $item->company; ?></div>
												<div class="ossnab-raw-address d-none"><?php echo $item->address; ?></div>
												<div class="ossnab-raw-desc d-none"><?php echo $item->description; ?></div>

												<div class="ossnab-avatar"><?php echo $initials; ?></div>

												<div class="ossnab-item-body">
														<div class="ossnab-item-top">
																<span class="ossnab-item-name"><?php echo $item->title; ?></span>
																<span class="ossnab-pill ossnab-pill-<?php echo $cat; ?>">
																		<?php echo ossn_print('ossnaddressbook:category:' . $cat); ?>
																</span>
														</div>

														<div class="ossnab-meta">
																<?php if(!empty($item->phone)): ?>
																		<a href="tel:<?php echo $item->phone; ?>" class="ossnab-meta-link">
																				<i class="fa fa-phone"></i> <?php echo $item->phone; ?>
																		</a>
																<?php endif; ?>
																<?php if(!empty($item->email)): ?>
																		<a href="mailto:<?php echo $item->email; ?>" class="ossnab-meta-link">
																				<i class="fa fa-envelope"></i> <?php echo $item->email; ?>
																		</a>
																<?php endif; ?>
																<?php if(!empty($item->company)): ?>
																		<span class="ossnab-meta-text">
																				<i class="fa fa-building"></i> <?php echo $item->company; ?>
																		</span>
																<?php endif; ?>
																<?php if(!empty($item->address)): ?>
																		<span class="ossnab-meta-text">
																				<i class="fa fa-map-marker"></i> <?php echo $item->address; ?>
																		</span>
																<?php endif; ?>
														</div>

														<?php if(!empty($item->description)): ?>
																<p class="ossnab-item-desc mb-0"><?php echo nl2br($item->description); ?></p>
														<?php endif; ?>
												</div>

												<div class="ossnab-item-actions">
														<button type="button" class="ossnab-action-btn ossnab-fav-btn <?php echo $is_fav ? 'active' : ''; ?>" data-guid="<?php echo $item->guid; ?>" title="<?php echo ossn_print('ossnaddressbook:favorite'); ?>">
																<i class="fa fa-star me-0"></i>
														</button>
														<button type="button" class="ossnab-action-btn ossnab-edit-btn" data-guid="<?php echo $item->guid; ?>" title="<?php echo ossn_print('ossnaddressbook:edit'); ?>">
																<i class="fa fa-edit me-0"></i>
														</button>
														<button type="button" class="ossnab-action-btn ossnab-delete" data-guid="<?php echo $item->guid; ?>" title="<?php echo ossn_print('ossnaddressbook:delete'); ?>">
																<i class="fa fa-trash me-0"></i>
														</button>
												</div>
										</div>
								<?php endforeach; ?>
						<?php else: ?>
								<div class="ossnab-empty" id="ossnab-empty">
										<div class="ossnab-empty-icon"><i class="fa fa-address-book"></i></div>
										<p class="mb-0"><?php echo ossn_print('ossnaddressbook:empty'); ?></p>
								</div>
						<?php endif; ?>
				</div>
		</div>
</div>