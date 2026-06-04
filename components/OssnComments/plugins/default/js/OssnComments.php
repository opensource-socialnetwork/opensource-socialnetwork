//<script>
/**
 * Open Source Social Network
 *
 * @package    Open Source Social Network
 * @author     Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license    Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link       https://www.opensource-socialnetwork.org/
 */
Ossn.register_callback('ossn', 'init', 'ossn_comment_init');
Ossn.register_callback('ossn', 'init', 'ossn_comment_delete_handler');
Ossn.register_callback('ossn', 'init', 'ossn_comment_edit');
Ossn.register_callback('ossn', 'init', 'ossn_comment_post_sm_button');

/**
 * UNIFIED COMMENT ENGINE PIPELINE (Plain-Text Optimized)
 */
Ossn.ExecuteCommentPipeline = function (targetUrl, $container, typeKey, callbackNamespace) {
	const $box = $('#comment-box-' + typeKey + $container);
	const $form = $('#comment-container-' + typeKey + $container);

	// Event Interceptions: Keypress Enter Submission Guards, Space Hooks & Active Input Scanning
	$box.off('keypress paste drop keyup focus').on('keypress', function (e) {
		// 1. Handle Spacebar Input Callback Trigger
		if (e.which == 32) {
			const selection = window.getSelection();
			if (selection.rangeCount > 0) {
				const range = selection.getRangeAt(0);
				const textBeforeCursor = range.startContainer.textContent ? range.startContainer.textContent.slice(0, range.startOffset) : '';
				const words = textBeforeCursor.split(/\s|\u00A0/);
				const currentWord = words[words.length - 1] || "";

				Ossn.trigger_callback('comment', 'input:space', {
					word: currentWord,
					$editor: $box,
					container: $container,
					type: typeKey
				});
			}
		}

		// 2. Handle Enter Key Comment Submission (Using Clean Plain-Text)
		if ($('.comment-post-btn').is(":visible") === false) {
			if (e.which == 13) {
				if (e.shiftKey === false) {
					e.preventDefault(); // Prevents an extra line break from being added on submission

					// Grab element text content directly
					let plainText = $box[0].innerText || $box[0].textContent;

					/**
					 * REGEX CLEANUP: Allow max one empty line
					 * Caps consecutive newlines at 2, trimming away 3 or more.
					 */
					plainText = plainText.replace(/\n{3,}/g, '\n\n');

					$form.append("<textarea name='comment' class='hidden'></textarea>");
					$form.find('textarea[name="comment"]').text(plainText); // Safe text binding escape
					$form.submit();
				}
			}
		}
	}).on('paste', function (e) {
		e.preventDefault();
		var text = (e.originalEvent || e).clipboardData.getData('text/plain');
		window.document.execCommand('insertText', false, text);
	}).on('drop', function (e) {
		e.preventDefault();
		var text = (e.originalEvent || e).dataTransfer.getData('text/plain');
		if (!text) {
			return;
		}
		$box.focus();
		window.document.execCommand('insertText', false, text);
	}).on('keyup focus', function (e) {
		const selection = window.getSelection();
		if (selection.rangeCount > 0) {
			const range = selection.getRangeAt(0);
			const textBeforeCursor = range.startContainer.textContent ? range.startContainer.textContent.slice(0, range.startOffset) : '';
			const words = textBeforeCursor.split(/\s|\u00A0/);
			const activeWord = words[words.length - 1] || "";

			Ossn.trigger_callback('comment', 'input:scan', {
				word: activeWord,
				$editor: $box,
				container: $container,
				type: typeKey
			});
		}
	});

	// Dynamic Core AJAX Request Submission Process
	Ossn.ajaxRequest({
		url: targetUrl,
		form: '#comment-container-' + typeKey + $container,
		beforeSend: function (request) {
			$box.attr('readonly', 'readonly');
			$box.attr('contenteditable', false);
		},
		callback: function (callback) {
			if (callback['process'] == 1) {
				$box.removeAttr('readonly');
				$box.val('');
				$('.ossn-comments-list-' + typeKey + $container).append(callback['comment']);
				$('#comment-attachment-container-' + typeKey + $container).hide();
				$('#ossn-comment-attachment-' + typeKey + $container).find('.image-data').html('');
				$form.find('input[name="comment-attachment"]').val('');
			}
			if (callback['process'] == 0) {
				$box.removeAttr('readonly');
				Ossn.MessageBox('syserror/unknown');
			}
			$box.attr('contenteditable', true);
			$box.html("");

			Ossn.trigger_callback('comment', callbackNamespace + ':callback', {
				guid: $container,
				response: callback,
			});
		}
	});
};

/**
 * Structural Interface Layer Wrappers 
 */
Ossn.PostComment = function ($container) {
	const url = Ossn.site_url + 'action/post/comment';
	Ossn.ExecuteCommentPipeline(url, $container, 'p', 'post');
};

Ossn.ObjectComment = function ($container) {
	const url = Ossn.site_url + 'action/post/object/comment';
	Ossn.ExecuteCommentPipeline(url, $container, 'o', 'object');
};

Ossn.EntityComment = function ($container) {
	const url = Ossn.site_url + 'action/post/entity/comment';
	Ossn.ExecuteCommentPipeline(url, $container, 'e', 'entity');
};

Ossn.CommentMenu = function ($id) {
	var $element = $($id).find('.menu-links');
	if ($element.is(":not(:visible)")) {
		$element.show();
		$($id).find('.drop-down-arrow').attr('style', 'display:block;');
	} else {
		$element.hide();
		$($id).find('.drop-down-arrow').attr('style', '');
	}
};

