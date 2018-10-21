//<script>
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
        $('body').on('click', '.ossn-wall-container-menu-post', function(e) {
            e.preventDefault();
            $('.ossn-wall-container-data-post').hide();
            $('.ossn-wall-container-data-post').show();
        });
        $('body').on('click', '.ossn-wall-post-delete', function(e) {
            $url = $(this);
            e.preventDefault();

            // new hack to insert the first posting from next page,
            // if a posting of the current page has been deleted

            // ignore new posts which have just been added
            // because they don't change the current pagination
            // so first check, whether the to be deleted posting has a 'new' attribute
            // see line #284 for marker setting
            $to_be_deleted = $('#activity-item-' + $url.attr('data-guid'));
            var post_attribute = $to_be_deleted.attr('post');
            var old_posting_deleted = false;
            if (typeof post_attribute === 'undefined') {
                // no attribute - so this is an already existing older post

                // check for existance of next page
                $next = $('.user-activity .ossn-pagination').find('.active').next();
                if ($next.length) {
                    var next_url = $next.find('a').attr('href');
                    var results = new RegExp('[\?&]' + 'offset' + '=([0-9]*)').exec(next_url);
                    $offset = results[1] || false;
                    next_url = '?offset=' + $offset;
                    // console.log('NEXT OFFSET: ' + $offset);

                    // remember current page we're on for later use - only needed in case of manual pagination
                    // $offset already pointing to next page here, so substract 1
                    var $current_offset = $offset - 1;

                    Ossn.PostRequest({
                        // IMPORTANT: we should be able to set async to false in the core lib
                        // otherwise we're getting unpredictable results from the callback here
                        // actually with async = true sometimes not the first posting was returned,
                        // but any other one. no idea what's happening there
                        // so I changed Javascript core lib to allow change of default value
                        async: false, // !!!
                        action: false,
                        url: Ossn.site_url + 'home' + next_url,
                        beforeSend: function() {},
                        callback: function(callback) {
                            // try to get the first posting of the next page
                            $element = $(callback).find('.ossn-wall-item').first();
                            //console.log($element);
                            if ($element.length) {
                                //append the posting at the bottom, right before pagination
                                $element.insertBefore('.container-table-pagination');
                                old_posting_deleted = true;
                            }
                            return;
                        },
                    });
                }
            }
            //

            Ossn.PostRequest({
                url: $url.attr('href'),
                async: false,
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
            //

            // needed for manual pagination only!
            <?php
			if(!com_is_active('OssnAutoPagination')) {
			?>
            //console.log('MANUAL PAGINATION');
            if (old_posting_deleted) {
                // find out whether there are still postings on the last page
                // if not, we have to shrink the paginator
                $last = $('.user-activity .ossn-pagination').find('li:last');
                if ($last.length) {
                    var last_url = $last.find('a').attr('href');
                    var results = new RegExp('[\?&]' + 'offset' + '=([0-9]*)').exec(last_url);
                    $offset = results[1] || false;
                    last_url = '?offset=' + $offset;

                    Ossn.PostRequest({
                        async: false,
                        action: false,
                        url: Ossn.site_url + 'home' + last_url,
                        beforeSend: function() {},
                        callback: function(callback) {
                            $element = $(callback).find('.ossn-wall-item').first();
                            //console.log($element);
                            if ($element.length) {
                                // the last page still has entries - do nothing
                                //console.log('LEAVE_PAGINATION AS IS');
                            } else {
                                // pagination needs to be adjusted
                                // so remove old pagination
                                $('.container-table-pagination').remove();
                                // and reload page we're currently on to retrieve a new one
                                var current_url = '?offset=' + $current_offset;
                                //console.log('REFRESH_PAGINATION of current offset: ', $current_offset);
                                Ossn.PostRequest({
                                    async: false,
                                    action: false,
                                    url: Ossn.site_url + 'home' + current_url,
                                    beforeSend: function() {},
                                    callback: function(callback) {
                                        $element = $(callback).find('.container-table-pagination');
                                        //console.log($element);
                                        if ($element.length) {
                                            // and add adjusted one
                                            $element.appendTo('.user-activity');
                                        }
                                        // note: if there's no element found
                                        // we have run into the special case
                                        // offset = 1 and either no postings at all or number of postings < pagelimit
                                        return;
                                    },
                                });
                            }
                            return;
                        },
                    });
                }
            }
            // end of manual pagination part
            <?php
			}
			?>
        });

        //post edit
        Ossn.ajaxRequest({
            url: Ossn.site_url + "action/wall/post/edit",
            containMedia: true,
            form: '#ossn-post-edit-form',
            beforeSend: function() {
                $('#ossn-post-edit-form').find('textarea').hide();
                $('#ossn-post-edit-form').append('<div class="ossn-loading ossn-box-loading"></div>');
            },
            callback: function(callback) {
                if (callback['success']) {
                    $text = $('#ossn-post-edit-form').find('#post-edit').val();
                    $guid = $('#ossn-post-edit-form').find('input[name="guid"]').val();
                    $elem = $("#activity-item-" + $guid).find('.post-contents').find('p:first');
                    if ($elem) {
                        $elem.text($text);
                    }
                    Ossn.trigger_message(callback['success']);
                }
                if (callback['error']) {
                    Ossn.trigger_message(callback['error'], 'error');
                }
                Ossn.MessageBoxClose();
            }
        });
        //post-edit />


        $('body').delegate('.ossn-wall-post-edit', 'click', function() {
            var $dataguid = $(this).attr('data-guid');
            Ossn.MessageBox('post/edit/' + $dataguid);
        });
        //Change the privacy button as per the privacy value #1289
        $('body').on('input', '#ossn-wall-privacy', function() {
            switch (parseInt($(this).val())) {
                case 3:
                    $('.ossn-wall-privacy-lock').removeClass('fa-lock');
                    $('.ossn-wall-privacy-lock').removeClass('fa-globe');
                    $('.ossn-wall-privacy-lock').removeClass('fa-users');
                    $('.ossn-wall-privacy-lock').addClass('fa-users');
                    break;
                case 2:
                    $('.ossn-wall-privacy-lock').removeClass('fa-lock');
                    $('.ossn-wall-privacy-lock').removeClass('fa-globe');
                    $('.ossn-wall-privacy-lock').removeClass('fa-users');
                    $('.ossn-wall-privacy-lock').addClass('fa-globe');
                    break;
            }
        });
        if ($('#ossn-wall-privacy').length) {
            $('#ossn-wall-privacy').trigger('input');
        }
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
            $('#ossn-wall-privacy').trigger("input");
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
                        var new_post = callback['data']['post'];
                        $('.user-activity').prepend(callback['data']['post']).fadeIn();
                        // mark post as 'new' in order to distinguish it on deleting
                        // new posts must not trigger inserts on deleting !!
                        $('.user-activity div').first().attr('post', 'new');
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
                if ($('#ossn-wall-friend-input').length) {
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
