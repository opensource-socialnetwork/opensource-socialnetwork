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
Ossn.register_callback('ossn', 'init', 'ossn_wall_init');
Ossn.register_callback('ossn', 'init', 'ossn_wall_postform');
Ossn.register_callback('ossn', 'init', 'ossn_wall_post_edit');
Ossn.register_callback('ossn', 'init', 'ossn_wall_select_friends');
Ossn.register_callback('ossn', 'init', 'ossn_wall_location');
Ossn.register_callback('ossn', 'init', 'ossn_wall_privacy');
Ossn.register_callback('ossn', 'init', 'ossn_wall_container_expend');

/**
 * Main editor
 */
var OssnWallEditor = {
	inject: function ($editor, type, value) {
		const sel = window.getSelection();
		if (!sel || !sel.rangeCount) return;

		const range = sel.getRangeAt(0);
		const node = range.startContainer;
		const offset = range.startOffset;
		const trigger = (type === 'mention') ? '@' : '#';

		const startPos = node.textContent.lastIndexOf(trigger, offset - 1);

		if (startPos !== -1) {
			const tokenText = (type === 'hashtag') ? node.textContent.substring(startPos, offset) : value;
			const tokenClass = (type === 'mention') ? 'ossn-wall-token-mention' : 'ossn-wall-token-hashtag';

			// 1. Prepare Replacement
			range.setStart(node, startPos);
			range.setEnd(node, offset);
			range.deleteContents();

			// 2. Create the Chip
			const span = document.createElement('span');
			const tempId = "token-" + Date.now();
			span.id = tempId;
			span.contentEditable = "false";
			span.className = `ossn-wall-token ${tokenClass}`;
			span.appendChild(document.createTextNode(tokenText));

			// 3. Insert the Chip
			range.insertNode(span);

			// 4. Handle Spacing
			if (type === 'mention') {
				// Create a literal standard space
				const spaceNode = document.createTextNode(' ');
				// Move range to immediately after the span and insert space
				range.setStartAfter(span);
				range.insertNode(spaceNode);

				// Move cursor to after the space
				range.setStartAfter(spaceNode);
			} else {
				// For hashtags, just move cursor after the span (the user's typed space is already there)
				range.setStartAfter(span);
			}

			// 5. Finalize Cursor Position
			range.collapse(true);
			sel.removeAllRanges();
			sel.addRange(range);

			// Cleanup temp ID
			const insertedElem = document.getElementById(tempId);
			if (insertedElem) {
				insertedElem.removeAttribute('id');
			}

			$editor.trigger('input');
		}
	},
	// UI HELPER: Finds cursor screen coordinates
	getCaretCoords: function () {
		const sel = window.getSelection();
		if (!sel.rangeCount) return {
			top: 0,
			left: 0
		};
		const range = sel.getRangeAt(0).cloneRange();
		const span = document.createElement("span");
		span.appendChild(document.createTextNode("\u200b"));
		range.insertNode(span);
		const rect = span.getBoundingClientRect();
		const coords = {
			top: rect.top + window.scrollY + 25, // Slightly more offset for larger UI
			left: rect.left + window.scrollX
		};
		span.parentNode.removeChild(span);
		return coords;
	}
};
/**
 * CORE ENGINE - Triggering Callbacks
 */
