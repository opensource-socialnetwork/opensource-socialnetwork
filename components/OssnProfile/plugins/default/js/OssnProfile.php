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
Ossn.RegisterStartupFunction(function () {
	$(document).ready(function () {
		/**
		 * Reposition cover
		 */
		$('#reposition-profile-cover').on('click', function () {
			$('#profile-menu').hide();
			$('#cover-menu').show();
			$('.profile-cover-controls').hide();
			$('.profile-cover').unbind('mouseenter').unbind('mouseleave');
			Ossn.Drag();
		});
		$("#upload-photo").on('submit', function (event) {
			event.preventDefault();
			var formData = new FormData($(this)[0]);
			var $url = Ossn.site_url + 'action/profile/photo/upload';
			$.ajax({
				url: Ossn.AddTokenToUrl($url),
				type: 'POST',
				data: formData,
				async: true,
				beforeSend: function () {
					$('.upload-photo').attr('class', 'user-photo-uploading');
				},
				error: function (xhr, status, error) {
					if (error == 'Internal Server Error' || error !== '') {
						Ossn.MessageBox('syserror/unknown');
					}
				},
				cache: false,
				contentType: false,
				processData: false,
				success: function (callback) {
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
					$('.user-photo-uploading').attr('class', 'upload-photo').hide();
				}
			});
		});

		$("#upload-cover").on('submit', function (event) {
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
							beforeSend: function (xhr, obj) {
								$('.profile-cover').prepend('<div class="ossn-covers-uploading-annimation"> <div class="ossn-loading"></div></div>');
								$('.profile-cover-img').attr('class', 'user-cover-uploading');
							},
							success: function (callback) {
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
							error: function (xhr, status, error) {
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
		$('#profile-extra-menu').on('click', function () {
			$div = $('.ossn-profile-extra-menu').find('div');
			if ($div.is(":not(:visible)")) {
				$div.show();
			} else {
				$div.hide();
			}
		});
	});

});

Ossn.repositionCOVER = function () {
	var $pcover_top = $('.profile-cover-img').css('top');
	var $pcover_left = $('.profile-cover-img').css('left');
	$url = Ossn.site_url + "action/profile/cover/reposition";
	$.ajax({
		async: true,
		type: 'post',
		data: '&top=' + $pcover_top + '&left=' + $pcover_left,
		url: Ossn.AddTokenToUrl($url),
		success: function (callback) {
			$("#draggable").draggable('destroy');
			$('#profile-menu').show();
			$('#cover-menu').hide();

			$('.profile-cover').on('mouseenter', function () {
				$('.profile-cover-controls').show();
			});
			$('.profile-cover').on('mouseleave', function () {
				$('.profile-cover-controls').hide();
			});
		},
	});
};
/**
 * Setup a profile photo buttons
 *
 * @return void
 */
Ossn.RegisterStartupFunction(function () {
	$(document).ready(function () {
		$('.profile-photo').on('mouseenter', function () {
			$('.upload-photo').slideDown();
		});
		$('.profile-photo').on('mouseleave', function () {
			$('.upload-photo').slideUp();
		});
	});
});
/**
 * Setup a profile cover buttons
 *
 * @return void
 */
Ossn.RegisterStartupFunction(function () {
	$(document).ready(function () {
		$('.profile-cover').on('mouseenter', function () {
			$('.profile-cover-controls').show();
		});
		$('.profile-cover').on('mouseleave', function () {
			$('.profile-cover-controls').hide();
		});
	});
});
