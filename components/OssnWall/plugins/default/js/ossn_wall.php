/**
 * 	Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence 
 * @link      https://www.opensource-socialnetwork.org/
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
        $('body').on('click', '.ossn-wall-container-menu-post', function(e){
        	e.preventDefault();
            $('.ossn-wall-container-data-post').hide();
            $('.ossn-wall-container-data-post').show();
        });
        $('body').on('click', '.ossn-wall-post-delete', function(e) {
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

        $('body').delegate('.ossn-wall-post-edit', 'click', function() {
            var $dataguid = $(this).attr('data-guid');
            Ossn.MessageBox('post/edit/' + $dataguid);
        });
    });

});
Ossn.RegisterStartupFunction(function() {
    $(document).ready(function() {
        if ($.isFunction($.fn.tokenInput)) {
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
        }
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
            action: true,
            containMedia: true,
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

                //need to clear file path after uploading the file #626
                var $file = $("#ossn-wall-form").find("input[type='file']");
                $file.replaceWith($file.val('').clone(true));
                $('#ossn-wall-photo').hide();

                //Tagged friend(s) and location should be cleared, too - after posting #641
                $("#ossn-wall-location-input").val('');
                $('#ossn-wall-location').hide();
     
                $('#ossn-wall-friend-input').val('');
                if($('#ossn-wall-friend-input').length){
	                $("#ossn-wall-friend-input").tokenInput("clear");
	                $('#ossn-wall-friend').hide();
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
 * Remove google map search API as it requires API #906 
 * 
 * @return void
 */
Ossn.RegisterStartupFunction(function() {
    $(document).ready(function() {
        if ($('#ossn-wall-location-input').length) {
            //Location autocomplete not working over https #1043
            //Change to places js
            var placesAutocomplete = places({
                container: document.querySelector('#ossn-wall-location-input')
            });
        }
    });
});
