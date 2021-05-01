//<script>
Ossn.register_callback('ossn', 'init', 'ossn_giphy_close_search_init');

var OssnGiphySearchXHR = false;

function ossn_giphy_search($form, $keyword) {
	//abort previous requests to avoid results mixup
	if (OssnGiphySearchXHR) {
		OssnGiphySearchXHR.abort();
	}
	OssnGiphySearchXHR = Ossn.PostRequest({
		url: Ossn.site_url + 'action/giphy/search?keyword=' + $keyword,
		beforeSend: function() {
			$form.find('.giphy-container-inner .giphy-list').html('<div class="ossn-loading ossn-loading-initial"></div>');
			$form.find('.giphy-container').show();
		},
		callback: function(data) {
			if (data['success'] == true) {
				$form.find('.giphy-container-inner .giphy-list').html('');
				$.each(data['images'], function() {
					$image = "<img id='giphy-item-" + this.id + "' class='img-thumbnail' src='" + this.thumb + "' data-url='" + this.thumb + "' />";
					$form.find('.giphy-container-inner .giphy-list').append($image);
				});
				if (data['pagination_code']) {
					$form.find('.giphy-container-inner .giphy-list').append(data['pagination_code']);
				}
				ossn_giphy_pagination($form);
			}
		},
	});
}

function ossn_giphy_search_offset($form, $keyword, $offset = 0) {
	Ossn.PostRequest({
		url: Ossn.site_url + 'action/giphy/search?keyword=' + $keyword + '&offset_giphy=' + $offset,
		beforeSend: function() {
			$form.find('.giphy-container-inner .giphy-list').append('<div class="ossn-loading"></div>');
		},
		callback: function(data) {
			if (data['success'] == true) {
				$form.find('.giphy-container-inner .giphy-list .ossn-loading').remove();
				$form.find('.giphy-container-inner .giphy-list .container-table-pagination').remove();
				$.each(data['images'], function() {
					$image = "<img id='giphy-item-" + this.id + "' class='img-thumbnail' src='" + this.thumb + "' data-url='" + this.thumb + "' />";
					if ($('#giphy-item-' + this.id).length == 0) {
						$form.find('.giphy-container-inner .giphy-list').append($image);
					} else {
						console.log('Duplicate ' + this.id);
					}
				});
				if (data['pagination_code']) {
					$form.find('.giphy-container-inner .giphy-list').append(data['pagination_code']);
				}
			}
		},
	});
}

function ossn_giphy_close_search_init() {
	$(document).ready(function() {
		$('body').on('click', '.close-giphy-container', function() {
			var $form = $(this).parent().parent().parent().parent().parent();
			$form.find('.giphy-container').hide();
			$form.find('.giphy-container .giphy-list').html('');
			$form.find('.giphy-container .giphy-list .search-giphy').html("");
		});
		$('body').on('click', '.giphy-list img', function() {
			var $form = $(this).parent().parent().parent().parent().parent().parent();
			var $url = $(this).attr('data-url');

			$form.find('textarea').remove();
			$form.find('input[type="file"]').val('');
			$form.append("<textarea name='comment' class='hidden'>" + $url + "</textarea>");

			$form.find('.close-giphy-container').trigger('click');
			$form.submit();

		});
		$('body').on('keyup', '.giphy-comment-icon-container .search-giphy', function(e) {
			if (e.keyCode == 13) {
				e.preventDefault();
				return false;
			}
			var $text = $(this).text();
			var $form = $(this).parent().parent().parent().parent().parent();

			if ($text && $text.length > 2) {
				console.log($form.attr('id'));
				ossn_giphy_search($form, $text);
			}
		});
		$('body').on('click', '.giphy-comment-icon-container .giphy-icon', function() {
			var $form = $(this).parent().parent().parent(); //comment form;
			ossn_giphy_search($form, '');
		});
	});
}

function ossn_giphy_pagination($form) {
	$calledOnce = [];
	$id = $form.attr('id');
	$('#' + $id + ' .giphy-container-inner .giphy-list').on('scroll', function() {
		$pagination_length = $('#' + $id + ' .giphy-container-inner .giphy-list .ossn-pagination').length;
		if ($pagination_length > 0 && $('#' + $id + ' .giphy-container-inner .giphy-list .ossn-pagination').visibleInScroll().isVisible) {

			$element = $('#' + $id + ' .giphy-container-inner .giphy-list .container-table-pagination');
			$next = $element.find('.ossn-pagination .active').next();
			$last = $element.find('.ossn-pagination').find('li:last');
			$last_url = $last.find('a').attr('href');
			$last_offset = Ossn.MessagesURLparam('offset_giphy', $last_url);

			var selfElement = $element;
			if ($next) {
				$url = $next.find('a').attr('href');
				$offset = Ossn.MessagesURLparam('offset_giphy', $url);
				$url = '?offset_giphy=' + $offset;

				if ($.inArray($url, $calledOnce) == -1 && $offset > 0) {
					$calledOnce.push($url); //push to array so we don't need to call ajax request again 
					$keyword = $form.find('.giphy-comment-icon-container .search-giphy').text();
					ossn_giphy_search_offset($form, $keyword, $offset);
				}
			}
		}
	});
}