Ossn.register_callback('ossn', 'init', function () {
	// Security: Block rich text pasting
	$(document).on('paste', '.ossn-wall-textarea', function (e) {
		e.preventDefault();
		const text = (e.originalEvent || e).clipboardData.getData('text/plain');
		document.execCommand("insertText", false, text);
	});

	$(document).on('drop', '.ossn-wall-textarea', function (e) {
		e.preventDefault();

		// Get the raw text data from the dropped item, ignoring HTML formatting
		const text = (e.originalEvent || e).dataTransfer.getData('text/plain');

		// Target the specific textarea the user dropped the text into
		const $textarea = $(this);
		$textarea.focus();

		// Insert the clean plain text at the current cursor drop point
		document.execCommand("insertText", false, text);
	});

	// Main Scanner
	$(document).on('input keyup', '.ossn-wall-textarea', function () {
		const sel = window.getSelection();
		if (!sel.rangeCount) return;
		const range = sel.getRangeAt(0);
		const node = range.startContainer;
		if (node.nodeType !== 3) return;

		const textBefore = node.textContent.substring(0, range.startOffset);
		const words = textBefore.split(/\s|\xa0/);
		const lastWord = words[words.length - 1];

		// Trigger Component Callbacks
		Ossn.trigger_callback('wall', 'input:scan', {
			word: lastWord,
			$editor: $(this)
		});
	});

	// Spacebar Listener
	$(document).on('keydown', '.ossn-wall-textarea', function (e) {
		if (e.keyCode === 32) {
			Ossn.trigger_callback('wall', 'input:space', {
				$editor: $(this)
			});
		}
	});
	// 4. Backspace Guard: Delete whole tokens at once
	$(document).on('keydown', '.ossn-wall-textarea', function (e) {
		if (e.keyCode === 8) { // Backspace
			const sel = window.getSelection();
			if (!sel.rangeCount) return;

			const range = sel.getRangeAt(0);
			const node = range.startContainer;

			// If we are at the start of a text node, check the previous element
			if (range.startOffset === 0) {
				let prev = node.previousSibling;

				// If there's no previous sibling, check parent's previous sibling
				if (!prev && node.parentNode !== this) {
					prev = node.parentNode.previousSibling;
				}

				if (prev && $(prev).hasClass('ossn-wall-token')) {
					e.preventDefault();
					prev.remove();
					// Trigger input to update any hidden fields
					$(this).trigger('input');
				}
			}
			// If we are inside a text node but just after the &nbsp; of a token
			else if (node.nodeType === 3) {
				const textBefore = node.textContent.substring(0, range.startOffset);
				// Check if the last character is the non-breaking space we added
				if (textBefore.endsWith('\u00A0') || textBefore.endsWith(' ')) {
					const prev = node.previousSibling;
					if (prev && $(prev).hasClass('ossn-wall-token')) {
						e.preventDefault();
						prev.remove();
						// Remove the trailing space as well
						node.textContent = node.textContent.substring(range.startOffset);
						$(this).trigger('input');
					}
				}
			}
		}
	});
	// Placeholder Fix: Ensure the div is TRULY empty when text is cleared
	$(document).on('blur keyup', '.ossn-wall-textarea', function () {
		const $this = $(this);

		// Use trim() to check for actual content
		// If it's just whitespace or a stray <br>, empty it out completely
		if ($this.text().trim().length === 0 && $this.find('img').length === 0) {
			$this.empty();
		}
	});
});

function ossn_wall_post_edit() {
	$(document).ready(function () {
		//post edit
		Ossn.ajaxRequest({
			url: Ossn.site_url + "action/wall/post/edit",
			containMedia: true,
			form: '#ossn-post-edit-form',
			beforeSend: function () {
				$('#ossn-post-edit-form').find('.ossn-wall-textarea').hide();
				$('#ossn-post-edit-form').append('<div class="ossn-loading ossn-box-loading"></div>');
			},
			callback: function (callback) {
				if (callback['success']) {
					$text = $('#ossn-post-edit-form').find('#post-edit').val();
					$guid = $('#ossn-post-edit-form').find('input[name="guid"]').val();
					$elem = $("#activity-item-" + $guid).find('.post-contents').find('p:first');
					/* LinkPreview support */
					var preview_url = '';
					$preview_block = $("#activity-item-" + $guid).find('.post-contents').find('.link-preview-item');
					$preview_link = $("#activity-item-" + $guid).find('.post-contents').find('.link-preview-item').find('a');
					if ($preview_link.length) {
						// if available, get old preview link to be passed to and compared with edited text in embed action
						preview_url = $preview_link[0].href;
					}

					if ($elem.length) {
						$elem.text('');
						Ossn.PostRequest({
							url: Ossn.site_url + "action/wall/post/embed",
							params: 'text=' + encodeURIComponent($text) + '&preview=' + preview_url + '&guid=' + $guid,
							callback: function (return_data) {
								$elem.append(return_data['text']);
								// handle existing/changed/removed/new preview according to action result
								if ((return_data['preview_state'] == 'removed') || (return_data['preview_state'] == 'changed')) {
									$preview_block.remove();
								}
								if ((return_data['preview_state'] == 'created') || (return_data['preview_state'] == 'changed')) {
									$("#activity-item-" + $guid).find('.post-contents').append(return_data['preview']);
								}
							}
						});
					}
					Ossn.trigger_message(callback['success']);
				}
				if (callback['error']) {
					Ossn.trigger_message(callback['error'], 'error');
				}
				Ossn.MessageBoxClose();
			}
		});
		//post-edit />	
	});
}

