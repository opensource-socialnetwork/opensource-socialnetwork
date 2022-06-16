//<script>
Ossn.RegisterStartupFunction(function() {
	$(document).ready(function() {
		$('#ossn-group-add').on('click', function() {
			Ossn.MessageBox('groups/add');
		});
	});
});
Ossn.RegisterStartupFunction(function() {
	$(document).ready(function() {
		$('body').on('submit', "#group-upload-cover", function(event) {
			event.preventDefault();
			var formData = new FormData($(this)[0]);
			var $url = Ossn.site_url + 'action/group/cover/upload';
			var fileInput = $('#group-upload-cover').find("input[type='file']")[0],
				file = fileInput.files && fileInput.files[0];
			var image_url = window.URL.createObjectURL(file);

			loadGroupCover(image_url).then(
				function resolved(img) {
					var width = img.naturalWidth,
						height = img.naturalHeight;
					window.URL.revokeObjectURL(img.src);
					if (width < 1040 || height < 300) {
						Ossn.trigger_message(Ossn.Print('profile:cover:err1:detail'), 'error');
						return false;
					} else {
						$.ajax({
							url: Ossn.AddTokenToUrl($url),
							type: 'POST',
							data: formData,
							async: true,
							cache: false,
							contentType: false,
							processData: false,
							beforeSend: function(xhr, obj) {
								if ($('.ossn-group-cover').length == 0) {
									$('.header-users').attr('style', 'opacity:0.7;');
								} else {
									$('.ossn-group-cover').attr('style', 'opacity:0.7;');
								}
								$('.ossn-group-profile').find('.groups-buttons').find('a').hide();
								if($('.ossn-group-cover').length == 0){
									 $('.ossn-group-top-row .profile-header').prepend('<div class="ossn-group-cover"><img id="draggable"></div>');
								}
								$('.ossn-group-cover').prepend('<div class="ossn-covers-uploading-annimation"> <div class="ossn-loading"></div></div>');
							},
							success: function(callback) {
								if(callback['success']) {
									$time = $.now();
									$('.ossn-group-cover').find('img').attr('style', '');
									$('.ossn-group-cover').find('img').show();
									$('.ossn-group-cover').find('img').attr('src', callback['url']);
								} else {
									// server side errors like exceeded max_upload_size go here
									Ossn.trigger_message(callback['error'], 'error');
								}
								$('.ossn-group-cover').attr('style', '');
								$('.ossn-covers-uploading-annimation').remove();
								$('.ossn-group-profile').find('.groups-buttons').find('a').show();
							},
							error: function(xhr, status, error) {
								// network errors
								if (error == 'Internal Server Error' || error !== '') {
									Ossn.MessageBox('syserror/unknown');
								}
							},
						});
					}
				},
				function rejected() {
					// client side errors like invalid image
					Ossn.trigger_message(Ossn.Print('upload:file:error:extension'), 'error');
				}
			);

			function loadGroupCover(url) {
				// Define the promise
				const imgPromise = new Promise(function imgPromise(resolve, reject) {
					// Create the image
					const imgElement = new Image();
					// When image is loaded, resolve the promise
					imgElement.addEventListener('load', function imgOnLoad() {
						resolve(this);
					});
					// When there's an error during load, reject the promise
					imgElement.addEventListener('error', function imgOnError() {
						reject();
					})
					// Assign URL
					imgElement.src = url;
				});
				return imgPromise;
			}
		});

		$('#add-cover-group').on('click', function(e) {
			e.preventDefault();
			$('#group-upload-cover').find('.coverfile').click();
		});
	});
});

Ossn.RegisterStartupFunction(function() {
	$(document).ready(function() {
		$('#reposition-group-cover').on('click', function() {
			$('.group-c-position').attr('style', 'display:inline-block !important;');
			$('.ossn-group-cover-button').hide();
			$('.ossn-group-cover').unbind('mouseenter').unbind('mouseleave');
			Ossn.Drag();
		});
	});
});

Ossn.RegisterStartupFunction(function() {
	$(document).ready(function() {
		$('.ossn-group-cover').on('mouseenter', function(){
			$('.ossn-group-cover-button').show();
		});
		$('.ossn-group-cover').on('mouseleave', function(){
			$('.ossn-group-cover-button').hide();
		});			
	});
});

Ossn.repositionGroupCOVER = function($group) {
	var cover_top  = parseInt($('.ossn-group-cover').find('img').css('top'));
	var cover_left = parseInt($('.ossn-group-cover').find('img').css('left'));
	var $url = Ossn.site_url + "action/group/cover/reposition";
	$.ajax({
		async: true,
		type: 'post',
		data: '&top=' + cover_top + '&left=' + cover_left + '&group=' + $group,
		url: Ossn.AddTokenToUrl($url),
		success: function(callback) {
			$("#draggable").draggable('destroy');
			$('.group-c-position').attr('style', 'display:none !important;');
			$('.ossn-group-cover').hover(function() {
				$('.ossn-group-cover-button').show();
			}, function() {
				$('.ossn-group-cover-button').hide();
			});
		},
	});
};
							
Ossn.RegisterStartupFunction(function() {
	$(document).ready(function() {
		$('.ossn-group-change-owner').on('click', function(e) {
			e.preventDefault();
			var new_owner = $(this).attr('data-new-owner');
			var is_admin  = $(this).attr('data-is-admin');
			if (is_admin) {
				var del = confirm(Ossn.Print('group:memb:make:owner:admin:confirm', [new_owner]));
			} else {
				var del = confirm(Ossn.Print('group:memb:make:owner:confirm', [new_owner]));
			}
			if (del == true) {
				var actionurl = $(this).attr('href');
				window.location = actionurl;
			}
		});
	});
});