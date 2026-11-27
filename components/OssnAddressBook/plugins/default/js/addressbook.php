//<script>
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$(document).ready(function() {
		function getInitials(name) {
				var txt = $('<div>').html(name || '').text().trim();
				return txt.substring(0, 2).toUpperCase();
		}

		function buildMetaHtml(res) {
				var html = '';
				if(res.phone) {
						html += '<a href="tel:' + res.phone + '" class="ossnab-meta-link"><i class="fa fa-phone"></i> ' + res.phone + '</a>';
				}
				if(res.email) {
						html += '<a href="mailto:' + res.email + '" class="ossnab-meta-link"><i class="fa fa-envelope"></i> ' + res.email + '</a>';
				}
				if(res.company) {
						html += '<span class="ossnab-meta-text"><i class="fa fa-building"></i> ' + res.company + '</span>';
				}
				if(res.address) {
						html += '<span class="ossnab-meta-text"><i class="fa fa-map-marker"></i> ' + res.address + '</span>';
				}
				return html;
		}

		function buildContactHtml(res) {
				var cat      = res.category || 'personal';
				var safeDesc = res.description || '';
				var descHtml = safeDesc ? '<p class="ossnab-item-desc mb-0">' + safeDesc.replace(/\n/g, '<br>') + '</p>' : '';

				return '<div class="ossnab-item" data-guid="' + res.guid + '" data-category="' + cat + '" data-favorite="0">' +
						'<div class="ossnab-raw-name d-none">' + res.name + '</div>' +
						'<div class="ossnab-raw-phone d-none">' + (res.phone || '') + '</div>' +
						'<div class="ossnab-raw-email d-none">' + (res.email || '') + '</div>' +
						'<div class="ossnab-raw-company d-none">' + (res.company || '') + '</div>' +
						'<div class="ossnab-raw-address d-none">' + (res.address || '') + '</div>' +
						'<div class="ossnab-raw-desc d-none">' + safeDesc + '</div>' +
						'<div class="ossnab-avatar">' + getInitials(res.name) + '</div>' +
						'<div class="ossnab-item-body">' +
						'<div class="ossnab-item-top">' +
						'<span class="ossnab-item-name">' + res.name + '</span>' +
						'<span class="ossnab-pill ossnab-pill-' + cat + '">' + Ossn.Print('ossnaddressbook:category:' + cat) + '</span>' +
						'</div>' +
						'<div class="ossnab-meta">' + buildMetaHtml(res) + '</div>' +
						descHtml +
						'</div>' +
						'<div class="ossnab-item-actions">' +
						'<button type="button" class="ossnab-action-btn ossnab-fav-btn" data-guid="' + res.guid + '" title="' + Ossn.Print('ossnaddressbook:favorite') + '"><i class="fa fa-star"></i></button>' +
						'<button type="button" class="ossnab-action-btn ossnab-edit-btn" data-guid="' + res.guid + '" title="' + Ossn.Print('ossnaddressbook:edit') + '"><i class="fa fa-edit"></i></button>' +
						'<button type="button" class="ossnab-action-btn ossnab-delete" data-guid="' + res.guid + '" title="' + Ossn.Print('ossnaddressbook:delete') + '"><i class="fa fa-trash"></i></button>' +
						'</div>' +
						'</div>';
		}

		function syncCounters() {
				var total = $('#ossnab-list .ossnab-item').length;
				var favs  = $('#ossnab-list .ossnab-item[data-favorite="1"]').length;

				$('#ossnab-total-stat').text(total);
				$('#ossnab-fav-stat').text(favs);

				if(total > 0) {
						$('#ossnab-delete-all, #ossnab-export-csv, #ossnab-export-vcf').removeClass('d-none');
				} else {
						$('#ossnab-delete-all, #ossnab-export-csv, #ossnab-export-vcf').addClass('d-none');
						$('#ossnab-list').html(
								'<div class="ossnab-empty" id="ossnab-empty">' +
								'<div class="ossnab-empty-icon"><i class="fa fa-address-book"></i></div>' +
								'<p class="mb-0">' + Ossn.Print('ossnaddressbook:empty') + '</p>' +
								'</div>'
						);
				}
		}

		function applyFilters() {
				var filter = $('.ossnab-filter.active').data('filter') || 'all';
				var query  = ($('#ossnab-search').val() || '').toLowerCase().trim();

				$('.ossnab-item').each(function() {
						var $item = $(this);
						var cat   = $item.attr('data-category');
						var isFav = $item.attr('data-favorite') === '1';

						var catMatch = (filter === 'all') ||
								(filter === 'favorites' && isFav) ||
								(cat === filter);

						var hay = (
								$item.find('.ossnab-raw-name').text() + ' ' +
								$item.find('.ossnab-raw-phone').text() + ' ' +
								$item.find('.ossnab-raw-email').text() + ' ' +
								$item.find('.ossnab-raw-company').text() + ' ' +
								$item.find('.ossnab-raw-address').text()
						).toLowerCase();

						var searchMatch = !query || hay.indexOf(query) !== -1;

						if(catMatch && searchMatch) {
								$item.show();
						} else {
								$item.hide();
						}
				});
		}

		// Toggle New Contact form
		$(document).on('click', '#ossnab-toggle-composer', function() {
				$('#ossnab-composer-wrap').toggleClass('d-none');
				if(!$('#ossnab-composer-wrap').hasClass('d-none')) {
						$('#ossnab-add-form input[name="name"]').focus();
				}
		});

		$(document).on('click', '#ossnab-composer-cancel', function() {
				$('#ossnab-add-form')[0].reset();
				$('#ossnab-composer-wrap').addClass('d-none');
		});

		// Add contact via Ossn.ajaxRequest
		Ossn.ajaxRequest({
				url: Ossn.site_url + 'action/addressbook/add',
				form: '#ossnab-add-form',
				beforeSend: function() {
						$('#ossnab-add-form .ossnab-submit-btn').prop('disabled', true);
				},
				callback: function(res) {
						$('#ossnab-add-form .ossnab-submit-btn').prop('disabled', false);
						if(res && res.status === 'success') {
								$('#ossnab-empty').remove();
								$('#ossnab-list').prepend(buildContactHtml(res));
								$('#ossnab-add-form')[0].reset();
								$('#ossnab-composer-wrap').addClass('d-none');
								syncCounters();
								applyFilters();
						}
				}
		});

		// Toggle favorite
		$(document).on('click', '.ossnab-fav-btn', function() {
				var $btn  = $(this);
				var guid  = $btn.data('guid');
				var $item = $btn.closest('.ossnab-item');

				Ossn.PostRequest({
						url: Ossn.AddTokenToUrl(Ossn.site_url + 'action/addressbook/favorite'),
						params: '&guid=' + guid,
						callback: function(res) {
								if(res && res.status === 'success') {
										if(res.is_favorite === '1') {
												$btn.addClass('active');
												$item.addClass('is-favorite').attr('data-favorite', '1');
										} else {
												$btn.removeClass('active');
												$item.removeClass('is-favorite').attr('data-favorite', '0');
										}
										syncCounters();
										applyFilters();
								}
						}
				});
		});

		// Open inline edit
		$(document).on('click', '.ossnab-edit-btn', function(e) {
				e.preventDefault();
				var $item = $(this).closest('.ossnab-item');
				if($item.find('.ossnab-inline-edit').length) {
						return;
				}
				var guid     = $item.data('guid');
				var name     = $item.find('.ossnab-raw-name').text();
				var phone    = $item.find('.ossnab-raw-phone').text();
				var email    = $item.find('.ossnab-raw-email').text();
				var company  = $item.find('.ossnab-raw-company').text();
				var address  = $item.find('.ossnab-raw-address').text();
				var desc     = $item.find('.ossnab-raw-desc').text();
				var category = $item.attr('data-category') || 'personal';

				$item.find('.ossnab-avatar, .ossnab-item-body, .ossnab-item-actions').hide();

				var $editor = $('<div class="ossnab-inline-edit">' +
						'<div class="ossnab-composer-grid">' +
						'<input type="text" class="ossnab-input ossnab-edit-name" placeholder="' + Ossn.Print('ossnaddressbook:name:placeholder') + '">' +
						'<input type="text" class="ossnab-input ossnab-edit-phone" placeholder="' + Ossn.Print('ossnaddressbook:phone:placeholder') + '">' +
						'<input type="email" class="ossnab-input ossnab-edit-email" placeholder="' + Ossn.Print('ossnaddressbook:email:placeholder') + '">' +
						'<input type="text" class="ossnab-input ossnab-edit-company" placeholder="' + Ossn.Print('ossnaddressbook:company:placeholder') + '">' +
						'<input type="text" class="ossnab-input ossnab-edit-address" placeholder="' + Ossn.Print('ossnaddressbook:address:placeholder') + '">' +
						'<select class="ossnab-select ossnab-edit-category">' +
						'<option value="personal">' + Ossn.Print('ossnaddressbook:category:personal') + '</option>' +
						'<option value="work">' + Ossn.Print('ossnaddressbook:category:work') + '</option>' +
						'<option value="family">' + Ossn.Print('ossnaddressbook:category:family') + '</option>' +
						'<option value="other">' + Ossn.Print('ossnaddressbook:category:other') + '</option>' +
						'</select>' +
						'</div>' +
						'<textarea rows="2" class="ossnab-textarea ossnab-edit-desc" placeholder="' + Ossn.Print('ossnaddressbook:note:placeholder') + '"></textarea>' +
						'<div class="ossnab-composer-btns">' +
						'<button type="button" class="ossnab-submit-btn ossnab-edit-save">' + Ossn.Print('ossnaddressbook:save') + '</button>' +
						'<button type="button" class="ossnab-cancel-btn ossnab-edit-cancel">' + Ossn.Print('ossnaddressbook:cancel') + '</button>' +
						'</div>' +
						'</div>');

				$editor.find('.ossnab-edit-name').val(name);
				$editor.find('.ossnab-edit-phone').val(phone);
				$editor.find('.ossnab-edit-email').val(email);
				$editor.find('.ossnab-edit-company').val(company);
				$editor.find('.ossnab-edit-address').val(address);
				$editor.find('.ossnab-edit-category').val(category);
				$editor.find('.ossnab-edit-desc').val(desc);
				$editor.find('.ossnab-edit-save').attr('data-guid', guid);

				$item.append($editor);
		});

		// Cancel inline edit
		$(document).on('click', '.ossnab-edit-cancel', function(e) {
				e.preventDefault();
				var $item = $(this).closest('.ossnab-item');
				$item.find('.ossnab-inline-edit').remove();
				$item.find('.ossnab-avatar, .ossnab-item-body, .ossnab-item-actions').show();
		});

		// Save inline edit
		$(document).on('click', '.ossnab-edit-save', function(e) {
				e.preventDefault();
				var $btn     = $(this);
				var guid     = $btn.attr('data-guid');
				var $item    = $btn.closest('.ossnab-item');
				var name     = $item.find('.ossnab-edit-name').val();
				var phone    = $item.find('.ossnab-edit-phone').val();
				var email    = $item.find('.ossnab-edit-email').val();
				var company  = $item.find('.ossnab-edit-company').val();
				var address  = $item.find('.ossnab-edit-address').val();
				var category = $item.find('.ossnab-edit-category').val();
				var desc     = $item.find('.ossnab-edit-desc').val();

				$btn.prop('disabled', true);
				Ossn.PostRequest({
						url: Ossn.AddTokenToUrl(Ossn.site_url + 'action/addressbook/edit'),
						params: '&guid=' + guid +
								'&name=' + encodeURIComponent(name) +
								'&phone=' + encodeURIComponent(phone) +
								'&email=' + encodeURIComponent(email) +
								'&company=' + encodeURIComponent(company) +
								'&address=' + encodeURIComponent(address) +
								'&category=' + encodeURIComponent(category) +
								'&description=' + encodeURIComponent(desc),
						callback: function(res) {
								$btn.prop('disabled', false);
								if(res && res.status === 'success') {
										var cat      = res.category || 'personal';
										var safeDesc = res.description || '';

										$item.attr('data-category', cat);
										$item.find('.ossnab-raw-name').html(res.name);
										$item.find('.ossnab-raw-phone').html(res.phone || '');
										$item.find('.ossnab-raw-email').html(res.email || '');
										$item.find('.ossnab-raw-company').html(res.company || '');
										$item.find('.ossnab-raw-address').html(res.address || '');
										$item.find('.ossnab-raw-desc').html(safeDesc);

										$item.find('.ossnab-avatar').text(getInitials(res.name));
										$item.find('.ossnab-item-name').html(res.name);
										$item.find('.ossnab-pill')
												.attr('class', 'ossnab-pill ossnab-pill-' + cat)
												.text(Ossn.Print('ossnaddressbook:category:' + cat));
										$item.find('.ossnab-meta').html(buildMetaHtml(res));

										$item.find('.ossnab-item-desc').remove();
										if(safeDesc) {
												$item.find('.ossnab-item-body').append('<p class="ossnab-item-desc mb-0">' + safeDesc.replace(/\n/g, '<br>') + '</p>');
										}

										$item.find('.ossnab-inline-edit').remove();
										$item.find('.ossnab-avatar, .ossnab-item-body, .ossnab-item-actions').show();
										applyFilters();
								}
						}
				});
		});

		// Delete single contact
		$(document).on('click', '.ossnab-delete', function() {
				var $btn  = $(this);
				var guid  = $btn.data('guid');
				var $item = $btn.closest('.ossnab-item');

				Ossn.PostRequest({
						url: Ossn.AddTokenToUrl(Ossn.site_url + 'action/addressbook/delete'),
						params: '&guid=' + guid,
						callback: function(res) {
								if(res && res.status === 'success') {
										$item.fadeOut(180, function() {
												$(this).remove();
												syncCounters();
										});
								}
						}
				});
		});

		// Delete all contacts
		$(document).on('click', '#ossnab-delete-all', function() {
				if(!confirm(Ossn.Print('ossnaddressbook:delete:all:confirm'))) {
						return;
				}
				var $btn = $(this);
				$btn.prop('disabled', true);
				Ossn.PostRequest({
						url: Ossn.AddTokenToUrl(Ossn.site_url + 'action/addressbook/delete_all'),
						callback: function(res) {
								$btn.prop('disabled', false);
								if(res && res.status === 'success') {
										$('#ossnab-list .ossnab-item').remove();
										syncCounters();
								}
						}
				});
		});

		// Category filter tabs & live search
		$('.ossnab-filter').on('click', function() {
				$('.ossnab-filter').removeClass('active');
				$(this).addClass('active');
				applyFilters();
		});

		$('#ossnab-search').on('input', function() {
				applyFilters();
		});
});