function ossn_wall_clear_form() {
	var $file = $("#ossn-wall-form").find("input[type='file']");
	$file.val("");

	$('#ossn-wall-photo').hide();

	//Tagged friend(s) and location should be cleared, too - after posting #641
	$("#ossn-wall-location-input").val('');
	$('#ossn-wall-location').hide();

	$('#ossn-wall-friend-input').val('');
	if ($('#ossn-wall-friend-input').length) {
		$("#ossn-wall-friend-input").tokenInput("clear");
		$('#ossn-wall-friend').hide();
	}

	$('#ossn-wall-form').find('.ossn-wall-post').show();
	$('#ossn-wall-form').find('.ossn-loading').addClass('ossn-hidden');
	$('#ossn-wall-form').find('.ossn-wall-textarea').html("");

	$('.ossn-wall-container-data .ossn-wall-textarea').removeClass('postbg-container');
	$('.ossn-wall-container-data .ossn-wall-textarea').attr('style', '');
	$('#ossn-wall-postbg').attr('data-toggle', 0);
	$('#ossn-wall-postbg').hide();
}

function ossn_wall_postform() {
	$(document).ready(function () {
		//ajax post
		$('body').on('click', '.ossn-wall-post', function (e) {
			e.preventDefault();

			const $form = $('#ossn-wall-form');
			const $editor = $('.ossn-wall-textarea');

			/**
			 * 1. EXTRACT PLAIN TEXT
			 * .text() handles the conversion of all <span> chips into plain 
			 * @username and #hashtag strings for the backend.
			 */
			const plainText = $editor.text().trim();

			/**
			 * 2. CLEANUP & INJECTION
			 * We remove any existing 'post' field to prevent conflicts, 
			 * then re-inject the updated content.
			 */
			$form.find('[name="post"]').remove();

			// Create a new hidden textarea to hold the final text
			const $hiddenPost = $('<textarea name="post" style="display:none;"></textarea>');
			$hiddenPost.val(plainText);
			$form.append($hiddenPost);

			/**
			 * 3. SUBMIT FORM
			 * Now that the 'post' field is synchronized, we trigger the form.
			 */
			$form.submit();
		});
		$url = $('#ossn-wall-form').attr('action');
		Ossn.ajaxRequest({
			url: $url,
			action: true,
			containMedia: true,
			form: '#ossn-wall-form',

			beforeSend: function (request) {
				$('#ossn-wall-form').find('.ossn-wall-post').hide();
				$('#ossn-wall-form').find('.ossn-loading').removeClass('ossn-hidden');
			},
			callback: function (callback) {
				if (callback['success']) {
					//[E] Hide a success message when post is added #1745
					//Ossn.trigger_message(callback['success']);
					if (callback['data']['post']) {
						var new_post = callback['data']['post'];
						$('.user-activity').prepend($(callback['data']['post']).hide().fadeIn('slow'));
						// mark post as 'new' in order to distinguish it on deleting
						// new posts must not trigger inserts on deleting !!
						$('.user-activity div').first().attr('post', 'new');
					}
				}
				if (callback['error']) {
					Ossn.trigger_message(callback['error'], 'error');
				}

				//need to clear file path after uploading the file #626
				ossn_wall_clear_form();
			}
		});
	});
}

