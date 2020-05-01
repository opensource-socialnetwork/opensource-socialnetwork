//<script>
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
Ossn.RegisterStartupFunction(function() {
	$(document).ready(function() {
		var cYear = (new Date).getFullYear();
		var alldays = Ossn.Print('datepicker:days');
		var shortdays = alldays.split(",");
		var allmonths = Ossn.Print('datepicker:months');
		var shortmonths = allmonths.split(",");

		var datepick_args = {
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd/mm/yy',
			yearRange: '1900:' + cYear,
		};

		if (Ossn.isLangString('datepicker:days')) {
			datepick_args['dayNamesMin'] = shortdays;
		}
		if (Ossn.isLangString('datepicker:months')) {
			datepick_args['monthNamesShort'] = shortmonths;
		}
		$("input[name='birthdate']").datepicker(datepick_args);

		/**
		 * Reposition cover
		 */
		$('#reposition-profile-cover').click(function() {
			$('#profile-menu').hide();
			$('#cover-menu').show();
			$('.profile-cover-controls').hide();
			$('.profile-cover').unbind('mouseenter').unbind('mouseleave');
			Ossn.Drag();
		});
		$("#upload-photo").submit(function(event) {
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
					$time = $.now();
					$('.user-photo-uploading').attr('class', 'upload-photo').hide();
					$imageurl = $('.profile-photo').find('img').attr('src') + '?' + $time;
					$('.profile-photo').find('img').attr('src', $imageurl);
					$topbar_icon_url = $('.ossn-topbar-menu').find('img').attr('src') + '?' + $time;
					$('.ossn-topbar-menu').find('img').attr('src', $topbar_icon_url);
				}
			});

			return false;
		});

		$("#upload-cover").submit(function(event) {
			event.preventDefault();
			//console.log('no');
			var formData = new FormData($(this)[0]);
			var $url = Ossn.site_url + 'action/profile/cover/upload';
			var fileInput = $('#upload-cover').find("input[type=file]")[0],
				file = fileInput.files && fileInput.files[0];

			if (file) {
				var img = new Image();
				img.src = window.URL.createObjectURL(file);

				img.onload = function() {
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
								$('.profile-cover').prepend('<div class="ossn-covers-uploading-annimation"> <div class="ossn-loading"></div></div>');
								$('.profile-cover-img').attr('class', 'user-cover-uploading');
							},
							success: function(callback) {
								$time = $.now();
								$('.profile-cover').find('img').removeClass('user-cover-uploading');
								$('.profile-cover').find('img').addClass('profile-cover-img');
								$imageurl = $('.profile-cover').find('img').attr('src') + '?' + $time;
								$('.profile-cover').find('img').attr('src', $imageurl);
								$('.profile-cover').find('img').attr('style', '');
								$('.profile-cover').find('img').show();
								$('.ossn-covers-uploading-annimation').remove();
							},
						});
					}
				};
			}

			return false;
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
	var $pcover_top = $('.profile-cover-img').css('top');
	var $pcover_left = $('.profile-cover-img').css('left');
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
			$('.profile-cover').hover(function() {
				$('.profile-cover-controls').show();
			}, function() {
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
Ossn.RegisterStartupFunction(function() {
	$(document).ready(function() {
		$('.profile-photo').hover(function() {
			$('.upload-photo').slideDown();
		}, function() {
			$('.upload-photo').slideUp();
		});
	});
});
/**
 * Setup a profile cover buttons
 *
 * @return void
 */
Ossn.RegisterStartupFunction(function() {
	$(document).ready(function() {
		$('.profile-cover').hover(function() {
			$('.profile-cover-controls').show();
		}, function() {
			$('.profile-cover-controls').hide();
		});
	});
});