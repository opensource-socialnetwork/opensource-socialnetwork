/**
 * 	Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
//<script> 
jQuery.fn.visibleInScroll = function (goDeep) {
    var parent = $(this[0]).scrollParent()[0],
        elRect = this[0].getBoundingClientRect(),
        rects = [ parent.getBoundingClientRect() ];
    elRect = {
        left: elRect.left, 
        top: elRect.top, 
        right: elRect.right, 
        bottom: elRect.bottom,
        width: elRect.width,
        height: elRect.height,
        visibleWidth: elRect.width,
        visibleHeight: elRect.height,
        isVisible: true,
        isContained: true
    };
    var elWidth = elRect.width,
        elHeight = elRect.height;
    if (parent === this[0].ownerDocument) {
        return elRect;
    }
    
    while (parent !== this[0].ownerDocument && parent !== null) {
        if (parent.scrollWidth > parent.clientWidth || parent.scrollHeight > parent.clientHeight) {
            rects.push(parent.getBoundingClientRect());
        }
        if (rects.length && goDeep) { break; }
        parent = $(parent).scrollParent()[0];
    }
    if (!goDeep) {
        rects.length = 1;
    }
    for (var i = 0; i < rects.length; i += 1) {
        var rect = rects[i];
        elRect.left = Math.max(elRect.left, rect.left);
        elRect.top = Math.max(elRect.top, rect.top);
        elRect.right = Math.min(elRect.right, rect.right);
        elRect.bottom = Math.min(elRect.bottom, rect.bottom);
    }
    elRect.visibleWidth = Math.max(0, elRect.right - elRect.left);
    elRect.visibleHeight = elRect.visibleWidth && Math.max(0, elRect.bottom - elRect.top);
    if (!elRect.visibleHeight) { elRect.visibleWidth = 0; }
    elRect.isVisible = elRect.visibleWidth > 0 && elRect.visibleHeight > 0;
    elRect.isContained = elRect.visibleWidth === elRect.width && elRect.visibleHeight === elRect.height;
    return elRect;
}; 
Ossn.MessagesURLparam = function(name, url){
	if(!name || !url){
		return false;	
	}
	//console.log(' url: ' + url);
    // var results = new RegExp('[\?&]' + name + '=([^]*)').exec(url);
	var results = new RegExp('[\?&]' + name + '=([0-9]*)').exec(url);
    if (results == null){
       return null;
    } else{
		//console.log('RESULTS' + JSON.stringify(results));
       return results[1] || false;
    }
};
Ossn.SendMessage = function($user) {
    Ossn.ajaxRequest({
        url: Ossn.site_url + "action/message/send",
        form: '#message-send-' + $user,
        action:true,
        beforeSend: function(request) {
            $('#message-send-' + $user).find('input[type=submit]').hide();
            $('#message-send-' + $user).find('.ossn-loading').removeClass('ossn-hidden');
        },
        callback: function(callback) {
	    if(callback !== '0'){
	          $('#message-append-' + $user).append(callback);
	    }
    	    $('#message-send-' + $user).find('textarea').val('');
       	    $('#message-send-' + $user).find('input[type=submit]').show();
            $('#message-send-' + $user).find('.ossn-loading').addClass('ossn-hidden');
            Ossn.message_scrollMove($user);
        }
    });

};
Ossn.getMessages = function($user, $guid) {
    Ossn.PostRequest({
        url: Ossn.site_url + "messages/getnew/" + $user,
        action: false,
        callback: function(callback) {
            $('#message-append-' + $guid).append(callback);
            if(callback){
            	//Unwanted refresh in message window #416 , there is no need to scroll if no new message.
	            Ossn.message_scrollMove($guid);
            }
        }
    });
};
Ossn.getRecent = function($user) {
    Ossn.PostRequest({
        url: Ossn.site_url + "messages/getrecent/" + $user,
        action: false,
        callback: function(callback) {
            $('#get-recent').html(callback);
            $('#get-recent').addClass('inner');
            $('.messages-from').find('.inner').remove();
            $('#get-recent').appendTo('.messages-from');
            $('#get-recent').show();
        }
    });
};
Ossn.playSound = function() {
    document.getElementById('ossn-chat-sound').play();
};
Ossn.message_scrollMove = function(fid) {
    var message = document.getElementById('message-append-' + fid);
    if (message) {
        message.scrollTop = message.scrollHeight;
        return message.scrollTop;
    }
};
/**<script>*/
$(document).ready(function() {
	$calledOnce = [];
	$('.ossn-messages .messages-recent .messages-from').scroll(function() {
		if ($('.ossn-pagination').visibleInScroll().isVisible) {
			$element = $('.ossn-messages .messages-recent .messages-from .inner .container-table-pagination');
			$next = $element.find('.ossn-pagination .active').next();
			$last = $element.find('.ossn-pagination').find('li:last');
			$last_url = $last.find('a').attr('href');
			$last_offset = Ossn.MessagesURLparam('offset_message_xhr_recent', $last_url);
			var selfElement = $element;
			if ($next) {
				$url = $next.find('a').attr('href');
				$offset = Ossn.MessagesURLparam('offset_message_xhr_recent', $url);
				$url = '?offset_message_xhr_recent=' + $offset;

				//console.log('A R R A Y ' + JSON.stringify($calledOnce));
				//console.log('OFFSET: ' + $offset);
				if ($.inArray($url, $calledOnce) == -1 && $offset > 0) {
					//console.log('BEFORE' + JSON.stringify($calledOnce));
					$calledOnce.push($url); //push to array so we don't need to call ajax request again for processed offset

					Ossn.PostRequest({
						url: Ossn.site_url + 'messages/xhr/recent' + $url,
						beforeSend: function() {
							$('.ossn-messages .messages-recent .messages-from .inner').append('<div class="ossn-messages-pagination-loading"><div class="ossn-loading"></div></div>');
						},
						callback: function(callback) {
							//return false;
							$element = $(callback).find('.inner'); //make callback to jquery object
							if ($element.length) {
								$clone = $element.find('.container-table-pagination').html();
								$element.find('.container-table-pagination').remove(); //remove pagination from contents as we'll replace contents of already existing pagination.

								$('.ossn-messages .messages-recent .messages-from .inner').append($element.html()); //append the new data
								selfElement.html($clone); //set pagination content with new pagination contents
								selfElement.appendTo('.ossn-messages .messages-recent .messages-from .inner'); //append the pagnation back to at end
								$('.ossn-messages .messages-recent .messages-from .inner .ossn-messages-pagination-loading').remove();
								if($offset == $last_offset) {
									$('.ossn-messages .messages-recent .messages-from .inner .container-table-pagination').fadeOut();
								}
							}
							return;
						},
					});
				} //if not in array
			}
		}
	});
});
Ossn.MessageNotifcationPagination = function(event, $calledOnce){
		if ($('.ossn-notification-messages .ossn-pagination').visibleInScroll().isVisible) {
			$element = $('.ossn-notification-messages .container-table-pagination');
			$next = $element.find('.ossn-pagination .active').next();
			$last = $element.find('.ossn-pagination').find('li:last');
			$last_url = $last.find('a').attr('href');
			$last_offset = Ossn.MessagesURLparam('offset_message_xhr_recent', $last_url);
			var selfElement = $element;
			if ($next) {
				$url = $next.find('a').attr('href');
				$offset = Ossn.MessagesURLparam('offset_message_xhr_recent', $url);
				$url = '?offset_message_xhr_recent=' + $offset;

				//console.log('A R R A Y ' + JSON.stringify($calledOnce));
				//console.log('OFFSET: ' + $offset);	
				if ($.inArray($url, $calledOnce) == -1 && $offset > 0) {
					//console.log('BEFORE' + JSON.stringify($calledOnce));
					$calledOnce.push($url); //push to array so we don't need to call ajax request again for processed offset

					Ossn.PostRequest({
						url: Ossn.site_url + 'messages/xhr/notification' + $url,
						beforeSend: function() {
							$('.ossn-notification-messages').append('<div class="ossn-messages-notification-pagination-loading"><div class="ossn-loading"></div></div>');
						},
						callback: function(callback) {
							$element = $(callback).find('.ossn-notification-messages'); //make callback to jquery object
							if ($element.length) {
								$clone = $element.find('.container-table-pagination').html();
								$element.find('.container-table-pagination').remove(); //remove pagination from contents as we'll replace contents of already existing pagination.

								$('.ossn-notification-messages').append($element.html()); //append the new data
								selfElement.html($clone); //set pagination content with new pagination contents
								selfElement.appendTo('.ossn-notification-messages'); //append the pagnation back to at end
								$('.ossn-notification-messages .ossn-messages-notification-pagination-loading').remove();
								if($offset == $last_offset) {
									$('.ossn-notification-messages .container-table-pagination').fadeOut();
								}
							}
							return;
						},
					});
				} //if not in array				
			}
		}
};
//message with user pagination
$(document).ready(function() {
	$calledOnce = [];
	$('.ossn-messages .ossn-widget .message-with .message-inner').scroll(function() {
		if ($('.ossn-messages .ossn-widget .message-with .message-inner .ossn-pagination').visibleInScroll().isVisible) {
			$element = $('.ossn-messages .ossn-widget .message-with .message-inner .container-table-pagination');
			$next = $element.find('.ossn-pagination .active').next();
			$last = $element.find('.ossn-pagination').find('li:last');
			$last_url = $last.find('a').attr('href');
			$last_offset = Ossn.MessagesURLparam('offset_message_xhr_with', $last_url);
			var selfElement = $element;
			if ($next) {
				$url = $next.find('a').attr('href');
				$offset = Ossn.MessagesURLparam('offset_message_xhr_with', $url);
				$url = '?offset_message_xhr_with=' + $offset;

				//console.log('A R R A Y ' + JSON.stringify($calledOnce));
				//console.log('OFFSET: ' + $offset);
				if ($.inArray($url, $calledOnce) == -1 && $offset > 0) {
					//console.log('BEFORE' + JSON.stringify($calledOnce));
					$calledOnce.push($url); //push to array so we don't need to call ajax request again for processed offset
					$user_guid = $('.ossn-messages .ossn-widget .message-with .message-inner').attr('data-guid');
					Ossn.PostRequest({
						url: Ossn.site_url + 'messages/xhr/with' + $url + '&guid='+$user_guid,
						beforeSend: function() {
							$('.ossn-messages .ossn-widget .message-with .message-inner').prepend('<div class="ossn-messages-with-pagination-loading"><div class="ossn-loading"></div></div>').fadeIn();
							if($offset != $last_offset) {
								// adjust the scrollbar a little backward
								// because with Edge and Firefox it may still stay at topmost position
								// hence you can't continue scrolling with your mouse
								var scrollPos = $('.ossn-messages .ossn-widget .message-with .message-inner').scrollTop();
								$('.ossn-messages .ossn-widget .message-with .message-inner').animate({scrollTop: scrollPos + 20}, 80);
							}
						},
						callback: function(callback) {
							//return false;
							$element = $(callback).find('.message-inner'); //make callback to jquery object
							if ($element.length) {
								$clone = $element.find('.container-table-pagination').html();
								$element.find('.container-table-pagination').remove(); //remove pagination from contents as we'll replace contents of already existing pagination.

								$('.ossn-messages .ossn-widget .message-with .message-inner').prepend($element.html()); //append the new data
								selfElement.html($clone); //set pagination content with new pagination contents
								selfElement.prependTo('.ossn-messages .ossn-widget .message-with .message-inner'); //append the pagnation back to at end
								$('.ossn-messages .ossn-widget .message-with .message-inner .ossn-messages-with-pagination-loading').remove();
								if($offset == $last_offset) {
									$('.ossn-messages .ossn-widget .message-with .message-inner .container-table-pagination').fadeOut();
								}
							}
							return;
						},
					});
				} //if not in array **/
			}
		}
	});
});
Ossn.RegisterStartupFunction(function() {
    $(document).ready(function() {
        $('body').on('click', '.ossn-message-delete', function(e) {
            e.preventDefault();
            $text = "<i class='fa fa-times-circle'></i>" + Ossn.Print('ossnmessages:deleted');
            $self   = $(this);
			$parent = $(this).parent().parent();
            $action = $(this).attr('href');
            if ($action) {
                Ossn.PostRequest({
                    url: $action,
                    action: false,
                    callback: function(callback) {
                        if (callback == 1) {
                            if ($parent.hasClass('message-box-sent')) {
                                $parent.find('span').html($text);
				$parent.find('.time-created').hide();
                                $parent.addClass('ossn-message-deleted');
                                $self.remove();
                            }
                        }
                    }
                });
            }
        });
    });
});
$(document).ready(function() {
	var $MessageNotifcationPagination = [];	
	$('body').on('click', '#ossn-notif-messages', function(){
			$MessageNotifcationPagination = [];	//reset the array on reopening the messages box
	});
	document.addEventListener('scroll',function(event){
        var $elm = $(event.target);
		if($elm.attr('class') == 'messages-inner' && $elm.parent().parent().hasClass('ossn-notifications-box')){
				Ossn.MessageNotifcationPagination(event, $MessageNotifcationPagination);
		}
		
	},true);	
});