function ossn_wall_init() {
	$(document).ready(function () {
		$('.ossn-wall-container').find('.ossn-wall-friend').on('click', function () {
			$('#ossn-wall-location').hide();
			$('#ossn-wall-photo').hide();
			$('#ossn-wall-friend').show();
		});
		$('.ossn-wall-container').find('.ossn-wall-location').on('click', function () {
			$('#ossn-wall-friend').hide();
			$('#ossn-wall-photo').hide();
			$('#ossn-wall-location').show();
		});
		$('.ossn-wall-container').find('.ossn-wall-photo').on('click', function () {
			$('#ossn-wall-friend').hide();
			$('#ossn-wall-location').hide();
			$('#ossn-wall-photo').show();

		});
		$('body').on('click', '.ossn-wall-container-menu-post', function (e) {
			e.preventDefault();
			$('.ossn-wall-container-data-post').hide();
			$('.ossn-wall-container-data-post').show();
		});
		$('body').on('click', '.ossn-wall-post-delete', function (e) {
			$url = $(this);
			e.preventDefault();

			// new code to insert the first posting from next page,
			// if a posting of the current page has been deleted

			// make it work with /home, /u/USERNAME, /group/GROUP_ID
			var ossn_site_url_parse = Ossn.ParseUrl(Ossn.site_url);
			var $page_url_path = $(location).attr('pathname').substr(1);

			//we need to check if OSSN is installed in subdirectory?
			//[B] Wall post delete issue when installation in subdirectory #1717
			if (Ossn.isset(ossn_site_url_parse['path'])) {
				$page_url_path = $(location).attr('pathname');
				$page_url_path = Ossn.str_replace(ossn_site_url_parse['path'], '', $page_url_path);
			}
			var base_page_url = Ossn.site_url + $page_url_path;
			// ignore new posts which have just been added
			// because they don't have an impact on the current pagination
			// so first check, whether the to be deleted posting has a 'new' attribute
			// see line #357 for marker setting
			$to_be_deleted = $('#activity-item-' + $url.attr('data-guid'));
			var post_attribute = $to_be_deleted.attr('post');
			var old_posting_deleted = false;
			var last_page_posting_deleted = false;
			var $element = '';
			if (typeof post_attribute === 'undefined') {
				// no attribute found - so this is an already existing older post
				// check for existance of next page
				$next = $('.user-activity .ossn-pagination').find('.active').next();
				if ($next.length) {
					// this page HAS a paginator !
					var next_url = $next.find('a').attr('href');
					var results = new RegExp('[\?&]' + 'offset' + '=([0-9]*)').exec(next_url);
					$next_offset = results[1] || false;
					next_url = '?offset=' + $next_offset;

					// remember the current page's offset we're on ...
					// - to rebuild paginator if necessary when AutoPagination is disabled
					// - to compare with last page offset, because there's nothing to insert on the last page
					var current_url = $(location).attr('href');
					var results = new RegExp('[\?&]' + 'offset' + '=([0-9]*)').exec(current_url);
					if (results) {
						var $current_offset = results[1] || false;
					} else {
						// pages without explicite included offset are assumed to be page 1
						var $current_offset = 1;
					}

					// and get the last page's offset
					$last = $('.user-activity .ossn-pagination').find('li:last');
					var last_url = $last.find('a').attr('href');
					var results = new RegExp('[\?&]' + 'offset' + '=([0-9]*)').exec(last_url);
					$last_offset = results[1] || false;

					if ($current_offset < $last_offset) {
						Ossn.PostRequest({
							// IMPORTANT: we must run the next 3 (4) XHR posts with async set to FALSE
							// otherwise we're getting unpredictable results from the callbacks here
							// like sometimes not the first posting is returned but a random other one,
							// or record is still available althought already deleted
							async: false, // !!!
							action: false,
							url: base_page_url + next_url,
							beforeSend: function () {},
							callback: function (callback) {
								// try to get the first posting of the next page
								$element = $(callback).find('.ossn-wall-item').first();
								if ($element.length) {
									//append the posting at the bottom, right before pagination
									$element.insertBefore('.user-activity .container-table-pagination');
									// temporarely hide inserted element, to allow deleting of old posting first in next step to avoid flickering
									$element.hide();
									old_posting_deleted = true;
								}
							},
						});
					} else {
						// we're on the last page
						last_page_posting_deleted = true;
					}
				}
			}

			// remove post from wall
			Ossn.PostRequest({
				url: $url.attr('href'),
				async: false,
				beforeSend: function (request) {
					$('#activity-item-' + $url.attr('data-guid')).attr('style', 'opacity:0.5;');
				},
				callback: function (callback) {
					if (callback == 1) {
						$('#activity-item-' + $url.attr('data-guid')).fadeOut();
						$('#activity-item-' + $url.attr('data-guid')).remove();
					} else {
						$('#activity-item-' + $url.attr('data-guid')).attr('style', 'opacity:1;');
					}
				}
			});

			if ($element.length) {
				// make inserted element visible
				$element.show();
			}

			// needed for manual pagination only!
			<?php
			if (!com_is_active('OssnAutoPagination')) {
				?>
				if (old_posting_deleted) {
					// now that we have deleted one posting,
					// find out whether there are still postings on the last page pointed to by current paginator
					// if not, we have to shrink the paginator
					$last = $('.user-activity .ossn-pagination').find('li:last');
					if ($last.length) {
						var last_url = $last.find('a').attr('href');
						var results = new RegExp('[\?&]' + 'offset' + '=([0-9]*)').exec(last_url);
						$offset = results[1] || false;
						last_url = '?offset=' + $offset;

						Ossn.PostRequest({
							async: false,
							action: false,
							url: base_page_url + last_url,
							beforeSend: function () {},
							callback: function (callback) {
								$element = $(callback).find('.ossn-wall-item').first();
								if ($element.length) {
									// the last page still has entries - do nothing
								} else {
									// pagination needs to be adjusted
									// so remove old pagination
									$('.user-activity .container-table-pagination').remove();
									// and reload page we're currently on to retrieve a new one
									var current_url = '?offset=' + $current_offset;
									Ossn.PostRequest({
										async: false,
										action: false,
										url: base_page_url + current_url,
										beforeSend: function () {},
										callback: function (callback) {
											$element = $(callback).find('.container-table-pagination');
											if ($element.length) {
												// and add adjusted pagination
												$element.appendTo('.user-activity');
											}
											// note: if there's no element found
											// we have run into the special case
											// offset = 1 and either no postings at all or number of postings < pagelimit
										},


									});
								}
							},
						});
					}
				}
				if (last_page_posting_deleted) {
					// now that we have deleted one posting on the last page we're currently on,
					// find out whether there are still other postings on this page
					// if not, we are going to display the previous page instead - in case we're not on page 1 already
					$last = $('.user-activity .ossn-pagination').find('li:last');
					if ($last.length) {
						var last_url = $last.find('a').attr('href');
						var results = new RegExp('[\?&]' + 'offset' + '=([0-9]*)').exec(last_url);
						$offset = results[1] || false;
						last_url = '?offset=' + $offset;

						Ossn.PostRequest({
							async: false,
							action: false,
							url: base_page_url + last_url,
							beforeSend: function () {},
							callback: function (callback) {
								$element = $(callback).find('.ossn-wall-item').first();
								if ($element.length) {
									// the last page still has entries - do nothing
								} else {
									// if the offset of our last page is 1, we don't have to care about a paginator
									// because there's IS no paginator on incomplete page 1
									if ($offset > 1) {
										$('.user-activity .container-table-pagination').remove();
										// the .user-activity div should be completely empty now
										// we're not on page 1, so load and insert the previous page's wall items and pagination
										$offset--;
										var current_url = '?offset=' + $offset;
										Ossn.PostRequest({
											async: false,
											action: false,
											url: base_page_url + current_url,
											beforeSend: function () {},
											callback: function (callback) {
												// get complete feed of previous page
												$element = $(callback).find('.user-activity');
												if ($element.length) {
													// and add it
													var previous_page_feed = $element.html();
													$(previous_page_feed).appendTo('.user-activity');
												}
											},
										});
									}
								}
							},
						});
					}

				}
				// end of manual pagination part
				<?php
			} ?>
		});

		$('body').on('click', '.ossn-wall-post-edit', function () {
			var $dataguid = $(this).attr('data-guid');
			Ossn.MessageBox('post/edit/' + $dataguid);
		});
		//Change the privacy button as per the privacy value #1289
		$('body').on('input', '#ossn-wall-privacy', function () {
			switch (parseInt($(this).val())) {
				case 3:
					$('.ossn-wall-privacy-lock').removeClass('fa-lock');
					$('.ossn-wall-privacy-lock').removeClass('fa-globe-americas');
					$('.ossn-wall-privacy-lock').removeClass('fa-users');
					$('.ossn-wall-privacy-lock').addClass('fa-users');
					break;
				case 2:
					$('.ossn-wall-privacy-lock').removeClass('fa-lock');
					$('.ossn-wall-privacy-lock').removeClass('fa-globe-americas');
					$('.ossn-wall-privacy-lock').removeClass('fa-users');
					$('.ossn-wall-privacy-lock').addClass('fa-globe-americas');
					break;
			}
		});
		if ($('#ossn-wall-privacy').length) {
			$('#ossn-wall-privacy').trigger('input');
		}
	});
}

