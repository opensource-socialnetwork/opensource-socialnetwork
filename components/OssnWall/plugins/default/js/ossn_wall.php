/**
 * 	Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence 
 * @link      http://www.opensource-socialnetwork.org/licence
 */
Ossn.RegisterStartupFunction(function() {
	$(document).ready(function() {
		$('.ossn-wall-container').find('.ossn-wall-friend').click(function() {
			$('#ossn-wall-location').hide();
			$('#ossn-wall-photo').hide();
			$('#ossn-wall-friend').show();
		});
		$('.ossn-wall-container').find('.ossn-wall-location').click(function() {
			$('#ossn-wall-friend').hide();
			$('#ossn-wall-photo').hide();
			$('#ossn-wall-location').show();
		});
		$('.ossn-wall-container').find('.ossn-wall-photo').click(function() {
			$('#ossn-wall-friend').hide();
			$('#ossn-wall-location').hide();
			$('#ossn-wall-photo').show();

		});
		$('.ossn-wall-post-delete').click(function(e) {
			$url = $(this);
			e.preventDefault();
			Ossn.PostRequest({
				url: $url.attr('href'),
				beforeSend: function(request) {
					$('#activity-item-' + $url.attr('data-guid')).attr('style', 'opacity:0.5;');
				},
				callback: function(callback) {
					if (callback == 1) {
						$('#activity-item-' + $url.attr('data-guid')).fadeOut();
						$('#activity-item-' + $url.attr('data-guid')).remove();
					} else {
						$('#activity-item-' + $url.attr('data-guid')).attr('style', 'opacity:1;');
					}
				}
			});

		});
	});
});
Ossn.RegisterStartupFunction(function() {
	$(document).ready(function() {
		$("#ossn-wall-friend-input").tokenInput(Ossn.site_url + "friendpicker", {
			placeholder: Ossn.Print('tag:friends'),
			hintText: false,
			propertyToSearch: "first_name",
			resultsFormatter: function(item) {
				return "<li>" + "<img src='" + item.imageurl + "' title='" + item.first_name + " " + item.last_name + "' height='25px' width='25px' />" + "<div style='display: inline-block; padding-left: 10px;'><div class='full_name' style='font-weight:bold;color:#2B5470;'>" + item.first_name + " " + item.last_name + "</div></div></li>"
			},
			tokenFormatter: function(item) {
				return "<li><p>" + item.first_name + " " + item.last_name + "</p></li>"
			},
		});

	});
});
Ossn.PostMenu = function($id) {
	$element = $($id).find('.menu-links');
	if ($element.is(":not(:visible)")) {
		$element.show();
	} else {
		$element.hide();
	}
};
Ossn.RegisterStartupFunction(function() {
	$(document).ready(function() {
		$('.ossn-wall-privacy').on('click', function(e) {
			Ossn.MessageBox('post/privacy');
		});
		$('#ossn-wall-privacy').on('click', function(e) {
			var wallprivacy = $('#ossn-wall-privacy-container').find('input[name="privacy"]:checked').val();
			$('#ossn-wall-privacy').val(wallprivacy);
			Ossn.MessageBoxClose();
		});
			//ajax post
			$url = $('#ossn-wall-form').attr('action');
            Ossn.ajaxRequest({
				url: $url,
                action:true,
                containMedia:true,
				form: '#ossn-wall-form',

				beforeSend: function(request) {
					$('#ossn-wall-form').find('input[type=submit]').hide();
					$('#ossn-wall-form').find('.ossn-loading').removeClass('ossn-hidden');
				},
				callback: function(callback) {
					if (callback['success']) {
						Ossn.trigger_message(callback['success']);
						if (callback['data']['post']) {
							$('.user-activity').prepend(callback['data']['post']).fadeIn();
						}
					}
					if (callback['error']) {
						Ossn.trigger_message(callback['error'], 'error');
					}
					$('#ossn-wall-form').find('input[type=submit]').show();
					$('#ossn-wall-form').find('.ossn-loading').addClass('ossn-hidden');
                    $('#ossn-wall-form').find('textarea').val("");                    
				}
			});
		});

});
/**
 * Setup Google Location input
 *
 * @return void
 */
Ossn.RegisterStartupFunction(function() {
    $(document).ready(function() {
        if ($('#ossn-wall-location-input').length) {
            var autocomplete;
            if (typeof google === 'object') {
                autocomplete = new google.maps.places.Autocomplete(
                    /** @type {HTMLInputElement} */
                    (document.getElementById('ossn-wall-location-input')), {
                        types: ['geocode']
                    });
                google.maps.event.addListener(autocomplete, 'place_changed', function() {});
            }
        }
    });
});
