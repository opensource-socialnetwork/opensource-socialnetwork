//<script>
/**
 * Close a Ossn message box
 *
 * @return void
 */
Ossn.MessageBoxClose = function() {
	$('.ossn-message-box').hide();
	$('.ossn-halt').removeClass('ossn-light').hide();
	$('.ossn-halt').attr('style', '');

};
/**
 * Load Message box
 *
 * @return void
 */
Ossn.MessageBox = function($url) {
	Ossn.PostRequest({
		url: Ossn.site_url + $url,
		beforeSend: function() {
			$('.ossn-halt').addClass('ossn-light');
			$('.ossn-halt').attr('style', 'height:' + $(document).height() + 'px;');
			$('.ossn-halt').show();
			$('.ossn-message-box').html('<div class="ossn-loading ossn-box-loading"></div>');
			$('.ossn-message-box').fadeIn('slow');
		},
		callback: function(callback) {
			$('.ossn-message-box').html(callback).fadeIn();
		},
	});

};
/**
 * Load a media viewer
 *
 * @return void
 */
Ossn.Viewer = function($url) {
	Ossn.PostRequest({
		url: Ossn.site_url + $url,

		beforeSend: function() {
			$('.ossn-halt').removeClass('ossn-light');
			$('.ossn-halt').show();
			$('.ossn-viewer').html('<table class="ossn-container"><tr><td class="image-block" style="text-align: center;width:100%;"><div class="ossn-viewer-loding">Loading...</div></td></tr></table>');
			$('.ossn-viewer').show();
		},
		callback: function(callback) {
			$('.ossn-viewer').html(callback).show();
		},
	});
};
/**
 * Close a media viewer
 *
 * @return void
 */
Ossn.ViewerClose = function($url) {
	$('.ossn-halt').addClass('ossn-light');
	$('.ossn-halt').hide();
	$('.ossn-viewer').html('');
	$('.ossn-viewer').hide();
};
/**
 * Add a system messages for users
 *
 * @param string $messages Message for user
 * @param string $type Message type success (default) or error
 *
 * @return void
 */
Ossn.trigger_message = function($message, $type) {
	$type = $type || 'success';
	if ($type == 'error') {
		//compitable to bootstrap framework
		$type = 'danger';
	}
	if ($message == '') {
		return false;
	}
	$html = "<div class='alert alert-" + $type + "'><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>" + $message + "</div>";
	$('.ossn-system-messages').find('.ossn-system-messages-inner').append($html);
	if ($('.ossn-system-messages').find('.ossn-system-messages-inner').is(":not(:visible)")) {
		$('.ossn-system-messages').find('.ossn-system-messages-inner').slideDown('slow');
	}
	setTimeout(function(){ 
		$('.ossn-system-messages').find('.ossn-system-messages-inner').empty().hide()
	}, 10000);
};
/**
 * Dragging support of images
 * currently used by OssnProfile and OssnGroups
 *
 * @return void
 */
Ossn.Drag = function() {
	// some sanitizing to work with fluid themes and covers eventually resized according to screen width
	const default_cover_width  = 1040;
	const default_cover_height = 200;
	var image_width  = document.querySelector("#draggable").naturalWidth;
	var image_height = document.querySelector("#draggable").naturalHeight;
	var cover_width  = $("#container").width();
	var cover_height = $("#container").height();
	var drag_width   = 0;
	var drag_height  = 0;
	// TODO: get rid of hardcoded dimensions
	// the calculation below relies on current cover images HAVE a minimum width of 1040px
	// which shouldn't be a must-have for every other theme
	if(image_width > cover_width && image_width + cover_width > default_cover_width * 2) {
		drag_width = image_width - default_cover_width;
	}
	if(image_height > cover_height && image_height + cover_height > default_cover_height * 2) {
		drag_height = image_height - default_cover_height;
	}
	$.globalVars = {
		originalTop: 0,
		originalLeft: 0,
		maxHeight: drag_height,
		maxWidth: drag_width
	};
	$("#draggable").draggable({
		start: function(event, ui) {
			if (ui.position != undefined) {
				$.globalVars.originalTop = ui.position.top;
				$.globalVars.originalLeft = ui.position.left;
			}
		},
		drag: function(event, ui) {
			var newTop = ui.position.top;
			var newLeft = ui.position.left;
			if (ui.position.top < 0 && ui.position.top * -1 > $.globalVars.maxHeight) {
				newTop = $.globalVars.maxHeight * -1;
			}
			if (ui.position.top > 0) {
				newTop = 0;
			}
			if (ui.position.left < 0 && ui.position.left * -1 > $.globalVars.maxWidth) {
				newLeft = $.globalVars.maxWidth * -1;
			}
			if (ui.position.left > 0) {
				newLeft = 0;
			}
			ui.position.top = newTop;
			ui.position.left = newLeft;
		}
	});
};	
/**
 * Message done
 *
 * @param $message = message
 *
 * @return mix data
 */
Ossn.MessageDone = function($message) {
	return "<div class='ossn-message-done'>" + $message + "</div>";
};