function ossn_wall_select_friends() {
	$(document).ready(function () {
		if (typeof $.fn.tokenInput === 'function' && $('#ossn-wall-friend-input').length > 0) {
			var picker_type = $('#ossn-wall-friend-input').attr('data-type');
			var tag_type = "";
			var $placeholder = Ossn.Print('tag:friends');

			if (typeof picker_type != 'undefined' && picker_type == 'group') {
				var group_guid = $('#ossn-wall-friend-input').attr('data-guid');
				tag_type = '?picker_type=group&guid=' + group_guid;
				$placeholder = Ossn.Print('ossn:wall:tag:member')
			}
			$("#ossn-wall-friend-input").tokenInput(Ossn.site_url + "friendpicker" + tag_type, {
				placeholder: $placeholder,
				hintText: false,
				propertyToSearch: "first_name",
				resultsFormatter: function (item) {
					return "<li>" + "<img src='" + item.imageurl + "' title='" + item.first_name + " " + item.last_name + "' height='25px' width='25px' />" + "<div style='display: inline-block; padding-left: 10px;'><div class='full_name' style='font-weight:bold;color:#2B5470;'>" + item.first_name + " " + item.last_name + "</div></div></li>"
				},
				tokenFormatter: function (item) {
					return "<li><p>" + item.first_name + " " + item.last_name + "</p></li>"
				},
			});
		}
	});
}
Ossn.PostMenu = function ($id) {
	$element = $($id).find('.menu-links');
	if ($element.is(":not(:visible)")) {
		$element.show();
	} else {
		$element.hide();
	}
};

