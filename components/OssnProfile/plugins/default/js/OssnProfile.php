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
Ossn.RegisterStartupFunction(function() {
	$(document).ready(function() {
		/**
		 * Reposition cover
		 */
		$('#reposition-profile-cover').on('click', function() {
			$('#profile-menu').hide();
			$('#cover-menu').show();
			$('.profile-cover-controls').hide();
			Ossn.Drag(function(ui) {
				
				//make picture not to move out from the container
				y1 = $('.profile-cover').height();
				y2 = $('.profile-cover').find('img').height();
				if (ui.position.top >= 0) {
					ui.position.top = 0;
				} else if (ui.position.top <= (y1 - y2)) {
					ui.position.top = y1 - y2;
				}
				
				var current_cover_height = 0;
				var current_cover_width = 0;
				if ($('.profile-cover').length) {
					current_cover_height = ~~($('.profile-cover').height() + 0.5);
					current_cover_width = ~~($('.profile-cover').width() + 0.5);
				} else if ($('.ossn-group-cover').length) {
					current_cover_height = ~~($('.ossn-group-cover').height() + 0.5);
					current_cover_width = ~~($('.ossn-group-cover').width() + 0.5);
				}
				if (current_cover_width < 1024) {
					var theme_config = $('#ossn-theme-config');
					var default_cover_height = theme_config.attr('data-desktop-cover-height');
					var default_cover_width = theme_config.attr('data-minimum-cover-image-width');

					// we're on mobile
					const desktop_cover_width = default_cover_width;
					const desktop_cover_height = default_cover_height;

					var real_image_width = document.querySelector("#draggable").naturalWidth;
					var real_image_height = document.querySelector("#draggable").naturalHeight;
					// 1. how many mobile heights would we need to hold the image?
					var mobile_height_factor = real_image_height / current_cover_height;
					// 2. how many pixels wide would be the scaled mobile image in comparison to fix desktop_cover_width?
					var mobile_pixel_width = desktop_cover_width / mobile_height_factor;
					// 3. how often would these pixels fit into the current coverwidth?
					var mobile_width_factor = current_cover_width / mobile_pixel_width;
					// 4. how many pixels do we get with the current mobile cover height?
					var mobile_pixel_height = mobile_width_factor * current_cover_height;
					mobile_pixel_width = parseInt($('#draggable').css('width'));

					// 5. calculate the height-scaling factor for dragging - get maximum possible scroll top position
					var desktop_scroll_top_max = real_image_height - desktop_cover_height;
					var mobile_scroll_top_max = mobile_pixel_height - current_cover_height;
					var height_scaling_factor = desktop_scroll_top_max / mobile_scroll_top_max;
					// 6. calculate the width-scaling factor for dragging - get maximum possible scroll left position
					var desktop_scroll_left_max = real_image_width - desktop_cover_width;
					var mobile_scroll_left_max = mobile_pixel_width - current_cover_width;
					var width_scaling_factor = desktop_scroll_left_max / mobile_scroll_left_max;

					var cover_top = parseInt(ui.position.top);
					var cover_left = parseInt(ui.position.left);

					var mobile_pixel_top = cover_top * height_scaling_factor;
					var mobile_pixel_left = cover_left * width_scaling_factor;
					
					$('.profile-cover-img').attr('data-scaled_top', parseInt(mobile_pixel_top)+"px");
					$('.profile-cover-img').attr('data-scaled_left', parseInt(mobile_pixel_left)+"px");
				}
			});
		});
		$("#upload-photo").on('submit', function(event) {
			event.preventDefault();
			var formData = new FormData($(this)[0]);
			var $url = Ossn.site_url + 'action/profile/photo/upload';
			$.ajax({
				url: Ossn.AddTokenToUrl($url),
				type: 'POST',
				data: formData,
				async: true,
				beforeSend: function() {
					$('.upload-photo').attr('class', 'user-photo-uploading');
				},
				error: function(xhr, status, error) {
					if (error == 'Internal Server Error' || error !== '') {
						Ossn.MessageBox('syserror/unknown');
					}
				},
				cache: false,
				contentType: false,
				processData: false,
				success: function(callback) {
					if (callback['success']) {
						$time = $.now();
						$imageurl = $('.profile-photo').find('img').attr('src') + '?' + $time;
						$('.profile-photo').find('img').attr('src', $imageurl);
						$topbar_icon_url = $('.ossn-topbar-menu').find('img').attr('src') + '?' + $time;
						$('.ossn-topbar-menu').find('img').attr('src', $topbar_icon_url);
					} else {
						// errors like file too large, not allowed type, etc...
						Ossn.trigger_message(callback['error'], 'error');
					}
					$('.user-photo-uploading').attr('class', 'upload-photo');
				}
			});
		});

		$("#upload-cover").on('submit', function(event) {
			event.preventDefault();
			var formData = new FormData($(this)[0]);
			var $url = Ossn.site_url + 'action/profile/cover/upload';
			var fileInput = $('#upload-cover').find("input[type=file]")[0],
				file = fileInput.files && fileInput.files[0];
			var image_url = window.URL.createObjectURL(file);

			loadProfileCover(image_url).then(
				function resolved(img) {
					var width = img.naturalWidth;
					var height = img.naturalHeight;
					window.URL.revokeObjectURL(img.src);

					//[E] Get size of cover from theme config #2305
					var theme_config = $('#ossn-theme-config');
					var default_cover_height = theme_config.attr('data-desktop-cover-height');
					var default_cover_width = theme_config.attr('data-minimum-cover-image-width');

					if (typeof default_cover_height == 'undefined' || typeof default_cover_width == 'undefined') {
						Ossn.MessageBox('syserror/unknown');
						console.error("Theme config not found for cover sizes");
						return false;
					}
					if (width < default_cover_width || height < default_cover_height) {
						var cover_error_message = Ossn.Print('profile:cover:err1:detail', [default_cover_width, default_cover_height]);
						Ossn.trigger_message(cover_error_message, 'error');
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
								$('.profile-cover').prepend('<div class="ossn-covers-uploading-annimation"> <div class="ossn-loading"></div></div>');
								$('.profile-cover-img').attr('class', 'user-cover-uploading');
							},
							success: function(callback) {
								if (callback['success']) {
									$time = $.now();
									$('.profile-cover').find('img').addClass('profile-cover-img');
									$imageurl = $('.profile-cover').find('img').attr('src') + '?' + $time;
									$('.profile-cover').find('img').attr('src', $imageurl);
									$('.profile-cover').find('img').attr('style', '');
									$('.profile-cover').find('img').show();
								} else {
									// server side errors like exceeded max_upload_size go here
									Ossn.trigger_message(callback['error'], 'error');
								}
								$('.profile-cover').find('img').removeClass('user-cover-uploading');
								$('.ossn-covers-uploading-annimation').remove();
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

			function loadProfileCover(url) {
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

		/* Profile extra menu */
		$('#profile-extra-menu').on('click', function() {
			$div = $('.ossn-profile-extra-menu').find('div');
			if ($div.is(":not(:visible)")) {
				$div.show();
			} else {
				$div.hide();
			}
		});
	});

});

Ossn.repositionCOVER = function() {
	var cover_elem  = $('.profile-cover-img');
	var $pcover_top = cover_elem.css('top');
	var $pcover_left = cover_elem.css('left');
	
	if(cover_elem.attr('data-scaled_top')){
		$pcover_top = cover_elem.attr('data-scaled_top'); 
	}
	if(cover_elem.attr('data-scaled_left')){
		$pcover_left = cover_elem.attr('data-scaled_left'); 
	}
	
	$url = Ossn.site_url + "action/profile/cover/reposition";
	$.ajax({
		async: true,
		type: 'post',
		data: '&top=' + $pcover_top + '&left=' + $pcover_left,
		url: Ossn.AddTokenToUrl($url),
		success: function(callback) {
			$("#draggable").draggable('destroy');
			$('#profile-menu').show();
			$('#cover-menu').hide();

			$('.profile-cover-controls').show();
		},
	});
};