function ossn_comment_delete_handler() {
	$(document).ready(function () {
		$('body').on('click', '.ossn-delete-comment', function (e) {
			e.preventDefault();
			var $comment = $(this);
			var url = $comment.attr('href');
			var id = Ossn.UrlParams('comment', url);

			Ossn.PostRequest({
				url: url,
				action: false,
				beforeSend: function () {
					$('#comments-item-' + id).attr('style', 'opacity:0.6;');
				},
				callback: function (callback) {
					if (callback == 1) {
						$('#comments-item-' + id).fadeOut().remove();
					}
					if (callback == 0) {
						$('#comments-item-' + id).attr('style', 'opacity:1.0;');
					}
					Ossn.trigger_callback('comment', 'delete:callback', {
						id: id,
						response: callback,
					});
				}
			});
		});
	});
}

Ossn.CommentImage = function ($container, $ftype) {
	var typeKey = $ftype[0];
	$(document).ready(function () {
		$("#ossn-comment-image-file-" + typeKey + $container).off('change').on('change', function (event) {
			event.preventDefault();
			var formData = new FormData($('#ossn-comment-attachment-' + typeKey + $container)[0]);
			$.ajax({
				url: Ossn.site_url + 'comment/attachment',
				type: 'POST',
				data: formData,
				async: true,
				beforeSend: function () {
					$('#ossn-comment-attachment-' + typeKey + $container).find('.image-data')
						.html('<img src="' + Ossn.site_url + 'components/OssnComments/images/loading.gif" style="width:30px;border:none;height: initial;" />');
					$('#comment-attachment-container-' + typeKey + $container).show();
				},
				cache: false,
				contentType: false,
				processData: false,
				success: function (callback) {
					if (callback['success']) {
						$('#comment-container-' + typeKey + $container).find('input[name="comment-attachment"]').val(callback['file']);
						$('#ossn-comment-attachment-' + typeKey + $container).find('.image-data')
							.html('<img src="' + Ossn.site_url + 'comment/staticimage?image=' + callback['file'] + '" />');
					} else {
						if (callback['error']) {
							$('#comment-container-' + typeKey + $container).find('input[name="comment-attachment"]').val('');
							$('#comment-attachment-container-' + typeKey + $container).hide();
							$('.ossn-message-box').html(callback['error']).fadeIn();
						} else {
							Ossn.MessageBox('syserror/unknown');
						}
					}
					Ossn.trigger_callback('comment', 'attachment:image:callback', {
						guid: $container,
						type: typeKey,
						response: callback,
					});
				},
				error: function (xhr, status, error) {
					if (error == 'Internal Server Error' || error !== '') {
						Ossn.MessageBox('syserror/unknown');
					}
				},
			});
		});
	});
};

function ossn_comment_edit() {
	$(document).ready(function () {
		$('body').on('click', '.ossn-edit-comment', function () {
			var $dataguid = $(this).attr('data-guid');

			Ossn.MessageBox('comment/edit/' + $dataguid);
		});
		Ossn.ajaxRequest({
			url: Ossn.site_url + "action/comment/edit",
			containMedia: true,
			form: '#ossn-comment-edit-form',
			beforeSend: function () {
				$('#ossn-comment-edit-form').find('textarea').hide().parent().append('<div class="ossn-loading ossn-box-loading"></div>');
			},
			callback: function (callback) {
				if (callback['success']) {
					var $text = $('#ossn-comment-edit-form').find('#comment-edit').val();
					var $guid = $('#ossn-comment-edit-form').find('input[name="guid"]').val();
					var $elem = $("#comments-item-" + $guid).find('.comment-contents').find('.comment-text:first');
					if ($elem.length > 0) {
						$elem.text('');
						Ossn.PostRequest({
							url: Ossn.site_url + "action/comment/embed",
							params: 'content=' + encodeURIComponent($text) + '&guid=' + $guid,
							callback: function (return_data) {
								$elem.append(return_data['data']);
								Ossn.trigger_callback('comment', 'edit:callback', {
									guid: $guid,
									response: return_data,
								});
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
	});
}

/**
 * Update the SM Button handler to use the same clean plain-text method
 */
function ossn_comment_post_sm_button() {
	$(document).ready(function () {
		$('body').on('click', '.comment-post-btn', function () {
			var $type = $(this).attr('data-type');
			var $guid = $(this).attr('data-guid');
			if ($type == 'p' || $type == 'o' || $type == 'e') {
				let $box = $('#comment-box-' + $type + $guid);
				let $container = $('#comment-container-' + $type + $guid);

				let plainText = $box[0].innerText || $box[0].textContent;

				/**
				 * REGEX CLEANUP: Also process the mobile/SM button click to match Enter behavior
				 */
				plainText = plainText.replace(/\n{3,}/g, '\n\n');

				$container.append("<textarea name='comment' class='hidden'></textarea>");
				$container.find('textarea[name="comment"]').text(plainText);
				$container.submit();
			}
		});
	});
}

function ossn_comment_init() {
	$(document).ready(function () {
		$('body').on('click', '.comment-post', function () {
			var $guid = $(this).attr('data-guid');
			if ($guid) {
				$("#comment-box-p" + $guid).focus();
			}
		});
		$('body').on('click', '.comment-entity', function () {
			var $guid = $(this).attr('data-guid');
			if ($guid) {
				$("#comment-box-e" + $guid).focus();
			}
		});
		$('body').on('click', '.comment-object', function () {
			var $guid = $(this).attr('data-guid');
			if ($guid) {
				$("#comment-box-o" + $guid).focus();
			}
		});
	});
}