/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
Ossn.PostComment = function($container) {
    Ossn.ajaxRequest({
        url: Ossn.site_url + 'action/post/comment',
        form: '#comment-container-' + $container,
        beforeSend: function(request) {
            $('#comment-box-' + $container).attr('readonly', 'readonly');
        },
        callback: function(callback) {
            if (callback['process'] == 1) {
                $('#comment-box-' + $container).removeAttr('readonly');
                $('#comment-box-' + $container).val('');
                $('.ossn-comments-list-' + $container).append(callback['comment']);
                $('#comment-attachment-container-' + $container).hide();
                $('#ossn-comment-attachment-' + $container).find('.image-data').html('');
            }
            if (callback['process'] == 0) {
                $('#comment-box-' + $container).removeAttr('readonly');
                Ossn.MessageBox('syserror/unknown');
            }
        }
    });
};
Ossn.EntityComment = function($container) {
    Ossn.ajaxRequest({
        url: Ossn.site_url + 'action/post/entity/comment',
        form: '#comment-container-' + $container,
        beforeSend: function(request) {
            $('#comment-box-' + $container).attr('readonly', 'readonly');
        },
        callback: function(callback) {
            if (callback['process'] == 1) {
                $('#comment-box-' + $container).removeAttr('readonly');
                $('#comment-box-' + $container).val('');
                $('.ossn-comments-list-' + $container).append(callback['comment']);
                $('#comment-attachment-container-' + $container).hide();
                $('#ossn-comment-attachment-' + $container).find('.image-data').html('');
            }
            if (callback['process'] == 0) {
                $('#comment-box-' + $container).removeAttr('readonly');
                Ossn.MessageBox('syserror/unknown');
            }
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
Ossn.RegisterStartupFunction(function() {
    $(document).ready(function() {
        $(document).delegate('.ossn-delete-comment', 'click', function(e) {
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
                }
            });
        });
    });
});
Ossn.CommentImage = function($container) {
    $(document).ready(function() {
        $("#ossn-comment-image-file-" + $container).on('change', function(event) {
            event.preventDefault();
            var formData = new FormData($('#ossn-comment-attachment-' + $container)[0]);
            $.ajax({
                url: Ossn.site_url + 'comment/attachment',
                type: 'POST',
                data: formData,
                async: true,
                beforeSend: function() {
                    $('#ossn-comment-attachment-' + $container).find('.image-data')
                        .html('<img src="' + Ossn.site_url + 'components/OssnComments/images/loading.gif" style="width:30px;border:none;" />');
                    $('#comment-attachment-container-' + $container).show();

                },
                cache: false,
                contentType: false,
                processData: false,
                success: function(callback) {
                    if (callback['type'] == 1) {
                        $('#comment-container-' + $container).find('input[name="comment-attachment"]').val(callback['file']);
                        $('#ossn-comment-attachment-' + $container).find('.image-data')
                            .html('<img src="' + Ossn.site_url + 'comment/staticimage?image=' + callback['file'] + '" />');
                    }
                    if (callback['type'] == 0) {
                        $('#comment-container-' + $container).find('input[name="comment-attachment"]').val('');
                        $('#comment-attachment-container-' + $container).hide();
                        Ossn.MessageBox('syserror/unknown');
                    }

                },
            });

        });
    });

};
Ossn.RegisterStartupFunction(function() {
    $(document).ready(function() {
    	$('body').delegate('.comment-post', 'click', function(){
        	var $guid = $(this).attr('data-guid');
            if($guid){
            	$("#comment-box-"+$guid).focus();
            }
        });
    });
});