//<script>
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
Ossn.register_callback('ossn', 'init', 'ossn_comment_init');
Ossn.register_callback('ossn', 'init', 'ossn_comment_delete_handler');
Ossn.register_callback('ossn', 'init', 'ossn_comment_edit');
Ossn.register_callback('ossn', 'init', 'ossn_comment_post_sm_button');

function ossn_comments_replace_tags(input, allowed) {
    allowed = (((allowed || '') + '').toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join('')
    var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi
    var commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>|&nbsp;/gi
    return input.replace(commentsAndPhpTags, '').replace(tags, function($0, $1) {
        return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : ''
    });
}
Ossn.PostComment = function($container) {
    $('#comment-box-p' + $container).on('keypress', function(e) {
        if ($('.comment-post-btn').is(":visible") === false) {
            if (e.which == 13) {
                if (e.shiftKey === false) {
                    //Postings and comments with same behaviour #924
                    $text = $('#comment-box-p' + $container).html();
                    $text = ossn_comments_replace_tags($text, '<br>').replace(/\<br\\?>/g, "\n");
                    $('#comment-container-p' + $container).append("<textarea name='comment' class='hidden'>" + $text + "</textarea>");
                    $('#comment-container-p' + $container).submit();
                }
            }
        }
    });
    $('#comment-box-p' + $container).on('paste', function(e) {
        e.preventDefault();
        var text = (e.originalEvent || e).clipboardData.getData('text/plain') || prompt('Paste something..');
        window.document.execCommand('insertText', false, text);
    });
    Ossn.ajaxRequest({
        url: Ossn.site_url + 'action/post/comment',
        form: '#comment-container-p' + $container,
        beforeSend: function(request) {
            $('#comment-box-p' + $container).attr('readonly', 'readonly');
            $('#comment-box-p' + $container).attr('contenteditable', false);
        },
        callback: function(callback) {
            if (callback['process'] == 1) {
                $('#comment-box-p' + $container).removeAttr('readonly');
                $('#comment-box-p' + $container).val('');
                $('.ossn-comments-list-p' + $container).append(callback['comment']);
                $('#comment-attachment-container-p' + $container).hide();
                $('#ossn-comment-attachment-p' + $container).find('.image-data').html('');
                //commenting pic followed by text gives warnings #664 $dev.githubertus
                $('#comment-container-p' + $container).find('input[name="comment-attachment"]').val('');
            }
            if (callback['process'] == 0) {
                $('#comment-box-p' + $container).removeAttr('readonly');
                Ossn.MessageBox('syserror/unknown');
            }
            $('#comment-box-p' + $container).attr('contenteditable', true);
            $('#comment-box-p' + $container).html("");
            Ossn.trigger_callback('comment', 'post:callback', {
                guid: $container,
                response: callback,
            });
        }
    });
};
Ossn.ObjectComment = function($container) {
    $('#comment-box-o' + $container).on('keypress', function(e) {
		 if ($('.comment-post-btn').is(":visible") === false) {													 
        if (e.which == 13) {
            if (e.shiftKey === false) {
                //Postings and comments with same behaviour #924
                $text = $('#comment-box-o' + $container).html();
                $text = ossn_comments_replace_tags($text, '<br>').replace(/\<br\\?>/g, "\n");
                $('#comment-container-o' + $container).append("<textarea name='comment' class='hidden'>" + $text + "</textarea>");
                $('#comment-container-o' + $container).submit();
            }
        }
		 }
    });
    $('#comment-box-o' + $container).on('paste', function(e) {
        e.preventDefault();
        var text = (e.originalEvent || e).clipboardData.getData('text/plain') || prompt('Paste something..');
        window.document.execCommand('insertText', false, text);
    });
    Ossn.ajaxRequest({
        url: Ossn.site_url + 'action/post/object/comment',
        form: '#comment-container-o' + $container,
        beforeSend: function(request) {
            $('#comment-box-o' + $container).attr('readonly', 'readonly');
            $('#comment-box-o' + $container).attr('contenteditable', false);
        },
        callback: function(callback) {
            if (callback['process'] == 1) {
                $('#comment-box-o' + $container).removeAttr('readonly');
                $('#comment-box-o' + $container).val('');
                $('.ossn-comments-list-o' + $container).append(callback['comment']);
                $('#comment-attachment-container-o' + $container).hide();
                $('#ossn-comment-attachment-o' + $container).find('.image-data').html('');
                //commenting pic followed by text gives warnings #664 $dev.githubertus
                $('#comment-container-o' + $container).find('input[name="comment-attachment"]').val('');
            }
            if (callback['process'] == 0) {
                $('#comment-box-o' + $container).removeAttr('readonly');
                Ossn.MessageBox('syserror/unknown');
            }
            $('#comment-box-o' + $container).attr('contenteditable', true);
            $('#comment-box-o' + $container).html("");
            Ossn.trigger_callback('comment', 'object:callback', {
                guid: $container,
                response: callback,
            });
        }
    });
};
Ossn.EntityComment = function($container) {
    $('#comment-box-e' + $container).on('keypress', function(e) {
		 if ($('.comment-post-btn').is(":visible") === false) {													 
        if (e.which == 13) {
            if (e.shiftKey === false) {
                //Postings and comments with same behaviour #924
                $text = $('#comment-box-e' + $container).html();
                $text = ossn_comments_replace_tags($text, '<br>').replace(/\<br\\?>/g, "\n");
                $('#comment-container-e' + $container).append("<textarea name='comment' class='hidden'>" + $text + "</textarea>");
                $('#comment-container-e' + $container).submit();
            }
        }
		 }
    });
    $('#comment-box-e' + $container).on('paste', function(e) {

        e.preventDefault();
        var text = (e.originalEvent || e).clipboardData.getData('text/plain') || prompt('Paste something..');
        window.document.execCommand('insertText', false, text);
    });
    Ossn.ajaxRequest({
        url: Ossn.site_url + 'action/post/entity/comment',
        form: '#comment-container-e' + $container,
        beforeSend: function(request) {
            $('#comment-box-e' + $container).attr('readonly', 'readonly');
            $('#comment-box-e' + $container).attr('contenteditable', false);

        },
        callback: function(callback) {
            if (callback['process'] == 1) {
                $('#comment-box-e' + $container).removeAttr('readonly');
                $('#comment-box-e' + $container).val('');
                $('.ossn-comments-list-e' + $container).append(callback['comment']);
                $('#comment-attachment-container-e' + $container).hide();
                $('#ossn-comment-attachment-e' + $container).find('.image-data').html('');
                $('#comment-container-e' + $container).find('input[name="comment-attachment"]').val('');
            }
            if (callback['process'] == 0) {
                $('#comment-box-e' + $container).removeAttr('readonly');
                Ossn.MessageBox('syserror/unknown');
            }
            $('#comment-box-e' + $container).attr('contenteditable', true);
            $('#comment-box-e' + $container).html("");
            Ossn.trigger_callback('comment', 'entity:callback', {
                guid: $container,
                response: callback,
            });
        }
    });
};
Ossn.CommentMenu = function($id) {
    $element = $($id).find('.menu-links');
    if ($element.is(":not(:visible)")) {
        $element.show();
        $($id).find('.drop-down-arrow').attr('style', 'display:block;');
    } else {
        $element.hide();
        $($id).find('.drop-down-arrow').attr('style', '');
    }
};

function ossn_comment_delete_handler() {
    $(document).ready(function() {
        $('body').on('click', '.ossn-delete-comment', function(e) {
            e.preventDefault();
            $comment = $(this);
            $url = $comment.attr('href');
            $comment_id = Ossn.UrlParams('comment', $url);

            Ossn.PostRequest({
                url: $url,
                action: false,
                beforeSend: function() {
                    $('#comments-item-' + $comment_id).attr('style', 'opacity:0.6;');
                },
                callback: function(callback) {
                    if (callback == 1) {
                        $('#comments-item-' + $comment_id).fadeOut().remove();
                    }
                    if (callback == 0) {
                        $('#comments-item-' + $comment_id).attr('style', 'opacity:0.6;');
                    }
                    Ossn.trigger_callback('comment', 'delete:callback', {
                        id: $comment_id,
                        response: callback,
                    });
                }
            });
        });
    });
}
Ossn.CommentImage = function($container, $ftype) {
	$ftype = $ftype[0]; // '[p]ost' or '[e]ntity' or '[o]bject'
    $(document).ready(function() {
        $("#ossn-comment-image-file-" + $ftype + "" + $container).on('change', function(event) {
            event.preventDefault();
            var formData = new FormData($('#ossn-comment-attachment-' + $ftype + '' + $container)[0]);
            $.ajax({
                url: Ossn.site_url + 'comment/attachment',
                type: 'POST',
                data: formData,
                async: true,
                beforeSend: function() {
                    $('#ossn-comment-attachment-' + $ftype + '' + $container).find('.image-data')
                        .html('<img src="' + Ossn.site_url + 'components/OssnComments/images/loading.gif" style="width:30px;border:none;height: initial;" />');
                    $('#comment-attachment-container-' + $ftype + '' + $container).show();

                },
                cache: false,
                contentType: false,
                processData: false,
                success: function(callback) {
					if (callback['success']) {
						$('#comment-container-' + $ftype + '' + $container).find('input[name="comment-attachment"]').val(callback['file']);
						$('#ossn-comment-attachment-' + $ftype + '' + $container).find('.image-data')
							.html('<img src="' + Ossn.site_url + 'comment/staticimage?image=' + callback['file'] + '" />');
					} else {
						if (callback['error']) { 
							$('#comment-container-' + $ftype + '' + $container).find('input[name="comment-attachment"]').val('');
							$('#comment-attachment-container-' + $ftype + '' + $container).hide();
							$('.ossn-message-box').html(callback['error']).fadeIn();
						} else {
							Ossn.MessageBox('syserror/unknown');
						}
					}
					Ossn.trigger_callback('comment', 'attachment:image:callback', {
						guid: $container,
						type: $ftype,
						response: callback,
					});
				},
				error: function(xhr, status, error) {
					if (error == 'Internal Server Error' || error !== '') {
						Ossn.MessageBox('syserror/unknown');
					}
				},
            });
        });
    });
};

function ossn_comment_edit() {
    $(document).ready(function() {
        $('body').on('click', '.ossn-edit-comment', function() {
            var $dataguid = $(this).attr('data-guid');
            Ossn.MessageBox('comment/edit/' + $dataguid);
        });
        //comment edit
        Ossn.ajaxRequest({
            url: Ossn.site_url + "action/comment/edit",
            containMedia: true,
            form: '#ossn-comment-edit-form',
            beforeSend: function() {
                $('#ossn-comment-edit-form').find('textarea').hide();
                $('#ossn-comment-edit-form').append('<div class="ossn-loading ossn-box-loading"></div>');
            },
            callback: function(callback) {
                if (callback['success']) {
                    $text = $('#ossn-comment-edit-form').find('#comment-edit').val();
                    $guid = $('#ossn-comment-edit-form').find('input[name="guid"]').val();
                    $elem = $("#comments-item-" + $guid).find('.comment-contents').find('.comment-text:first');
                    if ($elem) {
                        $elem.text('');
                        Ossn.PostRequest({
                            url: Ossn.site_url + "action/comment/embed",
                            // params: 'content=' + $text,
                            // make '+' characters work
                            // see https://stackoverflow.com/questions/1373414/ajax-post-and-plus-sign-how-to-encode
                            params: 'content=' + encodeURIComponent($text) + '&guid=' + $guid,
                            callback: function(return_data) {
                                $elem.append(return_data['data']);
                                Ossn.trigger_callback('comment', 'edit:callback', {
                                    guid: $guid,
                                    response: return_data,
                                });
                            }
                        });
                    }
                    Ossn.trigger_message(callback['success']);
                }
                if (callback['error']) {
                    Ossn.trigger_message(callback['error'], 'error');
                }
                Ossn.MessageBoxClose();
            }
        });
        //comment-edit />									
    });
}

function ossn_comment_post_sm_button() {
    $(document).ready(function() {
        $('body').on('click', '.comment-post-btn', function() {
            $type = $(this).attr('data-type');
            $guid = $(this).attr('data-guid');
            if ($type == 'p' || $type == 'o' || $type == 'e') {
                $text = $('#comment-box-'+ $type +'' + $guid).html();
                $container = $('#comment-container-'+ $type +'' + $guid);
            }
            $text = ossn_comments_replace_tags($text, '<br>').replace(/\<br\\?>/g, "\n");
            $container.append("<textarea name='comment' class='hidden'>" + $text + "</textarea>");
            $container.submit();
        });
    });
}

function ossn_comment_init() {
    $(document).ready(function() {
        $('body').on('click', '.comment-post', function() {
            var $guid = $(this).attr('data-guid');
            if ($guid) {
                $("#comment-box-p" + $guid).focus();
            }
        });
        $('body').on('click', '.comment-entity', function() {
            var $guid = $(this).attr('data-guid');
            if ($guid) {
                $("#comment-box-e" + $guid).focus();
            }
        });
        $('body').on('click', '.comment-object', function() {
            var $guid = $(this).attr('data-guid');
            if ($guid) {
                $("#comment-box-o" + $guid).focus();
            }
        });
    });
}