function ossn_wall_privacy() {
	$(document).ready(function () {
		$('.ossn-wall-privacy').on('click', function (e) {
			Ossn.MessageBox('post/privacy');
		});
		$('#ossn-wall-privacy').on('click', function (e) {
			var wallprivacy = $('#ossn-wall-privacy-container').find('input[name="privacy"]:checked').val();
			$('#ossn-wall-privacy').val(wallprivacy);
			$('#ossn-wall-privacy').trigger("input");
			Ossn.MessageBoxClose();
			var $url = window.location.href;
			if ($url.match(Ossn.site_url + 'home')) {
				wallSetCookie('ossn_home_wall_privacy', wallprivacy, 365);
			} else if ($url.match(Ossn.site_url + 'u/')) {
				wallSetCookie('ossn_user_wall_privacy', wallprivacy, 365);
			}
		});
	});

}
/**
 * Setup Google Location input
 *
 * Remove google map search API as it requires API #906 
 * 
 * @return void
 */
function ossn_wall_location() {
	$(document).ready(function () {
		if ($('#ossn-wall-location-input').length) {
			ossn_location({
				container: '#ossn-wall-location',
				input: '#ossn-wall-location-input',
			});
			$('#ossn-wall-location-input').on('keypress', function (event) {
				if (event.keyCode == 13) {
					event.preventDefault();
					return false;
				}
			});
		}
	});
}

/**
 * OSSN Wall Container Expand
 * Handles auto-height and max-height for contenteditable
 */
function ossn_wall_container_expend() {
	$(document).ready(function () {
		// Target the new contenteditable div
		const $editor = $('.ossn-wall-textarea');

		// We use 'input' to detect text changes, mentions, and hashtags
		$editor.on('input', function () {
			const el = this;

			// If the Post Background is active, we usually want a fixed height
			// so we skip the auto-expand logic if that class exists
			if ($(el).hasClass('postbg-container')) {
				return;
			}

			// Get max-height from CSS (usually 200px or 400px)
			let maxHeight = parseFloat($(el).css('max-height')) || 300;

			// Reset height to auto to calculate current content height
			el.style.height = 'auto';

			if (el.scrollHeight > maxHeight) {
				// If content is larger than max, lock height and scroll
				el.style.height = maxHeight + 'px';
				el.style.overflowY = 'auto';
			} else {
				// If content is small, expand naturally and hide scrollbar
				el.style.height = 'auto';
				el.style.overflowY = 'hidden';
			}
		});

		// Reset on AJAX Complete (After post is successful)
		$(document).ajaxComplete(function (event, xhr, settings) {
			var $url = settings.url;
			if ($url.indexOf('action/wall/post') >= 0) {
				$editor.css({
					height: 'auto',
					minHeight: '50px',
					overflowY: 'hidden'
				});
			}
		});
	});
}

function wallSetCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	Ossn.setCookie(cname, cvalue, d, '/');
}