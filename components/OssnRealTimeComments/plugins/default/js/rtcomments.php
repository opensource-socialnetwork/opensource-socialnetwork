//<script>
$.fn.isInViewComments = function() {
	var win = $(window);

	var viewport = {
		top: win.scrollTop(),
		left: win.scrollLeft()
	};
	viewport.right = viewport.left + win.width();
	viewport.bottom = viewport.top + win.height();

	var bounds = this.offset();
	if (!bounds) {
		return false;
	}
	bounds.right = bounds.left + this.outerWidth();
	bounds.bottom = bounds.top + this.outerHeight();

	return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));

};
$(document).ready(function() {
	var comment_typing_send;
	$('body').on('focus', '.comment-box', function() {
		$btype = false;
		if ($(this).parent().parent().find('input[name="post"]').length) {
			$guid = $(this).parent().parent().find('input[name="post"]').val();
			$btype = 'post';
		}
		if ($(this).parent().parent().find('input[name="entity"]').length) {
			$guid = $(this).parent().parent().find('input[name="entity"]').val();
			$btype = 'entity';
		}
		if (!$btype) {
			return false;
		}
		var $status = {
			url: Ossn.site_url + 'action/rtcomments/setstatus?type=' + $btype + '&guid=' + $guid,
			action: true,
			callback: function() {}
		};
		Ossn.PostRequest($status);
		comment_typing_send = setInterval(function() {
			Ossn.PostRequest($status);
		}, 3000);
	});
	$('body').on('blur', '.comment-box', function() {
		if ($(this).parent().parent().find('input[name="post"]').length) {
			$btype = 'post';
		}
		if ($(this).parent().parent().find('input[name="entity"]').length) {
			$btype = 'entity';
		}
		clearInterval(comment_typing_send);
	});
});
Ossn.commentTyping = function($guid, $type) {
	//Ossn <5.3 we don't know eather the comment list is for entities comments or the posts comments
	//so we need to add unique id for post/entity
	$addids = $(".ctyping-" + $type + "-" + $guid);
	$firstlist = $addids.parent().children(':first');
	if ($firstlist.length) {
		$firstclass = $firstlist.attr('class');
		if ($firstclass.indexOf('ossn-comments-list') >= 0) {
			if (!$firstlist.hasClass("ossn-comments-list-" + $type.charAt(0) + "" + $guid)) {
				$firstlist.addClass("ossn-comments-list-" + $type.charAt(0) + "" + $guid);
			}
		}
	}
	var $cguid = $guid;
	var $ctype = $type;
	var $elem = $('.ctyping-' + $ctype + '-' + $cguid);
	var $timestamp = $('.ctyping-' + $ctype + '-' + $cguid).attr('data-time');

	var $status = {
		url: Ossn.site_url + 'action/rtcomments/status?guid=' + $cguid + '&type=' + $ctype,
		action: true,
		callback: function(callback) {
			if (callback['status'] == 'typing') {
				$elem.find('.ctyping-c-item').fadeIn('slow');
			} else {
				$elem.find('.ctyping-c-item').fadeOut('slow');
			}
			if (callback['lists'] != '') {
				for(i=0;i < callback['lists'].length;i++){
					$id = $($.parseHTML(callback['lists'][i])).attr('id');
					$id = $id.replace(/[^0-9]/g, "");
					if($id && $('#comments-item-'+$id).length == 0){
						$(".ossn-comments-list-" + $type.charAt(0) + "" + $guid).append(callback['lists'][i]).fadeIn();	
					}
				}
			}
		}
	};
	setInterval(function() {
		if ($('.ctyping-' + $ctype + '-' + $cguid).isInViewComments()) {
			if ($(".ossn-comments-list-" + $type.charAt(0) + "" + $guid).find('.comments-item').length) {
				var $ids = new Array();
				$($(".ossn-comments-list-" + $type.charAt(0) + "" + $guid).find('.comments-item')).each(function() {
					$ids.push($(this).attr('id').replace('comments-item-', ''));
				});
				//console.log($ids.join(','));
				$status['params'] = '&comments_ids=' + $ids.join(',') + '&timestamp=' + $timestamp;
			}
			Ossn.PostRequest($status);
		} else {
			$elem.find('.ctyping-c-item').fadeOut('slow');
		}
	}, 4000);
};
