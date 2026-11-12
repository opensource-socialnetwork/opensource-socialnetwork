//<script>
$(document).ready(function() {
    $('body').on('click', '.ossn-comments-view-all', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        var type = $(this).attr('data-type');
        var guid = $(this).attr('data-guid');
        var acl = $(this).attr('data-acl');
        var bpage = $(this).attr('data-businesspage');

        acl = 'yes';
        if (acl == 0) {
            acl = 'no';
        }

        page_guid = 0;
        url = Ossn.site_url + 'action/comments/all?type=' + type + '&guid=' + guid + '&acl=' + acl;
        if (bpage) {
            url = Ossn.site_url + 'action/comments/all?type=' + type + '&guid=' + guid + '&acl=' + acl + '&bpage_guid=' + bpage;
        }

        $(this).parent().fadeOut();

        var $list = $('.ossn-comments-list-' + type + guid);
        $list.addClass("ossn-comments-loading");
        $list.html("<div class='p-4'><div class='ossn-loading mx-auto'></div></div>");

        Ossn.PostRequest({
            url: url,
            callback: function(result) {
                if (result.list) {
                    $list.html(result.list);
                }
            }
        });

        return false;
    });

    $("#business-page-cover-file").on('change', function() {
        var fileInput = $('#upload-cover-page').find("input[type=file]")[0];
        var file = fileInput.files && fileInput.files[0];

        if (file) {
            var img = new Image();
            img.src = window.URL.createObjectURL(file);

            img.onload = function() {
                var width = img.naturalWidth;
                var height = img.naturalHeight;

                var theme_config = $('#ossn-theme-config');
                var default_cover_height = theme_config.attr('data-desktop-cover-height');
                var default_cover_width = theme_config.attr('data-minimum-cover-image-width');

                window.URL.revokeObjectURL(img.src);

                if (width < default_cover_width || height < default_cover_height) {
                    var error = Ossn.Print('bpage:cover:err1:detail', [default_cover_width, default_cover_height]);
                    Ossn.trigger_message(error, 'error');
                    return;
                }
                $('#upload-cover-page').trigger('submit');
            };
        }
    });

    var $profile_cover_original_html = '';
    Ossn.ajaxRequest({
        url: Ossn.site_url + 'action/bpage/cover/add',
        action: true,
        containMedia: true,
        form: '#upload-cover-page',
        error: function(xhr, status, error) {
            if ((error == 'Internal Server Error' || error !== '') && status !== 'abort') {
                Ossn.MessageBox('syserror/unknown');
            }
            $('#change-bpcover-btn').html($profile_cover_original_html);
        },
        beforeSend: function() {
            // Save original HTML and extract just the text to keep button size stable
            $profile_cover_original_html = $('#change-bpcover-btn').html();
            var textOnly = $('#change-bpcover-btn').text().trim();
            $('#change-bpcover-btn').html("<div class='ossn-loading d-inline-block me-2' style='width:16px; height:16px; border-width:2px; vertical-align:middle;'></div>" + textOnly);
        },
        callback: function(code) {
            $('#change-bpcover-btn').html($profile_cover_original_html);
            if (code == 0) {
                Ossn.trigger_message(Ossn.Print('bpage:cover:upload:error'), 'error');
            } else {
                var $time = $.now();
                $('.business-page-cover-img').attr('src', code);
                $('#reposition-cover-page').removeClass('d-none').show();
            }
        }
    });
});

