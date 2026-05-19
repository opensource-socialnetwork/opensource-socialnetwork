//<script>
$(document).ready(function () {
	var $listsbg = <?php echo json_encode(__PostBackground_List__); ?>;

	if ($('.ossn-wall-container-data').length) {
		if (!$('#ossn-wall-postbg').length) {
			$('<div id="ossn-wall-postbg" style="display:none;"></div>').insertAfter('.ossn-wall-container-data .ossn-wall-textarea');
			$.each($listsbg, function () {
				$('#ossn-wall-postbg').append('<span class="" data-postbg-type="' + this['name'] + '" style="background:url(\'' + this['url'] + '\'); background-position: center; background-size: cover;"></span>');
			});
			if (!$('.postbg-input').length) {
				$('#ossn-wall-form').append('<input class="postbg-input" name="postbackground_type" type="hidden"/>');
			}
		}
	}

	$('body').on('click', '.ossn-wall-container-control-menu-postbg-selector', function () {
		if ($('#ossn-wall-postbg').attr('data-toggle') == 0 || !$('#ossn-wall-postbg').attr('data-toggle')) {
			$('#ossn-wall-postbg').attr('data-toggle', 1).show();
		} else {
			var $editor = $('.ossn-wall-textarea');
			var selection = window.getSelection();
			var range = selection.rangeCount > 0 ? selection.getRangeAt(0) : null;

			$editor.removeClass('postbg-container').attr('style', '');
			$('.postbg-input').val('');
			$('#ossn-wall-postbg').attr('data-toggle', 0).hide();

			if (range) {
				selection.removeAllRanges();
				selection.addRange(range);
			}
		}
	});

	$(document).on('input keyup', '.ossn-wall-textarea', function () {
		var $editor = $(this);
		var post = $editor.text().trim();
		var length = post.length;

		if (length > 125) {
			if ($editor.hasClass('postbg-container')) {
				var selection = window.getSelection();
				var range = selection.rangeCount > 0 ? selection.getRangeAt(0) : null;

				$editor.removeClass('postbg-container').attr('style', '');
				$('.postbg-input').val('');

				if (range) {
					selection.removeAllRanges();
					selection.addRange(range);
				}
			}
		}
	});

	$('body').on('click', '#ossn-wall-postbg span', function () {
		var $type = $(this).attr('data-postbg-type');
		var $editor = $('.ossn-wall-textarea');
		var rawDOM = $editor[0];

		if ($editor.text().trim().length > 125) {
			Ossn.trigger_message(Ossn.Print('postbackground:too:long'), 'error');
			return;
		}

		if (rawDOM.lastChild && rawDOM.lastChild.nodeType === 1 && $(rawDOM.lastChild).attr('contenteditable') === 'false') {
			var spaceNode = document.createTextNode('\u00A0');
			rawDOM.appendChild(spaceNode);
		}

		$.each($listsbg, function () {
			if (this['name'] == $type) {
				$editor.addClass('postbg-container').css({
					'background': 'url("' + this['url'] + '")',
					'background-position': 'center',
					'background-size': 'cover',
					'color': this['color_hex'],
				});
				$('.postbg-input').val($type);
				return false;
			}
		});

		$editor.focus();
		var selection = window.getSelection();
		var range = document.createRange();
		range.selectNodeContents(rawDOM);
		range.collapse(false);
		selection.removeAllRanges();
		selection.addRange(range);
	});

	$(document).ajaxComplete(function (event, xhr, settings) {
		var $url = settings.url;
		var $pagehandler = $url.replace(Ossn.site_url, '');

		if ($pagehandler.indexOf('action/wall/post') >= 0) {
			$('.ossn-wall-textarea').removeClass('postbg-container').attr('style', '');
			$('.postbg-input').val('');

			$('#ossn-wall-postbg').hide().attr('data-toggle', 0);
		}
	});
});