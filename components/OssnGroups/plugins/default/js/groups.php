Ossn.RegisterStartupFunction(function() {
	$(document).ready(function() {
		$('#ossn-group-add').click(function() {
			Ossn.MessageBox('groups/add');
		});
	});
});

Ossn.RegisterStartupFunction(function() {
	$(document).ready(function() {
		$("#group-upload-cover").submit(function(event) {
			event.preventDefault();
			var formData = new FormData($(this)[0]);
			var $url = Ossn.site_url + 'action/group/cover/upload';
			$.ajax({
				url: Ossn.AddTokenToUrl($url),
				type: 'POST',
				data: formData,
				async: true,
				beforeSend: function(xhr, obj) {
					if ($('.ossn-group-cover').length == 0) {
						$('.header-users').attr('style', 'opacity:0.7;');
					} else {
						$('.ossn-group-cover').attr('style', 'opacity:0.7;');
					}
					var fileInput = $('#group-upload-cover').find("input[type='file']")[0],
						file = fileInput.files && fileInput.files[0];

					if (file) {
						var img = new Image();

						img.src = window.URL.createObjectURL(file);

						img.onload = function() {
							var width = img.naturalWidth,
								height = img.naturalHeight;

							window.URL.revokeObjectURL(img.src);
							if (width < 850 || height < 300) {
								xhr.abort();
								Ossn.trigger_message(Ossn.Print('profile:cover:err1:detail'), 'error');
								return false;
							}
						};
					}
				},
				cache: false,
				contentType: false,
				processData: false,
				success: function(callback) {
					if (callback['type'] == 1) {
						if ($('.ossn-group-cover').length == 0) {
							location.reload();
						} else {
							$('.ossn-group-cover').attr('style', '');
							$('.ossn-group-cover').find('img').attr('style', '');
							$('.ossn-group-cover').find('img').attr('src', callback['url']);
						}
					}
					if (callback['type'] == 0) {
						Ossn.MessageBox('syserror/unknown');
					}
				}
			});
			return false;
		});

		$('#add-cover-group').click(function(e) {
			e.preventDefault();
			$('#group-upload-cover').find('.coverfile').click();
		});
	});
});




Ossn.RegisterStartupFunction(function() {
	$(document).ready(function() {
		$('#reposition-cover').click(function() {
			$('.group-c-position').attr('style', 'display:inline-block !important;');
			$(function() {
				$.globalVars = {
					originalTop: 0,
					originalLeft: 0,
					maxHeight: $("#draggable").height() - $("#container").height(),
					maxWidth: $("#draggable").width() - $("#container").width()
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

						Ossn.GroupCover_top = newTop;
						Ossn.GroupCover_left = newLeft;
					}
				});
			});
		});
	});
});

Ossn.RegisterStartupFunction(function() {
	$(document).ready(function() {
		$('.ossn-group-cover').hover(function() {
			$('.ossn-group-cover-button').show();
		}, function() {
			$('.ossn-group-cover-button').hide();
		});
	});
});

Ossn.repositionGroupCOVER = function($group) {
	var $url = Ossn.site_url + "action/group/cover/reposition";
	$.ajax({
		async: true,
		type: 'post',
		data: '&top=' + Ossn.GroupCover_top + '&left=' + Ossn.GroupCover_left + '&group=' + $group,
		url: Ossn.AddTokenToUrl($url),
		success: function(callback) {
			$('.group-c-position').attr('style', 'display:none !important;');
			$("#draggable").draggable({
				drag: function() {
					return false;
				}
			});
		},
	});
};