Ossn.RegisterStartupFunction(function() {
    $(document).ready(function() {
        /**
         * Reposition cover page
         */
        $('#reposition-cover-page').on('click', function() {
            $('#reposition-cover-page').hide();
            $('#change-bpcover-btn').hide(); // Hide camera during drag
            $('#save-position-cover-page').css('display', 'inline-block');
            $('#draggable').css('cursor', 'move');

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

                        Ossn.PageCover_top = newTop;
                        Ossn.PageCover_left = newLeft;
                    }
                });
            });
        });

        Ossn.ajaxRequest({
            url: Ossn.site_url + 'action/bpage/photo/add',
            action: true,
            containMedia: true,
            form: '#upload-photo-page',
            error: function(xhr, status, error) {
                window.location.reload();
            },
            beforeSend: function(xhr) {
                $('.business-page .upload-photo').addClass('user-photo-uploading');
            },
            callback: function(code) {
                if (code == 0) {
                    Ossn.trigger_message(Ossn.Print('bpage:cover:upload:error'), 'error');
                    window.location.reload();
                } else {
                    $time = $.now();
                    $('.business-page .logo-page').attr('src', code).attr('style', '');
                    $('.business-page .upload-photo').removeClass('user-photo-uploading');
                }
            }
        });

        $('body').on('click', '.like-page', function() {
            var $element = $(this);
            var $guid = $element.attr('data-guid');
            var btnText = $element.text().trim();
            
            Ossn.PostRequest({
                url: Ossn.site_url + "action/bpage/like?guid=" + $guid,
                beforeSend: function() {
                    $element.html("<div class='ossn-loading d-inline-block me-2' style='width:16px; height:16px; border-width:2px; vertical-align:middle;'></div>" + btnText);
                },
                callback: function(callback) {
                    if (callback == 0) {
                        $element.html("<i class='fa fa-thumbs-up me-2'></i>" + Ossn.Print('ossn:like'));
                    }
                    if (callback == 1) {
                        $element.html("<i class='fa fa-thumbs-down me-2'></i>" + Ossn.Print('ossn:unlike'));
                        $element.removeClass('like-page').addClass('unlike-page');
                    }
                }
            });
        });

        $('body').on('click', '.unlike-page', function() {
            var $element = $(this);
            var $guid = $element.attr('data-guid');
            var btnText = $element.text().trim();

            Ossn.PostRequest({
                url: Ossn.site_url + "action/bpage/unlike?guid=" + $guid,
                beforeSend: function() {
                    $element.html("<div class='ossn-loading d-inline-block me-2' style='width:16px; height:16px; border-width:2px; vertical-align:middle;'></div>" + btnText);
                },
                callback: function(callback) {
                    if (callback == 0) {
                        $element.html("<i class='fa fa-thumbs-down me-2'></i>" + Ossn.Print('ossn:unlike'));
                    }
                    if (callback == 1) {
                        $element.html("<i class='fa fa-thumbs-up me-2'></i>" + Ossn.Print('ossn:like'));
                        $element.addClass('like-page').removeClass('unlike-page');
                    }
                }
            });
        });

        $('body').on('click', '#bpage-upload-photo-btn', function() {
            Ossn.Clk("#upload-photo-page input[type='file']");
        });

        $('body').on('click', '#save-position-cover-page', function() {
            var $btn = $(this);
            var originalHTML = $btn.html();
            var btnText = $btn.text().trim();
            
            var $pcover_top = $('.business-page-cover-img').css('top');
            var $pcover_left = $('.business-page-cover-img').css('left');
            var $guid = $('.business-page-cover-img').attr('data-guid');

            Ossn.PostRequest({
                url: Ossn.site_url + "action/bpage/cover/save?guid=" + $guid + "&top=" + $pcover_top + '&left=' + $pcover_left,
                beforeSend: function() {
                    $btn.html("<div class='ossn-loading d-inline-block me-2' style='width:16px; height:16px; border-width:2px; vertical-align:middle;'></div>" + btnText);
                },
                callback: function(callback) {
                    $btn.html(originalHTML);
                    if (callback == 0) {
                        location.reload();
                    } else {
                        $('#reposition-cover-page').show();
                        $('#change-bpcover-btn').show();
                        $('#save-position-cover-page').hide();
                        $('#draggable').draggable("destroy").css('cursor', 'default');
                    }
                }
            });
        });
    });
});